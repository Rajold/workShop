<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Part.php';
require_once __DIR__ . '/../models/CasePart.php';

class InventoryService
{
    private PDO $db;

    private Part $partModel;

    private CasePart $casePartModel;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
        $this->partModel = new Part($pdo);
        $this->casePartModel = new CasePart($pdo);
    }

    public function confirmCart(
        int $caseId,
        int $vehId,
        int $userId,
        int $pendingId = 0
    ): void {
        $cart = $_SESSION['case_cart'][$caseId] ?? [];

        if (empty($cart)) {
            throw new Exception('No hay artículos en el carrito.');
        }

        $this->db->beginTransaction();

        try {

            foreach ($cart as $item) {

                $part = $this->partModel->findById($item['part_id']);

                if (!$part) {
                    throw new Exception(
                        "No existe el artículo {$item['nombre']}."
                    );
                }

                if ($part['stock_actual'] < $item['cantidad']) {
                    throw new Exception(
                        "Stock insuficiente para {$item['nombre']}."
                    );
                }

                $nuevoStock = $part['stock_actual'] - $item['cantidad'];

                if (!$this->partModel->updateStock(
                    $part['id'],
                    $nuevoStock
                )) {
                    throw new Exception(
                        "No fue posible actualizar el stock."
                    );
                }

                if (!$this->partModel->registerMovement([

                    'parte_id'         => $part['id'],
                    'usuario_id'       => $userId,
                    'caso_id'          => $caseId,
                    'tipo'             => 'consumo',
                    'motivo'           => 'Consumo durante reparación',
                    'cantidad'         => $item['cantidad'],
                    'stock_resultante' => $nuevoStock,
                    'costo_unitario'   => $part['costo'],
                    'observacion'      => 'Aplicado desde WorkShop'

                ])) {

                    throw new Exception(
                        "No fue posible registrar el movimiento."
                    );
                }

                $this->casePartModel->add([

                    'caso_id'         => $caseId,

                    'parte_id'        => $part['id'],

                    'usuario_id'      => $userId,

                    'cantidad'        => $item['cantidad'],

                    'costo_unitario'  => $part['costo'],

                    'precio_unitario' => $item['precio_venta'],

                    'subtotal'        => $item['precio_venta'] * $item['cantidad']

                ]);
            }

            if ($pendingId > 0) {

                $pendingModel = new Pending($this->db);

                if (!$pendingModel->resolve(
                    $pendingId,
                    $caseId
                )) {

                    throw new Exception(
                        'No fue posible resolver el pendiente.'
                    );
                }
            }
            $this->db->commit();

            $this->clearCart($caseId);
        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }


    
public function addSinglePartToCase(
    int $caseId,
    int $partId,
    float $quantity,
    float $salePrice,
    int $userId
): void {
    if ($caseId <= 0 || $partId <= 0 || $userId <= 0) {
        throw new Exception('Datos inválidos para agregar el repuesto.');
    }

    if (!is_finite($quantity) || $quantity <= 0) {
        throw new Exception('La cantidad debe ser mayor que cero.');
    }

    if (!is_finite($salePrice) || $salePrice < 0) {
        throw new Exception('El precio de venta no puede ser negativo.');
    }

    $this->db->beginTransaction();

    try {
        $caseModel = new RepairCase($this->db);
        $case = $caseModel->findById($caseId);

        if (!$case) {
            throw new Exception('El caso de reparación no existe.');
        }

        if (strtolower((string)$case['estado']) !== 'abierto') {
            throw new Exception(
                'No se pueden agregar repuestos a un caso cerrado.'
            );
        }

        $part = $this->partModel->findById($partId);

        $stmt = $this->db->prepare("
    SELECT *
    FROM partes
    WHERE id = ?
    FOR UPDATE
");

$stmt->execute([$partId]);
$part = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$part) {
    throw new Exception('El repuesto seleccionado no existe.');
}

        if ((float)$part['stock_actual'] < $quantity) {
            throw new Exception(
                'Stock insuficiente para ' . $part['nombre'] . '.'
            );
        }

        $newStock = (float)$part['stock_actual'] - $quantity;

        if (!$this->partModel->updateStock($partId, $newStock)) {
            throw new Exception('No fue posible actualizar el inventario.');
        }

        if (!$this->partModel->registerMovement([
            'parte_id'         => $partId,
            'usuario_id'       => $userId,
            'caso_id'          => $caseId,
            'tipo'             => 'consumo',
            'motivo'           => 'Consumo durante reparación',
            'cantidad'         => $quantity,
            'stock_resultante' => $newStock,
            'costo_unitario'   => (float)$part['costo'],
            'observacion'      => 'Agregado desde repuestos compatibles'
        ])) {
            throw new Exception('No fue posible registrar el movimiento.');
        }

        if (!$this->casePartModel->add([
            'caso_id'         => $caseId,
            'parte_id'        => $partId,
            'usuario_id'      => $userId,
            'cantidad'        => $quantity,
            'costo_unitario'  => (float)$part['costo'],
            'precio_unitario' => $salePrice,
            'subtotal'        => $salePrice * $quantity
        ])) {
            throw new Exception('No fue posible asociar el repuesto al caso.');
        }

        $this->db->commit();
    } catch (Throwable $e) {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }

        throw $e;
    }
}

    private function clearCart(int $caseId): void
    {
        unset($_SESSION['case_cart'][$caseId]);
    }
}

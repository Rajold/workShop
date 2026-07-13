<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Part.php';
require_once __DIR__ . '/../models/Avance.php';

class InventoryService
{
    private PDO $db;

    private Part $partModel;

    private Avance $avanceModel;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;

        $this->partModel = new Part($pdo);

        $this->avanceModel = new Avance($pdo);
    }

    public function confirmCart(
        int $caseId,
        int $vehId,
        int $userId
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

                $this->avanceModel->add(

                    $caseId,

                    $userId,

                    sprintf(
                        'Repuesto: %s x %s',
                        $item['nombre'],
                        $item['cantidad']
                    ),

                    'Repuesto',

                    (int)($item['precio_venta'] * $item['cantidad'])

                );
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

    private function clearCart(int $caseId): void
    {
        unset($_SESSION['case_cart'][$caseId]);
    }
}

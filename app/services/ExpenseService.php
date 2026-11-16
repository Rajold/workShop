<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Gasto.php';
require_once __DIR__ . '/../models/MovimientoFinanciero.php';

class ExpenseService
{
    private PDO $db;
    private Gasto $gastoModel;
    private MovimientoFinanciero $movimientoModel;

    private const CATEGORIAS = [
        'alimentacion',
        'operativo',
        'herramientas',
        'transporte',
        'imprevisto',
        'otro',
    ];

    private const FORMAS_PAGO = [
        'caja',
        'transferencia',
        'dinero_personal',
    ];

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
        $this->gastoModel = new Gasto($pdo);
        $this->movimientoModel = new MovimientoFinanciero($pdo);
    }

    public function cuentas(): array
    {
        return $this->movimientoModel->cuentas();
    }

    public function register(array $data, int $userId): int
    {
        $descripcion = trim((string)($data['descripcion'] ?? ''));
        $categoria = (string)($data['categoria'] ?? 'otro');
        $valorTexto = trim((string)($data['valor'] ?? ''));
        $formaPago = (string)($data['forma_pago'] ?? 'caja');
        $proveedor = trim((string)($data['proveedor'] ?? ''));
        $observacion = trim((string)($data['observacion'] ?? ''));
        $fecha = trim((string)($data['fecha_gasto'] ?? ''));

        if ($userId <= 0) {
            throw new InvalidArgumentException('No se pudo identificar al usuario.');
        }

        if ($descripcion === '' || mb_strlen($descripcion) > 255) {
            throw new InvalidArgumentException(
                'La descripción es obligatoria y no debe superar 255 caracteres.'
            );
        }

        if (!in_array($categoria, self::CATEGORIAS, true)) {
            throw new InvalidArgumentException('La categoría seleccionada no es válida.');
        }

        if (
            $valorTexto === '' ||
            !is_numeric($valorTexto) ||
            !is_finite((float)$valorTexto) ||
            (float)$valorTexto <= 0
        ) {
            throw new InvalidArgumentException(
                'El valor del gasto debe ser un número mayor que cero.'
            );
        }

        if (!in_array($formaPago, self::FORMAS_PAGO, true)) {
            throw new InvalidArgumentException(
                'La forma de pago seleccionada no es válida.'
            );
        }

        if ($proveedor !== '' && mb_strlen($proveedor) > 255) {
            throw new InvalidArgumentException(
                'El proveedor no debe superar 255 caracteres.'
            );
        }

        if ($fecha === '') {
            $fecha = date('Y-m-d\TH:i');
        }

        $fechaObjeto = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i', $fecha);

        if (!$fechaObjeto || $fechaObjeto->format('Y-m-d\TH:i') !== $fecha) {
            throw new InvalidArgumentException('La fecha del gasto no es válida.');
        }

        return $this->gastoModel->create([
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'valor' => round((float)$valorTexto, 2),
            'fecha_gasto' => $fechaObjeto->format('Y-m-d H:i:s'),
            'registrado_por' => $userId,
            'forma_pago' => $formaPago,
            'proveedor' => $proveedor,
            'observacion' => $observacion,
        ]);
    }

    public function all(
        ?string $estado = null,
        ?string $categoria = null,
        ?int $registradoPor = null
    ): array {
        if ($registradoPor !== null && $registradoPor <= 0) {
            return [];
        }

        return $this->gastoModel->findAll(
            $estado,
            $categoria,
            $registradoPor
        );
    }

    public function findById(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }

        return $this->gastoModel->findById($id);
    }

    public function decide(int $id, int $adminId, string $decision): bool
    {
        if ($id <= 0 || $adminId <= 0) {
            throw new InvalidArgumentException(
                'Los datos de la operación no son válidos.'
            );
        }

        if (!in_array($decision, ['aprobado', 'rechazado'], true)) {
            throw new InvalidArgumentException('La decisión no es válida.');
        }

        return $this->gastoModel->decide($id, $adminId, $decision);
    }

    /**
     * Pagar un gasto aprobado con Caja o Banco.
     * Los gastos personales no generan egreso en esta operación.
     */
    public function markPaid(int $id, int $userId): bool
    {
        if ($id <= 0 || $userId <= 0) {
            throw new InvalidArgumentException('Los datos del pago no son válidos.');
        }

        try {
            $this->db->beginTransaction();

            $gasto = $this->gastoModel->findByIdForUpdate($id);

            if (!$gasto) {
                throw new RuntimeException('El gasto no existe.');
            }

            if (
                $gasto['estado'] !== 'aprobado' ||
                $gasto['estado_pago'] !== 'pendiente'
            ) {
                throw new RuntimeException(
                    'El gasto no está aprobado o ya fue procesado.'
                );
            }

            if ($gasto['forma_pago'] === 'dinero_personal') {
                // No se mueve dinero del taller todavía.
                $this->db->commit();
                return true;
            }

            $tipoCuenta = match ($gasto['forma_pago']) {
                'caja' => 'caja',
                'transferencia' => 'banco',
                default => throw new RuntimeException('Forma de pago no válida.'),
            };

            $cuenta = $this->buscarCuentaPorTipo($tipoCuenta);

            if (!$cuenta) {
                throw new RuntimeException(
                    'No existe una cuenta activa para realizar este pago.'
                );
            }

            $this->verificarMovimientoExistente($id);

            $actualizado = $this->gastoModel->markPaid($id);

            if (!$actualizado) {
                throw new RuntimeException('No se pudo actualizar el estado del gasto.');
            }

            $this->movimientoModel->registrar(
                (int)$cuenta['id'],
                'egreso',
                'salida',
                (float)$gasto['valor'],
                'Pago de gasto #' . $id . ': ' . $gasto['descripcion'],
                $userId,
                null,
                null,
                $id,
                'GASTO-' . $id
            );

            $this->db->commit();

            return true;

        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }

    /**
     * Reembolsar un gasto pagado inicialmente con dinero personal.
     */
    public function markReimbursed(
        int $id,
        int $cuentaId,
        int $userId
    ): bool {
        if ($id <= 0 || $cuentaId <= 0 || $userId <= 0) {
            throw new InvalidArgumentException(
                'Los datos del reembolso no son válidos.'
            );
        }

        try {
            $this->db->beginTransaction();

            $gasto = $this->gastoModel->findByIdForUpdate($id);

            if (!$gasto) {
                throw new RuntimeException('El gasto no existe.');
            }

            if (
                $gasto['estado'] !== 'aprobado' ||
                $gasto['estado_pago'] !== 'pendiente' ||
                $gasto['forma_pago'] !== 'dinero_personal'
            ) {
                throw new RuntimeException(
                    'El gasto no está disponible para reembolso.'
                );
            }

            $cuenta = $this->buscarCuentaPorId($cuentaId);

            if (!$cuenta) {
                throw new RuntimeException('La cuenta seleccionada no está activa.');
            }

            $this->verificarMovimientoExistente($id);

            $actualizado = $this->gastoModel->markReimbursed($id);

            if (!$actualizado) {
                throw new RuntimeException(
                    'No se pudo actualizar el estado del reembolso.'
                );
            }

            $this->movimientoModel->registrar(
                $cuentaId,
                'egreso',
                'salida',
                (float)$gasto['valor'],
                'Reembolso de gasto #' . $id . ': ' . $gasto['descripcion'],
                $userId,
                null,
                null,
                $id,
                'GASTO-' . $id
            );

            $this->db->commit();

            return true;

        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }

    private function buscarCuentaPorTipo(string $tipo): ?array
    {
        foreach ($this->movimientoModel->cuentas() as $cuenta) {
            if ($cuenta['tipo'] === $tipo) {
                return $cuenta;
            }
        }

        return null;
    }

    private function buscarCuentaPorId(int $id): ?array
    {
        foreach ($this->movimientoModel->cuentas() as $cuenta) {
            if ((int)$cuenta['id'] === $id) {
                return $cuenta;
            }
        }

        return null;
    }

    private function verificarMovimientoExistente(int $gastoId): void
    {
        $sql = "
            SELECT id
            FROM movimientos_financieros
            WHERE gasto_id = ?
              AND tipo = 'egreso'
              AND sentido = 'salida'
            LIMIT 1
            FOR UPDATE
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$gastoId]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new RuntimeException(
                'Ya existe un egreso financiero asociado a este gasto.'
            );
        }
    }
}
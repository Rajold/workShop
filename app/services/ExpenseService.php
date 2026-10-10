<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Gasto.php';

class ExpenseService
{
    private Gasto $gastoModel;

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
        'otro',
    ];

    public function __construct(PDO $pdo)
    {
        $this->gastoModel = new Gasto($pdo);
    }

    /**
     * Registrar un gasto. Siempre queda pendiente de aprobación.
     */
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
            throw new InvalidArgumentException(
                'No se pudo identificar al usuario.'
            );
        }

        if ($descripcion === '' || mb_strlen($descripcion) > 255) {
            throw new InvalidArgumentException(
                'La descripción es obligatoria y no debe superar 255 caracteres.'
            );
        }

        if (!in_array($categoria, self::CATEGORIAS, true)) {
            throw new InvalidArgumentException(
                'La categoría seleccionada no es válida.'
            );
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

        $fechaObjeto = DateTimeImmutable::createFromFormat(
            '!Y-m-d\TH:i',
            $fecha
        );

        if (
            !$fechaObjeto ||
            $fechaObjeto->format('Y-m-d\TH:i') !== $fecha
        ) {
            throw new InvalidArgumentException(
                'La fecha del gasto no es válida.'
            );
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
        ?string $categoria = null
    ): array {
        return $this->gastoModel->findAll($estado, $categoria);
    }

    public function findById(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }

        return $this->gastoModel->findById($id);
    }

    /**
     * Solo debe invocarse desde una acción autorizada para administradores.
     */
    public function decide(
        int $id,
        int $adminId,
        string $decision
    ): bool {
        if ($id <= 0 || $adminId <= 0) {
            throw new InvalidArgumentException(
                'Los datos de la operación no son válidos.'
            );
        }

        if (!in_array($decision, ['aprobado', 'rechazado'], true)) {
            throw new InvalidArgumentException(
                'La decisión no es válida.'
            );
        }

        return $this->gastoModel->decide(
            $id,
            $adminId,
            $decision
        );
    }

    public function markPaid(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El gasto indicado no es válido.'
            );
        }

        return $this->gastoModel->markPaid($id);
    }

    public function markReimbursed(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El gasto indicado no es válido.'
            );
        }

        return $this->gastoModel->markReimbursed($id);
    }
}

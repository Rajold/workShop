<?php

declare(strict_types=1);

class CasePurchaseObligation
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene las obligaciones de compras directas de un caso.
     * Solo incluye dinero personal y crédito proveedor.
     */
    public function findByCase(int $caseId): array
    {
        $sql = "
            SELECT
                f.id AS financiacion_id,
                f.compra_id,
                f.origen,
                f.monto,
                f.fecha_registro,
                f.observacion AS observacion_financiacion,

                cc.descripcion,
                cc.proveedor,
                cc.cantidad,
                cc.costo_unitario,

                COALESCE(SUM(p.monto), 0) AS abonado,

                f.monto - COALESCE(SUM(p.monto), 0) AS pendiente,

                CASE
                    WHEN f.monto - COALESCE(SUM(p.monto), 0) <= 0
                        THEN 'pagada'
                    WHEN COALESCE(SUM(p.monto), 0) > 0
                        THEN 'abono parcial'
                    ELSE 'pendiente'
                END AS estado

            FROM financiacion_compras_caso f

            INNER JOIN compras_caso cc
                ON cc.id = f.compra_id

            LEFT JOIN pagos_obligaciones_compras p
                ON p.financiacion_id = f.id

            WHERE cc.caso_id = :caso_id
              AND f.origen IN ('personal', 'credito')

            GROUP BY
                f.id,
                f.compra_id,
                f.origen,
                f.monto,
                f.fecha_registro,
                f.observacion,
                cc.descripcion,
                cc.proveedor,
                cc.cantidad,
                cc.costo_unitario

            ORDER BY f.fecha_registro DESC, f.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':caso_id' => $caseId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el historial de pagos de las obligaciones de un caso.
     */
    public function findPaymentsByCase(int $caseId): array
    {
        $sql = "
            SELECT
                p.id AS pago_id,
                p.financiacion_id,
                p.monto,
                p.fecha_pago,
                p.observacion,

                c.nombre AS cuenta_nombre,
                u.nombre AS usuario_nombre,

                f.origen,
                cc.descripcion AS compra_descripcion,
                cc.proveedor

            FROM pagos_obligaciones_compras p

            INNER JOIN financiacion_compras_caso f
                ON f.id = p.financiacion_id

            INNER JOIN compras_caso cc
                ON cc.id = f.compra_id

            INNER JOIN cuentas_financieras c
                ON c.id = p.cuenta_id

            INNER JOIN usuarios u
                ON u.id = p.usuario_id

            WHERE cc.caso_id = :caso_id

            ORDER BY p.fecha_pago DESC, p.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':caso_id' => $caseId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

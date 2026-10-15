<?php

declare(strict_types=1);

class MovimientoFinanciero extends BaseModel
{
    /**
     * Obtener las cuentas activas.
     */
    public function cuentas(): array
    {
        $sql = "
            SELECT id, nombre, tipo
            FROM cuentas_financieras
            WHERE activa = 1
            ORDER BY id
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener el saldo de cada cuenta y el total combinado.
     * Las transferencias se compensan en el total general.
     */
    public function resumen(): array
    {
        $sql = "
            SELECT
                c.id,
                c.nombre,
                c.tipo,
                COALESCE(
                    SUM(
                        CASE
                            WHEN m.sentido = 'entrada' THEN m.monto
                            ELSE -m.monto
                        END
                    ),
                    0
                ) AS saldo
            FROM cuentas_financieras c
            LEFT JOIN movimientos_financieros m
                ON m.cuenta_id = c.id
            WHERE c.activa = 1
            GROUP BY c.id, c.nombre, c.tipo
            ORDER BY c.id
        ";

        $cuentas = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $total = 0.0;

        foreach ($cuentas as &$cuenta) {
            $cuenta['saldo'] = round((float)$cuenta['saldo'], 2);
            $total += $cuenta['saldo'];
        }
        unset($cuenta);

        return [
            'cuentas' => $cuentas,
            'total' => round($total, 2),
        ];
    }

    /**
     * Listar los movimientos más recientes.
     */
    public function movimientos(int $limite = 100): array
    {
        $limite = max(1, min($limite, 500));

        $sql = "
            SELECT
                m.*,
                c.nombre AS cuenta_nombre,
                u.nombre AS usuario_nombre
            FROM movimientos_financieros m
            INNER JOIN cuentas_financieras c
                ON c.id = m.cuenta_id
            INNER JOIN usuarios u
                ON u.id = m.registrado_por
            ORDER BY m.fecha_movimiento DESC, m.id DESC
            LIMIT {$limite}
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Registrar un movimiento individual.
     *
     * La operación requiere una cuenta activa, un usuario válido
     * y un monto estrictamente positivo.
     */
    public function registrar(
        int $cuentaId,
        string $tipo,
        string $sentido,
        float $monto,
        string $descripcion,
        int $usuarioId,
        ?int $casoId = null,
        ?string $casoReferencia = null,
        ?int $gastoId = null,
        ?string $referencia = null
    ): int {
        if ($cuentaId <= 0 || $usuarioId <= 0) {
            throw new InvalidArgumentException(
                'La cuenta o el usuario no son válidos.'
            );
        }

        if (!in_array(
            $tipo,
            ['ingreso', 'egreso', 'apertura', 'transferencia', 'ajuste'],
            true
        )) {
            throw new InvalidArgumentException(
                'El tipo de movimiento no es válido.'
            );
        }

        if (!in_array($sentido, ['entrada', 'salida'], true)) {
            throw new InvalidArgumentException(
                'El sentido del movimiento no es válido.'
            );
        }

        if (!is_finite($monto) || $monto <= 0) {
            throw new InvalidArgumentException(
                'El monto debe ser mayor que cero.'
            );
        }

        $descripcion = trim($descripcion);

        if ($descripcion === '' || mb_strlen($descripcion) > 255) {
            throw new InvalidArgumentException(
                'La descripción es obligatoria y no debe superar 255 caracteres.'
            );
        }

        $stmt = $this->db->prepare("
            SELECT id
            FROM cuentas_financieras
            WHERE id = :id AND activa = 1
        ");
        $stmt->execute([':id' => $cuentaId]);

        if (!$stmt->fetchColumn()) {
            throw new InvalidArgumentException(
                'La cuenta seleccionada no existe o está inactiva.'
            );
        }

        $stmt = $this->db->prepare("
            INSERT INTO movimientos_financieros (
                cuenta_id,
                tipo,
                sentido,
                monto,
                descripcion,
                registrado_por,
                caso_id,
                caso_referencia,
                gasto_id,
                referencia
            ) VALUES (
                :cuenta_id,
                :tipo,
                :sentido,
                :monto,
                :descripcion,
                :registrado_por,
                :caso_id,
                :caso_referencia,
                :gasto_id,
                :referencia
            )
        ");

        $stmt->execute([
            ':cuenta_id' => $cuentaId,
            ':tipo' => $tipo,
            ':sentido' => $sentido,
            ':monto' => number_format($monto, 2, '.', ''),
            ':descripcion' => $descripcion,
            ':registrado_por' => $usuarioId,
            ':caso_id' => $casoId,
            ':caso_referencia' => $casoReferencia,
            ':gasto_id' => $gastoId,
            ':referencia' => $referencia,
        ]);

        return (int)$this->db->lastInsertId();
    }
}

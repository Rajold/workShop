<?php

declare(strict_types=1);

class Gasto extends BaseModel
{
    protected string $table = 'gastos';

    /**
     * Registrar un gasto nuevo.
     * Los gastos nuevos siempre quedan pendientes de aprobación.
     */
    public function create(array $data): int
    {
        $sql = "
            INSERT INTO gastos (
                descripcion,
                categoria,
                valor,
                fecha_gasto,
                registrado_por,
                estado,
                estado_pago,
                forma_pago,
                proveedor,
                observacion
            ) VALUES (
                :descripcion,
                :categoria,
                :valor,
                :fecha_gasto,
                :registrado_por,
                'pendiente',
                'pendiente',
                :forma_pago,
                :proveedor,
                :observacion
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':descripcion'   => $data['descripcion'],
            ':categoria'     => $data['categoria'],
            ':valor'         => $data['valor'],
            ':fecha_gasto'   => $data['fecha_gasto'],
            ':registrado_por'=> $data['registrado_por'],
            ':forma_pago'    => $data['forma_pago'],
            ':proveedor'     => $data['proveedor'] ?: null,
            ':observacion'   => $data['observacion'] ?: null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Listar gastos con los nombres de sus responsables.
     */
    public function findAll(
        ?string $estado = null,
        ?string $categoria = null
    ): array {
        $sql = "
            SELECT
                g.*,
                u.nombre AS registrado_por_nombre,
                a.nombre AS autorizado_por_nombre
            FROM gastos g
            INNER JOIN usuarios u
                ON u.id = g.registrado_por
            LEFT JOIN usuarios a
                ON a.id = g.autorizado_por
            WHERE 1 = 1
        ";

        $params = [];

        if ($estado !== null && $estado !== '') {
            $sql .= " AND g.estado = :estado";
            $params[':estado'] = $estado;
        }

        if ($categoria !== null && $categoria !== '') {
            $sql .= " AND g.categoria = :categoria";
            $params[':categoria'] = $categoria;
        }

        $sql .= " ORDER BY g.fecha_gasto DESC, g.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Consultar un gasto por su identificador.
     */
    public function findById(int $id): ?array
    {
        $sql = "
            SELECT
                g.*,
                u.nombre AS registrado_por_nombre,
                a.nombre AS autorizado_por_nombre
            FROM gastos g
            INNER JOIN usuarios u
                ON u.id = g.registrado_por
            LEFT JOIN usuarios a
                ON a.id = g.autorizado_por
            WHERE g.id = ?
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $gasto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $gasto ?: null;
    }

    /**
     * Aprobar o rechazar un gasto pendiente.
     */
    public function decide(
        int $id,
        int $adminId,
        string $decision
    ): bool {
        if (!in_array($decision, ['aprobado', 'rechazado'], true)) {
            return false;
        }

        $sql = "
            UPDATE gastos
            SET estado = :estado,
                autorizado_por = :admin_id
            WHERE id = :id
              AND estado = 'pendiente'
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':estado'   => $decision,
            ':admin_id' => $adminId,
            ':id'       => $id,
        ]);

        return $stmt->rowCount() === 1;
    }

    /**
     * Marcar un gasto aprobado como pagado.
     */
    public function markPaid(int $id): bool
    {
        $sql = "
            UPDATE gastos
            SET estado_pago = 'pagado'
            WHERE id = ?
              AND estado = 'aprobado'
              AND estado_pago = 'pendiente'
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount() === 1;
    }

    /**
     * Registrar un reembolso que efectivamente se realizó.
     */
    public function markReimbursed(int $id): bool
    {
        $sql = "
            UPDATE gastos
            SET estado_pago = 'reembolsado'
            WHERE id = ?
              AND estado = 'aprobado'
              AND estado_pago = 'pendiente'
              AND forma_pago = 'dinero_personal'
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount() === 1;
    }
}

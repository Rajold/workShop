<?php

declare(strict_types=1);

class Pending extends BaseModel
{
    protected string $table = 'pendientes';

    public function findOpenByVehicle(int $vehiculoId): array
    {
        $stmt = $this->db->prepare("
            SELECT
                p.*,
                u.nombre AS usuario,
                c.id AS caso_origen
            FROM pendientes p
            INNER JOIN usuarios u
                ON u.id = p.usuario_id
            INNER JOIN casos c
                ON c.id = p.caso_origen_id
            WHERE
                p.vehiculo_id = :vehiculo
            AND
                p.estado = 'pendiente'
            ORDER BY
                p.created_at ASC
        ");

        $stmt->execute([
            ':vehiculo' => $vehiculoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO pendientes
            (
                vehiculo_id,
                caso_origen_id,
                usuario_id,
                descripcion
            )
            VALUES
            (
                :vehiculo,
                :caso,
                :usuario,
                :descripcion
            )
        ");

        return $stmt->execute([
            ':vehiculo'   => $data['vehiculo_id'],
            ':caso'       => $data['caso_origen_id'],
            ':usuario'    => $data['usuario_id'],
            ':descripcion'=> $data['descripcion']
        ]);
    }

public function findById(int $id): ?array
{
    $stmt = $this->db->prepare("
        SELECT *
        FROM pendientes
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    $pending = $stmt->fetch(PDO::FETCH_ASSOC);

    return $pending ?: null;
}

    public function resolve(
        int $id,
        int $caseId
    ): bool {

        $stmt = $this->db->prepare("
            UPDATE pendientes
            SET
                estado='resuelto',
                caso_resuelto_id=:caso,
                resolved_at=NOW()
            WHERE id=:id
        ");

        return $stmt->execute([
            ':caso'=>$caseId,
            ':id'=>$id
        ]);
    }

    public function discard(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE pendientes
            SET
                estado='descartado',
                resolved_at=NOW()
            WHERE id=:id
        ");

        return $stmt->execute([
            ':id'=>$id
        ]);
    }
}
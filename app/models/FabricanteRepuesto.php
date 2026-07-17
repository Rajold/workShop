<?php

class FabricanteRepuesto extends BaseModel
{
    protected string $table = 'fabricante_repuesto';

    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM fabricante_repuesto
            ORDER BY activo DESC, nombre
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function active(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM fabricante_repuesto
            WHERE activo = 1
            ORDER BY nombre
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM fabricante_repuesto
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): bool
{
    $stmt = $this->db->prepare("
        INSERT INTO fabricante_repuesto
        (
            nombre,
            descripcion
        )
        VALUES
        (
            :nombre,
            :descripcion
        )
    ");

    return $stmt->execute([
        ':nombre' => trim($data['nombre']),
        ':descripcion' => trim($data['descripcion'] ?? '')
    ]);
}

public function update(array $data): bool
{
    $stmt = $this->db->prepare("
        UPDATE fabricante_repuesto
        SET
            nombre = :nombre,
            descripcion = :descripcion
        WHERE id = :id
    ");

    return $stmt->execute([
        ':id' => $data['id'],
        ':nombre' => trim($data['nombre']),
        ':descripcion' => trim($data['descripcion'] ?? '')
    ]);
}

public function toggle(int $id): bool
{
    $stmt = $this->db->prepare("
        UPDATE fabricante_repuesto
        SET activo = NOT activo
        WHERE id = :id
    ");

    return $stmt->execute([
        ':id' => $id
    ]);
}

    public function canDelete(int $id): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) total
            FROM partes
            WHERE fabricante_repuesto_id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        return ((int)$stmt->fetchColumn()) === 0;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE
            FROM fabricante_repuesto
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
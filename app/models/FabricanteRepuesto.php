<?php

class FabricanteRepuesto extends CatalogModel
{
    protected string $table = 'fabricante_repuesto';

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

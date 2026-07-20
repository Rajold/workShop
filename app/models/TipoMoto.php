<?php

class TipoMoto extends CatalogModel
{
    protected string $table = 'tipos_moto';

    public function canDelete(int $id): bool
{
    return true;
}

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO tipos_moto
            (
                nombre
            )
            VALUES
            (
                :nombre
            )
        ");

        return $stmt->execute([
            ':nombre' => trim($data['nombre'])
        ]);
    }

    public function update(array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE tipos_moto
            SET nombre = :nombre
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id'     => $data['id'],
            ':nombre' => trim($data['nombre'])
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE
            FROM tipos_moto
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
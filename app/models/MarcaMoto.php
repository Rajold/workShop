<?php

class MarcaMoto extends CatalogModel
{
    protected string $table = 'marcas_moto';

    public function canDelete(int $id): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*)
            FROM modelos_moto
            WHERE marca_moto_id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        return ((int)$stmt->fetchColumn()) === 0;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO marcas_moto
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
            UPDATE marcas_moto
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
            FROM marcas_moto
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
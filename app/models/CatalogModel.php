<?php

abstract class CatalogModel extends BaseModel
{
    /**
     * Nombre de la tabla.
     */
    protected string $table;

    /**
     * Obtiene todos los registros.
     */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM {$this->table}
            ORDER BY activo DESC, nombre
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene únicamente los registros activos.
     */
    public function active(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM {$this->table}
            WHERE activo = 1
            ORDER BY nombre
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar por ID.
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Activa o desactiva un registro.
     */
    public function toggle(int $id): bool
    {
        $stmt = $this->db->prepare("
        UPDATE {$this->table}
        SET activo = NOT activo
        WHERE id = :id
    ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}

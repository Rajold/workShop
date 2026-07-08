<?php

class Part extends BaseModel
{

    protected string $table = 'partes';

    public function __construct(PDO $pdo)
{
    parent::__construct($pdo);
}

    /**
     * Obtiene todas las partes activas.
     */
    public function all(): array
    {
        $sql = "
            SELECT
                p.*,
                c.nombre AS categoria
            FROM partes p
            LEFT JOIN categorias_partes c
                ON c.id = p.categoria_id
            ORDER BY p.activo DESC,
         p.nombre ASC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca una parte por ID.
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM partes
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Busca por código.
     */
    public function findByCode(string $codigo): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM partes
            WHERE codigo = ?
            LIMIT 1
        ");

        $stmt->execute([$codigo]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Búsqueda por nombre o código.
     */
    public function search(string $texto): array
    {
        $stmt = $this->db->prepare("
            SELECT
                p.*,
                c.nombre AS categoria
            FROM partes p
            LEFT JOIN categorias_partes c
                ON c.id = p.categoria_id
            WHERE
      p.codigo LIKE ?
   OR p.nombre LIKE ?
   OR p.marca LIKE ?
            ORDER BY p.activo DESC,
         p.nombre ASC
        ");

        $like = "%{$texto}%";

        $stmt->execute([
    $like,
    $like,
    $like
]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crear parte.
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO partes (
                codigo,
                categoria_id,
                nombre,
                marca,
                unidad,
                stock_actual,
                stock_minimo,
                costo,
                precio,
                ubicacion,
                activo
            )
            VALUES (?,?,?,?,?,?,?,?,?,?,?)
        ";

        return $this->db
            ->prepare($sql)
            ->execute([
                $data['codigo'],
                $data['categoria_id'],
                $data['nombre'],
                $data['marca'],
                $data['unidad'],
                0,
                $data['stock_minimo'],
                $data['costo'],
                $data['precio'],
                $data['ubicacion'],
                $data['activo']
            ]);
    }

    /**
     * Actualizar parte.
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE partes
            SET
                codigo=?,
                categoria_id=?,
                nombre=?,
                marca=?,
                unidad=?,
                stock_minimo=?,
                costo=?,
                precio=?,
                ubicacion=?,
                activo=?
            WHERE id=?
        ";

        return $this->db
            ->prepare($sql)
            ->execute([
                $data['codigo'],
                $data['categoria_id'],
                $data['nombre'],
                $data['marca'],
                $data['unidad'],
                $data['stock_minimo'],
                $data['costo'],
                $data['precio'],
                $data['ubicacion'],
                $data['activo'],
                $id
            ]);
    }

    /**
     * Desactivar una parte.
     */
    public function deactivate(int $id): bool
    {
        return $this->db
            ->prepare("UPDATE partes SET activo=0 WHERE id=?")
            ->execute([$id]);
    }

    /**
     * Categorías para el formulario.
     */
    public function categories(): array
    {
        return $this->db
            ->query("
                SELECT *
                FROM categorias_partes
                WHERE activo=1
                ORDER BY nombre
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}
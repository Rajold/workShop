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
            tipo,
            nombre,
            marca,
            created_by,
            unidad,
            stock_actual,
            stock_minimo,
            costo,
            precio_venta,
            ubicacion,
            codigo_barras,
            activo
        )
        VALUES (
            :codigo,
            :categoria_id,
            :tipo,
            :nombre,
            :marca,
            :created_by,
            :unidad,
            0,
            :stock_minimo,
            :costo,
            :precio_venta,
            :ubicacion,
            :codigo_barras,
            :activo
        )
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':codigo'         => $data['codigo'],
        ':categoria_id'   => !empty($data['categoria_id']) ? $data['categoria_id'] : null,
        ':tipo'           => $data['tipo'],
        ':nombre'         => $data['nombre'],
        ':marca'          => $data['marca'] ?? null,
        ':created_by'     => $data['created_by'] ?? null,
        ':unidad'         => $data['unidad'],
        ':stock_minimo'   => $data['stock_minimo'] ?: 0,
        ':costo'          => $data['costo'] ?: 0,
        ':precio_venta'   => $data['precio_venta'] ?: 0,
        ':ubicacion'      => $data['ubicacion'] ?? null,
        ':codigo_barras'  => $data['codigo_barras'] ?? null,
        ':activo'         => isset($data['activo']) ? 1 : 0,
    ]);
}



    /**
     * Actualizar parte.
     */
   public function update(array $data): bool
{
    $sql = "
        UPDATE partes
        SET
            codigo = :codigo,
            categoria_id = :categoria_id,
            tipo = :tipo,
            nombre = :nombre,
            marca = :marca,
            unidad = :unidad,
            stock_minimo = :stock_minimo,
            costo = :costo,
            precio_venta = :precio_venta,
            ubicacion = :ubicacion,
            codigo_barras = :codigo_barras,
            activo = :activo
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':id'             => $data['id'],
        ':codigo'         => $data['codigo'],
        ':categoria_id'   => !empty($data['categoria_id']) ? $data['categoria_id'] : null,
        ':tipo'           => $data['tipo'],
        ':nombre'         => $data['nombre'],
        ':marca'          => $data['marca'] ?? null,
        ':unidad'         => $data['unidad'],
        ':stock_minimo'   => $data['stock_minimo'] ?: 0,
        ':costo'          => $data['costo'] ?: 0,
        ':precio_venta'   => $data['precio_venta'] ?: 0,
        ':ubicacion'      => $data['ubicacion'] ?? null,
        ':codigo_barras'  => $data['codigo_barras'] ?? null,
        ':activo'         => isset($data['activo']) ? 1 : 0,
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

    /**
 * Actualiza el stock de una parte.
 */
public function updateStock(int $partId, float $newStock): bool
{
    $stmt = $this->db->prepare("
        UPDATE partes
        SET stock_actual = ?
        WHERE id = ?
    ");

    return $stmt->execute([
        $newStock,
        $partId
    ]);
}

/**
 * Registrar movimiento de inventario.
 */
public function registerMovement(array $data): bool
{
    $sql = "
        INSERT INTO movimientos_inventario
        (
            parte_id,
            usuario_id,
            caso_id,
            tipo,
            motivo,
            cantidad,
            stock_resultante,
            costo_unitario,
            observacion
        )
        VALUES
        (
            :parte_id,
            :usuario_id,
            :caso_id,
            :tipo,
            :motivo,
            :cantidad,
            :stock_resultante,
            :costo_unitario,
            :observacion
        )
    ";

    return $this->db->prepare($sql)->execute([

        ':parte_id' => $data['parte_id'],
        ':usuario_id' => $data['usuario_id'],
        ':caso_id' => $data['caso_id'],

        ':tipo' => $data['tipo'],

        ':motivo' => $data['motivo'],

        ':cantidad' => $data['cantidad'],

        ':stock_resultante' => $data['stock_resultante'],

        ':costo_unitario' => $data['costo_unitario'],

        ':observacion' => $data['observacion']

    ]);
}
}
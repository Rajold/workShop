<?php

declare(strict_types=1);

class CasePurchase
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * Registrar una compra directa asociada a un caso.
     */
    public function add(array $data): int
    {
        $cantidad = (float)$data['cantidad'];
        $costoUnitario = (float)$data['costo_unitario'];
        $precioUnitario = (float)$data['precio_unitario'];

        $subtotal = $cantidad * $precioUnitario;

        $stmt = $this->db->prepare("
            INSERT INTO compras_caso
            (
                caso_id,
                usuario_id,
                descripcion,
                proveedor,
                cantidad,
                costo_unitario,
                precio_unitario,
                subtotal,
                fecha,
                observacion
            )
            VALUES
            (
                :caso_id,
                :usuario_id,
                :descripcion,
                :proveedor,
                :cantidad,
                :costo_unitario,
                :precio_unitario,
                :subtotal,
                NOW(),
                :observacion
            )
        ");

        $stmt->execute([
            ':caso_id'        => (int)$data['caso_id'],
            ':usuario_id'     => (int)$data['usuario_id'],
            ':descripcion'    => trim($data['descripcion']),
            ':proveedor'      => trim($data['proveedor'] ?? ''),
            ':cantidad'       => $cantidad,
            ':costo_unitario' => $costoUnitario,
            ':precio_unitario'=> $precioUnitario,
            ':subtotal'       => $subtotal,
            ':observacion'    => trim($data['observacion'] ?? '')
        ]);

        return (int)$this->db->lastInsertId();
    }

    /**
     * Obtener todas las compras directas de un caso.
     */
    public function findByCase(int $caseId): array
    {
        $stmt = $this->db->prepare("
            SELECT
                c.*,
                u.nombre AS usuario_nombre
            FROM compras_caso c
            JOIN usuarios u
                ON u.id = c.usuario_id
            WHERE c.caso_id = :caso_id
            ORDER BY c.fecha ASC, c.id ASC
        ");

        $stmt->execute([
            ':caso_id' => $caseId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Total cobrado al cliente por compras directas.
     */
    public function getTotalVentaByCase(int $caseId): float
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(subtotal), 0)
            FROM compras_caso
            WHERE caso_id = :caso_id
        ");

        $stmt->execute([
            ':caso_id' => $caseId
        ]);

        return (float)$stmt->fetchColumn();
    }

    /**
     * Costo real de las compras directas de un caso.
     */
    public function getTotalCostoByCase(int $caseId): float
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(
                SUM(cantidad * costo_unitario),
                0
            )
            FROM compras_caso
            WHERE caso_id = :caso_id
        ");

        $stmt->execute([
            ':caso_id' => $caseId
        ]);

        return (float)$stmt->fetchColumn();
    }

    /**
     * Utilidad generada por compras directas.
     */
    public function getUtilidadByCase(int $caseId): float
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(
                SUM(subtotal - (cantidad * costo_unitario)),
                0
            )
            FROM compras_caso
            WHERE caso_id = :caso_id
        ");

        $stmt->execute([
            ':caso_id' => $caseId
        ]);

        return (float)$stmt->fetchColumn();
    }

    /**
     * Eliminar una compra directa.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM compras_caso
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
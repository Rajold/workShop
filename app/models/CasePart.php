<?php

class CasePart extends BaseModel
{
    protected string $table = 'caso_repuestos';

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Registra un repuesto utilizado en un caso.
     */
    public function add(array $data): bool
{
    $stmt = $this->db->prepare("
        INSERT INTO caso_repuestos
        (
            caso_id,
            parte_id,
            usuario_id,
            cantidad,
            costo_unitario,
            precio_unitario,
            subtotal
        )
        VALUES
        (
            :caso_id,
            :parte_id,
            :usuario_id,
            :cantidad,
            :costo_unitario,
            :precio_unitario,
            :subtotal
        )
    ");

    return $stmt->execute([

        ':caso_id'          => $data['caso_id'],
        ':parte_id'         => $data['parte_id'],
        ':usuario_id'       => $data['usuario_id'],
        ':cantidad'         => $data['cantidad'],
        ':costo_unitario'   => $data['costo_unitario'],
        ':precio_unitario'  => $data['precio_unitario'],
        ':subtotal'         => $data['subtotal']

    ]);
}

    /**
     * Repuestos utilizados en un caso.
     */
    public function getByCase(int $caseId): array
    {
        $stmt = $this->db->prepare("
            SELECT

                cr.*,

                p.codigo,

                p.nombre,

                p.marca

            FROM caso_repuestos cr

            INNER JOIN partes p
                ON p.id = cr.parte_id

            WHERE cr.caso_id = :caso

            ORDER BY
                cr.created_at ASC
        ");

        $stmt->execute([
            ':caso' => $caseId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Total invertido en repuestos.
     */
    public function getTotalByCase(int $caseId): float
    {
        $stmt = $this->db->prepare("
            SELECT
                COALESCE(SUM(subtotal),0)
            FROM caso_repuestos
            WHERE caso_id = :caso
        ");

        $stmt->execute([
            ':caso' => $caseId
        ]);

        return (float)$stmt->fetchColumn();
    }

    public function findByCase(int $caseId): array
{
    $stmt = $this->db->prepare("
        SELECT

            cp.*,

            p.codigo,

            p.nombre,

            p.marca

        FROM caso_repuestos cp

        INNER JOIN partes p
            ON p.id = cp.parte_id

        WHERE cp.caso_id = ?

        ORDER BY cp.id ASC
    ");

    $stmt->execute([$caseId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getTotalVentaByCase(int $caseId): float
{
    $stmt = $this->db->prepare("
        SELECT COALESCE(SUM(subtotal), 0)
        FROM caso_repuestos
        WHERE caso_id = :caso_id
    ");

    $stmt->execute([
        ':caso_id' => $caseId
    ]);

    return (float)$stmt->fetchColumn();
}


public function getTotalCostoByCase(int $caseId): float
{
    $stmt = $this->db->prepare("
        SELECT COALESCE(
            SUM(cantidad * costo_unitario),
            0
        )
        FROM caso_repuestos
        WHERE caso_id = :caso_id
    ");

    $stmt->execute([
        ':caso_id' => $caseId
    ]);

    return (float)$stmt->fetchColumn();
}


public function getUtilidadByCase(int $caseId): float
{
    $stmt = $this->db->prepare("
        SELECT COALESCE(
            SUM(
                subtotal -
                (cantidad * costo_unitario)
            ),
            0
        )
        FROM caso_repuestos
        WHERE caso_id = :caso_id
    ");

    $stmt->execute([
        ':caso_id' => $caseId
    ]);

    return (float)$stmt->fetchColumn();
}
}

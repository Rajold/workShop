<?php
// app/models/Advance.php
declare(strict_types=1);

class Avance
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getByCase(int $caseId): array
    {
        $stmt = $this->db->prepare("
            SELECT a.*, u.nombre AS mecanico
            FROM avances a
            JOIN usuarios u ON a.mecanico_id = u.id
            WHERE a.caso_id = :id
            ORDER BY a.fecha DESC
        ");
        $stmt->execute([':id' => $caseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(
        int $caseId,
        int $mecanicoId,
        string $descripcion,
        string $tipo,
        int $valor
    ): void {

        $stmt = $this->db->prepare("
        INSERT INTO avances
        (caso_id, mecanico_id, descripcion, tipo, valor)
        VALUES
        (:c, :m, :d, :t, :v)
    ");

        $stmt->execute([
            ':c' => $caseId,
            ':m' => $mecanicoId,
            ':d' => $descripcion,
            ':t' => $tipo,
            ':v' => $valor
        ]);
    }

    public function getTotalesPorCaso(int $caseId): array
{
    // Total mano de obra
    $stmt = $this->db->prepare("
        SELECT
            COALESCE(SUM(valor), 0)
        FROM avances
        WHERE caso_id = :caso
          AND tipo = 'Mano de obra'
    ");

    $stmt->execute([
        ':caso' => $caseId
    ]);

    $manoObra = (float)$stmt->fetchColumn();

    // Total repuestos
    $stmt = $this->db->prepare("
        SELECT
            COALESCE(SUM(subtotal), 0)
        FROM caso_repuestos
        WHERE caso_id = :caso
    ");

    $stmt->execute([
        ':caso' => $caseId
    ]);

    $repuestos = (float)$stmt->fetchColumn();

    return [

        'mano_obra' => $manoObra,

        'repuestos' => $repuestos,

        'total' => $manoObra + $repuestos

    ];
}

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("
        SELECT
            a.*,
            c.vehiculo_id
        FROM avances a
        INNER JOIN casos c ON c.id = a.caso_id
        WHERE a.id = :id
    ");

        $stmt->execute([
            ':id' => $id
        ]);

        $avance = $stmt->fetch(PDO::FETCH_ASSOC);

        return $avance ?: null;
    }

    public function update(
        int $id,
        string $descripcion,
        string $tipo,
        int $valor
    ): bool {

        $stmt = $this->db->prepare("
        UPDATE avances
        SET
            descripcion = :descripcion,
            tipo = :tipo,
            valor = :valor
        WHERE id = :id
    ");

        return $stmt->execute([
            ':descripcion' => $descripcion,
            ':tipo' => $tipo,
            ':valor' => $valor,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
        DELETE FROM avances
        WHERE id = :id
    ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}

<?php
// app/models/Advance.php
declare(strict_types=1);

class Advance
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

    public function add(int $caseId, int $mecanicoId, string $descripcion): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO avances (caso_id, mecanico_id, descripcion)
            VALUES (:c, :m, :d)
        ");
        $stmt->execute([
            ':c' => $caseId,
            ':m' => $mecanicoId,
            ':d' => htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8')
        ]);
    }
}

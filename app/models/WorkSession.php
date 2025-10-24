<?php
// app/models/WorkSession.php
declare(strict_types=1);

class WorkSession
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    // Inicia una sesión de trabajo
    public function start(int $caseId, int $mechanicId): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO sesiones_trabajo (caso_id, mecanico_id, fecha_inicio, hora_inicio)
            VALUES (:c, :m, CURDATE(), CURTIME())
        ");
        $stmt->execute([
            ':c' => $caseId,
            ':m' => $mechanicId
        ]);
        return (int)$this->db->lastInsertId();
    }

    // Finaliza una sesión de trabajo
    public function end(int $sessionId): bool
    {
        $stmt = $this->db->prepare("SELECT fecha_inicio, hora_inicio FROM sesiones_trabajo WHERE id = :id");
        $stmt->execute([':id' => $sessionId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return false;

        // Calcular duración total en minutos (seguro)
        $inicio = new DateTime($row['fecha_inicio'] . ' ' . $row['hora_inicio']);
        $fin = new DateTime(); // hora actual
        $duracion = (int) round(($fin->getTimestamp() - $inicio->getTimestamp()) / 60);
        if ($duracion < 0) $duracion = 0;

        $stmt = $this->db->prepare("
            UPDATE sesiones_trabajo
            SET fecha_fin = CURDATE(), hora_fin = CURTIME(), duracion = :duracion
            WHERE id = :id
        ");
        return $stmt->execute([
            ':duracion' => $duracion,
            ':id' => $sessionId
        ]);
    }

    // Obtener sesión activa por caso y mecánico
    public function getActiveByCaseAndMechanic(int $caseId, int $mechanicId): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM sesiones_trabajo
            WHERE caso_id = :c AND mecanico_id = :m AND fecha_fin IS NULL
            ORDER BY id DESC LIMIT 1
        ");
        $stmt->execute([':c' => $caseId, ':m' => $mechanicId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Obtener todas las sesiones de un caso
    public function getByCase(int $caseId): array
    {
        $stmt = $this->db->prepare("
            SELECT s.*, u.nombre AS mecanico
            FROM sesiones_trabajo s
            JOIN usuarios u ON s.mecanico_id = u.id
            WHERE s.caso_id = :c
            ORDER BY s.fecha_inicio DESC, s.hora_inicio DESC
        ");
        $stmt->execute([':c' => $caseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

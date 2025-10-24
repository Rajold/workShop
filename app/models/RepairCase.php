<?php
// app/models/RepairCase.php
declare(strict_types=1);

class RepairCase
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO casos (vehiculo_id, mecanico_id, fecha_ingreso, hora_ingreso, causa, observaciones, diagnostico, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['vehiculo_id'],
            $data['mecanico_id'],
            $data['fecha_ingreso'],
            $data['hora_ingreso'],
            $data['causa'],
            $data['observaciones'],
            $data['diagnostico'],
            $data['estado'] ?? 'abierto'
        ]);
    }

    public function findByVehicle(int $vehiculo_id): array
    {
        $stmt = $this->pdo->prepare("
            SELECT c.*, u.nombre AS mecanico_nombre
            FROM casos c
            LEFT JOIN usuarios u ON c.mecanico_id = u.id
            WHERE c.vehiculo_id = ?
            ORDER BY c.fecha_ingreso DESC, c.hora_ingreso DESC
        ");
        $stmt->execute([$vehiculo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT c.*, v.placa, v.marca, v.modelo, v.color, v.propietario, u.nombre AS mecanico_nombre
            FROM casos c
            LEFT JOIN vehiculos v ON c.vehiculo_id = v.id
            LEFT JOIN usuarios u ON c.mecanico_id = u.id
            WHERE c.id = ?
            LIMIT 1
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function openCaseIfNone(int $vehiculo_id, int $mecanico_id, string $causa): int
    {
        $stmt = $this->pdo->prepare("
            SELECT id FROM casos WHERE vehiculo_id = ? AND estado = 'abierto' LIMIT 1
        ");
        $stmt->execute([$vehiculo_id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) return (int)$existing['id'];

        $stmt = $this->pdo->prepare("
            INSERT INTO casos (vehiculo_id, mecanico_id, fecha_ingreso, hora_ingreso, causa, estado)
            VALUES (?, ?, CURDATE(), CURTIME(), ?, 'abierto')
        ");
        $stmt->execute([$vehiculo_id, $mecanico_id, $causa]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE casos SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
}

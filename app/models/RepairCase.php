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
            ORDER BY
    CASE WHEN c.estado = 'abierto' THEN 0 ELSE 1 END,
    c.fecha_ingreso DESC,
    c.id DESC
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

    public function reabrir(
    int $casoId,
    int $mecanicoId,
    string $motivo,
    ?string $comentario
): bool {
    try {
        $this->pdo->beginTransaction();

        // Obtener el caso y bloquearlo durante la operación
        $stmt = $this->pdo->prepare("
            SELECT
                id,
                vehiculo_id,
                estado,
                precio_cobrado,
                descuento,
                utilidad,
                fecha_cierre
            FROM casos
            WHERE id = :id
            FOR UPDATE
        ");

        $stmt->execute([
            ':id' => $casoId
        ]);

        $caso = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$caso) {
            throw new RuntimeException('El caso no existe.');
        }

        if ($caso['estado'] !== 'cerrado') {
            throw new RuntimeException('El caso no está cerrado.');
        }

        // Verificar que la moto no tenga otro caso abierto
        $stmt = $this->pdo->prepare("
            SELECT id
            FROM casos
            WHERE vehiculo_id = :vehiculo_id
              AND estado = 'abierto'
              AND id <> :caso_id
            LIMIT 1
        ");

        $stmt->execute([
            ':vehiculo_id' => $caso['vehiculo_id'],
            ':caso_id' => $casoId
        ]);

        if ($stmt->fetch()) {
            throw new RuntimeException(
                'No se puede reabrir este caso porque el vehículo ya tiene otro caso abierto.'
            );
        }

        // Guardar la información del cierre anterior
        $stmt = $this->pdo->prepare("
            INSERT INTO reaperturas_caso (
                caso_id,
                mecanico_id,
                motivo,
                comentario,
                precio_cobrado_anterior,
                descuento_anterior,
                utilidad_anterior,
                fecha_cierre_anterior
            )
            VALUES (
                :caso_id,
                :mecanico_id,
                :motivo,
                :comentario,
                :precio_cobrado,
                :descuento,
                :utilidad,
                :fecha_cierre
            )
        ");

        $stmt->execute([
            ':caso_id' => $casoId,
            ':mecanico_id' => $mecanicoId,
            ':motivo' => $motivo,
            ':comentario' => $comentario !== '' ? $comentario : null,
            ':precio_cobrado' => $caso['precio_cobrado'],
            ':descuento' => $caso['descuento'],
            ':utilidad' => $caso['utilidad'],
            ':fecha_cierre' => $caso['fecha_cierre']
        ]);

        // Reabrir el caso
        $stmt = $this->pdo->prepare("
            UPDATE casos
            SET
                estado = 'abierto',
                precio_cobrado = NULL,
                descuento = 0,
                utilidad = NULL,
                fecha_cierre = NULL
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $casoId
        ]);

        $this->pdo->commit();

        return true;

    } catch (Throwable $e) {

        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }

        throw $e;
    }
}

    //pendiente por eliminar
    public function getHistoryByVehicleId(int $vehiculoId): array
    {
        $stmt = $this->pdo->prepare("
        SELECT c.id, c.estado, c.causa, c.fecha_ingreso, u.nombre AS mecanico_nombre
        FROM casos c
        LEFT JOIN usuarios u ON c.mecanico_id = u.id
        WHERE c.vehiculo_id = :vehiculo_id
        ORDER BY c.fecha_ingreso DESC
    ");
        $stmt->execute(['vehiculo_id' => $vehiculoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function crearNuevoDesde(int $vehiculoId, int $referenciaAnterior): ?int
    {
        try {
            $stmt = $this->pdo->prepare("
            INSERT INTO casos (
                vehiculo_id,
                fecha_ingreso,
                hora_ingreso,
                estado,
                referencia_anterior
            )
            VALUES (
                :vehiculo_id,
                CURDATE(),
                CURTIME(),
                'abierto',
                :referencia_anterior
            )
        ");

            $stmt->execute([
                ':vehiculo_id' => $vehiculoId,
                ':referencia_anterior' => $referenciaAnterior
            ]);

            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {

            error_log("Error al crear nuevo caso: " . $e->getMessage());

            return null;
        }
    }
}

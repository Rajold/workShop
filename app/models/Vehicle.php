<?php
// app/models/Vehicle.php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class Vehicle extends BaseModel
{
    public function findByPlate(string $placa)
    {
        $stmt = $this->db->prepare("SELECT * FROM vehiculos WHERE placa = :p LIMIT 1");
        $stmt->execute([':p'=>$placa]);
        return $stmt->fetch() ?: null;
    }

     public function findByBrand(string $marca)
    {
        $stmt = $this->db->prepare("SELECT * FROM vehiculos WHERE marca = :p LIMIT 1");
        $stmt->execute([':p'=>$marca]);
        return $stmt->fetch() ?: null;
    }
        // Buscar vehículo por su ID
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM vehiculos WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $vehiculo ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO vehiculos (placa, marca, modelo, color, propietario, telefono) VALUES (:placa,:marca,:modelo,:color,:propietario, :telefono)");
        $stmt->execute([
            ':placa'=>$data['placa'],
            ':marca'=>$data['marca'] ?? null,
            ':modelo'=>$data['modelo'] ?? null,
            ':color'=>$data['color'] ?? null,
            ':propietario'=>$data['propietario'] ?? null,
            ':telefono'=>$data['telefono'] ?? null,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE vehiculos SET placa=:placa, marca=:marca, modelo=:modelo, color=:color, propietario=:propietario, telefono=:telefono WHERE id=:id");
        return $stmt->execute([
            ':placa'=>$data['placa'],
            ':marca'=>$data['marca'] ?? null,
            ':modelo'=>$data['modelo'] ?? null,
            ':color'=>$data['color'] ?? null,
            ':propietario'=>$data['propietario'] ?? null,
            ':telefono'=>$data['telefono'] ?? null,
            ':id'=>$id,
        ]);
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM vehiculos ORDER BY placa");
        return $stmt->fetchAll();
    }

   public function findByOwner(string $owner): ?array
{
    $stmt = $this->db->prepare("
        SELECT *
        FROM vehiculos
        WHERE propietario LIKE :owner
        ORDER BY propietario
        LIMIT 1
    ");

    $stmt->execute([
        ':owner' => "%{$owner}%"
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

public function search(string $criterio, string $valor): array
{
    switch ($criterio) {

        case 'placa':
            $sql = "
                SELECT
    v.*,
    c.estado,
    c.fecha_ingreso
FROM vehiculos v
LEFT JOIN (
    SELECT c1.*
    FROM casos c1
    INNER JOIN (
        SELECT vehiculo_id, MAX(id) AS ultimo_id
        FROM casos
        GROUP BY vehiculo_id
    ) c2
    ON c1.id = c2.ultimo_id
) c
ON c.vehiculo_id = v.id
WHERE v.placa LIKE :valor
ORDER BY v.placa
            ";
            $param = "%{$valor}%";
            break;

        case 'propietario':
            $sql = "
                SELECT
    v.*,
    c.estado,
    c.fecha_ingreso
FROM vehiculos v
LEFT JOIN (
    SELECT c1.*
    FROM casos c1
    INNER JOIN (
        SELECT vehiculo_id, MAX(id) AS ultimo_id
        FROM casos
        GROUP BY vehiculo_id
    ) c2
    ON c1.id = c2.ultimo_id
) c
ON c.vehiculo_id = v.id
WHERE v.propietario LIKE :valor
ORDER BY v.propietario
            ";
            $param = "%{$valor}%";
            break;

        case 'marca':
            $sql = "
                SELECT
    v.*,
    c.estado,
    c.fecha_ingreso
FROM vehiculos v
LEFT JOIN (
    SELECT c1.*
    FROM casos c1
    INNER JOIN (
        SELECT vehiculo_id, MAX(id) AS ultimo_id
        FROM casos
        GROUP BY vehiculo_id
    ) c2
    ON c1.id = c2.ultimo_id
) c
ON c.vehiculo_id = v.id
WHERE v.marca LIKE :valor
ORDER BY v.marca
            ";
            $param = "%{$valor}%";
            break;

        case 'estado':
    $sql = "
        SELECT DISTINCT
            v.*,
            c.estado,
            c.fecha_ingreso
        FROM vehiculos v
        INNER JOIN casos c
            ON c.vehiculo_id = v.id
        WHERE c.estado = :valor
        ORDER BY c.fecha_ingreso DESC
    ";

    $param = strtolower($valor);
    break;

        default:
            return [];
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        ':valor' => $param
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

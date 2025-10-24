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
        $stmt = $this->db->prepare("INSERT INTO vehiculos (placa, marca, modelo, color, propietario) VALUES (:placa,:marca,:modelo,:color,:propietario)");
        $stmt->execute([
            ':placa'=>$data['placa'],
            ':marca'=>$data['marca'] ?? null,
            ':modelo'=>$data['modelo'] ?? null,
            ':color'=>$data['color'] ?? null,
            ':propietario'=>$data['propietario'] ?? null,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE vehiculos SET placa=:placa, marca=:marca, modelo=:modelo, color=:color, propietario=:propietario WHERE id=:id");
        return $stmt->execute([
            ':placa'=>$data['placa'],
            ':marca'=>$data['marca'] ?? null,
            ':modelo'=>$data['modelo'] ?? null,
            ':color'=>$data['color'] ?? null,
            ':propietario'=>$data['propietario'] ?? null,
            ':id'=>$id,
        ]);
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM vehiculos ORDER BY placa");
        return $stmt->fetchAll();
    }
}

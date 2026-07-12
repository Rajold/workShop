<?php
// app/models/User.php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class User extends BaseModel
{
    public function countUsers(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as c FROM usuarios");
        $r = $stmt->fetch();
        return (int)$r['c'];
    }

    public function create(string $nombre, string $usuario, string $password, string $rol): int
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, usuario, contraseña_hash, rol, fecha_creacion) VALUES (:nombre, :usuario, :hash, :rol, NOW())");
        $stmt->execute([':nombre' => $nombre, ':usuario' => $usuario, ':hash' => $hash, ':rol' => $rol]);
        return (int)$this->db->lastInsertId();
    }

    public function findByUsername(string $usuario)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = :u LIMIT 1");
        $stmt->execute([':u' => $usuario]);
        return $stmt->fetch() ?: null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT id, nombre, usuario, rol, fecha_creacion FROM usuarios ORDER BY nombre");
        return $stmt->fetchAll();
    }

    public function findById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updatePassword(int $id, string $newPassword)
    {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE usuarios SET contraseña_hash = :h WHERE id = :id");
        return $stmt->execute([':h' => $hash, ':id' => $id]);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}

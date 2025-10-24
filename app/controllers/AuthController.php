<?php
// app/controllers/AuthController.php

declare(strict_types=1);

class AuthController
{
    protected PDO $db;
    protected User $userModel;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
        require_once __DIR__ . '/../models/User.php';
        $this->userModel = new User($pdo);
    }

    public function login()
    {
        // Si no hay usuarios, mostrar setup
        if ($this->userModel->countUsers() === 0) {
            require __DIR__ . '/../views/auth/setup_admin.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByUsername($usuario);
            if ($user && password_verify($password, $user['contraseña_hash'])) {
                // iniciar sesión
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_role'] = $user['rol'];

                if ($user['rol'] === 'admin') {
                    header('Location: index.php?controller=admin&action=dashboard');
                    exit;
                } else {
                    header('Location: index.php?controller=mechanic&action=dashboard');
                    exit;
                }
            } else {
                $error = 'Usuario o contraseña incorrectos';
                require __DIR__ . '/../views/auth/login.php';
                return;
            }
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function setup()
    {
        // crear primer admin
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $usuario = trim($_POST['usuario'] ?? '');
            $password = $_POST['password'] ?? '';
            if ($nombre === '' || $usuario === '' || $password === '') {
                $error = 'Todos los campos son obligatorios';
                require __DIR__ . '/../views/auth/setup_admin.php';
                return;
            }
            $this->userModel->create($nombre, $usuario, $password, 'admin');
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        require __DIR__ . '/../views/auth/setup_admin.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
    }
}

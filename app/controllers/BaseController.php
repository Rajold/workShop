<?php

namespace App\Controllers;

use App\Core\Database;
use PDO;

abstract class BaseController
{
    protected PDO $pdo;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->ensureLogged();

        $this->pdo = Database::getConnection();
    }

    /**
     * Verifica que exista un usuario autenticado.
     */
    protected function ensureLogged(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Redirecciona y finaliza la ejecución.
     */
    protected function redirect(string $url): never
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * Mensaje de éxito.
     */
    protected function success(string $message): void
    {
        $_SESSION['success'] = $message;
    }

    /**
     * Mensaje de error.
     */
    protected function error(string $message): void
    {
        $_SESSION['error'] = $message;
    }

    /**
     * Mensaje de advertencia.
     */
    protected function warning(string $message): void
    {
        $_SESSION['warning'] = $message;
    }

    /**
     * Mensaje informativo.
     */
    protected function info(string $message): void
    {
        $_SESSION['info'] = $message;
    }
}
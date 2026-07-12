<?php

abstract class BaseController
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->pdo = $pdo;

        $this->ensureLogged();
    }


    /**
     * Verifica que exista un usuario autenticado.
     */
    protected function ensureLogged(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    /**
     * Renderiza una vista.
     */

    protected function render(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . '/../views/layouts/header.php';

        require __DIR__ . '/../views/' . $view . '.php';

        require __DIR__ . '/../views/layouts/footer.php';
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

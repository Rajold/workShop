<?php
// app/controllers/AdminController.php

declare(strict_types=1);

class AdminController
{
    private PDO $db;
    private User $userModel;
    private Dashboard $dashboardModel;


    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;

        $this->userModel = new User($pdo);

        $this->dashboardModel = new Dashboard($pdo);
    }

    protected function ensureAdmin()
    {
        if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();
        $users = $this->userModel->findAll();

        /*
|--------------------------------------------------------------------------
| Estadísticas
|--------------------------------------------------------------------------
*/

        $users = $this->userModel->findAll();

        $stats = $this->dashboardModel->getStats();

        echo '<pre>';
        print_r($stats);
        echo '</pre>';
        exit;

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/admin/dashboard.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function users()
    {
        $this->ensureAdmin();
        $users = $this->userModel->findAll();
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/admin/users_list.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function createUser()
    {
        $this->ensureAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->create($_POST['nombre'], $_POST['usuario'], $_POST['password'], $_POST['rol']);
            header('Location: index.php?controller=admin&action=users');
            exit;
        }
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/admin/user_form.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function deleteUser()
    {
        $this->ensureAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id) {
            $this->userModel->delete($id);
        }
        header('Location: index.php?controller=admin&action=users');
    }

    public function resetPassword()
    {
        $this->ensureAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $newp = $_POST['password'];
            $this->userModel->updatePassword($id, $newp);
            header('Location: index.php?controller=admin&action=users');
            exit;
        }
    }
}

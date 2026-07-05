<?php
// app/controllers/AdminController.php

declare(strict_types=1);

class AdminController
{
    protected PDO $db;
    protected User $userModel;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
        require_once __DIR__ . '/../models/User.php';
        $this->userModel = new User($pdo);
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

$totalVehiculos = (int)$this->db
    ->query("SELECT COUNT(*) FROM vehiculos")
    ->fetchColumn();

$casosAbiertos = (int)$this->db
    ->query("SELECT COUNT(*) FROM casos WHERE estado='abierto'")
    ->fetchColumn();

$casosCerrados = (int)$this->db
    ->query("SELECT COUNT(*) FROM casos WHERE estado='cerrado'")
    ->fetchColumn();

$totalMecanicos = (int)$this->db
    ->query("SELECT COUNT(*) FROM usuarios WHERE rol='mecanico'")
    ->fetchColumn();

       $totalFacturado = (float)$this->db
        ->query("
            SELECT COALESCE(SUM(precio_cobrado - descuento),0)
            FROM casos
            WHERE estado='cerrado'
        ")
        ->fetchColumn();

    $casosMes = (int)$this->db
        ->query("
            SELECT COUNT(*)
            FROM casos
            WHERE estado='cerrado'
            AND YEAR(fecha_ingreso)=YEAR(CURDATE())
            AND MONTH(fecha_ingreso)=MONTH(CURDATE())
        ")
        ->fetchColumn();

    $facturacionMes = (float)$this->db
        ->query("
            SELECT COALESCE(SUM(precio_cobrado - descuento),0)
            FROM casos
            WHERE estado='cerrado'
            AND YEAR(fecha_ingreso)=YEAR(CURDATE())
            AND MONTH(fecha_ingreso)=MONTH(CURDATE())
        ")
        ->fetchColumn();

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

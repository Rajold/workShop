<?php

class InventoryController
{
    protected PDO $db;
    protected Part $partModel;

    public function __construct(PDO $pdo)
{
    $this->db = $pdo;

    require_once __DIR__ . '/../models/BaseModel.php';
    require_once __DIR__ . '/../models/Part.php';

    $this->partModel = new Part($pdo);
}

    protected function ensureLogged()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['user_id'])) {

        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}

  public function index()
{
    $this->ensureLogged();

    $search = trim($_GET['q'] ?? '');

    if ($search !== '') {
        $parts = $this->partModel->search($search);
    } else {
        $parts = $this->partModel->all();
    }

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/inventory/index.php';
    require __DIR__ . '/../views/layouts/footer.php';
}


}
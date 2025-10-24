<?php
// app/controllers/ReportController.php

declare(strict_types=1);

class ReportController
{
    protected PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    protected function ensureAdminOrMechanic()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public function form()
    {
        $this->ensureAdminOrMechanic();
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/reports/report_form.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function generate()
    {
        $this->ensureAdminOrMechanic();
        $type = $_GET['type'] ?? 'vehiculo';
        $from = $_GET['from'] ?? null;
        $to = $_GET['to'] ?? null;

        // Example: simple report by mechanic
        if ($type === 'mecanico') {
            $mec_id = (int)($_GET['mecanico_id'] ?? 0);
            $stmt = $this->db->prepare("SELECT c.*, v.placa, s.duracion, u.nombre as mecanico FROM casos c LEFT JOIN vehiculos v ON c.vehiculo_id=v.id LEFT JOIN sesiones_trabajo s ON s.caso_id=c.id LEFT JOIN usuarios u ON c.mecanico_id = u.id WHERE c.mecanico_id = :m AND (c.fecha_ingreso BETWEEN :from AND :to)");
            $stmt->execute([':m'=>$mec_id, ':from'=>$from ?: '1970-01-01', ':to'=>$to ?: date('Y-m-d')]);
            $rows = $stmt->fetchAll();
        } else {
            // default por vehiculo
            $placa = $_GET['placa'] ?? null;
            if ($placa) {
                $stmt = $this->db->prepare("SELECT c.*, v.placa, u.nombre as mecanico, s.duracion FROM casos c LEFT JOIN vehiculos v ON c.vehiculo_id=v.id LEFT JOIN usuarios u ON c.mecanico_id=u.id LEFT JOIN sesiones_trabajo s ON s.caso_id=c.id WHERE v.placa = :placa AND (c.fecha_ingreso BETWEEN :from AND :to)");
                $stmt->execute([':placa'=>$placa, ':from'=>$from ?: '1970-01-01', ':to'=>$to ?: date('Y-m-d')]);
                $rows = $stmt->fetchAll();
            } else {
                $rows = [];
            }
        }
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/reports/report_result.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}

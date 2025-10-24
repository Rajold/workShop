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

    protected function ensureLogged()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public function form()
    {
        $this->ensureLogged();
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/reports/report_form.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function generate()
    {
        $this->ensureLogged();
        $mec_id = (int)$_SESSION['user_id']; // mecánico logueado
        $placa = $_GET['placa'] ?? null;
        $from  = $_GET['from'] ?: '1970-01-01';
        $to    = $_GET['to'] ?: date('Y-m-d');

        // Consulta principal: sin agrupar para mantener los avances
        $sql = "
            SELECT 
                c.id AS caso_id,
                c.fecha_ingreso, c.hora_ingreso, c.causa, c.diagnostico, c.observaciones, c.estado,
                v.placa, v.marca, v.modelo, v.color, v.propietario,
                u.nombre AS mecanico,
                a.fecha AS avance_fecha, a.descripcion AS avance_desc,
                (
                    SELECT COALESCE(SUM(TIMESTAMPDIFF(
                        MINUTE,
                        CONCAT(s2.fecha_inicio, ' ', s2.hora_inicio),
                        CONCAT(s2.fecha_fin, ' ', s2.hora_fin)
                    )), 0)
                    FROM sesiones_trabajo s2
                    WHERE s2.caso_id = c.id
                ) AS total_minutos
            FROM casos c
            LEFT JOIN vehiculos v ON c.vehiculo_id = v.id
            LEFT JOIN usuarios u ON c.mecanico_id = u.id
            LEFT JOIN avances a ON a.caso_id = c.id
            WHERE c.mecanico_id = :mec_id
              AND (c.fecha_ingreso BETWEEN :from AND :to)
        ";

        $params = [':mec_id' => $mec_id, ':from' => $from, ':to' => $to];

        if ($placa) {
            $sql .= " AND v.placa = :placa";
            $params[':placa'] = $placa;
        }

        $sql .= " ORDER BY c.fecha_ingreso DESC, a.fecha ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agrupar avances por caso
        $grouped = [];
        foreach ($rows as $r) {
            $cid = $r['caso_id'];
            if (!isset($grouped[$cid])) {
                $grouped[$cid] = $r;
                $grouped[$cid]['avances'] = [];
                // Calcular formato legible de tiempo
                $mins = (int)($r['total_minutos'] ?? 0);
                $hours = floor($mins / 60);
                $rem = $mins % 60;
                $grouped[$cid]['tiempo_legible'] = sprintf('%dh %02dmin', $hours, $rem);
            }
            if (!empty($r['avance_fecha']) || !empty($r['avance_desc'])) {
                $grouped[$cid]['avances'][] = [
                    'fecha' => $r['avance_fecha'],
                    'descripcion' => $r['avance_desc']
                ];
            }
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/reports/report_result.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}

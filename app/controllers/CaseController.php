<?php
require_once __DIR__ . '/../models/RepairCase.php';
require_once __DIR__ . '/../models/Avance.php';

class CaseController {
    private $pdo;
    private $caseModel;
    private $avanceModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->caseModel = new RepairCase($pdo);
        $this->avanceModel = new Avance($pdo);
    }

    // Mostrar detalles del caso y formulario de avances
    public function ver() {
        if (!isset($_GET['id'])) {
            echo "ID de caso no especificado";
            return;
        }

        $id = (int)$_GET['id'];

        $caso = $this->caseModel->obtenerPorId($id);
        $avances = $this->avanceModel->obtenerAvancesPorCaso($id);

        if (!$caso) {
            echo "Caso no encontrado";
            return;
        }

        require __DIR__ . '/../views/casos/ver.php';
    }

    // Guardar nuevo avance
    public function agregarAvance() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $caso_id = (int)$_POST['caso_id'];
            $comentario = trim($_POST['comentario']);

            $this->avanceModel->agregarAvance($caso_id, $_SESSION['user_id'], $comentario);

            header('Location: index.php?controller=case&action=ver&id=' . $caso_id);
            exit;
        } else {
            echo "Error al procesar el avance";
        }
    }
}

<?php
require_once __DIR__ . '/../models/RepairCase.php';
require_once __DIR__ . '/../models/Avance.php';
require_once __DIR__ . '/../models/WorkSession.php';

class CaseController {
    private PDO $pdo;
    private RepairCase $caseModel;
    private Avance $avanceModel;

    public function __construct(PDO $pdo) {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

        $this->pdo = $pdo;
        $this->caseModel = new RepairCase($pdo);
        $this->avanceModel = new Avance($pdo);
    }

    private function ensureLogged(): void {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    // Mostrar detalles del caso y formulario de avances
    public function ver(): void {
    $this->ensureLogged();

    if (empty($_GET['id'])) {
        echo "ID de caso no especificado";
        return;
    }

    $id = (int)$_GET['id'];
    $caso = $this->caseModel->findById($id);
    $avances = $this->avanceModel->getByCase($id);

    if (!$caso) {
        echo "Caso no encontrado";
        return;
    }

    // ✅ Obtener el historial de casos del mismo vehículo
    $historial = $this->caseModel->getHistoryByVehicleId((int)$caso['vehiculo_id']);

    require __DIR__ . '/../views/casos/ver.php';
}


    // Guardar nuevo avance
    public function add(): void {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caso_id = (int)$_POST['caso_id'];
            $descripcion = trim($_POST['descripcion']);

            $this->avanceModel->add($caso_id, $_SESSION['user_id'], $descripcion);

            header('Location: index.php?controller=case&action=ver&id=' . $caso_id);
            exit;
        }

        echo "Error al procesar el avance";
    }

    // ✅ Cerrar caso
    public function cerrar(): void {
    $this->ensureLogged();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['caso_id'])) {
        echo "<div class='alert alert-danger'>Solicitud inválida.</div>";
        return;
    }

    $caseId = (int)$_POST['caso_id'];
    $mechanicId = (int)$_SESSION['user_id'];

    // 🔍 Obtener el ID del vehículo asociado al caso
    $stmt = $this->pdo->prepare("SELECT vehiculo_id FROM casos WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $caseId]);
    $vehiculoId = $stmt->fetchColumn();

    if (!$vehiculoId) {
        echo "<div class='alert alert-danger'>No se encontró el vehículo asociado al caso.</div>";
        return;
    }

    // 🕓 Finalizar sesión activa si existe
    $workSession = new WorkSession($this->pdo);
    $active = $workSession->getActiveByCaseAndMechanic($caseId, $mechanicId);
    if ($active) {
        $workSession->end((int)$active['id']);
    }

    // ✅ Cerrar el caso
    $stmt = $this->pdo->prepare("UPDATE casos SET estado = 'cerrado' WHERE id = :id");
    $stmt->execute([':id' => $caseId]);

    // 📝 Registrar avance automático
    $this->avanceModel->add($caseId, $mechanicId, '✅ Caso cerrado por el mecánico.');

    // 🔁 Redirigir correctamente
    header('Location: index.php?controller=mechanic&action=viewCase&veh_id=' . $vehiculoId);
    exit;
}

// 🆕 Crear un nuevo caso desde uno cerrado
public function nuevoDesdeExistente(): void {
    $this->ensureLogged();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "<div class='alert alert-danger'>Solicitud inválida.</div>";
        return;
    }

    $vehiculoId = (int)$_POST['vehiculo_id'];
    $referenciaAnterior = (int)$_POST['referencia_anterior'];
    $mecanicoId = (int)$_SESSION['user_id'];

    // Llamar al modelo para crear el nuevo caso
    $nuevoCasoId = $this->caseModel->crearNuevoDesde($vehiculoId, $referenciaAnterior);

    if ($nuevoCasoId) {
        // Registrar un avance automático indicando que se creó el nuevo caso
        $this->avanceModel->add($nuevoCasoId, $mecanicoId, "🆕 Nuevo caso creado a partir del caso #$referenciaAnterior");

        // Redirigir a la vista del nuevo caso
        header("Location: index.php?controller=mechanic&action=viewCase&veh_id={$vehiculoId}&case_id={$nuevoCasoId}");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error al crear el nuevo caso.</div>";
    }
}


}

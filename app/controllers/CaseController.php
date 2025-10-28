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
public function nuevoDesdeExistente(): void
{
    $this->ensureLogged();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vehiculo_id = (int)$_POST['vehiculo_id'];
        $referencia_anterior = (int)$_POST['referencia_anterior'];
        $mecanico_id = (int)$_SESSION['user_id'];

        // 1️⃣ Verificar si el vehículo ya tiene un caso abierto
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM casos WHERE vehiculo_id = :vehiculo_id AND estado = 'abierto'");
        $stmt->execute(['vehiculo_id' => $vehiculo_id]);
        $abiertos = (int)$stmt->fetchColumn();

        if ($abiertos > 0) {
            // 🚫 No permitir crear otro caso abierto
            $_SESSION['error_message'] = "El vehículo ya tiene un caso abierto. Debe cerrarse antes de crear uno nuevo.";
            header("Location: index.php?controller=mechanic&action=viewCase&veh_id={$vehiculo_id}&case_id={$referencia_anterior}");
            exit;
        }

        // 2️⃣ Obtener información del caso anterior para referencia
        $stmt = $this->pdo->prepare("SELECT causa, diagnostico, observaciones FROM casos WHERE id = :id");
        $stmt->execute(['id' => $referencia_anterior]);
        $anterior = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3️⃣ Crear el nuevo caso
        $stmt = $this->pdo->prepare("
            INSERT INTO casos (vehiculo_id, mecanico_id, causa, diagnostico, observaciones, estado, fecha_ingreso)
            VALUES (:vehiculo_id, :mecanico_id, :causa, :diagnostico, :observaciones, 'abierto', NOW())
        ");

        $stmt->execute([
            'vehiculo_id' => $vehiculo_id,
            'mecanico_id' => $mecanico_id,
            'causa' => 'Nuevo ingreso del vehículo',
            'diagnostico' => $anterior['diagnostico'] ?? '',
            'observaciones' => 'Relacionado con caso #' . $referencia_anterior,
        ]);

        $nuevoCasoId = (int)$this->pdo->lastInsertId();

        // 4️⃣ Registrar avance automático
        $this->avanceModel->add($nuevoCasoId, $mecanico_id, "🆕 Caso creado a partir del caso anterior #{$referencia_anterior}");

        // 5️⃣ Redirigir a la nueva vista del caso
        header("Location: index.php?controller=mechanic&action=viewCase&veh_id={$vehiculo_id}&case_id={$nuevoCasoId}");
        exit;
    }

    echo "Solicitud inválida.";
}



}

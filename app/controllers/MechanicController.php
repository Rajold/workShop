<?php
// app/controllers/MechanicController.php

declare(strict_types=1);

class MechanicController
{
    protected PDO $db;
    protected Vehicle $vehicleModel;
    protected RepairCase $caseModel;
    protected WorkSession $sessionModel;
    protected User $userModel;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;

        require_once __DIR__ . '/../models/Vehicle.php';
        require_once __DIR__ . '/../models/RepairCase.php';
        require_once __DIR__ . '/../models/WorkSession.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Avance.php';

        $this->vehicleModel = new Vehicle($pdo);
        $this->caseModel = new RepairCase($pdo);
        $this->sessionModel = new WorkSession($pdo);
        $this->userModel = new User($pdo);
    }

    protected function ensureLogged()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public function dashboard()
    {
        $this->ensureLogged();
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mechanic/dashboard.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function searchVehicle()
    {
        $this->ensureLogged();
        $vehicle = null;
        $cases = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $placa = trim($_POST['placa'] ?? '');
            $vehicle = $this->vehicleModel->findByPlate($placa);
            if ($vehicle) {
                $cases = $this->caseModel->findByVehicle((int)$vehicle['id']);
            }
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mechanic/vehicle_search.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function saveVehicle()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'placa'=>trim($_POST['placa']),
                'marca'=>trim($_POST['marca'] ?? ''),
                'modelo'=>trim($_POST['modelo'] ?? ''),
                'color'=>trim($_POST['color'] ?? ''),
                'propietario'=>trim($_POST['propietario'] ?? ''),
            ];

            $existing = $this->vehicleModel->findByPlate($data['placa']);
            $id = $existing ? (int)$existing['id'] : $this->vehicleModel->create($data);

            if ($existing) $this->vehicleModel->update($id, $data);

            header('Location: index.php?controller=mechanic&action=viewCase&veh_id=' . $id);
            exit;
        }
    }

    public function viewCase()
    {
        $this->ensureLogged();

        $veh_id = (int)($_GET['veh_id'] ?? 0);
        $case_id = (int)($_GET['case_id'] ?? 0);
        $vehicle = null;
        $caso = null;
        $cases = [];
        $avances = [];
        $activeSession = null;

        $advanceModel = new Advance($this->db);

        if ($veh_id) {
            $vehicle = $this->vehicleModel->findById($veh_id);
            $cases = $this->caseModel->findByVehicle($veh_id);

            if ($case_id) {
                $caso = $this->caseModel->findById($case_id);
            } else {
                $caso = $cases[0] ?? null;
            }

            // Cargar avances
            if ($caso) {
                $avances = $advanceModel->getByCase((int)$caso['id']);
                $activeSession = $this->sessionModel->getActiveByCaseAndMechanic((int)$caso['id'], (int)($_SESSION['user_id'] ?? 0));
            }
        }

        // Guardar nuevo avance
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nuevo_avance']) && isset($caso['id'])) {
            $descripcion = trim($_POST['nuevo_avance']);
            if ($descripcion !== '' && $activeSession) {
                $advanceModel->add((int)$caso['id'], (int)$_SESSION['user_id'], $descripcion);
                header("Location: index.php?controller=mechanic&action=viewCase&case_id={$caso['id']}&veh_id={$veh_id}");
                exit;
            }
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mechanic/case_view.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function openCase()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $veh_id = (int)$_POST['veh_id'];
            $mec_id = (int)$_SESSION['user_id'];
            $causa = $_POST['causa'] ?? '';
            $caso_id = $this->caseModel->openCaseIfNone($veh_id, $mec_id, $causa);
            $this->sessionModel->start($caso_id, $mec_id);

            header('Location: index.php?controller=mechanic&action=viewCase&case_id=' . $caso_id . '&veh_id=' . $veh_id);
            exit;
        }
    }

    public function startSession()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $case_id = (int)$_POST['case_id'];

            // obtener vehiculo
            $stmt = $this->db->prepare("SELECT vehiculo_id FROM casos WHERE id = :id");
            $stmt->execute([':id' => $case_id]);
            $veh = $stmt->fetch(PDO::FETCH_ASSOC);
            $veh_id = $veh['vehiculo_id'] ?? 0;

            $this->sessionModel->start($case_id, (int)$_SESSION['user_id']);

            header("Location: index.php?controller=mechanic&action=viewCase&case_id={$case_id}&veh_id={$veh_id}");
            exit;
        }
    }

    public function endSession()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $session_id = (int)$_POST['session_id'];
            $this->sessionModel->end($session_id);

            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
            exit;
        }
    }
}

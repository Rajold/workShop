<?php
// app/controllers/MechanicController.php

declare(strict_types=1);

class MechanicController extends BaseController
{
    protected Vehicle $vehicleModel;
    protected RepairCase $caseModel;
    protected WorkSession $sessionModel;
    protected User $userModel;
    private ModeloMoto $motorcycleModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        require_once __DIR__ . '/../models/Vehicle.php';
        require_once __DIR__ . '/../models/RepairCase.php';
        require_once __DIR__ . '/../models/WorkSession.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Avance.php';

        $this->vehicleModel = new Vehicle($pdo);
        $this->caseModel = new RepairCase($pdo);
        $this->sessionModel = new WorkSession($pdo);
        $this->userModel = new User($pdo);
        $this->motorcycleModel = new ModeloMoto($pdo);
    }

    public function dashboard(): void
    {
        $this->render('mechanic/dashboard');
    }

    public function searchVehicle(): void
    {
        $vehicles = [];

        $criterio = 'placa';
        $valor = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $criterio = trim($_POST['criterio'] ?? 'placa');
            $valor    = trim($_POST['valor'] ?? '');

            $vehicles = $this->vehicleModel->search(
                $criterio,
                $valor
            );
        }

        $this->render(
            'mechanic/vehicle_search',
            [

                'vehicles' => $vehicles,

                'criterio' => $criterio,

                'valor' => $valor,

                'motorcycleModels' =>
                $this->motorcycleModel->allForPicker()

            ]
        );
    }


    public function saveVehicle()
    {
        $this->ensureLogged();

        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'placa' => trim($_POST['placa']),

                'marca' => trim($_POST['marca'] ?? ''),

                'modelo' => trim($_POST['modelo'] ?? ''),

                'modelo_moto_id' =>
                !empty($_POST['modelo_moto_id'])
                    ? (int)$_POST['modelo_moto_id']
                    : null,

                'color' => trim($_POST['color'] ?? ''),

                'propietario' => trim($_POST['propietario'] ?? ''),

                'telefono' => trim($_POST['telefono'] ?? '')
            ];

            // Crear o actualizar vehículo
            $existing = $this->vehicleModel->findByPlate($data['placa']);
            $veh_id = $existing ? (int)$existing['id'] : $this->vehicleModel->create($data);

            if ($existing) {
                $this->vehicleModel->update($veh_id, $data);
            }

            // Nueva: registrar la falla reportada en la tabla "casos"
            $causa = trim($_POST['causa'] ?? '');
            if ($causa !== '') {
                $mec_id = (int)$_SESSION['user_id'];
                $caso_id = $this->caseModel->openCaseIfNone($veh_id, $mec_id, $causa);

                // Redirigir a la ficha del caso recién creado
                header("Location: index.php?controller=mechanic&action=viewCase&veh_id={$veh_id}&case_id={$caso_id}");
                exit;
            }

            // Si no hay causa, mostrar la ficha del vehículo
            header("Location: index.php?controller=mechanic&action=viewCase&veh_id={$veh_id}");
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
        $hasOpenCase = false;
        $totales = [
            'mano_obra' => 0,
            'repuestos' => 0,
            'total' => 0
        ];

        $advanceModel = new Avance($this->pdo);

        if ($veh_id) {
            // 🚗 Obtener datos del vehículo y sus casos
            $vehicle = $this->vehicleModel->findById($veh_id);
            $cases = $this->caseModel->findByVehicle($veh_id);

            // 🔍 Verificar si hay un caso abierto
            foreach ($cases as $c) {
                if ($c['estado'] === 'abierto') {
                    $hasOpenCase = true;
                    break;
                }
            }

            // 📄 Seleccionar el caso activo o el primero disponible
            if ($case_id) {
                $caso = $this->caseModel->findById($case_id);
            } else {
                $caso = $cases[0] ?? null;
            }

            // 🧾 Cargar avances, totales y sesión activa
            if ($caso) {

                $avances = $advanceModel->getByCase((int)$caso['id']);

                $totales = $advanceModel->getTotalesPorCaso((int)$caso['id']);

                $activeSession = $this->sessionModel->getActiveByCaseAndMechanic(
                    (int)$caso['id'],
                    (int)($_SESSION['user_id'] ?? 0)
                );
            }
        }

        // 📝 Guardar nuevo avance
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nuevo_avance']) && isset($caso['id'])) {

            $descripcion = trim($_POST['nuevo_avance']);
            $tipo = trim($_POST['tipo'] ?? '');
            $valor = (int)($_POST['valor'] ?? 0);

            if ($descripcion !== '' && $tipo !== '' && $activeSession) {

                $advanceModel->add(
                    (int)$caso['id'],
                    (int)$_SESSION['user_id'],
                    $descripcion,
                    $tipo,
                    $valor
                );

                header("Location: index.php?controller=mechanic&action=viewCase&case_id={$caso['id']}&veh_id={$veh_id}");
                exit;
            }
        }

        // 🧱 Cargar vistas
        $this->render('mechanic/case_view', [
            'veh_id'         => $veh_id,
            'vehicle'        => $vehicle,
            'caso'           => $caso,
            'cases'          => $cases,
            'avances'        => $avances,
            'activeSession'  => $activeSession,
            'hasOpenCase'    => $hasOpenCase,
            'totales'        => $totales
        ]);
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
            $stmt = $this->pdo->prepare("SELECT vehiculo_id FROM casos WHERE id = :id");
            $stmt->execute([':id' => $case_id]);
            $veh = $stmt->fetch(PDO::FETCH_ASSOC);
            $veh_id = $veh['vehiculo_id'] ?? 0;

            $this->sessionModel->start($case_id, (int)$_SESSION['user_id']);

            header("Location: index.php?controller=mechanic&action=viewCase&case_id={$case_id}&veh_id={$veh_id}");
            exit;
        }
    }

    public function editAdvance()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $advanceModel = new Avance($this->pdo);

        $id = (int)($_POST['id'] ?? 0);

        $avance = $advanceModel->getById($id);

        if (!$avance) {
            $_SESSION['error_message'] = "El avance no existe.";
            header('Location: index.php');
            exit;
        }

        $descripcion = trim($_POST['descripcion'] ?? '');
        $tipo = trim($_POST['tipo'] ?? '');
        $valor = (int)($_POST['valor'] ?? 0);

        if ($advanceModel->update($id, $descripcion, $tipo, $valor)) {
            $_SESSION['success_message'] = "Avance actualizado correctamente.";
        } else {
            $_SESSION['error_message'] = "No fue posible actualizar el avance.";
        }

        header(
            "Location: index.php?controller=mechanic&action=viewCase&veh_id={$avance['vehiculo_id']}&case_id={$avance['caso_id']}"
        );
        exit;
    }

    public function deleteAdvance()
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $advanceModel = new Avance($this->pdo);

        $id = (int)($_POST['id'] ?? 0);

        $avance = $advanceModel->getById($id);

        if (!$avance) {
            $_SESSION['error_message'] = "El avance no existe.";
            header('Location: index.php');
            exit;
        }

        // 🔒 Validación de permisos
        if (
            $avance['mecanico_id'] != $_SESSION['user_id']
            && $_SESSION['user_role'] !== 'admin'
        ) {
            $_SESSION['error_message'] = "No tiene permisos para eliminar este avance.";
            header(
                "Location: index.php?controller=mechanic&action=viewCase&veh_id={$avance['vehiculo_id']}&case_id={$avance['caso_id']}"
            );
            exit;
        }

        // 🗑 Eliminar
        if ($advanceModel->delete($id)) {
            $_SESSION['success_message'] = "Avance eliminado.";
        } else {
            $_SESSION['error_message'] = "No fue posible eliminar el avance.";
        }

        header(
            "Location: index.php?controller=mechanic&action=viewCase&veh_id={$avance['vehiculo_id']}&case_id={$avance['caso_id']}"
        );
        exit;
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

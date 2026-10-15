<?php

declare(strict_types=1);

require_once __DIR__ . '/../services/ExpenseService.php';

class ExpenseController extends BaseController
{
    private ExpenseService $expenseService;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->expenseService = new ExpenseService($pdo);
    }

    /**
     * Listar gastos.
     * Los administradores ven todos; los demás, solo los propios.
     */
    public function index(): void
    {
        $this->ensureLogged();

        $estado = trim($_GET['estado'] ?? '');
        $categoria = trim($_GET['categoria'] ?? '');

        $estadosPermitidos = [
            'pendiente',
            'aprobado',
            'rechazado',
        ];

        $categoriasPermitidas = [
            'alimentacion',
            'operativo',
            'herramientas',
            'transporte',
            'imprevisto',
            'otro',
        ];

        // Validar los filtros recibidos por GET.
        if (!in_array($estado, $estadosPermitidos, true)) {
            $estado = '';
        }

        if (!in_array($categoria, $categoriasPermitidas, true)) {
            $categoria = '';
        }

        // Determinar el rol y el usuario actual.
        $esAdmin = ($_SESSION['user_role'] ?? '') === 'admin';
        $userId = (int) ($_SESSION['user_id'] ?? 0);

        // Verificar que los usuarios no administradores tengan un ID válido.
        if (!$esAdmin && $userId <= 0) {
            $this->error('No se pudo identificar al usuario.');
            $this->redirect('index.php');
            return;
        }

        // Los administradores ven todos los gastos.
        // Los demás usuarios solo ven los gastos que registraron.
        $registradoPor = $esAdmin ? null : $userId;

        $gastos = $this->expenseService->all(
            $estado !== '' ? $estado : null,
            $categoria !== '' ? $categoria : null,
            $registradoPor
        );

        $this->render('expense/index', [
            'title' => 'Gestión de gastos',
            'gastos' => $gastos,
            'estado' => $estado,
            'categoria' => $categoria,
            'esAdmin' => $esAdmin,
        ]);
    }
    /**
     * Mostrar formulario de registro.
     */
    public function create(): void
    {
        $this->ensureLogged();

        $this->render('expense/form', [
            'title' => 'Registrar gasto',
        ]);
    }

    /**
     * Guardar un gasto nuevo.
     */
    public function store(): void
    {
        $this->ensureLogged();

        if (!$this->isPost()) {
            $this->redirect(
                'index.php?controller=expense&action=create'
            );
        }

        try {
            $this->expenseService->register(
                $_POST,
                (int)$_SESSION['user_id']
            );

            $this->success(
                'Gasto registrado. Queda pendiente de aprobación.'
            );

            $this->redirect(
                'index.php?controller=expense&action=index'
            );
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            $this->redirect(
                'index.php?controller=expense&action=create'
            );
        }
    }

    /**
     * Aprobar o rechazar un gasto.
     */
    public function decide(): void
    {
        $this->ensureAdmin();

        if (!$this->isPost()) {
            $this->redirect(
                'index.php?controller=expense&action=index'
            );
        }

        $id = (int)($_POST['id'] ?? 0);
        $decision = trim($_POST['decision'] ?? '');

        try {
            $resultado = $this->expenseService->decide(
                $id,
                (int)$_SESSION['user_id'],
                $decision
            );

            if ($resultado) {
                $this->success(
                    $decision === 'aprobado'
                        ? 'Gasto aprobado correctamente.'
                        : 'Gasto rechazado correctamente.'
                );
            } else {
                $this->warning(
                    'El gasto no existe, ya fue procesado o no admite esa decisión.'
                );
            }
        } catch (Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(
            'index.php?controller=expense&action=index'
        );
    }

    /**
     * Marcar un gasto aprobado como pagado.
     */
    public function markPaid(): void
    {
        $this->ensureAdmin();

        if (!$this->isPost()) {
            $this->redirect(
                'index.php?controller=expense&action=index'
            );
        }

        $id = (int)($_POST['id'] ?? 0);

        try {
            if ($this->expenseService->markPaid($id)) {
                $this->success('Pago registrado correctamente.');
            } else {
                $this->warning(
                    'No se pudo registrar el pago. Comprueba el estado del gasto.'
                );
            }
        } catch (Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(
            'index.php?controller=expense&action=index'
        );
    }

    /**
     * Marcar un reembolso efectivamente realizado.
     */
    public function markReimbursed(): void
    {
        $this->ensureAdmin();

        if (!$this->isPost()) {
            $this->redirect(
                'index.php?controller=expense&action=index'
            );
        }

        $id = (int)($_POST['id'] ?? 0);

        try {
            if ($this->expenseService->markReimbursed($id)) {
                $this->success('Reembolso registrado correctamente.');
            } else {
                $this->warning(
                    'No se pudo registrar el reembolso. Comprueba el estado y la forma de pago.'
                );
            }
        } catch (Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(
            'index.php?controller=expense&action=index'
        );
    }

    /**
     * Comprobar permisos de administrador.
     */
    private function ensureAdmin(): void
    {
        $this->ensureLogged();

        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            $this->error(
                'No tienes permisos para realizar esta operación.'
            );

            $this->redirect(
                'index.php?controller=expense&action=index'
            );
            return;
        }
    }
}

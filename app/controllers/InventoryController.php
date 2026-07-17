<?php

declare(strict_types=1);
require_once __DIR__ . '/../services/InventoryService.php';

class InventoryController extends BaseController
{
    private Part $partModel;
    private InventoryService $inventoryService;
    private FabricanteRepuesto $manufacturerModel;


    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->partModel = new Part($pdo);
        $this->inventoryService = new InventoryService($pdo);
        $this->manufacturerModel = new FabricanteRepuesto($pdo);
    }

    /**
     * Listado del inventario.
     */
    public function index(): void
    {
        $search = trim($_GET['q'] ?? '');
        $stats = $this->partModel->getStatistics();
        if ($search !== '') {
            $parts = $this->partModel->search($search);
        } else {
            $parts = $this->partModel->all();
        }

        $this->render(
            'inventory/index',
            [
                'parts'  => $parts,
                'search' => $search,
                'stats'  => $stats,
                'title'  => 'Inventario'
            ]
        );
    }

    /**
     * Formulario de nuevo artículo.
     */
    public function create(): void
    {
        $this->render('inventory/form', [
            'part' => null,
            'categories' => $this->partModel->categories(),
            'title' => 'Nuevo artículo',
            'manufacturers' => $this->manufacturerModel->active()
        ]);
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(): void
    {
        $this->ensureLogged();

        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {

            $this->error('Artículo no válido.');

            $this->redirect('index.php?controller=inventory&action=index');

            return;
        }

        $part = $this->partModel->findById($id);


        if (!$part) {

            $this->error('El artículo no existe.');

            $this->redirect('index.php?controller=inventory&action=index');

            return;
        }

        $this->render('inventory/form', [
            'part' => $part,
            'categories' => $this->partModel->categories(),
            'title' => 'Editar artículo',
            'manufacturers' => $this->manufacturerModel->active()


        ]);
    }

    public function update(): void
    {
        $this->ensureLogged();

        $data = $_POST;
        // Fabricante
        $data['fabricante_repuesto_id'] =
            !empty($_POST['fabricante_repuesto_id'])
            ? (int)$_POST['fabricante_repuesto_id']
            : null;

        // Número de parte
        $data['numero_parte'] =
            trim($_POST['numero_parte'] ?? '');

        $id = (int)($data['id'] ?? 0);

        if ($id <= 0) {

            $this->error('Artículo no válido.');

            $this->redirect('index.php?controller=inventory&action=index');

            return;
        }

        // Normalizar valores numéricos
        $data['stock_minimo'] = $data['stock_minimo'] !== ''
            ? (float)$data['stock_minimo']
            : 0;

        $data['costo'] = $data['costo'] !== ''
            ? (float)$data['costo']
            : 0;

        $data['precio_venta'] = $data['precio_venta'] !== ''
            ? (float)$data['precio_venta']
            : 0;
        // Compatibilidad temporal con la columna "marca"
        $data['marca'] = null;

        if ($data['fabricante_repuesto_id']) {

            $fabricante = $this->manufacturerModel
                ->find($data['fabricante_repuesto_id']);

            if ($fabricante) {

                $data['marca'] = $fabricante['nombre'];
            }
        }
        $data['id'] = $id;

        // Validación básica
        if (empty($data['codigo']) || empty($data['nombre'])) {

            $this->error('El código y el nombre son obligatorios.');

            $this->redirect(
                'index.php?controller=inventory&action=edit&id=' . $id
            );

            return;
        }

        if ($this->partModel->update($data)) {

            $this->success('Artículo actualizado correctamente.');

            $this->redirect('index.php?controller=inventory&action=index');

            return;
        }

        $this->error('No fue posible actualizar el artículo.');

        $this->redirect(
            'index.php?controller=inventory&action=edit&id=' . $id
        );
    }

    public function store(): void
    {
        $this->ensureLogged();

        $data = $_POST;

        // Fabricante
        $data['fabricante_repuesto_id'] =
            !empty($_POST['fabricante_repuesto_id'])
            ? (int)$_POST['fabricante_repuesto_id']
            : null;

        // Número de parte
        $data['numero_parte'] =
            trim($_POST['numero_parte'] ?? '');

        // Normalizar valores numéricos
        $data['stock_minimo'] = $data['stock_minimo'] !== ''
            ? (float)$data['stock_minimo']
            : 0;

        $data['costo'] = $data['costo'] !== ''
            ? (float)$data['costo']
            : 0;

        $data['precio_venta'] = $data['precio_venta'] !== ''
            ? (float)$data['precio_venta']
            : 0;

        // Usuario que crea el registro
        $data['created_by'] = $_SESSION['user_id'];

        // Compatibilidad temporal con la columna "marca"
        $data['marca'] = null;

        if ($data['fabricante_repuesto_id']) {

            $fabricante = $this->manufacturerModel
                ->find($data['fabricante_repuesto_id']);

            if ($fabricante) {

                $data['marca'] = $fabricante['nombre'];
            }
        }

        // Validación básica
        if (empty($data['codigo']) || empty($data['nombre'])) {

            $this->error('El código y el nombre son obligatorios.');

            $this->redirect('index.php?controller=inventory&action=create');

            return;
        }

        // echo '<pre>';
        // var_dump($data['tipo']);
        // exit;

        if ($this->partModel->create($data)) {

            $this->success('Artículo creado correctamente.');

            $this->redirect('index.php?controller=inventory&action=index');

            return;
        }

        $this->error('No fue posible guardar el artículo.');

        $this->redirect('index.php?controller=inventory&action=create');
    }

    public function selectForCase(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_GET['case_id'] ?? 0);
        $vehId  = (int)($_GET['veh_id'] ?? 0);

        $search = trim($_GET['q'] ?? '');

        $parts = $this->partModel->all($search);

        $this->render('inventory/select_for_case', [
            'caseId' => $caseId,
            'vehId'  => $vehId,
            'parts'  => $parts,
            'search' => $search
        ]);
    }

    public function addToCart(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_POST['case_id'] ?? 0);
        $vehId  = (int)($_POST['veh_id'] ?? 0);
        $partId = (int)($_POST['parte_id'] ?? 0);
        $cantidad = (float)($_POST['cantidad'] ?? 1);

        if (!isset($_SESSION['case_cart'])) {

            $_SESSION['case_cart'] = [];
        }

        if (!isset($_SESSION['case_cart'][$caseId])) {

            $_SESSION['case_cart'][$caseId] = [];
        }

        $part = $this->partModel->findById($partId);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                "index.php?controller=inventory&action=selectForCase&case_id={$caseId}&veh_id={$vehId}"
            );

            return;
        }

        if (!isset($_SESSION['case_cart'])) {

            $_SESSION['case_cart'] = [];
        }

        if (isset($_SESSION['case_cart'][$caseId][$partId])) {

            $_SESSION['case_cart'][$caseId][$partId]['cantidad'] += $cantidad;
        } else {

            $_SESSION['case_cart'][$caseId][$partId] = [

                'part_id'        => $partId,

                'codigo'         => $part['codigo'],

                'nombre'         => $part['nombre'],

                'marca'          => $part['marca'],

                'unidad'         => $part['unidad'],

                'cantidad'       => $cantidad,

                'costo'          => (float)$part['costo'],

                'precio_venta'   => (float)$part['precio_venta']

            ];
        }

        $this->success('Artículo agregado al carrito.');

        $this->redirect(
            "index.php?controller=inventory&action=selectForCase&case_id={$caseId}&veh_id={$vehId}"
        );
    }

    public function removeFromCart(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_POST['case_id'] ?? 0);
        $vehId  = (int)($_POST['veh_id'] ?? 0);
        $partId = (int)($_POST['part_id'] ?? 0);

        if (isset($_SESSION['case_cart'][$caseId][$partId])) {

            unset($_SESSION['case_cart'][$caseId][$partId]);

            if (empty($_SESSION['case_cart'][$caseId])) {

                unset($_SESSION['case_cart'][$caseId]);
            }

            $this->success('Artículo eliminado del carrito.');
        } else {

            $this->error('El artículo no estaba en el carrito.');
        }

        $this->redirect(
            "index.php?controller=inventory&action=selectForCase&case_id={$caseId}&veh_id={$vehId}"
        );
    }

    public function confirmCart(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_POST['case_id'] ?? 0);
        $vehId  = (int)($_POST['veh_id'] ?? 0);

        try {

            $this->inventoryService->confirmCart(
                $caseId,
                $vehId,
                (int)$_SESSION['user_id']
            );

            $this->success(
                'Los repuestos fueron aplicados correctamente.'
            );
        } catch (Throwable $e) {

            $this->error($e->getMessage());
        }

        $this->redirect(
            "index.php?controller=mechanic&action=viewCase&veh_id={$vehId}"
        );
    }

    private function clearCaseCart(int $caseId): void
    {
        unset($_SESSION['case_cart'][$caseId]);

        if (empty($_SESSION['case_cart'])) {
            unset($_SESSION['case_cart']);
        }
    }

    private function createAdvance(
        Avance $avanceModel,
        int $caseId,
        array $item
    ): void {

        $descripcion = sprintf(
            'Repuesto: %s x %s',
            $item['nombre'],
            $item['cantidad']
        );

        $avanceModel->add(
            $caseId,
            $_SESSION['user_id'],
            $descripcion,
            'Repuesto',
            (int)($item['precio_venta'] * $item['cantidad'])
        );
    }

    private function validateCartStock(array $cart): bool
    {
        foreach ($cart as $item) {

            $part = $this->partModel->findById($item['part_id']);

            if (!$part) {
                return false;
            }

            if ($part['stock_actual'] < $item['cantidad']) {
                return false;
            }
        }

        return true;
    }

    public function movements(): void
    {
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        $part = $this->partModel->findById($id);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );

            return;
        }

        $movements = $this->partModel->getMovements($id);

        $this->render(
            'inventory/movements',
            [
                'part' => $part,
                'movements' => $movements,
                'title' => 'Movimientos de inventario'
            ]
        );
    }

    public function addStock(): void
    {
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        $part = $this->partModel->findById($id);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                'index.php?controller=inventory'
            );
        }

        $this->render(
            'inventory/add_stock',
            [
                'title' => 'Agregar stock',
                'part'  => $part
            ]
        );
    }

    public function saveStock(): void
    {
        $this->ensureLogged();

        if (!$this->isPost()) {

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );
        }

        $id = (int)$_POST['id'];

        $cantidad = (float)$_POST['cantidad'];

        $costo = (float)$_POST['costo'];

        $motivo = trim($_POST['motivo']);

        $observacion = trim($_POST['observacion']);

        $part = $this->partModel->findById($id);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                'index.php?controller=inventory'
            );
        }

        $nuevoStock = $part['stock_actual'] + $cantidad;

        try {

            $this->pdo->beginTransaction();

            if (!$this->partModel->updateInventory(
                $id,
                $nuevoStock,
                $costo
            )) {

                throw new Exception(
                    'No fue posible actualizar el inventario.'
                );
            }

            if (!$this->partModel->registerMovement([

                'parte_id'         => $id,
                'usuario_id'       => $_SESSION['user_id'],
                'caso_id'          => null,

                'tipo'             => 'compra',

                'motivo'           => $motivo,

                'cantidad'         => $cantidad,

                'stock_resultante' => $nuevoStock,

                'costo_unitario'   => $costo,

                'observacion'      => $observacion

            ])) {

                throw new Exception(
                    'No fue posible registrar el movimiento.'
                );
            }

            $this->pdo->commit();

            $this->success(
                'Stock actualizado correctamente.'
            );
        } catch (Throwable $e) {

            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            $this->error(
                $e->getMessage()
            );
        }

        $this->redirect(
            'index.php?controller=inventory'
        );
    }

    public function adjustStock(): void
    {
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        $part = $this->partModel->findById($id);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );
        }

        $this->render(
            'inventory/adjust_stock',
            [
                'title' => 'Ajuste de inventario',
                'part'  => $part
            ]
        );
    }

    public function saveAdjustment(): void
    {
        $this->ensureLogged();

        if (!$this->isPost()) {

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );
        }

        $id = (int)$_POST['id'];

        $tipo = $_POST['tipo'];

        $cantidad = (float)$_POST['cantidad'];

        $motivo = trim($_POST['motivo']);

        $observacion = trim($_POST['observacion']);

        $part = $this->partModel->findById($id);

        if (!$part) {

            $this->error('Artículo no encontrado.');

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );
        }

        if ($tipo === 'entrada') {

            $nuevoStock = $part['stock_actual'] + $cantidad;

            $tipoMovimiento = 'ajuste_entrada';
        } else {

            if ($cantidad > $part['stock_actual']) {

                $this->error(
                    'No es posible dejar el stock negativo.'
                );

                $this->redirect(
                    'index.php?controller=inventory&action=adjustStock&id=' . $id
                );
            }

            $nuevoStock = $part['stock_actual'] - $cantidad;

            $tipoMovimiento = 'ajuste_salida';
        }

        try {

            $this->pdo->beginTransaction();

            if (!$this->partModel->updateStock(
                $id,
                $nuevoStock
            )) {

                throw new Exception(
                    'No fue posible actualizar el stock.'
                );
            }

            if (!$this->partModel->registerMovement([

                'parte_id'         => $id,
                'usuario_id'       => $_SESSION['user_id'],
                'caso_id'          => null,

                'tipo'             => $tipoMovimiento,

                'motivo'           => $motivo,

                'cantidad'         => $cantidad,

                'stock_resultante' => $nuevoStock,

                'costo_unitario'   => $part['costo'],

                'observacion'      => $observacion

            ])) {

                throw new Exception(
                    'No fue posible registrar el movimiento.'
                );
            }

            $this->pdo->commit();

            $this->success(
                'Ajuste realizado correctamente.'
            );
        } catch (Throwable $e) {

            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            $this->error(
                $e->getMessage()
            );
        }

        $this->redirect(
            'index.php?controller=inventory&action=index'
        );
    }

    public function kardex(): void
    {
        $this->ensureLogged();

        $filters = [

            'buscar' => trim($_GET['buscar'] ?? ''),

            'tipo' => trim($_GET['tipo'] ?? '')

        ];

        $movements = $this->partModel->getAllMovements($filters);

        $summary = [

            'movimientos' => count($movements),

            'entradas' => 0,

            'salidas' => 0

        ];

        foreach ($movements as $m) {

            if (in_array($m['tipo'], ['compra', 'ajuste_entrada'])) {

                $summary['entradas'] += $m['cantidad'];
            }

            if (in_array($m['tipo'], ['consumo', 'ajuste_salida'])) {

                $summary['salidas'] += $m['cantidad'];
            }
        }

        $this->render(
            'inventory/kardex',
            [
                'title'     => 'Kardex General',
                'movements' => $movements,
                'filters'   => $filters,
                'summary'   => $summary
            ]
        );
    }
}

<?php

declare(strict_types=1);

class InventoryController extends BaseController
{
    private Part $partModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->partModel = new Part($pdo);
    }

    /**
     * Listado del inventario.
     */
    public function index(): void
    {
        $search = trim($_GET['q'] ?? '');

        if ($search !== '') {
            $parts = $this->partModel->search($search);
        } else {
            $parts = $this->partModel->all();
        }

        $this->render('inventory/index', [
            'parts'  => $parts,
            'search' => $search
        ]);
    }

    /**
     * Formulario de nuevo artículo.
     */
    public function create(): void
    {
        $this->render('inventory/form', [
            'part' => null,
            'categories' => $this->partModel->categories(),
            'title' => 'Nuevo artículo'
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
            'title' => 'Editar artículo'
        ]);
    }

    public function update(): void
    {
        $this->ensureLogged();

        $data = $_POST;

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

        $cart = $_SESSION['case_cart'][$caseId] ?? [];

        if (empty($cart)) {

            $this->error('No hay artículos en el carrito.');

            $this->redirect(
                "index.php?controller=inventory&action=selectForCase&case_id={$caseId}&veh_id={$vehId}"
            );

            return;
        }

        $avanceModel = new Avance($this->pdo);

        try {

            $this->pdo->beginTransaction();

            foreach ($cart as $item) {

                $part = $this->partModel->findById($item['part_id']);

                if (!$part) {

                    throw new Exception(
                        "No existe el artículo {$item['nombre']}."
                    );
                }

                if ($part['stock_actual'] < $item['cantidad']) {

                    throw new Exception(
                        "Stock insuficiente para {$item['nombre']}."
                    );
                }

                $nuevoStock = $part['stock_actual'] - $item['cantidad'];

                if (!$this->partModel->updateStock($part['id'], $nuevoStock)) {

                    throw new Exception(
                        "No fue posible actualizar el stock de {$item['nombre']}."
                    );
                }

                if (!$this->partModel->registerMovement([

                    'parte_id'         => $part['id'],
                    'usuario_id'       => $_SESSION['user_id'],
                    'caso_id'          => $caseId,

                    'tipo'             => 'consumo',

                    'motivo'           => 'Consumo durante reparación',

                    'cantidad'         => $item['cantidad'],

                    'stock_resultante' => $nuevoStock,

                    'costo_unitario'   => $part['costo'],

                    'observacion'      => 'Aplicado desde WorkShop'

                ])) {

                    throw new Exception(
                        "No fue posible registrar el movimiento de inventario."
                    );
                }

                $avanceModel->add(

                    $caseId,

                    $_SESSION['user_id'],

                    sprintf(
                        'Repuesto: %s x %s',
                        $item['nombre'],
                        $item['cantidad']
                    ),

                    'Repuesto',

                    (int)($item['precio_venta'] * $item['cantidad'])

                );
            }

            $this->pdo->commit();

            $this->clearCaseCart($caseId);

            $this->success('Los repuestos fueron aplicados correctamente.');
        } catch (Throwable $e) {

    if ($this->pdo->inTransaction()) {
        $this->pdo->rollBack();
    }

    die(
        '<pre>'.
        $e->getMessage().
        "\n\n".
        $e->getTraceAsString().
        '</pre>'
    );
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
}

<?php

declare(strict_types=1);
require_once __DIR__ . '/../services/InventoryService.php';
require_once __DIR__ . '/../models/MovimientoFinanciero.php';

class InventoryController extends BaseController
{


    /**
     * Procesa la fotografía de un artículo.
     * Devuelve la ruta relativa o conserva la imagen anterior.
     */
    private function uploadPartImage(?string $currentImage = null): ?string
    {
        if (
            !isset($_FILES['imagen']) ||
            $_FILES['imagen']['error'] === UPLOAD_ERR_NO_FILE
        ) {
            return $currentImage;
        }

        $file = $_FILES['imagen'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Error al recibir la fotografía.');
        }

        if ($file['size'] > 5 * 1024 * 1024) {
            throw new RuntimeException('La fotografía no puede superar los 5 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($allowed[$mime])) {
            throw new RuntimeException(
                'Formato no permitido. Usa JPG, PNG o WEBP.'
            );
        }

        if (@getimagesize($file['tmp_name']) === false) {
            throw new RuntimeException('El archivo no es una imagen válida.');
        }

        $directory = __DIR__ . '/../../public/uploads/parts/';

        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            throw new RuntimeException('No se pudo crear el directorio de imágenes.');
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
        $destination = $directory . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new RuntimeException('No se pudo guardar la fotografía.');
        }

        return 'uploads/parts/' . $filename;
    }


    private Part $partModel;
    private InventoryService $inventoryService;
    private FabricanteRepuesto $manufacturerModel;
    private AplicacionParte $applicationModel;
    private ModeloMoto $motorcycleModel;


    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->partModel = new Part($pdo);
        $this->inventoryService = new InventoryService($pdo);
        $this->manufacturerModel = new FabricanteRepuesto($pdo);
        $this->applicationModel = new AplicacionParte($pdo);
        $this->motorcycleModel = new ModeloMoto($pdo);
        $this->applicationModel = new AplicacionParte($pdo);
        $this->motorcycleModel = new ModeloMoto($pdo);
    }

    public function index()
    {
        $this->ensureLogged();

        $search = trim($_GET['q'] ?? '');

        $tipo = $_GET['tipo'] ?? 'repuesto';

        $tiposPermitidos = [
            'repuesto',
            'insumo',
            'herramienta'
        ];

        if (!in_array($tipo, $tiposPermitidos, true)) {
            $tipo = 'repuesto';
        }

        // Obtener categoría seleccionada
        $categoriaId = filter_input(
            INPUT_GET,
            'categoria_id',
            FILTER_VALIDATE_INT
        );

        if (!$categoriaId || $categoriaId < 1) {
            $categoriaId = 0;
        }

        // Obtener categorías disponibles para el tipo
        $categories = $this->partModel->categoriesByType(
            $tipo
        );

        // Consultar artículos
        if ($search !== '') {
            $parts = $this->partModel->search(
                $search,
                $tipo,
                $categoriaId
            );
        } else {
            $parts = $this->partModel->all(
                $tipo,
                $categoriaId
            );
        }

        // Estadísticas
        $stats = $this->partModel->getStatistics(
            $tipo
        );

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/inventory/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
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

        // Recuperar artículo actual y conservar su fotografía
        $currentPart = $this->partModel->findById($id);

        if (!$currentPart) {
            $this->error('El artículo no existe.');
            $this->redirect('index.php?controller=inventory&action=index');
            return;
        }

        $data['imagen'] = $currentPart['imagen'] ?? null;

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

        try {
            $data['imagen'] = $this->uploadPartImage($data['imagen']);

            if ($this->partModel->update($data)) {

                // Eliminar imagen anterior solo después de actualizar la BD
                $oldImage = $currentPart['imagen'] ?? null;

                if (
                    $oldImage &&
                    $oldImage !== $data['imagen'] &&
                    strpos($oldImage, 'uploads/parts/') === 0
                ) {
                    $oldPath = __DIR__ . '/../../public/' . $oldImage;

                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $this->success('Artículo actualizado correctamente.');
                $this->redirect('index.php?controller=inventory&action=index');
                return;
            }
        } catch (RuntimeException $e) {

            $this->error($e->getMessage());
            $this->redirect(
                'index.php?controller=inventory&action=edit&id=' . $id
            );
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

        try {

            $data['imagen'] = $this->uploadPartImage();

            if ($this->partModel->create($data)) {

                $this->success('Artículo creado correctamente.');

                $this->redirect('index.php?controller=inventory&action=index');

                return;
            }

            // Si falla MySQL, eliminar la fotografía recién cargada
            if (!empty($data['imagen'])) {
                $imagePath = __DIR__ . '/../../public/' . $data['imagen'];

                if (is_file($imagePath)) {
                    unlink($imagePath);
                }
            }
        } catch (RuntimeException $e) {

            $this->error($e->getMessage());

            $this->redirect('index.php?controller=inventory&action=create');

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
        $pendingId = (int)($_GET['pending_id'] ?? 0);

        $search = trim($_GET['q'] ?? '');

        $parts = $search !== ''
            ? $this->partModel->search($search)
            : $this->partModel->all();

        $this->render('inventory/select_for_case', [
            'caseId' => $caseId,
            'vehId' => $vehId,
            'pendingId' => $pendingId,
            'parts' => $parts,
            'search' => $search
        ]);
    }


    public function addToCart(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_POST['case_id'] ?? 0);
        $vehId  = (int)($_POST['veh_id'] ?? 0);
        $pendingId = (int)($_POST['pending_id'] ?? 0);
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
                "index.php?controller=inventory&action=selectForCase"
                    . "&case_id={$caseId}"
                    . "&veh_id={$vehId}"
                    . "&pending_id={$pendingId}"
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
            "index.php?controller=inventory&action=selectForCase"
                . "&case_id={$caseId}"
                . "&veh_id={$vehId}"
                . "&pending_id={$pendingId}"
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
        $pendingId = (int)($_POST['pending_id'] ?? 0);

        try {

            $this->inventoryService->confirmCart(
                $caseId,
                $vehId,
                (int)$_SESSION['user_id'],
                $pendingId
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


    public function addCompatiblePart(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_POST['case_id'] ?? 0);
        $vehId = (int)($_POST['veh_id'] ?? 0);
        $partId = (int)($_POST['parte_id'] ?? 0);
        $quantity = (float)($_POST['cantidad'] ?? 1);
        $salePrice = (float)($_POST['precio_venta'] ?? -1);

        try {
            $this->inventoryService->addSinglePartToCase(
                $caseId,
                $partId,
                $quantity,
                $salePrice,
                (int)$_SESSION['user_id']
            );

            $this->success('Repuesto agregado correctamente al caso.');
        } catch (Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(
            "index.php?controller=mechanic&action=viewCase"
                . "&veh_id={$vehId}&case_id={$caseId}"
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

    public function applications(): void
    {
        $this->ensureLogged();

        $partId = (int)($_GET['id'] ?? 0);

        $part = $this->partModel->findById($partId);

        if (!$part) {

            $this->error('El repuesto no existe.');

            $this->redirect(
                'index.php?controller=inventory&action=index'
            );

            return;
        }

        $this->render(
            'inventory/applications',
            [

                'title' => 'Aplicaciones del repuesto',

                'part' => $part,

                'groups' => $this->motorcycleModel->groupedByBrand(),

                'selected' => $this->applicationModel
                    ->getModelIdsByPart($partId)

            ]
        );
    }

    public function saveApplications(): void
    {
        $this->ensureLogged();

        $partId = (int)($_POST['part_id'] ?? 0);

        $models = $_POST['models'] ?? [];

        try {

            $this->applicationModel->sync(
                $partId,
                $models
            );

            $this->success(
                'Las aplicaciones se guardaron correctamente.'
            );
        } catch (Throwable $e) {

            $this->error(
                'Ocurrió un error al guardar las aplicaciones.'
            );
        }

        $this->redirect(
            'index.php?controller=inventory&action=applications&id=' . $partId
        );
    }

    /**
     * Mostrar formulario para registrar una compra.
     */
    public function registerPurchase(): void
    {
        $this->ensureLogged();

        $stmt = $this->pdo->query("
        SELECT id, nombre
        FROM proveedores
        WHERE activo = 1
        ORDER BY nombre ASC
    ");
        $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->pdo->query("
        SELECT id, codigo, nombre, tipo, unidad, stock_actual, costo
        FROM partes
        WHERE activo = 1
        ORDER BY nombre ASC
    ");
        $parts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $financialModel = new MovimientoFinanciero($this->pdo);
        $accounts = $financialModel->cuentas();

        $this->render('inventory/register_purchase', [
            'title' => 'Registrar compra',
            'suppliers' => $suppliers,
            'parts' => $parts,
            'accounts' => $accounts
        ]);
    }

    /**
     * Guardar una compra y actualizar el inventario.
     */
    public function savePurchase(): void
    {
        $this->ensureLogged();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }

        $supplierId = (int)($_POST['proveedor_id'] ?? 0);
        $paymentType = $_POST['forma_pago'] ?? '';
        $accountId = (int)($_POST['cuenta_id'] ?? 0);
        $paidInput = (float)($_POST['valor_pagado'] ?? 0);
        $observations = trim($_POST['observaciones'] ?? '');

        $partIds = $_POST['parte_id'] ?? [];
        $quantities = $_POST['cantidad'] ?? [];
        $unitCosts = $_POST['costo_unitario'] ?? [];

        $allowedPaymentTypes = ['contado', 'credito', 'parcial'];

        if (
            $supplierId <= 0 ||
            !in_array($paymentType, $allowedPaymentTypes, true) ||
            !is_array($partIds) ||
            !is_array($quantities) ||
            !is_array($unitCosts) ||
            count($partIds) === 0 ||
            count($partIds) !== count($quantities) ||
            count($partIds) !== count($unitCosts)
        ) {
            $this->error('Verifica el proveedor, la forma de pago y los artículos.');
            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }

        /*
     * Validar proveedor.
     */
        $stmt = $this->pdo->prepare("
        SELECT id
        FROM proveedores
        WHERE id = :id AND activo = 1
        LIMIT 1
    ");
        $stmt->execute([':id' => $supplierId]);

        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->error('El proveedor seleccionado no existe o está inactivo.');
            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }

        /*
     * Preparar y validar los artículos.
     */
        $items = [];
        $total = 0;

        foreach ($partIds as $i => $partIdValue) {
            $partId = (int)$partIdValue;
            $quantity = (float)$quantities[$i];
            $unitCost = (float)$unitCosts[$i];

            if (
                $partId <= 0 ||
                !is_finite($quantity) ||
                !is_finite($unitCost) ||
                $quantity <= 0 ||
                $unitCost < 0
            ) {
                $this->error('Hay artículos con cantidades o costos no válidos.');
                $this->redirect('index.php?controller=inventory&action=registerPurchase');
                return;
            }

            $subtotal = round($quantity * $unitCost, 2);

            $items[] = [
                'parte_id' => $partId,
                'cantidad' => $quantity,
                'costo_unitario' => $unitCost,
                'subtotal' => $subtotal
            ];

            $total += $subtotal;
        }

        $total = round($total, 2);

        if ($total <= 0) {
            $this->error('El total de la compra debe ser mayor que cero.');
            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }

        /*
     * Determinar el pago inicial.
     */
        if ($paymentType === 'contado') {
            $paid = $total;
        } elseif ($paymentType === 'credito') {
            $paid = 0;
        } else {
            $paid = round($paidInput, 2);

            if ($paid <= 0 || $paid >= $total) {
                $this->error('En una compra parcial, el pago debe ser mayor que cero y menor que el total.');
                $this->redirect('index.php?controller=inventory&action=registerPurchase');
                return;
            }
        }

        if ($paid > 0 && $accountId <= 0) {
            $this->error('Selecciona la cuenta financiera desde la que se realizará el pago.');
            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }

        $balance = round($total - $paid, 2);

        $status = $balance <= 0
            ? 'pagada'
            : ($paid > 0 ? 'parcial' : 'pendiente');

        $userId = (int)$_SESSION['user_id'];

        try {
            $this->pdo->beginTransaction();

            /*
         * Crear encabezado de compra.
         */
            $stmt = $this->pdo->prepare("
            INSERT INTO compras_inventario (
                proveedor_id,
                usuario_id,
                forma_pago,
                total,
                valor_pagado,
                saldo_pendiente,
                estado,
                observaciones
            ) VALUES (
                :proveedor_id,
                :usuario_id,
                :forma_pago,
                :total,
                :valor_pagado,
                :saldo_pendiente,
                :estado,
                :observaciones
            )
        ");

            $stmt->execute([
                ':proveedor_id' => $supplierId,
                ':usuario_id' => $userId,
                ':forma_pago' => $paymentType,
                ':total' => $total,
                ':valor_pagado' => $paid,
                ':saldo_pendiente' => $balance,
                ':estado' => $status,
                ':observaciones' => $observations !== '' ? $observations : null
            ]);

            $purchaseId = (int)$this->pdo->lastInsertId();

            /*
         * Preparar inserciones de detalle y movimiento.
         */
            $detailStmt = $this->pdo->prepare("
            INSERT INTO detalle_compra_inventario (
                compra_id,
                parte_id,
                cantidad,
                costo_unitario,
                subtotal
            ) VALUES (
                :compra_id,
                :parte_id,
                :cantidad,
                :costo_unitario,
                :subtotal
            )
        ");

            $movementStmt = $this->pdo->prepare("
            INSERT INTO movimientos_inventario (
                parte_id,
                detalle_compra_id,
                usuario_id,
                caso_id,
                tipo,
                motivo,
                cantidad,
                stock_resultante,
                costo_unitario,
                observacion
            ) VALUES (
                :parte_id,
                :detalle_compra_id,
                :usuario_id,
                NULL,
                'compra',
                'Compra de inventario',
                :cantidad,
                :stock_resultante,
                :costo_unitario,
                :observacion
            )
        ");

            foreach ($items as $item) {
                /*
             * Bloquear el artículo para evitar cálculos
             * simultáneos sobre el mismo stock y costo.
             */
                $lockStmt = $this->pdo->prepare("
                SELECT id, stock_actual, costo
                FROM partes
                WHERE id = :id AND activo = 1
                FOR UPDATE
            ");

                $lockStmt->execute([
                    ':id' => $item['parte_id']
                ]);

                $part = $lockStmt->fetch(PDO::FETCH_ASSOC);

                if (!$part) {
                    throw new Exception(
                        'Uno de los artículos no existe o está inactivo.'
                    );
                }

                $oldStock = (float)$part['stock_actual'];
                $oldCost = (float)$part['costo'];

                $newStock = $oldStock + $item['cantidad'];

                /*
             * Costo promedio ponderado.
             */
                if ($newStock > 0) {
                    $newCost = (
                        ($oldStock * $oldCost) +
                        ($item['cantidad'] * $item['costo_unitario'])
                    ) / $newStock;
                } else {
                    $newCost = $item['costo_unitario'];
                }

                $newCost = round($newCost, 2);

                /*
             * Insertar detalle de compra.
             */
                $detailStmt->execute([
                    ':compra_id' => $purchaseId,
                    ':parte_id' => $item['parte_id'],
                    ':cantidad' => $item['cantidad'],
                    ':costo_unitario' => $item['costo_unitario'],
                    ':subtotal' => $item['subtotal']
                ]);

                $detailId = (int)$this->pdo->lastInsertId();

                /*
             * Actualizar stock y costo promedio.
             */
                if (!$this->partModel->updateInventory(
                    $item['parte_id'],
                    $newStock,
                    $newCost
                )) {
                    throw new Exception(
                        'No fue posible actualizar el inventario de un artículo.'
                    );
                }

                /*
             * Registrar movimiento vinculado al detalle.
             */
                $movementStmt->execute([
                    ':parte_id' => $item['parte_id'],
                    ':detalle_compra_id' => $detailId,
                    ':usuario_id' => $userId,
                    ':cantidad' => $item['cantidad'],
                    ':stock_resultante' => $newStock,
                    ':costo_unitario' => $item['costo_unitario'],
                    ':observacion' => 'Compra #' . $purchaseId
                ]);
            }

            /*
         * Registrar el pago inicial, si existe.
         */
            if ($paid > 0) {
                $financialModel = new MovimientoFinanciero($this->pdo);

                $financialMovementId = $financialModel->registrar(
                    $accountId,
                    'egreso',
                    'salida',
                    $paid,
                    'Pago de compra de inventario #' . $purchaseId,
                    $userId,
                    null,
                    null,
                    null,
                    'COMPRA-' . $purchaseId
                );

                if (!$financialMovementId) {
                    throw new Exception(
                        'No fue posible registrar el movimiento financiero.'
                    );
                }

                $paymentStmt = $this->pdo->prepare("
                INSERT INTO pagos_compra_inventario (
                    compra_id,
                    cuenta_id,
                    usuario_id,
                    movimiento_financiero_id,
                    monto,
                    observacion
                ) VALUES (
                    :compra_id,
                    :cuenta_id,
                    :usuario_id,
                    :movimiento_id,
                    :monto,
                    :observacion
                )
            ");

                $paymentStmt->execute([
                    ':compra_id' => $purchaseId,
                    ':cuenta_id' => $accountId,
                    ':usuario_id' => $userId,
                    ':movimiento_id' => $financialMovementId,
                    ':monto' => $paid,
                    ':observacion' => 'Pago inicial de compra'
                ]);
            }

            $this->pdo->commit();

            $this->success(
                'Compra #' . $purchaseId . ' registrada correctamente.'
            );

            $this->redirect('index.php?controller=inventory&action=index');
            return;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            error_log('Error al registrar compra: ' . $e->getMessage());

            $this->error(
                'No fue posible registrar la compra. Revisa los datos e inténtalo nuevamente.'
            );

            $this->redirect('index.php?controller=inventory&action=registerPurchase');
            return;
        }
    }
    /**
     * Mostrar historial de compras de inventario.
     */
    public function purchases(): void
    {
        $this->ensureLogged();

        $stmt = $this->pdo->query("
        SELECT
            c.*,
            p.nombre AS proveedor,
            u.nombre AS usuario
        FROM compras_inventario c
        INNER JOIN proveedores p ON p.id = c.proveedor_id
        INNER JOIN usuarios u ON u.id = c.usuario_id
        ORDER BY c.fecha_compra DESC, c.id DESC
    ");

        $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->render('inventory/purchases', [
            'title' => 'Historial de compras',
            'purchases' => $purchases
        ]);
    }

    /**
     * Mostrar detalle de una compra y sus pagos.
     */
    public function purchaseDetail(): void
    {
        $this->ensureLogged();

        $purchaseId = (int)($_GET['id'] ?? 0);

        if ($purchaseId <= 0) {
            $this->error('Identificador de compra no válido.');
            $this->redirect('index.php?controller=inventory&action=purchases');
            return;
        }

        // Encabezado de la compra.
        $stmt = $this->pdo->prepare("
        SELECT
            c.*,
            p.nombre AS proveedor,
            u.nombre AS usuario
        FROM compras_inventario c
        INNER JOIN proveedores p ON p.id = c.proveedor_id
        INNER JOIN usuarios u ON u.id = c.usuario_id
        WHERE c.id = :id
        LIMIT 1
    ");

        $stmt->execute([':id' => $purchaseId]);
        $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$purchase) {
            $this->error('La compra solicitada no existe.');
            $this->redirect('index.php?controller=inventory&action=purchases');
            return;
        }

        // Artículos incluidos en la compra.
        $stmt = $this->pdo->prepare("
        SELECT
            d.*,
            p.codigo,
            p.nombre AS articulo,
            p.tipo
        FROM detalle_compra_inventario d
        INNER JOIN partes p ON p.id = d.parte_id
        WHERE d.compra_id = :compra_id
        ORDER BY d.id ASC
    ");

        $stmt->execute([':compra_id' => $purchaseId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Historial de pagos y abonos.
        $stmt = $this->pdo->prepare("
        SELECT
            pago.*,
            cf.nombre AS cuenta,
            cf.tipo AS tipo_cuenta,
            u.nombre AS usuario,
            mf.descripcion AS movimiento_descripcion,
            mf.referencia AS movimiento_referencia
        FROM pagos_compra_inventario pago
        INNER JOIN cuentas_financieras cf
            ON cf.id = pago.cuenta_id
        INNER JOIN usuarios u
            ON u.id = pago.usuario_id
        INNER JOIN movimientos_financieros mf
            ON mf.id = pago.movimiento_financiero_id
        WHERE pago.compra_id = :compra_id
        ORDER BY pago.fecha_pago ASC, pago.id ASC
    ");

        $stmt->execute([':compra_id' => $purchaseId]);
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cuentas disponibles para registrar nuevos abonos.
        $financialModel = new MovimientoFinanciero($this->pdo);
        $accounts = $financialModel->cuentas();

        $this->render('inventory/purchase_detail', [
            'title' => 'Detalle de compra #' . $purchaseId,
            'purchase' => $purchase,
            'items' => $items,
            'payments' => $payments,
            'accounts' => $accounts
        ]);
    }

    /**
     * Registrar un abono a una compra de inventario.
     *
     * El movimiento financiero, el pago y la actualización
     * del saldo se ejecutan dentro de una sola transacción.
     */
    public function savePurchasePayment(): void
    {
        $this->ensureLogged();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=inventory&action=purchases');
            return;
        }

        $purchaseId = (int)($_POST['compra_id'] ?? 0);
        $accountId = (int)($_POST['cuenta_id'] ?? 0);
        $amountInput = trim((string)($_POST['monto'] ?? ''));
        $observation = trim((string)($_POST['observacion'] ?? ''));

        $userId = (int)($_SESSION['user_id'] ?? 0);

        $detailUrl = 'index.php?controller=inventory&action=purchaseDetail&id=' . $purchaseId;

        if (
            $purchaseId <= 0 ||
            $accountId <= 0 ||
            $userId <= 0 ||
            !is_numeric($amountInput)
        ) {
            $this->error('Verifica los datos del abono.');
            $this->redirect(
                $purchaseId > 0
                    ? $detailUrl
                    : 'index.php?controller=inventory&action=purchases'
            );
            return;
        }

        $amount = round((float)$amountInput, 2);

        if (!is_finite($amount) || $amount <= 0) {
            $this->error('El monto del abono debe ser mayor que cero.');
            $this->redirect($detailUrl);
            return;
        }

        if ($observation === '') {
            $observation = 'Abono de compra de inventario #' . $purchaseId;
        }

        try {
            $this->pdo->beginTransaction();

            /*
         * Bloquear la compra para impedir que dos abonos
         * simultáneos utilicen el mismo saldo pendiente.
         */
            $stmt = $this->pdo->prepare("
            SELECT
                id,
                total,
                valor_pagado,
                saldo_pendiente,
                estado
            FROM compras_inventario
            WHERE id = :id
            FOR UPDATE
        ");

            $stmt->execute([':id' => $purchaseId]);
            $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$purchase) {
                throw new Exception('La compra no existe.');
            }

            if ($purchase['estado'] === 'anulada') {
                throw new Exception('No se pueden registrar abonos en una compra anulada.');
            }

            $balance = round((float)$purchase['saldo_pendiente'], 2);

            if ($balance <= 0) {
                throw new Exception('Esta compra ya está completamente pagada.');
            }

            if ($amount > $balance) {
                throw new Exception(
                    'El abono supera el saldo pendiente de la compra.'
                );
            }

            /*
         * Verificar que la cuenta seleccionada esté activa.
         */
            $stmt = $this->pdo->prepare("
            SELECT id
            FROM cuentas_financieras
            WHERE id = :id AND activa = 1
            LIMIT 1
            FOR UPDATE
        ");

            $stmt->execute([':id' => $accountId]);

            if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                throw new Exception('La cuenta financiera no existe o está inactiva.');
            }

            /*
         * Obtener un consecutivo para diferenciar cada pago.
         * La compra permanece bloqueada durante esta operación.
         */
            $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM pagos_compra_inventario
            WHERE compra_id = :compra_id
        ");

            $stmt->execute([':compra_id' => $purchaseId]);

            $paymentNumber = (int)$stmt->fetchColumn() + 1;

            $reference = 'COMPRA-' . $purchaseId . '-PAGO-' . $paymentNumber;

            /*
         * Registrar el egreso financiero.
         */
            $financialModel = new MovimientoFinanciero($this->pdo);

            $financialMovementId = $financialModel->registrar(
                $accountId,
                'egreso',
                'salida',
                $amount,
                'Abono de compra de inventario #' . $purchaseId,
                $userId,
                null,
                null,
                null,
                $reference
            );

            if (!$financialMovementId) {
                throw new Exception('No fue posible registrar el movimiento financiero.');
            }

            /*
         * Registrar el pago vinculado al movimiento financiero.
         */
            $stmt = $this->pdo->prepare("
            INSERT INTO pagos_compra_inventario (
                compra_id,
                cuenta_id,
                usuario_id,
                movimiento_financiero_id,
                monto,
                observacion
            ) VALUES (
                :compra_id,
                :cuenta_id,
                :usuario_id,
                :movimiento_id,
                :monto,
                :observacion
            )
        ");

            $stmt->execute([
                ':compra_id' => $purchaseId,
                ':cuenta_id' => $accountId,
                ':usuario_id' => $userId,
                ':movimiento_id' => $financialMovementId,
                ':monto' => $amount,
                ':observacion' => $observation
            ]);

            /*
         * Actualizar valores acumulados de la compra.
         */
            $newPaid = round(
                (float)$purchase['valor_pagado'] + $amount,
                2
            );

            $newBalance = round(
                (float)$purchase['total'] - $newPaid,
                2
            );

            if ($newBalance <= 0) {
                $newBalance = 0;
                $newPaid = (float)$purchase['total'];
                $newStatus = 'pagada';
            } else {
                $newStatus = 'parcial';
            }

            $stmt = $this->pdo->prepare("
            UPDATE compras_inventario
            SET
                valor_pagado = :valor_pagado,
                saldo_pendiente = :saldo_pendiente,
                estado = :estado
            WHERE id = :id
        ");

            $stmt->execute([
                ':valor_pagado' => $newPaid,
                ':saldo_pendiente' => $newBalance,
                ':estado' => $newStatus,
                ':id' => $purchaseId
            ]);

            $this->pdo->commit();

            $this->success(
                'Abono de $' . number_format($amount, 2, ',', '.') .
                    ' registrado correctamente.'
            );

            $this->redirect($detailUrl);
            return;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            error_log(
                'Error al registrar abono de compra #' .
                    $purchaseId . ': ' . $e->getMessage()
            );

            $this->error(
                'No fue posible registrar el abono. Verifica los datos e inténtalo nuevamente.'
            );

            $this->redirect($detailUrl);
            return;
        }
    }
}

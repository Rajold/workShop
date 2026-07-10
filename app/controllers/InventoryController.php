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

    if ($this->partModel->create($data)) {

        $this->success('Artículo creado correctamente.');

        $this->redirect('index.php?controller=inventory&action=index');

        return;
    }

    $this->error('No fue posible guardar el artículo.');

    $this->redirect('index.php?controller=inventory&action=create');
}
}
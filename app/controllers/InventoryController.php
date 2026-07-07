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
     * Catálogo de partes.
     */
    public function index(): void
    {
        $search = trim($_GET['q'] ?? '');

        if ($search !== '') {
            $parts = $this->partModel->search($search);
        } else {
            $parts = $this->partModel->all();
        }

        require __DIR__ . '/../views/inventory/index.php';
    }

    /**
     * Formulario de creación.
     */
    public function create(): void
    {
        $part = null;
        $categories = $this->partModel->categories();

        require __DIR__ . '/../views/inventory/form.php';
    }

    /**
     * Guarda una nueva parte.
     */
    public function store(): void
    {
        $data = $this->postData();

        $errors = $this->validate($data);

        if ($this->partModel->findByCode($data['codigo'])) {
            $errors[] = 'Ya existe una parte con ese código.';
        }

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $_SESSION['old'] = $data;

            $this->redirect('/index.php?controller=inventory&action=create');
        }

        $this->partModel->create($data);

        $_SESSION['success'] = 'Parte creada correctamente.';

        $this->redirect('/index.php?controller=inventory&action=index');
    }

    /**
     * Formulario de edición.
     */
    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $part = $this->partModel->findById($id);

        if (!$part) {
            $_SESSION['error'] = 'La parte no existe.';
            $this->redirect('/index.php?controller=inventory&action=index');
        }

        $categories = $this->partModel->categories();

        require __DIR__ . '/../views/inventory/form.php';
    }

    /**
     * Actualiza una parte.
     */
    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        $data = $this->postData();

        $errors = $this->validate($data);

        $existing = $this->partModel->findByCode($data['codigo']);

        if ($existing && (int)$existing['id'] !== $id) {
            $errors[] = 'Ya existe una parte con ese código.';
        }

        if (!empty($errors)) {

            $_SESSION['error'] = implode('<br>', $errors);

            $this->redirect(
                "/index.php?controller=inventory&action=edit&id={$id}"
            );
        }

        $this->partModel->update($id, $data);

        $_SESSION['success'] = 'Parte actualizada correctamente.';

        $this->redirect('/index.php?controller=inventory&action=index');
    }

    /**
     * Obtiene los datos enviados por POST.
     */
    private function postData(): array
    {
        return [

            'codigo' => trim($_POST['codigo'] ?? ''),

            'categoria_id' => (int) ($_POST['categoria_id'] ?? 0),

            'nombre' => trim($_POST['nombre'] ?? ''),

            'marca' => trim($_POST['marca'] ?? ''),

            'unidad' => trim($_POST['unidad'] ?? 'UND'),

            'stock_minimo' => (float) ($_POST['stock_minimo'] ?? 0),

            'costo' => (float) ($_POST['costo'] ?? 0),

            'precio' => (float) ($_POST['precio'] ?? 0),

            'ubicacion' => trim($_POST['ubicacion'] ?? ''),

            'activo' => isset($_POST['activo']) ? 1 : 0,
        ];
    }

    /**
     * Valida los datos.
     */
    private function validate(array $data): array
    {
        $errors = [];

        if ($data['codigo'] === '') {
            $errors[] = 'Debe ingresar un código.';
        }

        if ($data['nombre'] === '') {
            $errors[] = 'Debe ingresar un nombre.';
        }

        if ($data['categoria_id'] <= 0) {
            $errors[] = 'Debe seleccionar una categoría.';
        }

        if ($data['stock_minimo'] < 0) {
            $errors[] = 'El stock mínimo es inválido.';
        }

        if ($data['costo'] < 0) {
            $errors[] = 'El costo es inválido.';
        }

        if ($data['precio'] < 0) {
            $errors[] = 'El precio es inválido.';
        }

        return $errors;
    }

public function destroy(): void
{
    $id = (int)($_GET['id'] ?? 0);

    $this->partModel->deactivate($id);

    $this->success('Parte desactivada correctamente.');

    $this->redirect('/index.php?controller=inventory&action=index');
}

}
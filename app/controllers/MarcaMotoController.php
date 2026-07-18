<?php

class MarcaMotoController extends CatalogController
{
    private MarcaMoto $brandModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->brandModel = new MarcaMoto($pdo);
        $this->model = $this->brandModel;
        $this->route = 'marca_moto';
        $this->entityName = 'Marca';
    }

    public function index(): void
{
    $this->ensureLogged();

    $brands = $this->brandModel->all();

    foreach ($brands as &$brand) {

        $brand['can_delete'] =
            $this->brandModel->canDelete($brand['id']);

    }

    unset($brand);

    $this->render('brands/index', [
        'title'  => 'Marcas de motocicletas',
        'brands' => $brands
    ]);
}

    public function create(): void
    {
        $this->ensureLogged();

        $this->render('brands/form', [
    'title' => 'Nueva marca',
    'brand' => null
]);
    }

    public function store(): void
    {
        $this->ensureLogged();

        $data = $_POST;

        if (empty(trim($data['nombre'] ?? ''))) {

            $this->error('Debe ingresar el nombre del fabricante.');

            $this->redirect(
                'index.php?controller=marca_moto&action=create'
            );

            return;
        }

        if ($this->brandModel->create($data)) {

            $this->success('Fabricante creado correctamente.');
        } else {

            $this->error('No fue posible crear el fabricante.');
        }

        $this->redirect(
            'index.php?controller=marca_moto&action=index'
        );
    }

   public function edit(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    $brand = $this->brandModel->find($id);

    if (!$brand) {

        $this->error('Marca no encontrada.');

        $this->redirect(
            'index.php?controller=marca_moto&action=index'
        );

        return;
    }

    $this->render('brands/form', [
        'title' => 'Editar marca',
        'brand' => $brand
    ]);
}

    public function update(): void
    {
        $this->ensureLogged();

        $data = $_POST;

        $data['id'] = (int)($data['id'] ?? 0);

        if ($data['id'] <= 0) {

            $this->error('Fabricante no válido.');

            $this->redirect(
                'index.php?controller=marca_moto&action=index'
            );

            return;
        }

        if (empty(trim($data['nombre'] ?? ''))) {

            $this->error('Debe ingresar un nombre.');

            $this->redirect(
                'index.php?controller=marca_moto&action=edit&id=' . $data['id']
            );

            return;
        }

        if ($this->brandModel->update($data)) {

            $this->success('Fabricante actualizado correctamente.');
        } else {

            $this->error('No fue posible actualizar el fabricante.');
        }

        $this->redirect(
            'index.php?controller=marca_moto&action=index'
        );
    }

    public function delete(): void
    {
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {

            $this->error('Fabricante no válido.');
        } elseif (!$this->brandModel->canDelete($id)) {

            $this->error(
                'No es posible eliminar el fabricante porque está siendo utilizado por uno o más repuestos.'
            );
        } elseif ($this->brandModel->delete($id)) {

            $this->success('Fabricante eliminado correctamente.');
        } else {

            $this->error('No fue posible eliminar el fabricante.');
        }

        $this->redirect(
            'index.php?controller=marca_moto&action=index'
        );
    }
}

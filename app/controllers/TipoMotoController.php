<?php

class TipoMotoController extends CatalogController
{
    private TipoMoto $typeModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->typeModel = new TipoMoto($pdo);
        $this->model = $this->typeModel;
        $this->route = 'tipo_moto';
        $this->entityName = 'Tipo';
    }

    public function index(): void
{
    $this->ensureLogged();

    $types = $this->typeModel->all();

    foreach ($types as &$type) {

        $type['can_delete'] =
            $this->typeModel->canDelete($type['id']);

    }

    unset($type);

    $this->render('types/index', [
        'title' => 'Tipos de motocicleta',
        'types' => $types
    ]);
}

    public function create(): void
    {
        $this->ensureLogged();

        $this->render('types/form', [
    'title' => 'Nuevo tipo',
    'type' => null
]);
    }

    public function store(): void
    {
        $this->ensureLogged();

        $data = $_POST;

        if (empty(trim($data['nombre'] ?? ''))) {

            $this->error('Debe ingresar el nombre del fabricante.');

            $this->redirect(
                'index.php?controller=tipo_moto&action=create'
            );

            return;
        }

        if ($this->typeModel->create($data)) {

            $this->success('Fabricante creado correctamente.');
        } else {

            $this->error('No fue posible crear el fabricante.');
        }

        $this->redirect(
            'index.php?controller=tipo_moto&action=index'
        );
    }
public function edit(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    $type = $this->typeModel->find($id);

    if (!$type) {

        $this->error('Tipo de motocicleta no encontrado.');

        $this->redirect(
            'index.php?controller=tipo_moto&action=index'
        );

        return;
    }

    $this->render('types/form', [
        'title' => 'Editar tipo',
        'type' => $type
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
                'index.php?controller=tipo_moto&action=index'
            );

            return;
        }

        if (empty(trim($data['nombre'] ?? ''))) {

            $this->error('Debe ingresar un nombre.');

            $this->redirect(
                'index.php?controller=tipo_moto&action=edit&id=' . $data['id']
            );

            return;
        }

        if ($this->typeModel->update($data)) {

            $this->success('Fabricante actualizado correctamente.');
        } else {

            $this->error('No fue posible actualizar el fabricante.');
        }

        $this->redirect(
            'index.php?controller=tipo_moto&action=index'
        );
    }

    public function delete(): void
    {
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {

            $this->error('Fabricante no válido.');
        } elseif (!$this->typeModel->canDelete($id)) {

            $this->error(
                'No es posible eliminar el fabricante porque está siendo utilizado por uno o más repuestos.'
            );
        } elseif ($this->typeModel->delete($id)) {

            $this->success('Fabricante eliminado correctamente.');
        } else {

            $this->error('No fue posible eliminar el fabricante.');
        }

        $this->redirect(
            'index.php?controller=tipo_moto&action=index'
        );
    }
}

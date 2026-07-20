<?php

class ModeloMotoController extends BaseController
{
    private ModeloMoto $modelModel;

    private MarcaMoto $brandModel;

    private TipoMoto $typeModel;

   public function __construct(PDO $pdo)
{
    parent::__construct($pdo);

    $this->modelModel = new ModeloMoto($pdo);
    $this->brandModel = new MarcaMoto($pdo);
    $this->typeModel = new TipoMoto($pdo);
}

    public function index(): void
{
    $this->ensureLogged();

    $models = $this->modelModel->all();

    foreach ($models as &$model) {

        $model['can_delete'] =
            $this->modelModel->canDelete($model['id']);

    }

    unset($model);

    $this->render('motorcycle_models/index', [
        'title'  => 'Modelos de motocicleta',
        'models' => $models
    ]);
}

public function create(): void
{
    $this->ensureLogged();

    $this->render('motorcycle_models/form', [
        'title'  => 'Nuevo modelo',
        'model'  => null,
        'brands' => $this->brandModel->active(),
        'types'  => $this->typeModel->active()
    ]);
}

public function store(): void
{
    $this->ensureLogged();

    if ($this->modelModel->create($_POST)) {

        $this->success('Modelo creado correctamente.');

    } else {

        $this->error('No fue posible crear el modelo.');
    }

    $this->redirect(
        'index.php?controller=modelo_moto&action=index'
    );
}

public function edit(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    $model = $this->modelModel->find($id);

    if (!$model) {

        $this->error('Modelo de motocicleta no encontrado.');

        $this->redirect(
            'index.php?controller=modelo_moto&action=index'
        );

        return;
    }

    $this->render('motorcycle_models/form', [
        'title'  => 'Editar modelo',
        'model'  => $model,
        'brands' => $this->brandModel->active(),
        'types'  => $this->typeModel->active()
    ]);
}

public function update(): void
{
    $this->ensureLogged();

    if ($this->modelModel->update($_POST)) {

        $this->success('Modelo actualizado correctamente.');

    } else {

        $this->error('No fue posible actualizar el modelo.');
    }

    $this->redirect(
        'index.php?controller=modelo_moto&action=index'
    );
}

public function toggle(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    if ($id <= 0) {

        $this->error('Modelo no válido.');

    } elseif ($this->modelModel->toggle($id)) {

        $this->success('Estado actualizado correctamente.');

    } else {

        $this->error('No fue posible actualizar el estado.');
    }

    $this->redirect(
        'index.php?controller=modelo_moto&action=index'
    );
}

public function delete(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    if ($id <= 0) {

        $this->error('Modelo no válido.');

    } elseif (!$this->modelModel->canDelete($id)) {

        $this->error(
            'No es posible eliminar este modelo porque está siendo utilizado.'
        );

    } elseif ($this->modelModel->delete($id)) {

        $this->success('Modelo eliminado correctamente.');

    } else {

        $this->error('No fue posible eliminar el modelo.');
    }

    $this->redirect(
        'index.php?controller=modelo_moto&action=index'
    );
}
}
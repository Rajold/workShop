<?php

class FabricanteRepuestoController extends BaseController
{
    private FabricanteRepuesto $manufacturerModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->manufacturerModel = new FabricanteRepuesto($pdo);
    }

    public function index(): void
    {
        $this->ensureLogged();

        $this->render('manufacturers/index', [
            'title' => 'Fabricantes de repuestos',
            'manufacturers' => $this->manufacturerModel->all()
        ]);
    }

    public function create(): void
    {
        $this->ensureLogged();

        $this->render('manufacturers/form', [
            'title' => 'Nuevo fabricante',
            'manufacturer' => null
        ]);
    }

    public function store(): void
{
    $this->ensureLogged();

    $data = $_POST;

    if (empty(trim($data['nombre'] ?? ''))) {

        $this->error('Debe ingresar el nombre del fabricante.');

        $this->redirect(
            'index.php?controller=fabricante_repuesto&action=create'
        );

        return;
    }

    if ($this->manufacturerModel->create($data)) {

        $this->success('Fabricante creado correctamente.');

    } else {

        $this->error('No fue posible crear el fabricante.');

    }

    $this->redirect(
        'index.php?controller=fabricante_repuesto&action=index'
    );
}

    public function edit(): void
    {
        // lo implementaremos en el siguiente paso
    }

    public function update(): void
    {
        // lo implementaremos en el siguiente paso
    }

    public function toggle(): void
    {
        // lo implementaremos en el siguiente paso
    }

    public function delete(): void
    {
        // lo implementaremos en el siguiente paso
    }
}
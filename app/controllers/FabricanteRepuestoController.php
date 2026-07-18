<?php

class FabricanteRepuestoController extends CatalogController
{
    private FabricanteRepuesto $manufacturerModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->manufacturerModel = new FabricanteRepuesto($pdo);
        $this->model = $this->manufacturerModel;
        $this->route = 'fabricante_repuesto';
        $this->entityName = 'Fabricante';
    }

    public function index(): void
    {
        $this->ensureLogged();

        $manufacturers = $this->manufacturerModel->all();

        foreach ($manufacturers as &$manufacturer) {
            $manufacturer['can_delete'] =
                $this->manufacturerModel->canDelete($manufacturer['id']);
        }

        unset($manufacturer);

        $this->render('manufacturers/index', [
            'title' => 'Fabricantes de repuestos',
            'manufacturers' => $manufacturers
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
        $this->ensureLogged();

        $id = (int)($_GET['id'] ?? 0);

        $manufacturer = $this->manufacturerModel->find($id);

        if (!$manufacturer) {

            $this->error('Fabricante no encontrado.');

            $this->redirect(
                'index.php?controller=fabricante_repuesto&action=index'
            );

            return;
        }

        $this->render('manufacturers/form', [
            'title' => 'Editar fabricante',
            'manufacturer' => $manufacturer
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
                'index.php?controller=fabricante_repuesto&action=index'
            );

            return;
        }

        if (empty(trim($data['nombre'] ?? ''))) {

            $this->error('Debe ingresar un nombre.');

            $this->redirect(
                'index.php?controller=fabricante_repuesto&action=edit&id=' . $data['id']
            );

            return;
        }

        if ($this->manufacturerModel->update($data)) {

            $this->success('Fabricante actualizado correctamente.');
        } else {

            $this->error('No fue posible actualizar el fabricante.');
        }

        $this->redirect(
            'index.php?controller=fabricante_repuesto&action=index'
        );
    }
}

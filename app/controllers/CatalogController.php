<?php

abstract class CatalogController extends BaseController
{
    /**
     * Modelo del catálogo.
     */
    protected BaseModel $model;

    /**
     * Ruta del controlador.
     */
    protected string $route;

    /**
     * Carpeta de vistas.
     */
    protected string $viewPath;

    /**
     * Título del catálogo.
     */
    protected string $title;

    /**
     * Nombre de la entidad en singular.
     * Ejemplo: Fabricante, Marca, Tipo...
     */
    protected string $entityName;

    public function toggle(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    if ($id <= 0) {

        $this->error($this->entityName . ' no válido.');

    } elseif ($this->model->toggle($id)) {

        $this->success('Estado actualizado correctamente.');

    } else {

        $this->error('No fue posible actualizar el estado.');

    }

    $this->redirect(
        'index.php?controller=' .
        $this->route .
        '&action=index'
    );
}

public function delete(): void
{
    $this->ensureLogged();

    $id = (int)($_GET['id'] ?? 0);

    if ($id <= 0) {

        $this->error($this->entityName . ' no válido.');

    } elseif (!$this->model->canDelete($id)) {

        $this->error(
            'No es posible eliminar este ' .
            strtolower($this->entityName) .
            ' porque está siendo utilizado.'
        );

    } elseif ($this->model->delete($id)) {

        $this->success(
            $this->entityName . ' eliminado correctamente.'
        );

    } else {

        $this->error(
            'No fue posible eliminar el ' .
            strtolower($this->entityName) .
            '.'
        );

    }

    $this->redirect(
        'index.php?controller=' .
        $this->route .
        '&action=index'
    );
}
}

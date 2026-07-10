<?php require __DIR__ . '/../layouts/header.php'; ?>

<?php

$isEdit = !empty($part);

$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);

function field($name, $part, $old)
{
    return htmlspecialchars($old[$name] ?? ($part[$name] ?? ''));
}

?>

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">

                <i class="bi bi-box-seam"></i>

                <?= $isEdit ? 'Editar artículo' : 'Nuevo artículo' ?>

            </h3>

        </div>

        <div class="card-body">

            <?php if (!empty($_SESSION['error'])): ?>

                <div class="alert alert-danger">

                    <?= $_SESSION['error']; ?>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>

            <form
                method="post"
                action="index.php?controller=inventory&action=<?= $isEdit ? 'update' : 'store' ?>">

                <?php if ($isEdit): ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $part['id'] ?>">

                <?php endif; ?>



                <!-- ====================================== -->
                <!-- Información general -->
                <!-- ====================================== -->

                <div class="card mb-4">

                    <div class="card-header bg-light">

                        <strong>Información general</strong>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Código *

                                </label>

                                <input
                                    type="text"
                                    name="codigo"
                                    maxlength="60"
                                    required
                                    class="form-control"
                                    value="<?= field('codigo',$part,$old) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Código de barras

                                </label>

                                <input
                                    type="text"
                                    name="codigo_barras"
                                    maxlength="100"
                                    class="form-control"
                                    value="<?= field('codigo_barras',$part,$old) ?>">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label class="form-label">

                                    Nombre *

                                </label>

                                <input
                                    type="text"
                                    required
                                    name="nombre"
                                    class="form-control"
                                    value="<?= field('nombre',$part,$old) ?>">

                            </div>

                        </div>

                        <div class="row">

                                                    <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Marca

                                </label>

                                <input
                                    type="text"
                                    name="marca"
                                    class="form-control"
                                    value="<?= field('marca',$part,$old) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Categoría *

                                </label>

                                <select
                                    name="categoria_id"
                                    class="form-select"
                                    required>

                                    <option value="">Seleccione...</option>

                                    <?php foreach($categories as $cat): ?>

                                        <?php
                                        $selected =
                                            ($old['categoria_id'] ?? $part['categoria_id'] ?? '') == $cat['id'];
                                        ?>

                                        <option
                                            value="<?= $cat['id'] ?>"
                                            <?= $selected ? 'selected' : '' ?>>

                                            <?= htmlspecialchars($cat['nombre']) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Tipo *

                                </label>

                                <?php
                                $tipo = $old['tipo'] ?? $part['tipo'] ?? 'repuesto';
                                ?>

                                <select
                                    name="tipo"
                                    class="form-select">

                                    <option value="repuesto" <?= $tipo=='repuesto'?'selected':'' ?>>
                                        Repuesto
                                    </option>

                                    <option value="insumo" <?= $tipo=='insumo'?'selected':'' ?>>
                                        Insumo
                                    </option>

                                    <option value="herramienta" <?= $tipo=='herramienta'?'selected':'' ?>>
                                        Herramienta
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Unidad *

                                </label>

                                <?php
                                $unidad = $old['unidad'] ?? $part['unidad'] ?? 'Unidad';
                                ?>

                                <select
                                    name="unidad"
                                    class="form-select">

                                    <?php

                                    $unidades = [
                                        'Unidad',
                                        'Juego',
                                        'Par',
                                        'Litro',
                                        'Mililitro',
                                        'Kilogramo',
                                        'Gramo',
                                        'Metro',
                                        'Centimetro'
                                    ];

                                    foreach($unidades as $u):

                                    ?>

                                        <option
                                            value="<?= $u ?>"
                                            <?= $unidad==$u?'selected':'' ?>>

                                            <?= $u ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>




                <!-- ====================================== -->
                <!-- Inventario -->
                <!-- ====================================== -->

                <div class="card mb-4">

                    <div class="card-header bg-light">

                        <strong>Inventario</strong>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-8 mb-3">

                                <label class="form-label">

                                    Ubicación

                                </label>

                                <input
                                    type="text"
                                    name="ubicacion"
                                    class="form-control"
                                    value="<?= field('ubicacion',$part,$old) ?>">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">

                                    Stock mínimo

                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="stock_minimo"
                                    class="form-control"
                                    value="<?= field('stock_minimo',$part,$old) ?>">

                            </div>

                        </div>

                    </div>

                </div>




                <!-- ====================================== -->
                <!-- Valores -->
                <!-- ====================================== -->

                <div class="card mb-4">

                    <div class="card-header bg-light">

                        <strong>Valores</strong>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Costo

                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="costo"
                                    class="form-control"
                                    value="<?= field('costo',$part,$old) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Precio de venta

                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="precio_venta"
                                    class="form-control"
                                    value="<?= field('precio_venta',$part,$old) ?>">

                            </div>

                        </div>

                                            </div>

                </div>





                <!-- ====================================== -->
                <!-- Estado -->
                <!-- ====================================== -->

                <div class="card mb-4">

                    <div class="card-header bg-light">

                        <strong>Estado</strong>

                    </div>

                    <div class="card-body">

                        <?php
                        $activo = $old['activo'] ?? $part['activo'] ?? 1;
                        ?>

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="activo"
                                name="activo"
                                value="1"
                                <?= $activo ? 'checked' : '' ?>>

                            <label
                                class="form-check-label"
                                for="activo">

                                Artículo activo

                            </label>

                        </div>

                    </div>

                </div>





                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="index.php?controller=inventory&action=index"
                        class="btn btn-secondary">

                        <i class="bi bi-x-circle"></i>

                        Cancelar

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save"></i>

                        <?= $isEdit ? 'Actualizar' : 'Guardar' ?>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
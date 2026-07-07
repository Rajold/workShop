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

    <div class="card shadow-sm">

        <div class="card-header">

            <h3 class="mb-0">

                <i class="bi bi-box-seam"></i>

                <?= $isEdit ? 'Editar Parte' : 'Nueva Parte' ?>

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


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Código

                        </label>

                        <input
                            type="text"
                            name="codigo"
                            class="form-control"
                            maxlength="30"
                            required
                            value="<?= field('codigo',$part,$old) ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nombre

                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            required
                            value="<?= field('nombre',$part,$old) ?>">

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Categoría

                        </label>

                        <select
                            class="form-select"
                            name="categoria_id"
                            required>

                            <option value="">

                                Seleccione...

                            </option>

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

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Marca

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="marca"
                            value="<?= field('marca',$part,$old) ?>">

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Unidad

                        </label>

                        <select
                            class="form-select"
                            name="unidad">

                            <?php

                            $unidad = $old['unidad'] ?? $part['unidad'] ?? 'UND';

                            ?>

                            <option value="UND" <?= $unidad=='UND'?'selected':'' ?>>Unidad</option>

                            <option value="LTS" <?= $unidad=='LTS'?'selected':'' ?>>Litros</option>

                            <option value="MTS" <?= $unidad=='MTS'?'selected':'' ?>>Metros</option>

                            <option value="KG" <?= $unidad=='KG'?'selected':'' ?>>Kilogramos</option>

                            <option value="JGO" <?= $unidad=='JGO'?'selected':'' ?>>Juego</option>

                        </select>

                    </div>

                    <div class="col-md-8 mb-3">

                        <label class="form-label">

                            Ubicación

                        </label>

                        <input
                            class="form-control"
                            name="ubicacion"
                            value="<?= field('ubicacion',$part,$old) ?>">

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Costo

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control"
                            name="costo"
                            value="<?= field('costo',$part,$old) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Precio

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control"
                            name="precio"
                            value="<?= field('precio',$part,$old) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Stock mínimo

                        </label>

                        <input
                            type="number"
                            step="1"
                            min="0"
                            class="form-control"
                            name="stock_minimo"
                            value="<?= field('stock_minimo',$part,$old) ?>">

                    </div>

                </div>


                <div class="form-check mb-4">

                    <?php

                    $activo = $old['activo'] ?? $part['activo'] ?? 1;

                    ?>

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="activo"
                        value="1"
                        <?= $activo ? 'checked' : '' ?>>

                    <label class="form-check-label">

                        Parte activa

                    </label>

                </div>


                <hr>

                <div class="d-flex justify-content-end">

                    <a
                        href="index.php?controller=inventory&action=index"
                        class="btn btn-secondary me-2">

                        Cancelar

                    </a>

                    <button
                        class="btn btn-primary">

                        <i class="bi bi-save"></i>

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
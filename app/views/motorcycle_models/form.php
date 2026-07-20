<h2><?= $title ?></h2>

<form
    method="post"
    action="index.php?controller=modelo_moto&action=<?= isset($model['id']) ? 'update' : 'store' ?>">

<?php if (isset($model['id'])): ?>

    <input
        type="hidden"
        name="id"
        value="<?= $model['id'] ?>">

<?php endif; ?>

<div class="mb-3">

    <label class="form-label">Marca</label>

    <select
        name="marca_moto_id"
        class="form-select"
        required>

        <option value="">Seleccione...</option>

        <?php foreach ($brands as $brand): ?>

            <option
                value="<?= $brand['id'] ?>"
                <?= isset($model['marca_moto_id']) &&
                    $model['marca_moto_id'] == $brand['id']
                    ? 'selected'
                    : '' ?>>

                <?= htmlspecialchars($brand['nombre']) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div class="mb-3">

    <label class="form-label">Tipo</label>

    <select
        name="tipo_moto_id"
        class="form-select"
        required>

        <option value="">Seleccione...</option>

        <?php foreach ($types as $type): ?>

            <option
                value="<?= $type['id'] ?>"
                <?= isset($model['tipo_moto_id']) &&
                    $model['tipo_moto_id'] == $type['id']
                    ? 'selected'
                    : '' ?>>

                <?= htmlspecialchars($type['nombre']) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div class="mb-3">

    <label class="form-label">Línea</label>

    <input
        type="text"
        name="linea"
        class="form-control"
        maxlength="30"
        value="<?= htmlspecialchars($model['linea'] ?? '') ?>"
        required>

</div>

<div class="mb-3">

    <label class="form-label">Cilindrada</label>

    <input
        type="number"
        name="cilindrada"
        class="form-control"
        min="0"
        value="<?= htmlspecialchars($model['cilindrada'] ?? '') ?>">

</div>

<button
    type="submit"
    class="btn btn-success">

    <?= isset($model['id'])
        ? 'Actualizar'
        : 'Guardar' ?>

</button>

<a
    href="index.php?controller=modelo_moto&action=index"
    class="btn btn-secondary">

    Cancelar

</a>

</form>
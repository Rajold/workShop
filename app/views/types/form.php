<h2><?= $title ?></h2>

<form
    method="post"
    action="index.php?controller=tipo_moto&action=<?= isset($type['id']) ? 'update' : 'store' ?>">

    <?php if (isset($type['id'])): ?>
        <input
            type="hidden"
            name="id"
            value="<?= $type['id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input
            type="text"
            name="nombre"
            class="form-control"
            maxlength="100"
            value="<?= htmlspecialchars($type['nombre'] ?? '') ?>"
            required>
    </div>

    <button type="submit" class="btn btn-success">
        <?= isset($type['id']) ? 'Actualizar' : 'Guardar' ?>
    </button>

    <a
        href="index.php?controller=tipo_moto&action=index"
        class="btn btn-secondary">
        Cancelar
    </a>

</form>
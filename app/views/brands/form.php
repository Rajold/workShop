<h2><?= $title ?></h2>

<form
    method="post"
    action="index.php?controller=marca_moto&action=<?= isset($brand['id']) ? 'update' : 'store' ?>">

    <?php if (isset($brand['id'])): ?>
        <input
            type="hidden"
            name="id"
            value="<?= $brand['id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input
            type="text"
            name="nombre"
            class="form-control"
            maxlength="100"
            value="<?= htmlspecialchars($brand['nombre'] ?? '') ?>"
            required>
    </div>

    <button type="submit" class="btn btn-success">
        <?= isset($brand['id']) ? 'Actualizar' : 'Guardar' ?>
    </button>

    <a
        href="index.php?controller=marca_moto&action=index"
        class="btn btn-secondary">
        Cancelar
    </a>

</form>
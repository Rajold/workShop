<h2><?= $title ?></h2>

<form
    method="post"
    action="index.php?controller=fabricante_repuesto&action=<?= isset($manufacturer['id']) ? 'update' : 'store' ?>">

    <?php if (isset($manufacturer['id'])): ?>
        <input
            type="hidden"
            name="id"
            value="<?= $manufacturer['id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input
            type="text"
            name="nombre"
            class="form-control"
            maxlength="100"
            value="<?= htmlspecialchars($manufacturer['nombre'] ?? '') ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea
            name="descripcion"
            class="form-control"
            rows="3"><?= htmlspecialchars($manufacturer['descripcion'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <?= isset($manufacturer['id']) ? 'Actualizar' : 'Guardar' ?>
    </button>

    <a
        href="index.php?controller=fabricante_repuesto&action=index"
        class="btn btn-secondary">
        Cancelar
    </a>

</form>
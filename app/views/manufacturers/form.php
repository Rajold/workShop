<h2><?= $title ?></h2>

<form
    method="post"
    action="index.php?controller=fabricante_repuesto&action=store">

    <div class="mb-3">

        <label class="form-label">

            Nombre

        </label>

        <input
            type="text"
            name="nombre"
            class="form-control"
            maxlength="100"
            value="<?= htmlspecialchars($manufacturer['nombre'] ?? '') ?>"
            required>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Descripción

        </label>

        <textarea
            name="descripcion"
            class="form-control"
            rows="3"><?= htmlspecialchars($manufacturer['descripcion'] ?? '') ?></textarea>

    </div>

    <button
        type="submit"
        class="btn btn-success">

        Guardar

    </button>

</form>
<h2><?= htmlspecialchars($part['nombre']) ?></h2>

<p class="text-muted">
Seleccione los modelos compatibles con este repuesto.
</p>

<hr>

<form
    method="post"
    action="index.php?controller=inventory&action=saveApplications">

<?php foreach ($groups as $brand => $models): ?>

    <div class="card mb-3">

        <div class="card-header bg-dark text-white">

            <strong><?= htmlspecialchars($brand) ?></strong>

        </div>

        <div class="card-body">

            <div class="row">

                <?php foreach ($models as $model): ?>

                    <?php

                    $checked = in_array(
                        $model['id'],
                        $selected
                    );

                    ?>

                    <div class="col-md-4 mb-2">

                        <label>

                            <input
                                type="checkbox"
                                name="models[]"
                                value="<?= $model['id'] ?>"
                                <?= $checked ? 'checked' : '' ?>>

                            <?= htmlspecialchars(
                                $model['linea'] .
                                $model['cilindrada']
                            ) ?>

                        </label>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

<?php endforeach; ?>

<input
    type="hidden"
    name="part_id"
    value="<?= $part['id'] ?>">

<button class="btn btn-success">

    Guardar aplicaciones

</button>

<a
    href="index.php?controller=inventory&action=index"
    class="btn btn-secondary">

    Cancelar

</a>

</form>
<div class="mb-3">

    <label class="form-label">

        Modelo de motocicleta

    </label>

    <select
        id="modelo_moto_id"
        name="modelo_moto_id"
        class="form-select">

        <option value="">

            Seleccione un modelo...

        </option>

        <?php foreach ($motorcycleModels as $item): ?>

            <option
                value="<?= $item['id'] ?>"
                data-brand="<?= htmlspecialchars($item['marca']) ?>"
                data-model="<?= htmlspecialchars($item['short_name']) ?>"
                data-line="<?= htmlspecialchars($item['linea']) ?>"
                data-cc="<?= $item['cilindrada'] ?>"
                data-type="<?= htmlspecialchars($item['tipo']) ?>"

                <?= (($selectedModelId ?? null) == $item['id'])
                    ? 'selected'
                    : '' ?>>

                <?= htmlspecialchars($item['display_name']) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<input
    type="hidden"
    id="marca"
    name="marca"
    value="<?= htmlspecialchars($selectedBrand ?? '') ?>">

<input
    type="hidden"
    id="modelo"
    name="modelo"
    value="<?= htmlspecialchars($selectedModel ?? '') ?>">
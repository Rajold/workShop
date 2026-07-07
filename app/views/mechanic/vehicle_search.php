<h2>Resultado de la búsqueda</h2>

<?php if (!empty($vehicles)): ?>

    <div class="alert alert-success">
        Se encontraron <strong><?= count($vehicles) ?></strong> vehículo(s).
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead>
<tr>
    <th>Placa</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Propietario</th>
    <th>Estado</th>
    <th>Último ingreso</th>
    <th></th>
</tr>
</thead>

                <tbody>

                <?php foreach ($vehicles as $vehicle): ?>

                    <tr>

                        <td>
                            <strong><?= htmlspecialchars($vehicle['placa']) ?></strong>
                        </td>

                        <td>
                            <?= htmlspecialchars($vehicle['marca']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($vehicle['modelo']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($vehicle['propietario']) ?>
                        </td>

                        <td>
<?php
if (($vehicle['estado'] ?? '') === 'abierto') {
    echo '<span class="badge bg-success">🟢 Abierto</span>';
} elseif (($vehicle['estado'] ?? '') === 'cerrado') {
    echo '<span class="badge bg-secondary">⚪ Cerrado</span>';
} else {
    echo '<span class="badge bg-light text-dark">Sin casos</span>';
}
?>
</td>

<td>
<?= htmlspecialchars($vehicle['fecha_ingreso'] ?? '-') ?>
</td>

                        <td class="text-end">

                            <a
                                class="btn btn-primary btn-sm"
                                href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>">
                                Ver ficha
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

<?php else: ?>

    <div class="alert alert-warning">
        No se encontraron vehículos.
    </div>

    <h4>Registrar nuevo vehículo</h4>

    <form method="post"
          action="index.php?controller=mechanic&action=saveVehicle"
          onsubmit="return validateVehicleForm(this)">

        <div class="mb-2">
            <input name="placa" class="form-control" placeholder="Placa"
            value="<?= ($criterio ?? '') === 'placa' ? htmlspecialchars($valor ?? '') : '' ?>" required>
        </div>

        <div class="mb-2">
            <input name="marca" class="form-control" placeholder="Marca"
            value="<?= ($criterio ?? '') === 'marca' ? htmlspecialchars($valor ?? '') : '' ?>" required>
        </div>

        <div class="mb-2">
            <input name="modelo" class="form-control" placeholder="Modelo">
        </div>

        <div class="mb-2">
            <input name="color" class="form-control" placeholder="Color">
        </div>

        <div class="mb-2">
            <input name="propietario" class="form-control" placeholder="Propietario"
            value="<?= ($criterio ?? '') === 'propietario' ? htmlspecialchars($valor ?? '') : '' ?>" required>
        </div>

        <div class="mb-2">
            <input name="telefono" class="form-control" placeholder="Teléfono" maxlength="20">
        </div>
        <div class="mb-2">
            <textarea name="causa" class="form-control" rows="3" placeholder="Falla reportada por el propietario"
                required></textarea>
        </div>

        <button class="btn btn-success">
            Guardar vehículo y registrar caso
        </button>

    </form>

<?php endif; ?>

<div class="mt-3">

    <a href="index.php?controller=mechanic&action=dashboard"
       class="btn btn-secondary">

        ← Nueva búsqueda

    </a>

</div>
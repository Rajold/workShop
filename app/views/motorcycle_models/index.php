<h2><?= $title ?></h2>

<p>
    <a
        class="btn btn-primary"
        href="index.php?controller=modelo_moto&action=create">
        Nuevo modelo
    </a>
</p>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Línea</th>
            <th>Cilindrada</th>
            <th>Estado</th>
            <th style="width:260px">Acciones</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($models as $model): ?>

        <tr>

            <td><?= htmlspecialchars($model['marca']) ?></td>

            <td><?= htmlspecialchars($model['tipo']) ?></td>

            <td><?= htmlspecialchars($model['linea']) ?></td>

            <td><?= $model['cilindrada'] ?></td>

            <td>
                <?= $model['activo']
                    ? '<span class="badge bg-success">Activo</span>'
                    : '<span class="badge bg-secondary">Inactivo</span>' ?>
            </td>

            <td>

                <a
                    href="index.php?controller=modelo_moto&action=edit&id=<?= $model['id'] ?>"
                    class="btn btn-sm btn-warning">
                    Editar
                </a>

                <a
                    href="index.php?controller=modelo_moto&action=toggle&id=<?= $model['id'] ?>"
                    class="btn btn-sm btn-info">
                    <?= $model['activo']
                        ? 'Desactivar'
                        : 'Activar' ?>
                </a>

                <?php if ($model['can_delete']): ?>

                    <a
                        href="index.php?controller=modelo_moto&action=delete&id=<?= $model['id'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar este modelo de motocicleta?');">
                        Eliminar
                    </a>

                <?php endif; ?>

            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>
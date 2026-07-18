<h2><?= $title ?></h2>

<p>
    <a
        class="btn btn-primary"
        href="index.php?controller=marca_moto&action=create">
        Nueva marca
    </a>
</p>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th style="width:260px">Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($brands as $brand): ?>
        <tr>

            <td><?= $brand['id'] ?></td>

            <td><?= htmlspecialchars($brand['nombre']) ?></td>


            <td>
                <?= $brand['activo']
                    ? '<span class="badge bg-success">Activo</span>'
                    : '<span class="badge bg-secondary">Inactivo</span>' ?>
            </td>

            <td>
                <a
                    href="index.php?controller=marca_moto&action=edit&id=<?= $brand['id'] ?>"
                    class="btn btn-sm btn-warning">
                    Editar
                </a>

                <a
                    href="index.php?controller=marca_moto&action=toggle&id=<?= $brand['id'] ?>"
                    class="btn btn-sm btn-info">
                    <?= $brand['activo'] ? 'Desactivar' : 'Activar' ?>
                </a>

                <?php if ($brand['can_delete']): ?>
                    <a
                        href="index.php?controller=marca_moto&action=delete&id=<?= $brand['id'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar este fabricante?');">
                        Eliminar
                    </a>
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
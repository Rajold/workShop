<h2><?= $title ?></h2>

<p>
    <a
        class="btn btn-primary"
        href="index.php?controller=tipo_moto&action=create">
        Nuevo tipo
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

        <?php foreach ($types as $type): ?>
        <tr>

            <td><?= $type['id'] ?></td>

            <td><?= htmlspecialchars($type['nombre']) ?></td>


            <td>
                <?= $type['activo']
                    ? '<span class="badge bg-success">Activo</span>'
                    : '<span class="badge bg-secondary">Inactivo</span>' ?>
            </td>

            <td>
                <a
                    href="index.php?controller=fabricante_repuesto&action=edit&id=<?= $type['id'] ?>"
                    class="btn btn-sm btn-warning">
                    Editar
                </a>

                <a
                    href="index.php?controller=fabricante_repuesto&action=toggle&id=<?= $type['id'] ?>"
                    class="btn btn-sm btn-info">
                    <?= $type['activo'] ? 'Desactivar' : 'Activar' ?>
                </a>

                <?php if ($type['can_delete']): ?>
                    <a
                        href="index.php?controller=fabricante_repuesto&action=delete&id=<?= $type['id'] ?>"
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
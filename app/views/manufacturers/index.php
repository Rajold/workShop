<h2><?= $title ?></h2>

<p>
    <a
    class="btn btn-primary"
    href="index.php?controller=fabricante_repuesto&action=create">
    Nuevo fabricante
</a>
</p>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>

            <th>Nombre</th>

            <th>Activo</th>

        </tr>

    </thead>

    <tbody>

    <?php foreach ($manufacturers as $m): ?>

        <tr>

            <td><?= $m['id'] ?></td>

            <td><?= htmlspecialchars($m['nombre']) ?></td>

            <td><?= $m['activo'] ? 'Sí' : 'No' ?></td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>
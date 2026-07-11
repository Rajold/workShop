<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="bi bi-box-seam"></i>
            Agregar repuesto al caso
        </h2>

        <a
    href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehId ?>"
    class="btn btn-secondary">

    Volver al caso

</a>

    </div>

    <form method="GET" class="row g-2 mb-4">

        <input type="hidden" name="controller" value="inventory">
<input type="hidden" name="action" value="selectForCase">
<input type="hidden" name="case_id" value="<?= $caseId ?>">
<input type="hidden" name="veh_id" value="<?= $vehId ?>">

        <div class="col-md-10">

            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Buscar artículo..."
                value="<?= htmlspecialchars($search) ?>">

        </div>

        <div class="col-md-2 d-grid">

            <button class="btn btn-primary">

                Buscar

            </button>

        </div>

    </form>

    <table class="table table-hover">

        <thead>

            <tr>

                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th></th>

            </tr>

        </thead>

        <tbody>

        <?php foreach ($parts as $part): ?>

            <tr>

                <td><?= htmlspecialchars($part['codigo']) ?></td>

                <td><?= htmlspecialchars($part['nombre']) ?></td>

                <td>

<?php

$stock = (float)$part['stock_actual'];

if ($stock <= 0) {

    echo '<span class="badge bg-danger">0</span>';

} elseif ($stock <= $part['stock_minimo']) {

    echo '<span class="badge bg-warning text-dark">'.$stock.'</span>';

} else {

    echo '<span class="badge bg-success">'.$stock.'</span>';

}

?>

</td>

                <td>

    <form
        method="POST"
        action="index.php?controller=inventory&action=addToCase"
        class="d-flex align-items-center gap-2">

        <input
            type="hidden"
            name="case_id"
            value="<?= $caseId ?>">

        <input
            type="hidden"
            name="veh_id"
            value="<?= $vehId ?>">

        <input
            type="hidden"
            name="parte_id"
            value="<?= $part['id'] ?>">

        <input
            type="number"
            name="cantidad"
            value="1"
            min="1"
            max="<?= (int)$part['stock_actual'] ?>"
            class="form-control form-control-sm"
            style="width:75px">

        <button
            type="submit"
            class="btn btn-success btn-sm">

            <i class="bi bi-plus-circle"></i>

            Agregar

        </button>

    </form>

</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
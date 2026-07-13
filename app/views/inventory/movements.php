<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>

                <i class="bi bi-clock-history"></i>

                Kardex del artículo

            </h2>

            <h5 class="text-muted">

                <?= htmlspecialchars($part['codigo']) ?>

                -

                <?= htmlspecialchars($part['nombre']) ?>

            </h5>

        </div>

        <a
            href="index.php?controller=inventory&action=index"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>


    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card">

                <div class="card-body text-center">

                    <small>Stock actual</small>

                    <h2>

                        <?= $part['stock_actual'] ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body text-center">

                    <small>Stock mínimo</small>

                    <h2>

                        <?= $part['stock_minimo'] ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body text-center">

                    <small>Costo</small>

                    <h2>

                        $<?= number_format($part['costo'],0,',','.') ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body text-center">

                    <small>Precio venta</small>

                    <h2>

                        $<?= number_format($part['precio_venta'],0,',','.') ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>


    <div class="card">

        <div class="card-header">

            Historial de movimientos

        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>Fecha</th>

                        <th>Tipo</th>

                        <th>Cantidad</th>

                        <th>Stock</th>

                        <th>Caso</th>

                        <th>Usuario</th>

                        <th>Motivo</th>

                    </tr>

                </thead>

                <tbody>

                <?php if(empty($movements)): ?>

                    <tr>

                        <td colspan="7"
                            class="text-center text-muted p-4">

                            No existen movimientos para este artículo.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach($movements as $m): ?>

                    <tr>

                        <td>

                            <?= date('d/m/Y H:i',strtotime($m['fecha'])) ?>

                        </td>

                        <td>

<?php

switch($m['tipo']){

case 'compra':

    echo '<span class="badge bg-success">Compra</span>';

break;

case 'consumo':

    echo '<span class="badge bg-danger">Consumo</span>';

break;

case 'ajuste_entrada':

    echo '<span class="badge bg-primary">Ajuste +</span>';

break;

case 'ajuste_salida':

    echo '<span class="badge bg-warning text-dark">Ajuste -</span>';

break;

}

?>

                        </td>

                        <td>

                            <?= $m['cantidad'] ?>

                        </td>

                        <td>

                            <?= $m['stock_resultante'] ?>

                        </td>

                        <td>

<?php if($m['caso_id']): ?>

Caso #<?= $m['caso_id'] ?>

<?php else: ?>

—

<?php endif; ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($m['usuario']) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($m['motivo']) ?>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
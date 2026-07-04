//_financial_summary.php
<div class="card border-success mb-4">

    <div class="card-header bg-success text-white">
        <strong>💰 Resumen económico</strong>
    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-4">
                <h6>🔧 Mano de obra</h6>

                <h4 class="text-primary">
                    $<?= number_format((int)$totales['mano_obra'],0,",",".") ?>
                </h4>

            </div>

            <div class="col-md-4">

                <h6>📦 Repuestos</h6>

                <h4 class="text-warning">
                    $<?= number_format((int)$totales['repuestos'],0,",",".") ?>
                </h4>

            </div>

            <div class="col-md-4">

                <h6>💰 Total</h6>

                <h3 class="text-success">
                    $<?= number_format((int)$totales['total'],0,",",".") ?>
                </h3>

            </div>

        </div>

    </div>

</div>
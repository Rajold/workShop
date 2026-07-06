<h2 class="mb-4">📊 Panel de administración</h2>

<div class="row g-4">

    <div class="col-md-3">

        <div class="card shadow-sm border-primary">

            <div class="card-body text-center">

                <h6>🚗 Vehículos</h6>

                <h2><?= $stats['totalVehiculos'] ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-success">

            <div class="card-body text-center">

                <h6>🟢 Casos abiertos</h6>

                <h2><?= $stats['casosAbiertos'] ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-secondary">

            <div class="card-body text-center">

                <h6>⚫ Casos cerrados</h6>

                <h2><?= $stats['casosCerrados'] ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>👨‍🔧 Mecánicos</h6>

                <h2><?= $stats['totalMecanicos'] ?></h2>


            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>👨‍🔧 Facturado</h6>

                <h2><?= $stats['totalFacturado'] ?></h2>


            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>👨‍🔧 Facturado este mes</h6>

                <h2><?= $stats['facturacionMes'] ?></h2>


            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>👨‍🔧 Casos este mes</h6>

                <h2><?= $stats['casosMes'] ?></h2>


            </div>

        </div>

    </div>

</div>

<div class="mt-4">

    <a
        class="btn btn-primary"
        href="index.php?controller=admin&action=users">

        👥 Gestionar usuarios

    </a>

</div>
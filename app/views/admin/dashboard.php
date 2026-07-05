<h2 class="mb-4">📊 Panel de administración</h2>

<div class="row g-4">

    <div class="col-md-3">

        <div class="card shadow-sm border-primary">

            <div class="card-body text-center">

                <h6>🚗 Vehículos</h6>

                <h2><?= $totalVehiculos ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-success">

            <div class="card-body text-center">

                <h6>🟢 Casos abiertos</h6>

                <h2><?= $casosAbiertos ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-secondary">

            <div class="card-body text-center">

                <h6>⚫ Casos cerrados</h6>

                <h2><?= $casosCerrados ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>👨‍🔧 Mecánicos</h6>

                <h2><?= $totalMecanicos ?></h2>


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
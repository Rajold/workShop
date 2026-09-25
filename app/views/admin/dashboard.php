<h2 class="mb-4">📊 Panel de administración</h2>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="index.php" class="row g-3 align-items-end">

            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="dashboard">

            <div class="col-md-4">
                <label for="periodo" class="form-label">
                    Período
                </label>

                <select
                    name="periodo"
                    id="periodo"
                    class="form-select"
                    onchange="this.form.submit()"
                >
                    <option value="semana"
                        <?= ($_GET['periodo'] ?? 'mes') === 'semana' ? 'selected' : '' ?>>
                        Esta semana
                    </option>

                    <option value="mes"
                        <?= ($_GET['periodo'] ?? 'mes') === 'mes' ? 'selected' : '' ?>>
                        Este mes
                    </option>

                    <option value="anio"
                        <?= ($_GET['periodo'] ?? 'mes') === 'anio' ? 'selected' : '' ?>>
                        Este año
                    </option>

                    <option value="rango"
                        <?= ($_GET['periodo'] ?? 'mes') === 'rango' ? 'selected' : '' ?>>
                        Rango personalizado
                    </option>
                </select>
            </div>

        </form>
    </div>
</div>

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

                <h6>💵 Facturado</h6>

                <h2><?= $stats['totalFacturado'] ?></h2>


            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body text-center">

                <h6>📅 Facturado este mes</h6>

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

<h4 class="mt-5 mb-3">💰 Resumen financiero</h4>
<!-- RESUMEN FINANCIERO
     INGRESOS -->

<div class="row g-4">

    <!-- Mano de obra -->
    <div class="col-md-4">
        <div class="card shadow-sm border-primary h-100">
            <div class="card-body">

                <h6 class="text-muted">
                    🔧 Mano de obra
                </h6>

                <h2>
                    $<?= number_format(
                        $stats['manoObraTotal'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

                <small class="text-muted">
                    Venta de servicios de reparación
                </small>

            </div>
        </div>
    </div>


    <!-- Venta inventario -->
    <div class="col-md-4">
        <div class="card shadow-sm border-success h-100">
            <div class="card-body">

                <h6 class="text-muted">
                    📦 Venta de inventario
                </h6>

                <h2>
                    $<?= number_format(
                        $stats['ventaInventarioTotal'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

                <small class="text-muted">
                    Venta de repuestos existentes en inventario
                </small>

            </div>
        </div>
    </div>


    <!-- Venta compras directas -->
    <div class="col-md-4">
        <div class="card shadow-sm border-success h-100">
            <div class="card-body">

                <h6 class="text-muted">
                    🛒 Venta compras directas
                </h6>

                <h2>
                    $<?= number_format(
                        $stats['ventaComprasDirectasTotal'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

                <small class="text-muted">
                    Repuestos comprados específicamente para casos
                </small>

            </div>
        </div>
    </div>

</div>


<!-- =========================================================
     MÁRGENES / GANANCIAS
========================================================== -->

<h5 class="mt-5 mb-3">📈 Ganancia por origen</h5>

<div class="row g-4">

    <!-- Ganancia inventario -->
    <div class="col-md-6">

        <div class="card shadow-sm border-info h-100">

            <div class="card-body">

                <h5>📦 Inventario</h5>

                <hr>

                <div class="d-flex justify-content-between">
                    <span>Venta</span>

                    <strong>
                        $<?= number_format(
                            $stats['ventaInventarioTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Costo</span>

                    <strong>
                        $<?= number_format(
                            $stats['costoInventarioTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <strong>Ganancia</strong>

                    <strong>
                        $<?= number_format(
                            $stats['gananciaInventarioTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>

                </div>

            </div>

        </div>

    </div>


    <!-- Ganancia compras directas -->
    <div class="col-md-6">

        <div class="card shadow-sm border-info h-100">

            <div class="card-body">

                <h5>🛒 Compras directas</h5>

                <hr>

                <div class="d-flex justify-content-between">
                    <span>Venta</span>

                    <strong>
                        $<?= number_format(
                            $stats['ventaComprasDirectasTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Costo</span>

                    <strong>
                        $<?= number_format(
                            $stats['costoComprasDirectasTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <strong>Ganancia</strong>

                    <strong>
                        $<?= number_format(
                            $stats['gananciaComprasDirectasTotal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     TOTALES
========================================================== -->

<h5 class="mt-5 mb-3">📊 Totales generales</h5>

<div class="row g-4">

    <!-- Facturación -->
    <div class="col-md-4">

        <div class="card shadow-sm border-success h-100">

            <div class="card-body text-center">

                <h6>💵 Facturación total</h6>

                <h2>
                    $<?= number_format(
                        $stats['totalFacturado'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

            </div>

        </div>

    </div>


    <!-- Costo repuestos -->
    <div class="col-md-4">

        <div class="card shadow-sm border-danger h-100">

            <div class="card-body text-center">

                <h6>📦 Costo total de repuestos</h6>

                <h2>
                    $<?= number_format(
                        $stats['costoRepuestosTotal'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

            </div>

        </div>

    </div>


    <!-- Utilidad -->
    <div class="col-md-4">

        <div class="card shadow-sm border-primary h-100">

            <div class="card-body text-center">

                <h6>📈 Utilidad calculada</h6>

                <h2>
                    $<?= number_format(
                        $stats['utilidadTotal'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </h2>

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
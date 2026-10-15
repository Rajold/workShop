<?php
$formatCOP = static fn($valor): string =>
    '$ ' . number_format((float)$valor, 2, ',', '.');
?>

<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Caja y bancos</h1>
            <p class="text-muted mb-0">
                Resumen de saldos e historial financiero del taller.
            </p>
        </div>
        <a href="index.php?controller=mechanic&action=dashboard"
           class="btn btn-outline-secondary">
            Volver al panel
        </a>
    </div>

    <div class="row g-3 mb-4">
        <?php foreach ($cuentas as $cuenta): ?>
            <div class="col-12 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="h5 mb-2">
                                    <?= htmlspecialchars($cuenta['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>
                                <p class="text-muted mb-2">
                                    <?= $cuenta['tipo'] === 'caja'
                                        ? 'Dinero disponible en efectivo'
                                        : 'Dinero disponible en cuentas bancarias' ?>
                                </p>
                            </div>
                            <span class="badge text-bg-light">
                                <?= $cuenta['tipo'] === 'caja' ? 'EFECTIVO' : 'BANCO' ?>
                            </span>
                        </div>

                        <div class="fs-3 fw-semibold">
                            <?= $formatCOP($cuenta['saldo']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-12">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <div class="text-muted mb-2">Total combinado</div>
                    <div class="fs-2 fw-bold">
                        <?= $formatCOP($totalGeneral) ?>
                    </div>
                    <small class="text-muted">
                        Suma de los saldos de las cuentas activas.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-body">
            <h2 class="h5 mb-0">Movimientos recientes</h2>
        </div>

        <div class="card-body p-0">
            <?php if (empty($movimientos)): ?>
                <div class="p-4 text-center text-muted">
                    Todavía no hay movimientos financieros registrados.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cuenta</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Registrado por</th>
                                <th class="text-end">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($movimientos as $movimiento): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars(
                                            date('d/m/Y H:i', strtotime($movimiento['fecha_movimiento'])),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($movimiento['cuenta_nombre'], ENT_QUOTES, 'UTF-8') ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($movimiento['descripcion'], ENT_QUOTES, 'UTF-8') ?>
                                        <?php if (!empty($movimiento['caso_referencia'])): ?>
                                            <div class="small text-muted">
                                                <?= htmlspecialchars($movimiento['caso_referencia'], ENT_QUOTES, 'UTF-8') ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(
                                            ucfirst($movimiento['tipo']) . ' · ' . $movimiento['sentido'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($movimiento['usuario_nombre'], ENT_QUOTES, 'UTF-8') ?>
                                    </td>
                                    <td class="text-end text-nowrap fw-semibold">
                                        <span class="<?= $movimiento['sentido'] === 'entrada'
                                            ? 'text-success'
                                            : 'text-danger' ?>">
                                            <?= $movimiento['sentido'] === 'entrada' ? '+' : '−' ?>
                                            <?= $formatCOP($movimiento['monto']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="alert alert-info mt-4 mb-0" role="alert">
        <strong>Nota:</strong> los saldos reflejan únicamente los movimientos
        registrados en este módulo. Todavía no incluyen saldos iniciales
        ni pagos históricos de reparaciones.
    </div>
</div>

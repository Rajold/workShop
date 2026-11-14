<h3>Avances del caso</h3>

<?php if (!empty($avances)): ?>
    <ul class="list-group mb-3">
        <?php foreach ($avances as $a): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($a['mecanico']) ?>:</strong>
                <?= nl2br(htmlspecialchars($a['descripcion'])) ?>
                <br><small class="text-muted"><?= htmlspecialchars($a['fecha']) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay avances registrados aún.</p>
<?php endif; ?>

<!-- Formulario para añadir nuevo avance -->
<form method="POST" action="index.php?controller=case&action=add">
    <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id']) ?>">
    <div class="mb-3">
        <label for="descripcion" class="form-label">Nuevo avance:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agregar avance</button>
</form>


<hr class="my-4">

<h3>Resumen financiero de la reparación</h3>

<?php
    $formatoDinero = function ($valor) {
        return '$ ' . number_format((float) $valor, 2, ',', '.');
    };
?>

<div class="card mb-4">
    <div class="card-body">

        <?php if ($caso['estado'] === 'cerrado'): ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-muted">Precio cobrado</div>
                    <h5><?= $formatoDinero($caso['precio_cobrado']) ?></h5>
                </div>

                <div class="col-md-4">
                    <div class="text-muted">Descuento</div>
                    <h5><?= $formatoDinero($caso['descuento']) ?></h5>
                </div>

                <div class="col-md-4">
                    <div class="text-muted">Valor neto</div>
                    <h5><?= $formatoDinero($valorNeto) ?></h5>
                </div>

                <div class="col-md-6">
                    <div class="text-muted">Total abonado</div>
                    <h5 class="text-success">
                        <?= $formatoDinero($totalPagado) ?>
                    </h5>
                </div>

                <div class="col-md-6">
                    <div class="text-muted">Saldo pendiente</div>
                    <h5 class="<?= $saldoPendiente > 0 ? 'text-danger' : 'text-success' ?>">
                        <?= $formatoDinero($saldoPendiente) ?>
                    </h5>
                </div>
            </div>

            <?php if ($saldoPendiente <= 0): ?>
                <div class="alert alert-success mt-3 mb-0">
                    Reparación completamente pagada.
                </div>
            <?php endif; ?>

        <?php else: ?>

            <p class="mb-2">
                <strong>Estado:</strong>
                <span class="badge bg-success">Reparación abierta</span>
            </p>

            <p class="mb-2">
                <strong>Total recibido:</strong>
                <span class="text-success fw-bold">
                    <?= $formatoDinero($totalPagado) ?>
                </span>
            </p>

            <p class="text-muted mb-0">
                El saldo definitivo estará disponible cuando se cierre
                la reparación y se establezcan el precio y el descuento.
            </p>

        <?php endif; ?>

    </div>
</div>

<h4>Registrar abono del cliente</h4>

<?php if (!empty($cuentasPago)): ?>

    <?php if ($caso['estado'] !== 'cerrado' || $saldoPendiente > 0): ?>

        <form method="POST"
              action="index.php?controller=case&action=pagar"
              class="card card-body mb-4">

            <input type="hidden"
                   name="caso_id"
                   value="<?= (int) $caso['id'] ?>">

            <input type="hidden"
                   name="token_pago"
                   value="<?= htmlspecialchars($tokenPago) ?>">

            <div class="row g-3">

                <div class="col-md-4">
                    <label for="monto" class="form-label">
                        Valor del abono
                    </label>

                    <input type="number"
                           class="form-control"
                           id="monto"
                           name="monto"
                           min="0.01"
                           step="0.01"
                           required>
                </div>

                <div class="col-md-4">
                    <label for="cuenta_id" class="form-label">
                        Recibir en
                    </label>

                    <select class="form-select"
                            id="cuenta_id"
                            name="cuenta_id"
                            required>

                        <option value="">Seleccionar cuenta</option>

                        <?php foreach ($cuentasPago as $cuenta): ?>
                            <option value="<?= (int) $cuenta['id'] ?>">
                                <?= htmlspecialchars($cuenta['nombre']) ?>
                                (<?= htmlspecialchars(ucfirst($cuenta['tipo'])) ?>)
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="col-md-4">
                    <label for="observacion" class="form-label">
                        Observación
                    </label>

                    <input type="text"
                           class="form-control"
                           id="observacion"
                           name="observacion"
                           maxlength="255"
                           placeholder="Opcional">
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    Registrar abono
                </button>
            </div>

        </form>

    <?php endif; ?>

<?php else: ?>

    <div class="alert alert-warning">
        No hay cuentas financieras activas para recibir pagos.
    </div>

<?php endif; ?>

<h4>Historial de pagos</h4>

<?php if (!empty($pagos)): ?>

    <div class="table-responsive mb-4">
        <table class="table table-striped table-bordered align-middle">

            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th>Cuenta</th>
                    <th>Registrado por</th>
                    <th>Observación</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($pagos as $pago): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($pago['fecha_pago']) ?>
                        </td>

                        <td class="text-success fw-bold">
                            <?= $formatoDinero($pago['monto']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($pago['cuenta_nombre']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($pago['usuario_nombre']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($pago['observacion'] ?? '') ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

<?php else: ?>

    <p class="text-muted mb-4">
        Esta reparación todavía no tiene abonos registrados.
    </p>

<?php endif; ?>


<hr class="my-4">

<hr class="my-4">

<hr class="my-4">

<h4>Historial del vehículo</h4>

<?php if (!empty($historial)): ?>
    <?php $totalCasos = count($historial); ?>
    <p class="text-muted">
        📋 Este vehículo tiene <strong><?= $totalCasos ?></strong> caso<?= $totalCasos > 1 ? 's' : '' ?> registrado<?= $totalCasos > 1 ? 's' : '' ?>.
    </p>

    <ul class="list-group">
        <?php foreach ($historial as $h): ?>
            <?php
                $isCurrent = ($h['id'] == $caso['id']); // 🔍 Es el caso actual
                $badgeColor = ($h['estado'] === 'abierto') ? 'success' : 'secondary';
                $itemClass = $isCurrent ? 'list-group-item-info border-primary' : '';
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center <?= $itemClass ?>">
                <div>
                    <a href="index.php?controller=case&action=ver&id=<?= htmlspecialchars($h['id']) ?>" 
                       class="text-decoration-none <?= $isCurrent ? 'fw-bold text-primary' : '' ?>">
                        <?php if ($isCurrent): ?>
                            🔹 Caso actual:
                        <?php else: ?>
                            Caso #<?= htmlspecialchars($h['id']) ?> –
                        <?php endif; ?>
                        <?= htmlspecialchars($h['causa'] ?? 'Sin causa') ?>
                    </a>
                    <br>
                    <small class="text-muted">
                        <?= htmlspecialchars($h['fecha_ingreso']) ?> – 
                        Mecánico: <?= htmlspecialchars($h['mecanico_nombre'] ?? 'N/D') ?>
                    </small>
                </div>
                <span class="badge bg-<?= $badgeColor ?>">
                    <?= htmlspecialchars(ucfirst($h['estado'])) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-muted">Este vehículo no tiene historial de casos anteriores.</p>
<?php endif; ?>




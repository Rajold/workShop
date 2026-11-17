
<?php
$formatMoney = static function ($value): string {
    return '$' . number_format((float)$value, 2, ',', '.');
};

$escape = static function ($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
};

$statusLabels = [
    'pendiente' => 'Pendiente',
    'parcial' => 'Pago parcial',
    'pagada' => 'Pagada',
    'anulada' => 'Anulada'
];

$statusClasses = [
    'pendiente' => 'bg-warning text-dark',
    'parcial' => 'bg-info text-dark',
    'pagada' => 'bg-success',
    'anulada' => 'bg-secondary'
];

$status = $purchase['estado'] ?? '';
$statusLabel = $statusLabels[$status] ?? ucfirst($status);
$statusClass = $statusClasses[$status] ?? 'bg-secondary';

$total = (float)$purchase['total'];
$paid = (float)$purchase['valor_pagado'];
$balance = (float)$purchase['saldo_pendiente'];

$progress = $total > 0
    ? min(100, max(0, ($paid / $total) * 100))
    : 0;

$canPay = $balance > 0 && $status !== 'anulada';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-receipt-cutoff"></i>
            Compra #<?= (int)$purchase['id'] ?>
        </h2>
        <p class="text-muted mb-0">
            Detalle de artículos y movimientos de pago.
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="index.php?controller=inventory&action=purchases"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Volver al historial
        </a>

        <a href="index.php?controller=inventory&action=index"
           class="btn btn-outline-primary">
            <i class="bi bi-box-seam"></i>
            Inventario
        </a>
    </div>
</div>

<!-- INFORMACIÓN GENERAL -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-info-circle"></i>
            Información de la compra
        </h5>

        <span class="badge <?= $statusClass ?> fs-6">
            <?= $escape($statusLabel) ?>
        </span>
    </div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <small class="text-muted">Proveedor</small>
                <div class="fw-semibold">
                    <?= $escape($purchase['proveedor']) ?>
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Fecha de compra</small>
                <div class="fw-semibold">
                    <?= $escape(
                        date('d/m/Y', strtotime($purchase['fecha_compra']))
                    ) ?>
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Registrada por</small>
                <div class="fw-semibold">
                    <?= $escape($purchase['usuario']) ?>
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Forma de pago inicial</small>
                <div class="fw-semibold">
                    <?= $escape(ucfirst($purchase['forma_pago'])) ?>
                </div>
            </div>

            <div class="col-md-8">
                <small class="text-muted">Observaciones</small>
                <div>
                    <?= $purchase['observaciones']
                        ? nl2br($escape($purchase['observaciones']))
                        : '<span class="text-muted">Sin observaciones</span>' ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RESUMEN FINANCIERO -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <small class="text-muted">Total de la compra</small>
                <h4 class="mb-0 mt-2">
                    <?= $formatMoney($total) ?>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <small class="text-muted">Total pagado</small>
                <h4 class="mb-0 mt-2 text-success">
                    <?= $formatMoney($paid) ?>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <small class="text-muted">Saldo pendiente</small>
                <h4 class="mb-0 mt-2 <?= $balance > 0 ? 'text-danger' : 'text-success' ?>">
                    <?= $formatMoney($balance) ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<!-- PROGRESO DE PAGO -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <strong>Progreso de pago</strong>
            <strong><?= number_format($progress, 1, ',', '.') ?>%</strong>
        </div>

        <div class="progress" style="height: 12px;">
            <div class="progress-bar <?= $progress >= 100 ? 'bg-success' : 'bg-primary' ?>"
                 role="progressbar"
                 style="width: <?= $progress ?>%;"
                 aria-valuenow="<?= $progress ?>"
                 aria-valuemin="0"
                 aria-valuemax="100">
            </div>
        </div>
    </div>
</div>

<!-- ARTÍCULOS -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bi bi-box-seam"></i>
            Artículos comprados
        </h5>
    </div>

    <div class="card-body p-0">
        <?php if (empty($items)): ?>

            <div class="text-center py-4 text-muted">
                No se encontraron artículos asociados a esta compra.
            </div>

        <?php else: ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Artículo</th>
                            <th>Código</th>
                            <th class="text-end">Cantidad</th>
                            <th class="text-end">Costo unitario</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <strong><?= $escape($item['articulo']) ?></strong>
                                    <div class="small text-muted">
                                        <?= $escape($item['tipo']) ?>
                                    </div>
                                </td>

                                <td><?= $escape($item['codigo']) ?></td>

                                <td class="text-end">
                                    <?= number_format((float)$item['cantidad'], 2, ',', '.') ?>
                                </td>

                                <td class="text-end text-nowrap">
                                    <?= $formatMoney($item['costo_unitario']) ?>
                                </td>

                                <td class="text-end fw-semibold text-nowrap">
                                    <?= $formatMoney($item['subtotal']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th class="text-end">
                                <?= $formatMoney($total) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        <?php endif; ?>
    </div>
</div>

<!-- HISTORIAL DE PAGOS -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bi bi-cash-stack"></i>
            Historial de pagos y abonos
        </h5>
    </div>

    <div class="card-body p-0">
        <?php if (empty($payments)): ?>

            <div class="text-center py-4 text-muted">
                Esta compra todavía no tiene pagos registrados.
            </div>

        <?php else: ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Cuenta</th>
                            <th>Registrado por</th>
                            <th>Observación</th>
                            <th>Movimiento</th>
                            <th class="text-end">Monto</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td class="text-nowrap">
                                    <?= $escape(
                                        date(
                                            'd/m/Y H:i',
                                            strtotime($payment['fecha_pago'])
                                        )
                                    ) ?>
                                </td>

                                <td>
                                    <strong><?= $escape($payment['cuenta']) ?></strong>
                                    <div class="small text-muted">
                                        <?= $escape(ucfirst($payment['tipo_cuenta'])) ?>
                                    </div>
                                </td>

                                <td><?= $escape($payment['usuario']) ?></td>

                                <td>
                                    <?= $escape($payment['observacion'] ?? '') ?>
                                </td>

                                <td>
                                    #<?= (int)$payment['movimiento_financiero_id'] ?>
                                </td>

                                <td class="text-end text-success fw-semibold text-nowrap">
                                    <?= $formatMoney($payment['monto']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>
</div>

<!-- FORMULARIO DE ABONO -->
<?php if ($canPay): ?>

    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle"></i>
                Registrar nuevo abono
            </h5>
        </div>

        <div class="card-body">
            <?php if (empty($accounts)): ?>

                <div class="alert alert-warning mb-0">
                    No hay cuentas financieras activas para registrar el abono.
                </div>

            <?php else: ?>

                <div class="alert alert-info">
                    <strong>Saldo pendiente:</strong>
                    <?= $formatMoney($balance) ?>
                </div>

                <form method="POST"
                      action="index.php?controller=inventory&action=savePurchasePayment"
                      onsubmit="return confirm('¿Confirmas el registro de este abono? Se generará un egreso en la cuenta seleccionada.');">

                    <input type="hidden"
                           name="compra_id"
                           value="<?= (int)$purchase['id'] ?>">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="monto" class="form-label">
                                Monto del abono
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="monto"
                                   name="monto"
                                   min="0.01"
                                   max="<?= number_format($balance, 2, '.', '') ?>"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label for="cuenta_id" class="form-label">
                                Cuenta de pago
                            </label>

                            <select class="form-select"
                                    id="cuenta_id"
                                    name="cuenta_id"
                                    required>
                                <option value="">Seleccionar cuenta...</option>

                                <?php foreach ($accounts as $account): ?>
                                    <option value="<?= (int)$account['id'] ?>">
                                        <?= $escape($account['nombre']) ?>
                                        (<?= $escape(ucfirst($account['tipo'])) ?>)
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
                                   placeholder="Ej. Segundo abono">
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            Registrar abono
                        </button>
                    </div>
                </form>

            <?php endif; ?>
        </div>
    </div>

<?php elseif ($status === 'anulada'): ?>

    <div class="alert alert-secondary">
        Esta compra está anulada. No se pueden registrar nuevos abonos.
    </div>

<?php else: ?>

    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i>
        Esta compra está completamente pagada.
    </div>

<?php endif; ?>

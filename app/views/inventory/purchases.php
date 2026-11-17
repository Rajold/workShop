
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
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-receipt"></i>
            Historial de compras
        </h2>
        <p class="text-muted mb-0">
            Consulta las compras de inventario y sus saldos pendientes.
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="index.php?controller=inventory&action=index"
           class="btn btn-outline-secondary">
            <i class="bi bi-box-seam"></i>
            Inventario
        </a>

        <a href="index.php?controller=inventory&action=registerPurchase"
           class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Registrar compra
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bi bi-list-ul"></i>
            Compras registradas
            <span class="badge bg-secondary">
                <?= count($purchases) ?>
            </span>
        </h5>
    </div>

    <div class="card-body p-0">
        <?php if (empty($purchases)): ?>

            <div class="text-center py-5">
                <i class="bi bi-inbox display-4 text-muted"></i>
                <h5 class="mt-3">No hay compras registradas</h5>
                <p class="text-muted">
                    Las compras de inventario aparecerán aquí.
                </p>
            </div>

        <?php else: ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Compra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Forma de pago</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Pagado</th>
                            <th class="text-end">Pendiente</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($purchases as $purchase): ?>
                            <?php
                            $status = $purchase['estado'] ?? '';
                            $statusLabel = $statusLabels[$status] ?? ucfirst($status);
                            $statusClass = $statusClasses[$status] ?? 'bg-secondary';
                            ?>

                            <tr>
                                <td>
                                    <strong>
                                        #<?= (int)$purchase['id'] ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= $escape(
                                        date(
                                            'd/m/Y',
                                            strtotime($purchase['fecha_compra'])
                                        )
                                    ) ?>
                                </td>

                                <td>
                                    <?= $escape($purchase['proveedor']) ?>
                                </td>

                                <td>
                                    <?= $escape(ucfirst($purchase['forma_pago'])) ?>
                                </td>

                                <td class="text-end text-nowrap">
                                    <?= $formatMoney($purchase['total']) ?>
                                </td>

                                <td class="text-end text-nowrap text-success">
                                    <?= $formatMoney($purchase['valor_pagado']) ?>
                                </td>

                                <td class="text-end text-nowrap
                                    <?= (float)$purchase['saldo_pendiente'] > 0
                                        ? 'text-danger fw-semibold'
                                        : 'text-muted' ?>">
                                    <?= $formatMoney($purchase['saldo_pendiente']) ?>
                                </td>

                                <td>
                                    <span class="badge <?= $statusClass ?>">
                                        <?= $escape($statusLabel) ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="index.php?controller=inventory&action=purchaseDetail&id=<?= (int)$purchase['id'] ?>"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Ver detalle">
                                        <i class="bi bi-eye"></i>
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>
</div>

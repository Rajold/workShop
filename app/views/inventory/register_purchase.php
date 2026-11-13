<?php
$partsJson = json_encode(
    $parts,
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
);
?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">
                <i class="bi bi-cart-plus"></i>
                Registrar compra
            </h3>
            <p class="text-muted mb-0">
                Entrada de mercancía y registro del pago al proveedor.
            </p>
        </div>

        <a href="index.php?controller=inventory&action=index"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST"
          action="index.php?controller=inventory&action=savePurchase"
          id="purchaseForm">

        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <strong>Información de la compra</strong>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Proveedor</label>

                        <select name="proveedor_id"
                                class="form-select"
                                required>
                            <option value="">Seleccione un proveedor...</option>

                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?= (int)$supplier['id'] ?>">
                                    <?= htmlspecialchars($supplier['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Forma de pago</label>

                        <select name="forma_pago"
                                id="formaPago"
                                class="form-select"
                                required>
                            <option value="contado">Contado</option>
                            <option value="credito">Crédito</option>
                            <option value="parcial">Pago parcial</option>
                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones"
                              class="form-control"
                              rows="2"
                              placeholder="Factura, número de comprobante u otros detalles..."></textarea>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Artículos de la compra</strong>

                <button type="button"
                        class="btn btn-sm btn-primary"
                        id="addRow">
                    <i class="bi bi-plus-lg"></i>
                    Agregar artículo
                </button>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle"
                           id="purchaseTable">

                        <thead class="table-light">
                            <tr>
                                <th style="min-width:250px">Artículo</th>
                                <th style="min-width:110px">Cantidad</th>
                                <th style="min-width:140px">Costo unitario</th>
                                <th style="min-width:140px">Subtotal</th>
                                <th style="width:60px"></th>
                            </tr>
                        </thead>

                        <tbody id="purchaseRows"></tbody>

                    </table>
                </div>

                <div class="text-end mt-3">
                    <span class="text-muted me-2">TOTAL DE LA COMPRA</span>
                    <strong class="fs-4" id="totalDisplay">$0.00</strong>
                </div>

            </div>
        </div>

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Pago inicial</strong>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3"
                         id="paidContainer">

                        <label class="form-label">Valor pagado</label>

                        <input type="number"
                               name="valor_pagado"
                               id="valorPagado"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="0">
                    </div>

                    <div class="col-md-4 mb-3"
                         id="accountContainer">

                        <label class="form-label">Cuenta de pago</label>

                        <select name="cuenta_id"
                                id="cuentaId"
                                class="form-select">

                            <option value="">Seleccione una cuenta...</option>

                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= (int)$account['id'] ?>">
                                    <?= htmlspecialchars($account['nombre']) ?>
                                    (<?= htmlspecialchars($account['tipo']) ?>)
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Saldo pendiente</label>

                        <div class="form-control bg-light fw-bold"
                             id="balanceDisplay">
                            $0.00
                        </div>
                    </div>

                </div>

                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i>
                    El inventario se actualizará por el valor total de la compra,
                    independientemente de cuánto se pague inicialmente.
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">

            <a href="index.php?controller=inventory&action=index"
               class="btn btn-secondary">
                Cancelar
            </a>

            <button type="submit"
                    class="btn btn-success"
                    id="savePurchase">
                <i class="bi bi-check-circle"></i>
                Registrar compra
            </button>

        </div>

    </form>
</div>

<template id="rowTemplate">
    <tr class="purchase-row">

        <td>
            <select name="parte_id[]"
                    class="form-select part-select"
                    required>
                <option value="">Seleccione un artículo...</option>
            </select>
        </td>

        <td>
            <input type="number"
                   name="cantidad[]"
                   class="form-control quantity-input"
                   min="0.01"
                   step="0.01"
                   value="1"
                   required>
        </td>

        <td>
            <input type="number"
                   name="costo_unitario[]"
                   class="form-control cost-input"
                   min="0"
                   step="0.01"
                   value="0"
                   required>
        </td>

        <td class="text-end fw-semibold subtotal-cell">
            $0.00
        </td>

        <td class="text-center">
            <button type="button"
                    class="btn btn-outline-danger btn-sm remove-row"
                    title="Eliminar artículo">
                <i class="bi bi-trash"></i>
            </button>
                            </td>


    </tr>
</template>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const parts = <?= $partsJson ?: '[]' ?>;

    const rowsContainer = document.getElementById('purchaseRows');
    const template = document.getElementById('rowTemplate');

    const addButton = document.getElementById('addRow');
    const paymentType = document.getElementById('formaPago');

    const paidInput = document.getElementById('valorPagado');
    const accountSelect = document.getElementById('cuentaId');

    const totalDisplay = document.getElementById('totalDisplay');
    const balanceDisplay = document.getElementById('balanceDisplay');

    const paidContainer = document.getElementById('paidContainer');
    const accountContainer = document.getElementById('accountContainer');

    const purchaseForm = document.getElementById('purchaseForm');

    function money(value) {
        return '$' + Number(value).toLocaleString('es-CO', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function addRow() {

        const fragment = template.content.cloneNode(true);
        const row = fragment.querySelector('.purchase-row');

        const select = row.querySelector('.part-select');
        const quantityInput = row.querySelector('.quantity-input');
        const costInput = row.querySelector('.cost-input');

        parts.forEach(part => {

            const option = document.createElement('option');

            option.value = part.id;

            option.textContent =
                part.codigo + ' - ' + part.nombre +
                ' (Stock: ' + part.stock_actual + ')';

            option.dataset.cost = part.costo;

            select.appendChild(option);
        });

        select.addEventListener('change', function () {

            const selected = this.options[this.selectedIndex];

            if (selected.dataset.cost !== undefined) {
                costInput.value = Number(selected.dataset.cost).toFixed(2);
            }

            calculateTotals();
        });

        quantityInput.addEventListener('input', calculateTotals);
        costInput.addEventListener('input', calculateTotals);

        row.querySelector('.remove-row').addEventListener('click', function () {

            row.remove();

            if (rowsContainer.children.length === 0) {
                addRow();
            }

            calculateTotals();
        });

        rowsContainer.appendChild(fragment);

        calculateTotals();
    }

    function calculateTotals() {

        let total = 0;

        document.querySelectorAll('.purchase-row').forEach(row => {

            const quantity = Number(
                row.querySelector('.quantity-input').value
            ) || 0;

            const cost = Number(
                row.querySelector('.cost-input').value
            ) || 0;

            const subtotal = quantity * cost;

            row.querySelector('.subtotal-cell').textContent = money(subtotal);

            total += subtotal;
        });

        total = Math.round((total + Number.EPSILON) * 100) / 100;

        let paid = 0;

        if (paymentType.value === 'contado') {
            paid = total;
            paidInput.value = total.toFixed(2);
        }

        if (paymentType.value === 'credito') {
            paid = 0;
            paidInput.value = '0.00';
        }

        if (paymentType.value === 'parcial') {
            paid = Number(paidInput.value) || 0;
        }

        const balance = Math.max(0, total - paid);

        totalDisplay.textContent = money(total);
        balanceDisplay.textContent = money(balance);

        const isCredit = paymentType.value === 'credito';

        paidContainer.style.display = isCredit ? 'none' : '';
        accountContainer.style.display = isCredit ? 'none' : '';

        paidInput.readOnly = paymentType.value === 'contado';

        if (paid > 0) {
            accountSelect.required = true;
        } else {
            accountSelect.required = false;
        }
    }

    addButton.addEventListener('click', addRow);

    paymentType.addEventListener('change', calculateTotals);

    paidInput.addEventListener('input', calculateTotals);

    purchaseForm.addEventListener('submit', function (event) {

        const rows = document.querySelectorAll('.purchase-row');

        if (rows.length === 0) {
            event.preventDefault();
            alert('Agrega al menos un artículo a la compra.');
            return;
        }

        for (const row of rows) {

            const part = row.querySelector('.part-select').value;
            const quantity = Number(row.querySelector('.quantity-input').value);
            const cost = Number(row.querySelector('.cost-input').value);

            if (!part || quantity <= 0 || cost < 0) {
                event.preventDefault();
                alert('Revisa los artículos, cantidades y costos.');
                return;
            }
        }

        const total = rowsContainer.querySelectorAll('.purchase-row').length;

        if (total === 0) {
            event.preventDefault();
            alert('La compra no contiene artículos.');
        }
    });

    addRow();
    calculateTotals();

});
</script>

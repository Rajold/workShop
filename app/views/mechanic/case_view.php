<?php
// app/views/mechanic/case_view.php
?>

<!-- Cargar Bootstrap desde CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<a
    href="index.php?controller=case&action=imprimir&case_id=<?= $caso['id'] ?>"
    target="_blank"
    class="btn btn-danger">

    🖨 Imprimir PDF

</a>

<div class="container mt-4">
    <h2 class="mb-4">Ficha del vehículo</h2>

    <?php if ($vehicle): ?>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Placa:</strong> <?= htmlspecialchars($vehicle['placa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Marca:</strong> <?= htmlspecialchars($vehicle['marca'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Modelo:</strong> <?= htmlspecialchars($vehicle['modelo'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Color:</strong> <?= htmlspecialchars($vehicle['color'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Propietario:</strong> <?= htmlspecialchars($vehicle['propietario'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Ningún vehículo seleccionado.</div>
    <?php endif; ?>

    <h3>Casos del vehículo</h3>
    <?php if (!empty($cases)): ?>
        <ul class="list-group mb-4">
            <?php foreach ($cases as $c): ?>
                <li class="list-group-item">
                    <a href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>&case_id=<?= $c['id'] ?>" class="text-decoration-none">
                        Caso #<?= htmlspecialchars($c['id']) ?> – <?= htmlspecialchars($c['causa'] ?? 'Sin causa') ?> 
                        <span class="badge bg-<?= ($c['estado'] === 'abierto' ? 'success' : 'secondary') ?> float-end"><?= htmlspecialchars($c['estado'] ?? 'Desconocido') ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info">El vehículo no tiene casos registrados.</div>
    <?php endif; ?>

    <h2 class="mt-4">Ficha del caso</h2>

    <?php if ($caso): ?>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Causa:</strong> <?= htmlspecialchars($caso['causa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Observaciones:</strong> <?= htmlspecialchars($caso['observaciones'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Diagnóstico:</strong> <?= htmlspecialchars($caso['diagnostico'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($caso['estado'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>

<?php if ($caso['estado'] === 'abierto'): ?>
    <div class="alert alert-info">
        <?php if (empty($activeSession)): ?>
            <form method="post" action="index.php?controller=mechanic&action=startSession" class="mb-3">
                <input type="hidden" name="case_id" value="<?= $caso['id'] ?>">
                <button type="submit" class="btn btn-primary">Iniciar sesión de trabajo</button>
            </form>
        <?php else: ?>
            <p><strong>Sesión activa</strong></p>

            <h4>Agregar avance</h4>
            <form method="post">
                <div class="mb-3">
                    <textarea name="nuevo_avance" rows="4" class="form-control" placeholder="Describa el avance..." required></textarea>
                </div>
                <div class="mb-3">
    <label class="form-label">Tipo de avance</label>

    <select name="tipo" class="form-control" required>
        <option value="">Seleccione...</option>
        <option value="Repuesto">Repuesto</option>
        <option value="Mano de obra">Mano de obra</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Valor</label>

    <input
        type="number"
        class="form-control"
        name="valor"
        min="0"
        step="0.01"
        required>
</div>
                <button type="submit" class="btn btn-success">Guardar avance</button>
            </form>

            <form method="post" action="index.php?controller=mechanic&action=endSession" class="mt-3">
                <input type="hidden" name="session_id" value="<?= $activeSession['id'] ?>">
                <button type="submit" class="btn btn-danger">Terminar sesión de trabajo</button>
            </form>
        <?php endif; ?>
    </div>
    

    <!-- Botón para cerrar caso -->
    <button
    type="button"
    class="btn btn-warning w-100 mt-3"
    data-bs-toggle="modal"
    data-bs-target="#modalCerrarCaso">

    🏁 Cerrar caso

</button>


<?php else: ?>

<div class="alert alert-success">
    <h5 class="mb-0">✅ Caso cerrado</h5>
</div>

<div class="card border-success shadow-sm mb-4">

    <div class="card-header bg-success text-white">
        <strong>📊 Resumen del caso</strong>
    </div>

    <div class="card-body">

        <table class="table table-sm">

            <tr>
                <th>Costo mano de obra</th>
                <td class="text-end">
                    $<?= number_format($totales['mano_obra'],0,',','.') ?>
                </td>
            </tr>

            <tr>
                <th>Costo repuestos</th>
                <td class="text-end">
                    $<?= number_format($totales['repuestos'],0,',','.') ?>
                </td>
            </tr>

            <tr class="table-light">
                <th>Total registrado</th>
                <th class="text-end">
                    $<?= number_format($totales['total'],0,',','.') ?>
                </th>
            </tr>

            <tr>
                <th>Precio cobrado</th>
                <td class="text-end">
                    $<?= number_format($caso['precio_cobrado'],0,',','.') ?>
                </td>
            </tr>

            <tr>
                <th>Descuento</th>
                <td class="text-end">
                    $<?= number_format($caso['descuento'],0,',','.') ?>
                </td>
            </tr>

            <tr class="table-warning">
                <th>Total facturado</th>
                <th class="text-end">
                    $<?= number_format(
                        $caso['precio_cobrado'] - $caso['descuento'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </th>
            </tr>

            <tr>
                <th>Fecha cierre</th>
                <td class="text-end">
                    <?= !empty($caso['fecha_cierre'])
                        ? date('d/m/Y H:i', strtotime($caso['fecha_cierre']))
                        : '--' ?>
                </td>
            </tr>

        </table>

    </div>

</div>

<?php endif; ?>

<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error_message']) ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<?php if ($caso['estado'] === 'cerrado'): ?>
    <?php if (!empty($hasOpenCase)): ?>
        <button class="btn btn-secondary mt-3 w-100" disabled title="Ya existe un caso abierto para este vehículo">
            🆕 Nuevo caso (no disponible)
        </button>
    <?php else: ?>
        <form method="POST" action="index.php?controller=case&action=nuevoDesdeExistente">
            <input type="hidden" name="vehiculo_id" value="<?= htmlspecialchars($caso['vehiculo_id']) ?>">
            <input type="hidden" name="referencia_anterior" value="<?= htmlspecialchars($caso['id']) ?>">
            <button type="submit" class="btn btn-success mt-3 w-100">
                🆕 Nuevo caso
            </button>
        </form>
    <?php endif; ?>
<?php endif; ?>

<?php require __DIR__ . '/partials/_financial_summary.php'; ?>

        <?php require __DIR__ . '/partials/_advance_history.php'; ?>

        <div class="modal fade" id="modalEditarAvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="index.php?controller=mechanic&action=editAdvance">

                <div class="modal-header">
                    <h5 class="modal-title">Editar avance</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>

                        <textarea
                            id="edit-descripcion"
                            name="descripcion"
                            class="form-control"
                            rows="4"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo</label>

                        <select
                            id="edit-tipo"
                            name="tipo"
                            class="form-control">

                            <option value="Repuesto">Repuesto</option>
                            <option value="Mano de obra">Mano de obra</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Valor</label>

                        <input
                            id="edit-valor"
                            type="number"
                            name="valor"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Guardar cambios

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

    <?php else: ?>
        <div class="alert alert-warning">No hay caso seleccionado.</div>
    <?php endif; ?>
</div>

<!-- Modal Cerrar Caso -->
<div class="modal fade" id="modalCerrarCaso" tabindex="-1" aria-labelledby="modalCerrarCasoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="index.php?controller=case&action=cerrar">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalCerrarCasoLabel">
                        🏁 Cerrar caso
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="caso_id"
                        value="<?= $caso['id'] ?>">

                    <div class="alert alert-info">

                        <strong>📊 Resumen económico</strong>

                        <hr>

                        <p>
                            Costo de mano de obra:
                            <strong>$<?= number_format($totales['mano_obra'],0,',','.') ?></strong>
                        </p>

                        <p>
                            Costo de repuestos:
                            <strong>$<?= number_format($totales['repuestos'],0,',','.') ?></strong>
                        </p>

                        <p class="fs-5">
                            Costo del caso:
                            <strong>$<?= number_format($totales['total'],0,',','.') ?></strong>
                        </p>

                    </div>

                    <hr>

<div class="mb-3">
    <label class="form-label">
        Precio cobrado al cliente
    </label>

    <input
    type="number"
    class="form-control"
    id="precio_cobrado"
    name="precio_cobrado"
    min="0"
    value="<?= $totales['total'] ?>"
    required>
</div>

<div class="mb-3">
    <label class="form-label">
        Descuento
    </label>

    <input
        type="number"
        class="form-control"
        id="descuento"
        name="descuento"
        min="0"
        value="0">
</div>

<div class="alert alert-success">

    <h5>Resultado</h5>

    <p>
        Total facturado:
        <strong id="totalCobrado">
            $0
        </strong>
    </p>

    <p class="mb-0">
        Utilidad:
        <strong id="utilidad">
            $0
        </strong>
    </p>

</div>

                    <p class="text-danger mb-0">
                        ¿Está seguro de cerrar este caso?
                    </p>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        🏁 Cerrar caso

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script>

const costoTotal = <?= (int)$totales['total'] ?>;

const precio = document.getElementById('precio_cobrado');
const descuento = document.getElementById('descuento');

const lblTotal = document.getElementById('totalCobrado');
const lblUtilidad = document.getElementById('utilidad');

function actualizarResumen(){

    const p = parseInt(precio.value) || 0;
    const d = parseInt(descuento.value) || 0;

    const total = p - d;
    const utilidad = total - costoTotal;

    lblTotal.textContent =
        '$' + total.toLocaleString('es-CO');

    lblUtilidad.textContent =
        '$' + utilidad.toLocaleString('es-CO');

}

precio.addEventListener('input', actualizarResumen);
descuento.addEventListener('input', actualizarResumen);

actualizarResumen();

</script>

<!-- Cargar Bootstrap JS y Popper.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.editar-avance').forEach(function(btn){

        btn.addEventListener('click', function(){

            document.getElementById('edit-id').value = this.dataset.id;

            document.getElementById('edit-descripcion').value =
                this.dataset.descripcion;

            document.getElementById('edit-tipo').value =
                this.dataset.tipo;

            document.getElementById('edit-valor').value =
                this.dataset.valor;

        });

    });

});
</script>

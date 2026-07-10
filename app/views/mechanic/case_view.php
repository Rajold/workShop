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
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">

            <div>
                <h3 class="mb-1">
                    🛵 <?= htmlspecialchars($vehicle['marca']) ?>
                    <?= htmlspecialchars($vehicle['modelo']) ?>
                </h3>

              <div class="license-plate mb-3">
    <?= htmlspecialchars(strtoupper($vehicle['placa'])) ?>
</div>

                <p class="mb-1">
                    <strong>Propietario:</strong>
                    <?= htmlspecialchars($vehicle['propietario']) ?>
                </p>
                <p><strong>Teléfono:</strong>
    <?= htmlspecialchars($vehicle['telefono'] ?? '-') ?>
</p>

<?php
$telefono = preg_replace('/\D/', '', $vehicle['telefono']);

$mensaje = urlencode(
    "Hola {$vehicle['propietario']}, le escribimos desde el taller respecto a su vehículo de placa {$vehicle['placa']}."
);
?>

<a class="btn btn-success"
   target="_blank"
   href="https://wa.me/57<?= $telefono ?>?text=<?= $mensaje ?>">
    💬 WhatsApp
</a>

                <p class="mb-0">
                    <strong>Color:</strong>
                    <?= htmlspecialchars($vehicle['color']) ?>
                </p>
            </div>

            <div class="text-end">

                <?php if (!empty($caso)): ?>

                    <?php if ($caso['estado'] === 'abierto'): ?>

                        <span class="badge bg-success fs-6">
                            🟢 Caso abierto
                        </span>

                    <?php else: ?>

                        <span class="badge bg-secondary fs-6">
                            ⚫ Caso cerrado
                        </span>

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
                🆕 Iniciar nuevo caso
            </button>
        </form>
    <?php endif; ?>
<?php endif; ?>


                    <?php endif; ?>

                    <div class="mt-3">

                        <small class="text-muted">

                            Caso #<?= $caso['id'] ?><br>

                            <?= htmlspecialchars($caso['fecha_ingreso']) ?>

                        </small>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>
</div>
<?php else: ?>
<div class="alert alert-warning">
    Ningún vehículo seleccionado.
</div>
<?php endif; ?>

    <h3 class="mb-3">📚 Historial del vehículo</h3>

<?php if (!empty($cases)): ?>

<div class="row">

<?php foreach ($cases as $c): ?>

<div class="col-md-6 mb-3">

    <div class="card h-100 shadow-sm <?= $c['id'] == $caso['id'] ? 'border-primary' : '' ?>">

        <div class="card-body">

            <h5 class="card-title">

                Caso #<?= $c['id'] ?>

            </h5>

            <p class="mb-1">

                <strong>Fecha:</strong>

                <?= htmlspecialchars($c['fecha_ingreso']) ?>

            </p>

            <p class="mb-2">

                <?= htmlspecialchars($c['causa'] ?: 'Sin descripción') ?>

            </p>

            <span class="badge bg-<?= $c['estado']=='abierto' ? 'success' : 'secondary' ?>">

                <?= ucfirst($c['estado']) ?>

            </span>

        </div>

        <div class="card-footer bg-white">

            <a
                class="btn btn-sm btn-outline-primary"
                href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>&case_id=<?= $c['id'] ?>">

                👁 Ver

            </a>

            <?php if ($c['estado'] == 'cerrado'): ?>

                <a
                    class="btn btn-sm btn-outline-danger"
                    target="_blank"
                    href="index.php?controller=case&action=imprimir&case_id=<?= $c['id'] ?>">

                    📄 PDF

                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<div class="alert alert-info">

    El vehículo no tiene casos registrados.

</div>

<?php endif; ?>
        <div class="alert alert-info">El vehículo no tiene casssos registrados.</div>
</php endif; ?>

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
        <strong>📊 Resumen del casos</strong>
    </div>

    <div class="card-body">

        <div class="row mb-4">

    <div class="col-md-4">

        <div class="card border-primary shadow-sm h-100">

            <div class="card-body text-center">

                <h6 class="text-muted mb-2">
                    👨‍🔧 Mano de obra
                </h6>

                <h2 class="text-primary mb-0">
                    $<?= number_format($totales['mano_obra'],0,',','.') ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card border-warning shadow-sm h-100">

            <div class="card-body text-center">

                <h6 class="text-muted mb-2">
                    🔩 Repuestos
                </h6>

                <h2 class="text-warning mb-0">
                    $<?= number_format($totales['repuestos'],0,',','.') ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card border-success shadow-sm h-100">

            <div class="card-body text-center">

                <h6 class="text-muted mb-2">
                    💰 Total
                </h6>

                <h2 class="text-success mb-0">
                    $<?= number_format($totales['total'],0,',','.') ?>
                </h2>

            </div>

        </div>

    </div>

</div>

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

                        <strong>📊 Ressumen económico</strong>

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

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


        <?php if (!empty($pendingItems)): ?>

            <div class="alert alert-warning shadow-sm mb-4">

                <h5 class="mb-3">
                    ⚠ Pendientes del vehículo
                </h5>

                <ul class="mb-0">

                    <?php foreach ($pendingItems as $pending): ?>

                        <li>

                            <?= htmlspecialchars($pending['descripcion']) ?>

                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <h3 class="mb-1">

                            <?php if (!empty($vehicle['display_name'])): ?>

                                🏍️ <?= htmlspecialchars($vehicle['display_name']) ?>

                            <?php else: ?>

                                🏍️ <?= htmlspecialchars($vehicle['marca']) ?>
                                <?= htmlspecialchars($vehicle['modelo']) ?>

                            <?php endif; ?>

                        </h3>

                        <?php if (!empty($vehicle['tipo_moto'])): ?>

                            <div class="text-muted mb-2">

                                <?= htmlspecialchars($vehicle['tipo_moto']) ?>

                                <?php if (!empty($vehicle['cilindrada'])): ?>

                                    • <?= (int)$vehicle['cilindrada'] ?> cc

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                        <?php
                        $plate = $vehicle['placa'];
                        include __DIR__ . '/../components/license_plate.php';
                        ?>

                        <!-- <div class="license-plate">
        <div class="plate-number">
            <?= strtoupper($vehicle['placa']) ?>
        </div> 
        <div class="country">
            COLOMBIA
        </div>
    </div> -->

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
                        <?php if (!empty($compatibleParts)): ?>

                            <div class="card mt-4 border-success">

                                <div class="card-header bg-success text-white">

                                    <i class="bi bi-tools"></i>

                                    Repuestos compatibles

                                </div>

                                <div class="list-group list-group-flush">

                                    <?php foreach ($compatibleParts as $part): ?>

                                        <?php

                                        $stock = (float)$part['stock_actual'];

                                        if ($stock <= 0) {

                                            $badge = 'danger';
                                            $texto = 'Agotado';
                                        } elseif ($stock <= $part['stock_minimo']) {

                                            $badge = 'warning';
                                            $texto = 'Stock bajo';
                                        } else {

                                            $badge = 'success';
                                            $texto = 'Disponible';
                                        }

                                        ?>

                                        <div class="list-group-item">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <strong>

                                                        <?= htmlspecialchars($part['nombre']) ?>

                                                    </strong>

                                                    <br>

                                                    <small class="text-muted">

                                                        <?= htmlspecialchars($part['codigo']) ?>

                                                    </small>

                                                </div>

                                                <div class="text-end">

                                                    <span class="badge bg-<?= $badge ?>">

                                                        <?= $texto ?>

                                                    </span>

                                                    <br>

                                                    <small>

                                                        Stock:
                                                        <?= $stock ?>

                                                    </small>

                                                </div>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </div>

                        <?php endif; ?>
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

                                            <input
                                                type="hidden"
                                                name="vehiculo_id"
                                                value="<?= htmlspecialchars($caso['vehiculo_id']) ?>">

                                            <input
                                                type="hidden"
                                                name="referencia_anterior"
                                                value="<?= htmlspecialchars($caso['id']) ?>">

                                            <!-- Tipo de ingreso -->
                                            <div class="mt-3 text-start">

                                                <label class="form-label fw-bold">
                                                    Tipo de nuevo ingreso
                                                </label>

                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="tipo_ingreso"
                                                        id="ingresoRelacionado"
                                                        value="relacionado"
                                                        checked>

                                                    <label
                                                        class="form-check-label"
                                                        for="ingresoRelacionado">
                                                        🔄 Continuación del caso anterior
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="tipo_ingreso"
                                                        id="ingresoNuevo"
                                                        value="nuevo">

                                                    <label
                                                        class="form-check-label"
                                                        for="ingresoNuevo">
                                                        🆕 Falla o servicio diferente
                                                    </label>
                                                </div>

                                            </div>

                                            <!-- Motivo -->
                                            <div class="mt-3 text-start">

                                                <label
                                                    for="motivo_ingreso"
                                                    class="form-label fw-bold">
                                                    Motivo del ingreso
                                                </label>

                                                <textarea
                                                    class="form-control"
                                                    name="motivo_ingreso"
                                                    id="motivo_ingreso"
                                                    rows="3"
                                                    placeholder="Describa por qué el vehículo ingresa nuevamente al taller..."
                                                    required></textarea>

                                                <small class="text-muted">
                                                    Ejemplo: La falla persiste, apareció una nueva falla,
                                                    el cliente solicita una revisión adicional, etc.
                                                </small>

                                            </div>

                                            <!-- Observaciones -->
                                            <div class="mt-3 text-start">

                                                <label
                                                    for="observaciones"
                                                    class="form-label fw-bold">
                                                    Observaciones
                                                </label>

                                                <textarea
                                                    class="form-control"
                                                    name="observaciones"
                                                    id="observaciones"
                                                    rows="3"
                                                    placeholder="Información adicional proporcionada por el cliente o relevante para el ingreso..."></textarea>

                                                <small class="text-muted">
                                                    Ejemplo: El cliente indica que la falla aparece principalmente
                                                    cuando el motor está caliente.
                                                </small>

                                            </div>

                                            <button
                                                type="submit"
                                                class="btn btn-success mt-3 w-100">
                                                🆕 Crear nuevo caso
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

                            <span class="badge bg-<?= $c['estado'] == 'abierto' ? 'success' : 'secondary' ?>">

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
    <div class="alert alert-info">El vehículo no tiene más casos registrados.</div>
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

        <?php if (!empty($pendingItems)): ?>

            <div class="card border-warning shadow-sm mt-4 mb-4">

                <div class="card-header bg-warning">

                    <strong>📌 Pendientes del vehículo</strong>

                </div>

                <div class="card-body">

                    <?php foreach ($pendingItems as $pending): ?>

                        <div class="border rounded p-3 mb-3">

                            <div class="mb-2">

                                <?= nl2br(htmlspecialchars($pending['descripcion'])) ?>

                            </div>

                            <small class="text-muted">

                                Creado en caso #<?= $pending['caso_origen'] ?>

                                ·

                                <?= htmlspecialchars($pending['usuario']) ?>

                            </small>

                            <div class="mt-3">

                                <button
                                    type="button"
                                    class="btn btn-success btn-sm btn-resolve-pending"

                                    data-bs-toggle="modal"
                                    data-bs-target="#resolvePendingModal"

                                    data-pending-id="<?= $pending['id'] ?>"
                                    data-case-id="<?= $caso['id'] ?>"
                                    data-veh-id="<?= $veh_id ?>"
                                    data-description="<?= htmlspecialchars($pending['descripcion'], ENT_QUOTES) ?>">

                                    👨‍🔧 Convertir en mano de obra

                                </button>

                                <a
                                    href="index.php?controller=inventory&action=selectForCase&case_id=<?= $caso['id'] ?>&veh_id=<?= $veh_id ?>&pending_id=<?= $pending['id'] ?>"
                                    class="btn btn-primary btn-sm">

                                    🔩 Convertir en repuesto

                                </a>

                                <a
                                    href="index.php?controller=mechanic&action=discardPending&pending_id=<?= $pending['id'] ?>&case_id=<?= $caso['id'] ?>&veh_id=<?= $veh_id ?>"
                                    class="btn btn-outline-danger btn-sm"

                                    onclick="return confirm('¿Descartar este pendiente?');">

                                    ❌ Descartar

                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif; ?>

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
                    <a
                        href="index.php?controller=inventory&action=selectForCase&case_id=<?= $caso['id'] ?>&veh_id=<?= $veh_id ?>"
                        class="btn btn-primary">

                        <i class="bi bi-box-seam"></i>

                        Agregar repuesto

                    </a>

                    <button
                        type="button"
                        class="btn btn-outline-primary ms-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalCompraDirecta">

                        🛒 Registrar compra directa

                    </button>

                    <form method="post">
                        <div class="mb-3">
                            <textarea name="nuevo_avance" rows="4" class="form-control" placeholder="Describa el avance..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo de avance</label>

                            <select name="tipo" class="form-control" required>
                                <option value="">Seleccione...</option>

                                <option value="Mano de obra">
                                    Mano de obra
                                </option>

                                <option value="Pendiente">
                                    Pendiente
                                </option>
                            </select>
                        </div>

                        <div class="mb-3" id="valorContainer">

                            <label class="form-label">Valor</label>

                            <input
                                type="number"
                                class="form-control"
                                id="valor"
                                name="valor"
                                min="0"
                                step="0.01">

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
                                        $<?= number_format($totales['mano_obra'], 0, ',', '.') ?>
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
                                        $<?= number_format($totales['repuestos'], 0, ',', '.') ?>
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
                                        $<?= number_format($totales['total'], 0, ',', '.') ?>
                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



                <?php endif; ?>

        <div class="row mt-4">

            <div class="col-12">

                <div class="card border-info shadow-sm">

                    <div class="card-header bg-info text-white">
                        <strong>📊 Resumen financiero del caso</strong>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <p class="mb-2">
                                    Mano de obra:
                                    <strong>
                                        $<?= number_format($financial['mano_obra'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-2">
                                    Venta repuestos inventario:
                                    <strong>
                                        $<?= number_format($financial['repuestos_venta'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-2">
                                    Costo repuestos inventario:
                                    <strong>
                                        $<?= number_format($financial['repuestos_costo'], 0, ',', '.') ?>
                                    </strong>
                                </p>
                            </div>

                            <div class="col-md-4">
                                <p class="mb-2">
                                    Venta compras directas:
                                    <strong>
                                        $<?= number_format($financial['compras_directas_venta'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-2">
                                    Costo compras directas:
                                    <strong>
                                        $<?= number_format($financial['compras_directas_costo'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-2">
                                    Utilidad repuestos:
                                    <strong>
                                        $<?= number_format($financial['utilidad_repuestos'], 0, ',', '.') ?>
                                    </strong>
                                </p>
                            </div>

                            <div class="col-md-4">

                                <p class="mb-2">
                                    Venta total de repuestos:
                                    <strong>
                                        $<?= number_format($financial['total_repuestos_venta'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-2">
                                    Costo total de repuestos:
                                    <strong>
                                        $<?= number_format($financial['total_repuestos_costo'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                                <p class="mb-0 fs-5">
                                    Venta teórica total:
                                    <strong>
                                        $<?= number_format($financial['total_venta_teorica'], 0, ',', '.') ?>
                                    </strong>
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

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

        <?php if (!empty($casePurchases)): ?>

            <div class="card shadow-sm mt-4">

                <div class="card-header bg-primary text-white">
                    <strong>🛒 Compras directas del caso</strong>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover table-sm mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Descripción</th>
                                    <th>Proveedor</th>
                                    <th class="text-end">Cantidad</th>
                                    <th class="text-end">Costo unitario</th>
                                    <th class="text-end">Precio unitario</th>
                                    <th class="text-end">Subtotal</th>
                                    <th>Registrado por</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($casePurchases as $purchase): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($purchase['descripcion']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($purchase['proveedor'] ?? '') ?>
                                        </td>

                                        <td class="text-end">
                                            <?= number_format(
                                                (float)$purchase['cantidad'],
                                                2,
                                                ',',
                                                '.'
                                            ) ?>
                                        </td>

                                        <td class="text-end">
                                            $<?= number_format(
                                                    (float)$purchase['costo_unitario'],
                                                    0,
                                                    ',',
                                                    '.'
                                                ) ?>
                                        </td>

                                        <td class="text-end">
                                            $<?= number_format(
                                                    (float)$purchase['precio_unitario'],
                                                    0,
                                                    ',',
                                                    '.'
                                                ) ?>
                                        </td>

                                        <td class="text-end fw-bold">
                                            $<?= number_format(
                                                    (float)$purchase['subtotal'],
                                                    0,
                                                    ',',
                                                    '.'
                                                ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $purchase['usuario_nombre'] ?? ''
                                            ) ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

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

                                <select name="tipo" class="form-control" required>

                                    <option value="">Seleccione...</option>

                                    <option value="Mano de obra">
                                        Mano de obra
                                    </option>

                                    <option value="Pendiente">
                                        Pendiente
                                    </option>

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
        Mano de obra:
        <strong>
            $<?= number_format($financial['mano_obra'], 0, ',', '.') ?>
        </strong>
    </p>

    <p>
        Venta de repuestos:
        <strong>
            $<?= number_format($financial['total_repuestos_venta'], 0, ',', '.') ?>
        </strong>
    </p>

    <p>
        Costo real de repuestos:
        <strong>
            $<?= number_format($financial['total_repuestos_costo'], 0, ',', '.') ?>
        </strong>
    </p>

    <p class="fs-5">
        Venta teórica total:
        <strong>
            $<?= number_format($financial['total_venta_teorica'], 0, ',', '.') ?>
        </strong>
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
        value="<?= (int)$financial['total_venta_teorica'] ?>"
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
            $<?= number_format($financial['total_venta_teorica'], 0, ',', '.') ?>
        </strong>
    </p>

    <p class="mb-0">
        Utilidad:
        <strong id="utilidad">
            $<?= number_format(
                $financial['total_venta_teorica']
                - $financial['total_repuestos_costo'],
                0,
                ',',
                '.'
            ) ?>
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

<!-- Modal convertir pendiente a mano de obra -->
<div
    class="modal fade"
    id="resolvePendingModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="post"
                action="index.php?controller=mechanic&action=resolvePending">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Resolver pendiente

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
                        name="pending_id"
                        id="pending_id">

                    <input
                        type="hidden"
                        name="case_id"
                        id="case_id">

                    <input
                        type="hidden"
                        name="veh_id"
                        id="veh_id">

                    <div class="mb-3">

                        <label class="form-label">

                            Descripción

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="descripcion"
                            id="descripcion"
                            required></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Valor mano de obra

                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="valor"
                            value="0"
                            min="0"
                            required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        type="button">

                        Cancelar

                    </button>

                    <button
                        class="btn btn-success"
                        type="submit">

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Modal registrar compra directa -->
<div
    class="modal fade"
    id="modalCompraDirecta"
    tabindex="-1"
    aria-labelledby="modalCompraDirectaLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="post"
                action="index.php?controller=case&action=registrarCompraDirecta">

                <div class="modal-header bg-primary text-white">

                    <h5
                        class="modal-title"
                        id="modalCompraDirectaLabel">

                        🛒 Registrar compra directa

                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="caso_id"
                        value="<?= $caso['id'] ?>">

                    <div class="alert alert-info">

                        Este artículo se comprará específicamente
                        para este caso y no se agregará al inventario general.

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Descripción
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="descripcion"
                            placeholder=""
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Proveedor
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="proveedor"
                            placeholder="">

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Cantidad
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="cantidad"
                                min="0.01"
                                step="0.01"
                                value="1"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Costo unitario
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="costo_unitario"
                                min="0"
                                step="1"
                                placeholder="$">

                            <small class="text-muted">
                                Lo que pagó el taller
                            </small>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Precio unitario
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="precio_unitario"
                                min="0"
                                step="1"
                                placeholder="$"
                                required>

                            <small class="text-muted">
                                Lo que se cobra al cliente
                            </small>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Observación
                        </label>

                        <textarea
                            class="form-control"
                            name="observacion"
                            rows="3"
                            placeholder="Información adicional sobre la compra..."></textarea>

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

                        🛒 Registrar compra

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.querySelectorAll('.btn-resolve-pending').forEach(function(button) {

        button.addEventListener('click', function() {

            document.getElementById('pending_id').value =
                this.dataset.pendingId;

            document.getElementById('case_id').value =
                this.dataset.caseId;

            document.getElementById('veh_id').value =
                this.dataset.vehId;

            document.getElementById('descripcion').value =
                this.dataset.description;

        });

    });
</script>

<script>
    const costoTotal = <?= (int)$totales['total'] ?>;

    const precio = document.getElementById('precio_cobrado');
    const descuento = document.getElementById('descuento');

    const lblTotal = document.getElementById('totalCobrado');
    const lblUtilidad = document.getElementById('utilidad');

    function actualizarResumen() {

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
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.editar-avance').forEach(function(btn) {

            btn.addEventListener('click', function() {

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

<script>
    const tipo = document.querySelector('select[name="tipo"]');

    const valorContainer = document.getElementById('valorContainer');

    const valor = document.getElementById('valor');

    function actualizarFormulario() {

        if (!tipo) return;

        if (tipo.value === 'Pendiente') {

            valorContainer.style.display = 'none';

            valor.required = false;

            valor.value = '';

        } else {

            valorContainer.style.display = '';

            valor.required = true;

        }

    }

    tipo.addEventListener('change', actualizarFormulario);

    actualizarFormulario();
</script>
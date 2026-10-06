<?php
// app/views/mechanic/case_view.php
?>

<!-- Bootstrap -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet">

<!-- Estilos específicos de la ficha -->
<link
    href="css/case_view.css"
    rel="stylesheet">


<div class="container mt-4 case-view">

    <!-- CABECERA SUPERIOR -->
    <div class="case-topbar">

        <!-- IZQUIERDA: PDF -->
        <div class="case-topbar-left">

            <a
                href="index.php?controller=case&action=imprimir&case_id=<?= $caso['id'] ?>"
                target="_blank"
                class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf"></i>
                Imprimir PDF

            </a>

        </div>


        <!-- DERECHA: USUARIO + TIEMPO -->
        <div class="case-topbar-right">




            <?php if (!empty($tiempoCaso)): ?>

                <div
                    class="case-duration"
                    data-case-duration
                    data-seconds="<?= (int)$tiempoCaso['segundos'] ?>"
                    data-active="<?= $tiempoCaso['activo'] ? '1' : '0' ?>">

                    <div class="case-duration-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <div class="case-duration-content">

                        <span class="case-duration-label">
                            Tiempo en taller
                        </span>

                        <strong
                            class="case-duration-value"
                            data-case-duration-value>
                            Calculando...
                        </strong>

                    </div>

                    <span
                        class="case-duration-status"
                        data-case-duration-status>
                    </span>

                </div>

            <?php endif; ?>

        </div>

    </div>


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

        <div class="card mb-4 case-vehicle-header">
            <div class="card-body p-4">

                <div class="case-vehicle-top">

                    <div>
                        <h3 class="mb-1 case-vehicle-title">

                            <?php if (!empty($vehicle['display_name'])): ?>

                                🏍️ <?= htmlspecialchars($vehicle['display_name']) ?>

                            <?php else: ?>

                                🏍️ <?= htmlspecialchars($vehicle['marca']) ?>
                                <?= htmlspecialchars($vehicle['modelo']) ?>

                            <?php endif; ?>

                        </h3>

                        <?php if (!empty($vehicle['tipo_moto'])): ?>

                            <div class="case-vehicle-subtitle mb-2">

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

                        <p class="mb-1 case-vehicle-info-item">
                            <strong>Propietario:</strong>
                            <?= htmlspecialchars($vehicle['propietario']) ?>
                        </p>
                        <p class="case-vehicle-info-item">
                            <strong>Teléfono:</strong>
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

                        <p class="mb-0 case-vehicle-info-item">
                            <strong>Color:</strong>
                            <?= htmlspecialchars($vehicle['color']) ?>
                        </p>

                        <div class="case-vehicle-edit">
                            <button
                                type="button"
                                class="btn btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarVehiculo">

                                ✏️ Editar datos del vehículo

                            </button>
                        </div>

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

                                        <button
                                            class="btn btn-secondary mt-3 w-100"
                                            disabled
                                            title="Ya existe un caso abierto para este vehículo">

                                            🆕 Nuevo caso (no disponible)

                                        </button>

                                    <?php else: ?>

                                        <!-- Botón abre el modal -->
                                        <button
                                            type="button"
                                            class="btn btn-success mt-3 w-100"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNuevoCaso">

                                            🆕 Crear nuevo caso

                                        </button>



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


    <!-- =========================================================
     HISTORIAL DEL VEHÍCULO
     ========================================================= -->

    <details class="case-collapsible case-collapsible-history">
        <summary>
            <span class="case-collapsible-title">
                <span class="case-collapsible-icon">📚</span>
                <span>Historial del vehículo</span>
            </span>
            <span class="case-collapsible-meta">
                <?= count($cases) ?> <?= count($cases) === 1 ? 'caso' : 'casos' ?>
            </span>
        </summary>

        <div class="case-collapsible-body">
            <?php if (!empty($cases)): ?>
                <div class="case-history">
                    <?php foreach ($cases as $c): ?>
                        <?php
                        $isCurrent = ((int)$c['id'] === (int)$caso['id']);
                        $isOpen = ($c['estado'] === 'abierto');
                        ?>
                        <div class="case-history-item">
                            <div class="card shadow-sm case-history-card <?= $isCurrent ? 'case-history-current' : '' ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <div class="case-history-number">Caso #<?= (int)$c['id'] ?></div>
                                            <div class="case-history-date"><?= htmlspecialchars($c['fecha_ingreso'], ENT_QUOTES, 'UTF-8') ?></div>
                                        </div>
                                        <div>
                                            <?php if ($isOpen): ?>
                                                <span class="case-status case-status-open">🟢 Abierto</span>
                                            <?php else: ?>
                                                <span class="case-status case-status-closed">⚫ Cerrado</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="case-history-cause">
                                        <?= htmlspecialchars($c['causa'] ?: 'Sin descripción', ENT_QUOTES, 'UTF-8') ?>
                                    </div>
                                    <div class="case-actions mt-3">
                                        <a class="btn btn-sm btn-outline-primary" href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>&case_id=<?= $c['id'] ?>">
                                            👁 Ver caso
                                        </a>
                                        <?php if ($c['estado'] === 'cerrado'): ?>
                                            <a class="btn btn-sm btn-outline-secondary" target="_blank" href="index.php?controller=case&action=imprimir&case_id=<?= $c['id'] ?>">
                                                📄 PDF
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">El vehículo no tiene casos registrados.</div>
            <?php endif; ?>
        </div>
    </details>

    <div class="case-section-title">
        <span class="section-icon">🔧</span>
        Ficha del caso
    </div>

    <?php if ($caso): ?>
        <div class="card shadow-sm mb-4 border-0">

            <div class="card-body">

                <div class="case-data-grid">

                    <div class="case-data-item">
                        <span class="case-data-label">
                            Causa del ingreso
                        </span>

                        <div class="case-data-value">
                            <?= htmlspecialchars(
                                $caso['causa'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </div>
                    </div>


                    <div class="case-data-item">
                        <span class="case-data-label">
                            Estado
                        </span>

                        <div class="case-data-value">
                            <?php if ($caso['estado'] === 'abierto'): ?>

                                <span class="case-status case-status-open">
                                    🟢 Caso abierto
                                </span>

                            <?php else: ?>

                                <span class="case-status case-status-closed">
                                    ⚫ Caso cerrado
                                </span>

                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="case-data-item">
                        <span class="case-data-label">
                            Observaciones
                        </span>

                        <div class="case-data-value">
                            <?= nl2br(htmlspecialchars(
                                $caso['observaciones'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            )) ?>
                        </div>
                    </div>


                    <div class="case-data-item">
                        <span class="case-data-label">
                            Diagnóstico
                        </span>

                        <div class="case-data-value">
                            <?= nl2br(htmlspecialchars(
                                $caso['diagnostico'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            )) ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <?php if (!empty($pendingItems)): ?>

            <div class="case-pending-panel">

                <div class="case-pending-header">

                    <div>
                        <div class="case-pending-title">
                            📌 Pendientes del vehículo
                        </div>

                        <div class="case-pending-subtitle">
                            Trabajos o elementos pendientes de resolver
                        </div>
                    </div>

                    <span class="case-pending-count">
                        <?= count($pendingItems) ?>
                    </span>

                </div>

                <div class="case-pending-body">

                    <?php foreach ($pendingItems as $pending): ?>

                        <div class="case-pending-item">

                            <div class="case-pending-description">

                                <?= nl2br(
                                    htmlspecialchars(
                                        $pending['descripcion'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    )
                                ) ?>

                            </div>

                            <small class="text-muted">

                                Creado en caso #<?= $pending['caso_origen'] ?>

                                ·

                                <?= htmlspecialchars($pending['usuario']) ?>

                            </small>

                            <div class="case-pending-actions">
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

        <?php if (!empty($compatibleParts)): ?>

            <details class="case-collapsible case-collapsible-compatible">
                <summary>
                    <span class="case-collapsible-title">
                        <span class="case-collapsible-icon">🔩</span>
                        <span>Repuestos compatibles</span>
                    </span>
                    <span class="case-collapsible-meta">
                        <?= count($compatibleParts) ?> encontrados
                    </span>
                </summary>

                <div class="case-collapsible-body">
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
                            <div class="list-group-item case-compatible-item">
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div>
                                        <strong><?= htmlspecialchars($part['nombre']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($part['codigo']) ?></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-<?= $badge ?>"><?= $texto ?></span><br>
                                        <small>Stock: <?= $stock ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </details>

        <?php endif; ?>

        <?php if ($caso['estado'] === 'abierto'): ?>
            <div class="case-work-panel">
                <?php if (empty($activeSession)): ?>
                    <div class="case-work-header">

                        <div>
                            <div class="case-work-title">
                                🔧 Sesión de trabajo
                            </div>

                            <div class="case-work-subtitle">
                                Inicie una sesión para registrar trabajos realizados en este caso.
                            </div>
                        </div>

                        <span class="case-work-status case-work-status-inactive">
                            ● Sin sesión activa
                        </span>

                    </div>

                    <form
                        method="post"
                        action="index.php?controller=mechanic&action=startSession">

                        <input
                            type="hidden"
                            name="case_id"
                            value="<?= $caso['id'] ?>">

                        <button
                            type="submit"
                            class="btn btn-primary case-work-start">

                            ▶ Iniciar sesión de trabajo

                        </button>

                    </form>
                <?php else: ?>
                    <div class="case-work-header">

                        <div>
                            <div class="case-work-title">
                                🔧 Sesión de trabajo
                            </div>

                            <div class="case-work-subtitle">
                                Registre aquí los trabajos y elementos utilizados.
                            </div>
                        </div>

                        <span class="case-work-status case-work-status-active">
                            ● Sesión activa
                        </span>

                    </div>

                    <div class="case-work-actions-title">
                        Acciones del caso
                    </div>
                    <div class="case-work-actions">

                        <a
                            href="index.php?controller=inventory&action=selectForCase&case_id=<?= $caso['id'] ?>&veh_id=<?= $veh_id ?>"
                            class="btn btn-primary">

                            <i class="bi bi-box-seam"></i>
                            Agregar repuesto

                        </a>

                        <button
                            type="button"
                            class="btn btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalCompraDirecta">

                            🛒 Registrar compra directa

                        </button>

                    </div>
                    <div class="case-work-form-title">
                        Registrar avance
                    </div>
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

                    <div class="case-work-end">

                        <form
                            method="post"
                            action="index.php?controller=mechanic&action=endSession">

                            <input
                                type="hidden"
                                name="session_id"
                                value="<?= $activeSession['id'] ?>">

                            <button
                                type="submit"
                                class="btn btn-outline-danger">

                                ■ Terminar sesión de trabajo

                            </button>

                        </form>

                    </div>
                <?php endif; ?>
            </div>
            <!-- =========================================================
     RESUMEN COMERCIAL DEL CASO
     ========================================================= -->

            <div class="case-section-title">
                <span class="section-icon">💰</span>
                Resumen del servicio
            </div>

            <div class="case-financial-summary">

                <!-- Mano de obra -->
                <div class="case-financial-card">
                    <div class="case-financial-label">
                        👨‍🔧 Mano de obra
                    </div>

                    <div class="case-financial-value">
                        $<?= number_format(
                                (float)$financial['mano_obra'],
                                0,
                                ',',
                                '.'
                            ) ?>
                    </div>
                </div>


                <!-- Repuestos -->
                <div class="case-financial-card">
                    <div class="case-financial-label">
                        🔩 Repuestos
                    </div>

                    <div class="case-financial-value">
                        $<?= number_format(
                                (float)$financial['total_repuestos_venta'],
                                0,
                                ',',
                                '.'
                            ) ?>
                    </div>
                </div>


                <!-- Total -->
                <div class="case-financial-card case-financial-total">
                    <div class="case-financial-label">
                        Total del servicio
                    </div>

                    <div class="case-financial-value">
                        $<?= number_format(
                                (float)$financial['total_venta_teorica'],
                                0,
                                ',',
                                '.'
                            ) ?>
                    </div>
                </div>

            </div>
            <!-- Botón para cerrar caso -->
            <button
                type="button"
                class="btn btn-warning w-100 mt-3 py-2 fw-semibold"
                data-bs-toggle="modal"
                data-bs-target="#modalCerrarCaso">

                🏁 Cerrar caso

            </button>


        <?php else: ?>

            <div class="alert alert-success">
                <h5 class="mb-0">✅ Caso cerrado</h5>
            </div>

            <!-- Botón para reabrir caso -->
            <button
                type="button"
                class="btn btn-outline-danger w-100 mb-4 py-2 fw-semibold"
                data-bs-toggle="modal"
                data-bs-target="#modalReabrirCaso">

                🔓 Reabrir caso

            </button>

            <div class="card border-success shadow-sm mb-4">

                <div class="card-header bg-success text-white">
                    <strong>📊 Resumen del casos</strong>
                </div>

                <div class="card-body">

                    <div class="row mb-4">

                        <div class="col-md-6 mx-auto">

                            <div class="card border-success shadow-sm h-100">

                                <div class="card-body text-center">

                                    <h6 class="text-muted mb-2">
                                        💰 Total cobrado
                                    </h6>

                                    <h2 class="text-success mb-0">
                                        $<?= number_format(
                                                (float)$caso['precio_cobrado'] -
                                                    (float)($caso['descuento'] ?? 0),
                                                0,
                                                ',',
                                                '.'
                                            ) ?>
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

            <details class="case-collapsible case-collapsible-purchases">
                <summary>
                    <span class="case-collapsible-title">
                        <span class="case-collapsible-icon">🛒</span>
                        <span>Compras directas</span>
                    </span>
                    <span class="case-collapsible-meta">
                        <?= count($casePurchases) ?> <?= count($casePurchases) === 1 ? 'registro' : 'registros' ?>
                    </span>
                </summary>
                <div class="case-collapsible-body p-0">
                    <div class="card shadow-sm">

                        <div class="card-header bg-primary text-white">
                            <strong>🛒 Compras directas</strong>
                        </div>

                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover table-sm mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Descripción</th>
                                            <th class="text-end">Cantidad</th>
                                            <th class="text-end">Precio unitario</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($casePurchases as $purchase): ?>

                                            <tr>

                                                <td>
                                                    <?= htmlspecialchars($purchase['descripcion']) ?>
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

                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
            </details>

        <?php endif; ?>

        <details class="case-collapsible case-collapsible-advances">
            <summary>
                <span class="case-collapsible-title">
                    <span class="case-collapsible-icon">📋</span>
                    <span>Historial de avances</span>
                </span>
                <span class="case-collapsible-meta">Consultar registros</span>
            </summary>
            <div class="case-collapsible-body">
                <?php require __DIR__ . '/partials/_advance_history.php'; ?>
            </div>
        </details>




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

<!-- Modal Reabrir Caso -->
<div
    class="modal fade"
    id="modalReabrirCaso"
    tabindex="-1"
    aria-labelledby="modalReabrirCasoLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="post"
                action="index.php?controller=case&action=reabrir">

                <div class="modal-header bg-danger text-white">

                    <h5
                        class="modal-title"
                        id="modalReabrirCasoLabel">

                        🔓 Reabrir caso

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

                    <div class="alert alert-warning">

                        <strong>⚠️ Atención</strong>

                        <p class="mb-0 mt-2">
                            El cierre actual quedará registrado como histórico
                            y el caso volverá a estado abierto para continuar
                            trabajando en él.
                        </p>

                    </div>

                    <div class="mb-3">

                        <label
                            for="motivoReapertura"
                            class="form-label">

                            Motivo de la reapertura

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="motivoReapertura"
                            name="motivo"
                            maxlength="100"
                            placeholder="Ej.: Trabajo adicional solicitado por el cliente"
                            required>

                    </div>

                    <div class="mb-3">

                        <label
                            for="comentarioReapertura"
                            class="form-label">

                            Comentario
                            <span class="text-muted">(opcional)</span>

                        </label>

                        <textarea
                            class="form-control"
                            id="comentarioReapertura"
                            name="comentario"
                            rows="4"
                            placeholder="Describa brevemente qué debe hacerse después de la reapertura..."></textarea>

                    </div>

                    <p class="text-danger mb-0">
                        ¿Está seguro de reabrir este caso?
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
                        class="btn btn-danger">

                        🔓 Reabrir caso

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

<!-- Modal para Editar datos del vehículo -->
<div
    class="modal fade"
    id="modalEditarVehiculo"
    tabindex="-1"
    aria-labelledby="modalEditarVehiculoLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                method="post"
                action="index.php?controller=mechanic&action=updateVehicle">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="modalEditarVehiculoLabel">

                        ✏️ Editar datos del vehículo

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="veh_id"
                        value="<?= (int)$vehicle['id'] ?>">

                    <input
                        type="hidden"
                        name="case_id"
                        value="<?= (int)($caso['id'] ?? 0) ?>">

                    <div class="mb-3">

                        <label
                            for="editarPlaca"
                            class="form-label">

                            Placa

                        </label>

                        <input
                            type="text"
                            class="form-control text-uppercase"
                            id="editarPlaca"
                            name="placa"
                            value="<?= htmlspecialchars($vehicle['placa']) ?>"
                            maxlength="10"
                            required>

                    </div>

                    <div class="mb-3">

                        <label
                            for="editarPropietario"
                            class="form-label">

                            Propietario

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarPropietario"
                            name="propietario"
                            value="<?= htmlspecialchars($vehicle['propietario']) ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label
                            for="editarTelefono"
                            class="form-label">

                            Teléfono

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarTelefono"
                            name="telefono"
                            value="<?= htmlspecialchars($vehicle['telefono'] ?? '') ?>"
                            maxlength="20">

                    </div>

                    <div class="mb-3">

                        <label
                            for="editarColor"
                            class="form-label">

                            Color

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarColor"
                            name="color"
                            value="<?= htmlspecialchars($vehicle['color'] ?? '') ?>"
                            maxlength="50">

                    </div>

                    <div class="alert alert-info mb-0">

                        <small>
                            Estos cambios actualizarán los datos actuales del
                            vehículo sin modificar el historial de sus casos.
                        </small>

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

                        💾 Guardar cambios

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
    const costoRepuestos = <?= (float)$financial['total_repuestos_costo'] ?>;

    const precio = document.getElementById('precio_cobrado');
    const descuento = document.getElementById('descuento');

    const lblTotal = document.getElementById('totalCobrado');
    const lblUtilidad = document.getElementById('utilidad');

    function actualizarResumen() {

        const p = parseFloat(precio.value) || 0;
        const d = parseFloat(descuento.value) || 0;

        const total = Math.max(0, p - d);

        const utilidad = total - costoRepuestos;

        lblTotal.textContent =
            '$' + total.toLocaleString('es-CO');

        lblUtilidad.textContent =
            '$' + utilidad.toLocaleString('es-CO');
    }

    precio.addEventListener('input', actualizarResumen);
    descuento.addEventListener('input', actualizarResumen);

    actualizarResumen();
</script>

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

<?php if (
    !empty($caso) &&
    $caso['estado'] === 'cerrado' &&
    empty($hasOpenCase)
): ?>

    <div
        class="modal fade"
        id="modalNuevoCaso"
        tabindex="-1"
        aria-labelledby="modalNuevoCasoLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <div>
                        <h5
                            class="modal-title"
                            id="modalNuevoCasoLabel">

                            🆕 Crear nuevo caso

                        </h5>

                        <small class="text-muted">
                            <?= htmlspecialchars($vehicle['marca'] ?? '') ?>
                            <?= htmlspecialchars($vehicle['modelo'] ?? '') ?>
                            ·
                            <?= htmlspecialchars($vehicle['placa'] ?? '') ?>
                        </small>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                    </button>

                </div>


                <form
                    method="POST"
                    action="index.php?controller=case&action=nuevoDesdeExistente">

                    <div class="modal-body">

                        <input
                            type="hidden"
                            name="vehiculo_id"
                            value="<?= htmlspecialchars($caso['vehiculo_id']) ?>">

                        <input
                            type="hidden"
                            name="referencia_anterior"
                            value="<?= htmlspecialchars($caso['id']) ?>">


                        <!-- TIPO DE INGRESO -->

                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Tipo de nuevo ingreso
                            </label>

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="border rounded p-3 d-block h-100">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="tipo_ingreso"
                                                id="ingresoRelacionado"
                                                value="relacionado"
                                                checked>

                                            <label
                                                class="form-check-label fw-semibold"
                                                for="ingresoRelacionado">

                                                🔄 Continuación del caso anterior

                                            </label>

                                        </div>

                                        <small class="text-muted d-block mt-2 ms-4">

                                            El vehículo regresa por la misma falla
                                            o por un problema relacionado.

                                        </small>

                                    </label>

                                </div>


                                <div class="col-md-6">

                                    <label class="border rounded p-3 d-block h-100">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="tipo_ingreso"
                                                id="ingresoNuevo"
                                                value="nuevo">

                                            <label
                                                class="form-check-label fw-semibold"
                                                for="ingresoNuevo">

                                                🆕 Falla o servicio diferente

                                            </label>

                                        </div>

                                        <small class="text-muted d-block mt-2 ms-4">

                                            Se inicia un trabajo diferente al
                                            realizado anteriormente.

                                        </small>

                                    </label>

                                </div>

                            </div>

                        </div>


                        <!-- MOTIVO -->

                        <div class="mb-4">

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

                        </div>


                        <!-- OBSERVACIONES -->

                        <div class="mb-2">

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
                            class="btn btn-success">

                            <i class="bi bi-plus-circle"></i>

                            Crear nuevo caso

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

<?php endif; ?>
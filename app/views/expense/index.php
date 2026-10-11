<?php

$categorias = [
    'alimentacion' => 'Alimentación',
    'operativo' => 'Operativo',
    'herramientas' => 'Herramientas',
    'transporte' => 'Transporte',
    'imprevisto' => 'Imprevisto',
    'otro' => 'Otro',
];

$estados = [
    'pendiente' => 'Pendiente de aprobación',
    'aprobado' => 'Aprobado',
    'rechazado' => 'Rechazado',
];

$estadosPago = [
    'pendiente' => 'Pendiente de pago',
    'pagado' => 'Pagado',
    'reembolsado' => 'Reembolsado',
];

$formatCOP = static function ($valor): string {
    return '$ ' . number_format((float)$valor, 0, ',', '.');
};
?>

<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="mb-1">Gestión de gastos</h2>
            <p class="text-muted mb-0">
                Registro y seguimiento de los gastos del taller.
            </p>
        </div>

        <a href="index.php?controller=expense&action=create"
           class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Registrar gasto
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="index.php"
                  class="row g-3 align-items-end">

                <input type="hidden" name="controller" value="expense">
                <input type="hidden" name="action" value="index">

                <div class="col-md-5">
                    <label for="estado" class="form-label">
                        Estado de aprobación
                    </label>
                    <select name="estado" id="estado" class="form-select">
                        <option value="">Todos los estados</option>

                        <?php foreach ($estados as $valor => $etiqueta): ?>
                            <option
                                value="<?= htmlspecialchars($valor) ?>"
                                <?= ($estado ?? '') === $valor ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($etiqueta) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="categoria" class="form-label">
                        Categoría
                    </label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="">Todas las categorías</option>

                        <?php foreach ($categorias as $valor => $etiqueta): ?>
                            <option
                                value="<?= htmlspecialchars($valor) ?>"
                                <?= ($categoria ?? '') === $valor ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($etiqueta) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        Filtrar
                    </button>

                    <a href="index.php?controller=expense&action=index"
                       class="btn btn-outline-secondary">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php
    $totalGastos = 0;
    $totalPendientes = 0;
    $totalAprobados = 0;

    foreach ($gastos as $gasto) {
        $totalGastos += (float)$gasto['valor'];

        if ($gasto['estado'] === 'pendiente') {
            $totalPendientes += (float)$gasto['valor'];
        }

        if ($gasto['estado'] === 'aprobado') {
            $totalAprobados += (float)$gasto['valor'];
        }
    }
    ?>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total listado</div>
                    <h4 class="mb-0">
                        <?= $formatCOP($totalGastos) ?>
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Pendiente de aprobación</div>
                    <h4 class="mb-0">
                        <?= $formatCOP($totalPendientes) ?>
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Aprobado</div>
                    <h4 class="mb-0">
                        <?= $formatCOP($totalAprobados) ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <?php if (empty($gastos)): ?>

                <div class="text-center py-5">
                    <h5>No hay gastos para mostrar</h5>
                    <p class="text-muted mb-0">
                        Registra un gasto nuevo o cambia los filtros.
                    </p>
                </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Valor</th>
                                <th>Registrado por</th>
                                <th>Aprobación</th>
                                <th>Pago</th>
                                <?php if ($esAdmin): ?>
                                    <th>Acciones</th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($gastos as $gasto): ?>
                                <?php
                                $estadoActual = $gasto['estado'] ?? 'pendiente';

                                $claseEstado = match ($estadoActual) {
                                    'aprobado' => 'success',
                                    'rechazado' => 'danger',
                                    default => 'warning',
                                };

                                $pagoActual = $gasto['estado_pago'] ?? 'pendiente';
                                ?>

                                <tr>
                                    <td>
                                        <?= htmlspecialchars(
                                            date(
                                                'd/m/Y H:i',
                                                strtotime($gasto['fecha_gasto'])
                                            )
                                        ) ?>
                                    </td>

                                    <td>
                                        <strong>
                                            <?= htmlspecialchars($gasto['descripcion']) ?>
                                        </strong>

                                        <?php if (!empty($gasto['proveedor'])): ?>
                                            <div class="small text-muted">
                                                <?= htmlspecialchars($gasto['proveedor']) ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($gasto['observacion'])): ?>
                                            <div class="small text-muted">
                                                <?= htmlspecialchars($gasto['observacion']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $categorias[$gasto['categoria']]
                                                ?? $gasto['categoria']
                                        ) ?>
                                    </td>

                                    <td class="text-nowrap">
                                        <?= $formatCOP($gasto['valor']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $gasto['registrado_por_nombre']
                                                ?? 'Usuario'
                                        ) ?>
                                    </td>

                                    <td>
                                        <span class="badge text-bg-<?= $claseEstado ?>">
                                            <?= htmlspecialchars(
                                                $estados[$estadoActual]
                                                    ?? $estadoActual
                                            ) ?>
                                        </span>

                                        <?php if (!empty($gasto['autorizado_por_nombre'])): ?>
                                            <div class="small text-muted mt-1">
                                                <?= htmlspecialchars(
                                                    $gasto['autorizado_por_nombre']
                                                ) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $estadosPago[$pagoActual] ?? $pagoActual
                                        ) ?>

                                        <div class="small text-muted">
                                            <?= htmlspecialchars(
                                                $gasto['forma_pago'] === 'dinero_personal'
                                                    ? 'Dinero personal'
                                                    : ($gasto['forma_pago'] === 'caja'
                                                        ? 'Caja'
                                                        : ucfirst(
                                                            str_replace(
                                                                '_',
                                                                ' ',
                                                                $gasto['forma_pago']
                                                            )
                                                        ))
                                            ) ?>
                                        </div>
                                    </td>

                                    <?php if ($esAdmin): ?>
                                        <td>
                                            <div class="d-flex flex-column gap-2">

                                                <?php if ($estadoActual === 'pendiente'): ?>

                                                    <form method="POST"
                                                          action="index.php?controller=expense&action=decide"
                                                          class="d-flex flex-wrap gap-1">

                                                        <input type="hidden"
                                                               name="id"
                                                               value="<?= (int)$gasto['id'] ?>">

                                                        <button type="submit"
                                                                name="decision"
                                                                value="aprobado"
                                                                class="btn btn-sm btn-success">
                                                            Aprobar
                                                        </button>

                                                        <button type="submit"
                                                                name="decision"
                                                                value="rechazado"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('¿Rechazar este gasto?')">
                                                            Rechazar
                                                        </button>
                                                    </form>

                                                <?php elseif (
                                                    $estadoActual === 'aprobado'
                                                    && $pagoActual === 'pendiente'
                                                    && $gasto['forma_pago'] === 'dinero_personal'
                                                ): ?>

                                                    <form method="POST"
                                                          action="index.php?controller=expense&action=markReimbursed"
                                                          onsubmit="return confirm('Confirma que el reembolso ya se realizó.')">

                                                        <input type="hidden"
                                                               name="id"
                                                               value="<?= (int)$gasto['id'] ?>">

                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary">
                                                            Registrar reembolso
                                                        </button>
                                                    </form>

                                                <?php elseif (
                                                    $estadoActual === 'aprobado'
                                                    && $pagoActual === 'pendiente'
                                                ): ?>

                                                    <form method="POST"
                                                          action="index.php?controller=expense&action=markPaid"
                                                          onsubmit="return confirm('Confirma que el gasto ya fue pagado.')">

                                                        <input type="hidden"
                                                               name="id"
                                                               value="<?= (int)$gasto['id'] ?>">

                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary">
                                                            Registrar pago
                                                        </button>
                                                    </form>

                                                <?php else: ?>

                                                    <span class="text-muted small">
                                                        Sin acciones
                                                    </span>

                                                <?php endif; ?>

                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="small text-muted">
                    El total corresponde a los registros mostrados según los filtros.
                    No representa necesariamente dinero ya desembolsado.
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

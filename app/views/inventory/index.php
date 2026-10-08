<!-- Encabezado -->
<div class="inventory-header">
    <div>
        <div class="inventory-title">
            <div class="inventory-title-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>
                <h1>Inventario</h1>
                <p>Gestiona tus repuestos, herramientas y existencias.</p>
            </div>
        </div>
    </div>

    <div class="inventory-header-actions">
        <a
            href="index.php?controller=inventory&action=kardex"
            class="btn btn-outline-dark">

            <i class="bi bi-clock-history"></i>
            Kardex
        </a>

        <a
            href="index.php?controller=inventory&action=create"
            class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Nuevo artículo
        </a>
    </div>
</div>


<!-- Buscador -->
<div class="inventory-search-card">

    <form method="GET">

        <input
            type="hidden"
            name="controller"
            value="inventory">

        <input
            type="hidden"
            name="action"
            value="index">

            <div class="mb-3">

    <label for="tipo" class="form-label fw-semibold">
        Tipo de inventario
    </label>

    <select
        name="tipo"
        id="tipo"
        class="form-select"
        onchange="this.form.submit()">

        <option
            value="repuesto"
            <?= ($tipo ?? 'repuesto') === 'repuesto' ? 'selected' : '' ?>>
            🔧 Repuestos
        </option>

        <option
            value="insumo"
            <?= ($tipo ?? '') === 'insumo' ? 'selected' : '' ?>>
            🧴 Insumos
        </option>

        <option
            value="herramienta"
            <?= ($tipo ?? '') === 'herramienta' ? 'selected' : '' ?>>
            🛠️ Herramientas
        </option>

    </select>

</div>

        <div class="inventory-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="q"
                placeholder="Buscar por código, nombre o marca..."
                value="<?= htmlspecialchars($search ?? '') ?>">

            <?php if (!empty($search)): ?>

                <a
                    href="index.php?controller=inventory&action=index"
                    class="inventory-search-clear"
                    title="Limpiar búsqueda">

                    <i class="bi bi-x-circle"></i>

                </a>

            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
                Buscar
            </button>

        </div>

    </form>

    <?php if (!empty($search)): ?>

        <div class="inventory-search-result">

            <i class="bi bi-funnel"></i>

            Resultados para:
            <strong><?= htmlspecialchars($search) ?></strong>

        </div>

    <?php endif; ?>

</div>


<!-- Estadísticas -->
<div class="inventory-stats">

    <div class="inventory-stat-card">

        <div class="stat-icon stat-icon-blue">
            <i class="bi bi-boxes"></i>
        </div>

        <div>
            <span>Total artículos</span>
            <strong><?= $stats['total'] ?></strong>
        </div>

    </div>


    <div class="inventory-stat-card">

        <div class="stat-icon stat-icon-yellow">
            <i class="bi bi-exclamation-triangle"></i>
        </div>

        <div>
            <span>Stock bajo</span>
            <strong><?= $stats['stock_bajo'] ?></strong>
        </div>

    </div>


    <div class="inventory-stat-card">

        <div class="stat-icon stat-icon-red">
            <i class="bi bi-x-circle"></i>
        </div>

        <div>
            <span>Agotados</span>
            <strong><?= $stats['agotados'] ?></strong>
        </div>

    </div>

</div>


<!-- Tabla -->
<div class="inventory-table-card">

    <div class="inventory-table-header">

        <div>
            <h3>Artículos</h3>

            <span>
                <?= count($parts) ?>
                <?= count($parts) === 1 ? 'resultado' : 'resultados' ?>
            </span>
        </div>

    </div>


    <div class="table-responsive">

        <table class="table inventory-table">

            <thead>

                <tr>
                    <th>Código</th>
                    <th>Artículo</th>
                    <th>Marca</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>

            </thead>

            <tbody>

            <?php if (empty($parts)): ?>

                <tr>

                    <td colspan="6">

                        <div class="inventory-empty">

                            <div class="inventory-empty-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <h4>No encontramos artículos</h4>

                            <?php if (!empty($search)): ?>

                                <p>
                                    No hay resultados para
                                    <strong>
                                        "<?= htmlspecialchars($search) ?>"
                                    </strong>
                                </p>

                                <a
                                    href="index.php?controller=inventory&action=index"
                                    class="btn btn-outline-primary btn-sm">

                                    Ver todo el inventario

                                </a>

                            <?php else: ?>

                                <p>
                                    Todavía no hay artículos registrados.
                                </p>

                                <a
                                    href="index.php?controller=inventory&action=create"
                                    class="btn btn-primary btn-sm">

                                    <i class="bi bi-plus-lg"></i>
                                    Crear artículo

                                </a>

                            <?php endif; ?>

                        </div>

                    </td>

                </tr>

            <?php else: ?>

                <?php foreach ($parts as $part): ?>

                    <?php

                    $stock = (float)$part['stock_actual'];
                    $minimo = max(1, (float)$part['stock_minimo']);

                    if ($stock <= 0) {

                        $stockColor = 'danger';
                        $stockText = 'Agotado';
                        $porcentaje = 0;

                    } elseif ($stock <= $part['stock_minimo']) {

                        $stockColor = 'warning';
                        $stockText = 'Stock bajo';
                        $porcentaje = min(
                            100,
                            ($stock / $minimo) * 100
                        );

                    } else {

                        $stockColor = 'success';
                        $stockText = 'Disponible';
                        $porcentaje = 100;
                    }

                    ?>

                    <tr>

                        <!-- Código -->
                        <td>

                            <span class="inventory-code">
                                <?= htmlspecialchars($part['codigo']) ?>
                            </span>

                        </td>


                        <!-- Artículo -->
                        <td>

                            <div class="inventory-product">

                                <div class="inventory-product-icon">
                                    <i class="bi bi-box"></i>
                                </div>

                                <div>

                                    <strong>
                                        <?= htmlspecialchars($part['nombre']) ?>
                                    </strong>

                                    <small>
                                        <?= htmlspecialchars($part['tipo'] ?? '') ?>
                                    </small>

                                </div>

                            </div>

                        </td>


                        <!-- Marca -->
                        <td>

                            <?php if (!empty($part['marca'])): ?>

                                <span class="inventory-brand">
                                    <?= htmlspecialchars($part['marca']) ?>
                                </span>

                            <?php else: ?>

                                <span class="text-muted">
                                    —
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- Stock -->
                        <td>

                            <div class="inventory-stock">

                                <div class="inventory-stock-number">

                                    <strong>
                                        <?= rtrim(
                                            rtrim(number_format($stock, 2, '.', ''),
                                            '0'),
                                            '.'
                                        ) ?>
                                    </strong>

                                    <span>
                                        <?= htmlspecialchars($part['unidad'] ?? 'und.') ?>
                                    </span>

                                </div>

                                <div class="progress inventory-progress">

                                    <div
                                        class="progress-bar bg-<?= $stockColor ?>"
                                        role="progressbar"
                                        style="width: <?= $porcentaje ?>%">

                                    </div>

                                </div>

                            </div>

                        </td>


                        <!-- Estado -->
                        <td>

                            <?php if (!$part['activo']): ?>

                                <span class="inventory-status status-inactive">
                                    <span></span>
                                    Inactivo
                                </span>

                            <?php elseif ($stock <= 0): ?>

                                <span class="inventory-status status-danger">
                                    <span></span>
                                    Agotado
                                </span>

                            <?php elseif ($stock <= $part['stock_minimo']): ?>

                                <span class="inventory-status status-warning">
                                    <span></span>
                                    Stock bajo
                                </span>

                            <?php else: ?>

                                <span class="inventory-status status-success">
                                    <span></span>
                                    Disponible
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- Acciones -->
                        <td>

                            <div class="dropdown text-end">

                                <button
                                    class="btn inventory-action-btn"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">

                                    <i class="bi bi-three-dots"></i>
                                    <span>Acciones</span>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="index.php?controller=inventory&action=edit&id=<?= $part['id'] ?>">

                                            <i class="bi bi-pencil"></i>
                                            Editar

                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="index.php?controller=inventory&action=applications&id=<?= $part['id'] ?>">

                                            <i class="bi bi-motorcycle"></i>
                                            Aplicaciones

                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="index.php?controller=inventory&action=movements&id=<?= $part['id'] ?>">

                                            <i class="bi bi-clock-history"></i>
                                            Movimientos

                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a
                                            class="dropdown-item text-success"
                                            href="index.php?controller=inventory&action=addStock&id=<?= $part['id'] ?>">

                                            <i class="bi bi-box-arrow-in-down"></i>
                                            Agregar stock

                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            class="dropdown-item text-warning"
                                            href="index.php?controller=inventory&action=adjustStock&id=<?= $part['id'] ?>">

                                            <i class="bi bi-sliders"></i>
                                            Ajustar stock

                                        </a>
                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

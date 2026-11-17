<!-- Encabezado -->
<div class="inventory-header">
    <div>
        <div class="inventory-title">
            <div class="inventory-title-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>
                <h1>Inventario</h1>
                <p>Gestiona los repuestos, herramientas y existencias.</p>
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
            href="index.php?controller=inventory&action=purchases"
            class="btn btn-outline-primary">

            <i class="bi bi-receipt"></i>
            Historial de compras
        </a>

        <a href="index.php?controller=inventory&action=registerPurchase"
            class="btn btn-success">
            <i class="bi bi-cart-plus"></i>
            Registrar compra
        </a>

        <a
            href="index.php?controller=inventory&action=create"
            class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Nuevo artículo
        </a>
    </div>
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

<!-- Buscador y filtros -->
<div class="inventory-search-card">

    <form method="GET">

        <input type="hidden" name="controller" value="inventory">
        <input type="hidden" name="action" value="index">

        <!-- Tipo de inventario -->
        <div class="mb-3">

            <label for="tipo" class="form-label fw-semibold">
                Tipo de inventario
            </label>

            <select
                name="tipo"
                id="tipo"
                class="form-select"
                onchange="this.form.submit()">

                <option value="repuesto"
                    <?= ($tipo ?? 'repuesto') === 'repuesto' ? 'selected' : '' ?>>
                    🔧 Repuestos
                </option>

                <option value="insumo"
                    <?= ($tipo ?? '') === 'insumo' ? 'selected' : '' ?>>
                    🧴 Insumos
                </option>

                <option value="herramienta"
                    <?= ($tipo ?? '') === 'herramienta' ? 'selected' : '' ?>>
                    🛠️ Herramientas
                </option>

            </select>

        </div>

        <!-- Categoría -->
        <div class="mb-3">

            <label for="categoria_id" class="form-label fw-semibold">
                Categoría
            </label>

            <select
                name="categoria_id"
                id="categoria_id"
                class="form-select"
                onchange="this.form.submit()">

                <option value="">Todas las categorías</option>

                <?php foreach ($categories as $category): ?>

                    <option
                        value="<?= (int) $category['id'] ?>"
                        <?= (int) $categoriaId === (int) $category['id'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($category['nombre']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- Búsqueda -->
        <div class="inventory-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="q"
                placeholder="Buscar por código, nombre o marca..."
                value="<?= htmlspecialchars($search ?? '') ?>">

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



<!-- Tarjetas de inventario -->
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

    <?php if (empty($parts)): ?>

        <div class="inventory-empty">

            <div class="inventory-empty-icon">
                <i class="bi bi-search"></i>
            </div>

            <h4>No encontramos artículos</h4>

            <?php if (!empty($search)): ?>

                <p>
                    No hay resultados para
                    <strong>"<?= htmlspecialchars($search) ?>"</strong>
                </p>

                <a
                    href="index.php?controller=inventory&action=index"
                    class="btn btn-outline-primary btn-sm">
                    Ver todo el inventario
                </a>

            <?php else: ?>

                <p>Todavía no hay artículos registrados.</p>

                <a
                    href="index.php?controller=inventory&action=create"
                    class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i>
                    Crear artículo
                </a>

            <?php endif; ?>

        </div>

    <?php else: ?>

        <div class="inventory-cards-grid">

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
                    $porcentaje = min(100, ($stock / $minimo) * 100);
                } else {
                    $stockColor = 'success';
                    $stockText = 'Disponible';
                    $porcentaje = 100;
                }

                ?>

                <article class="inventory-item-card">

                    <!-- Encabezado -->
                    <div class="inventory-card-top">

                        <span class="inventory-code">
                            <?= htmlspecialchars($part['codigo']) ?>
                        </span>

                        <div class="dropdown">

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

                    </div>

                    <!-- Información del artículo -->
                    <div class="inventory-card-product">


                        <?php
                        $iconos = [
                            'repuesto' => 'bi-gear',
                            'insumo' => 'bi-droplet',
                            'herramienta' => 'bi-tools'
                        ];

                        $tipoIcono = $part['tipo'] ?? 'repuesto';

                        // Comprobar que la imagen existe físicamente
                        $hasImage = !empty($part['imagen'])
                            && strpos($part['imagen'], 'uploads/parts/') === 0
                            && is_file(__DIR__ . '/../../../public/' . $part['imagen']);
                        ?>

                        <div class="inventory-product-icon">
                            <?php if ($hasImage): ?>
                                <img
                                    src="/projects/workShop/public/<?= htmlspecialchars($part['imagen'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($part['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                                    class="inventory-product-image">
                            <?php else: ?>
                                <i class="bi <?= $iconos[$tipoIcono] ?? 'bi-box' ?>"></i>
                            <?php endif; ?>
                        </div>


                        <div class="inventory-card-title">

                            <h4>
                                <?= htmlspecialchars($part['nombre']) ?>
                            </h4>

                            <small>
                                <?= htmlspecialchars($part['categoria'] ?? 'Sin categoría') ?>
                            </small>

                        </div>

                    </div>

                    <!-- Datos complementarios -->
                    <div class="inventory-card-details">

                        <div>
                            <span>Marca</span>
                            <strong>
                                <?= htmlspecialchars($part['marca'] ?: '—') ?>
                            </strong>
                        </div>

                        <div>
                            <span>Número de parte</span>
                            <strong>
                                <?= htmlspecialchars($part['numero_parte'] ?: '—') ?>
                            </strong>
                        </div>

                    </div>

                    <!-- Stock -->
                    <div class="inventory-card-stock">

                        <div class="inventory-stock-number">

                            <strong>
                                <?= rtrim(rtrim(number_format($stock, 2, '.', ''), '0'), '.') ?>
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

                    <!-- Estado -->
                    <div class="inventory-card-footer">

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

                        <span class="inventory-card-type">
                            <?= ucfirst(htmlspecialchars($tipoIcono)) ?>
                        </span>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>
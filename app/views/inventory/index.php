<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-box-seam"></i>
            Inventario
        </h2>

        <a href="index.php?controller=inventory&action=create"
            class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Nuevo artículo
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4">

        <input type="hidden" name="controller" value="inventory">
        <input type="hidden" name="action" value="index">

        <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                name="q"
                placeholder="Buscar por código, nombre o marca..."
                value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        </div>

        <div class="col-md-2 d-grid">
            <button class="btn btn-secondary">
                Buscar
            </button>
        </div>

    </form>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3><?= $stats['total'] ?></h3>

                    <small>Total artículos</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-warning">

                        <?= $stats['stock_bajo'] ?>

                    </h3>

                    <small>Stock bajo</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-danger">

                        <?= $stats['agotados'] ?>

                    </h3>

                    <small>Sin existencias</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-primary">

                        <?= $stats['herramientas'] ?>

                    </h3>

                    <small>Herramientas</small>
                </div>
            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>Código</th>
                        <th>Artículo</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th width="170">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($parts)): ?>

                        <tr>

                            <td colspan="7" class="text-center p-4 text-muted">

                                No hay artículos registrados.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php foreach ($parts as $part): ?>

                            <?php

                            $rowClass = '';

                            if ($part['stock_actual'] <= 0) {

                                $rowClass = 'table-danger';
                            } elseif ($part['stock_actual'] <= $part['stock_minimo']) {

                                $rowClass = 'table-warning';
                            }

                            ?>

                            <tr class="<?= $rowClass ?>">

                                <td><?= htmlspecialchars($part['codigo']) ?></td>

                                <td><?= htmlspecialchars($part['nombre']) ?></td>

                                <td><?= htmlspecialchars($part['tipo']) ?></td>

                                <td><?= htmlspecialchars($part['marca']) ?></td>

                                <td>

                                    <?php

                                    $stock = (float)$part['stock_actual'];
                                    $minimo = max(1, (float)$part['stock_minimo']);

                                    if ($stock <= 0) {

                                        $color = 'danger';
                                        $texto = 'Agotado';
                                        $porcentaje = 0;
                                    } elseif ($stock <= $part['stock_minimo']) {

                                        $color = 'warning';
                                        $texto = 'Bajo';
                                        $porcentaje = min(100, ($stock / $minimo) * 100);
                                    } else {

                                        $color = 'success';
                                        $texto = 'Disponible';
                                        $porcentaje = 100;
                                    }

                                    ?>

                                    <strong>

                                        <?= $stock ?>

                                    </strong>

                                    <span class="badge bg-<?= $color ?> ms-2">

                                        <?= $texto ?>

                                    </span>

                                    <div class="progress mt-2" style="height:8px;">

                                        <div
                                            class="progress-bar bg-<?= $color ?>"
                                            role="progressbar"
                                            style="width: <?= $porcentaje ?>%">

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <?php if ($part['activo']): ?>

                                        <span class="badge bg-success">
                                            Activo
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Inactivo
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a
                                        href="index.php?controller=inventory&action=movements&id=<?= $part['id'] ?>"
                                        class="btn btn-sm btn-info">

                                        <i class="bi bi-clock-history"></i>
                                        Movimientos

                                    </a>
                                    <a
                                        href="index.php?controller=inventory&action=addStock&id=<?= $part['id'] ?>"
                                        class="btn btn-success btn-sm">

                                        <i class="bi bi-box-arrow-in-down"></i>

                                        Stock

                                    </a>
                                    <a
                                        href="index.php?controller=inventory&action=edit&id=<?= $part['id'] ?>"
                                        class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>
                                        Editar

                                    </a>
                                    

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
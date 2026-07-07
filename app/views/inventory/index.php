<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="bi bi-box-seam"></i>
                    Inventario
                </h3>
                <small class="text-muted">
                    Catálogo de repuestos y consumibles
                </small>
            </div>

            <a href="index.php?controller=inventory&action=create"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Nueva Parte
            </a>
        </div>

        <div class="card-body">

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>

                    <button class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>

                    <button class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>


            <form method="GET" class="row g-3 mb-4">

                <input type="hidden"
                       name="controller"
                       value="inventory">

                <input type="hidden"
                       name="action"
                       value="index">

                <div class="col-md-8">

                    <input
                        type="text"
                        class="form-control"
                        name="q"
                        placeholder="Buscar por código o nombre..."
                        value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-outline-primary w-100">

                        <i class="bi bi-search"></i>

                        Buscar

                    </button>

                </div>

                <div class="col-md-2">

                    <a href="index.php?controller=inventory&action=index"
                       class="btn btn-outline-secondary w-100">

                        Limpiar

                    </a>

                </div>

            </form>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                    <tr>

                        <th>Código</th>

                        <th>Parte</th>

                        <th>Categoría</th>

                        <th>Marca</th>

                        <th class="text-center">Stock</th>

                        <th class="text-center">Mínimo</th>

                        <th class="text-center">Estado</th>

                        <th width="140">Acciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (empty($parts)): ?>

                        <tr>

                            <td colspan="8" class="text-center text-muted py-5">

                                No existen partes registradas.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php foreach ($parts as $part): ?>

                            <?php

                            $stockClass = 'success';

                            if ($part['stock_actual'] <= 0) {
                                $stockClass = 'danger';
                            } elseif ($part['stock_actual'] <= $part['stock_minimo']) {
                                $stockClass = 'warning';
                            }

                            ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= htmlspecialchars($part['codigo']) ?>

                                    </strong>

                                </td>

                                <td>

                                    <?= htmlspecialchars($part['nombre']) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($part['categoria']) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($part['marca']) ?>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-<?= $stockClass ?>">

                                        <?= $part['stock_actual'] ?>

                                    </span>

                                </td>

                                <td class="text-center">

                                    <?= $part['stock_minimo'] ?>

                                </td>

                                <td class="text-center">

                                    <?php if ($part['activo']): ?>

                                        <span class="badge bg-success">

                                            Activo

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            Inactivo

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a
                                        href="index.php?controller=inventory&action=edit&id=<?= $part['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-pencil"></i>

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

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
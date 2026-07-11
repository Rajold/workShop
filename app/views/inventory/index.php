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
                    <h3><?= count($parts) ?></h3>
                    <small>Total artículos</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3>0</h3>
                    <small>Stock bajo</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3>0</h3>
                    <small>Sin existencias</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3>0</h3>
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

                        <tr>

                            <td><?= htmlspecialchars($part['codigo']) ?></td>

                            <td><?= htmlspecialchars($part['nombre']) ?></td>

                            <td><?= htmlspecialchars($part['tipo']) ?></td>

                            <td><?= htmlspecialchars($part['marca']) ?></td>

                            <td><?= $part['stock_actual'] ?></td>

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

    <a href="index.php?controller=inventory&action=edit&id=<?= $part['id'] ?>"
       class="btn btn-sm btn-warning">
        Editar
    </a>

    <a href="index.php?controller=inventory&action=edit&id=<?= $part['id'] ?>"
       class="btn btn-sm btn-danger">
        Eliminar
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
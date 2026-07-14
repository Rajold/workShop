<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            <i class="bi bi-clock-history"></i>

            Kardex General

        </h2>

        <a
            href="index.php?controller=inventory"
            class="btn btn-secondary">

            Volver

        </a>

    </div>

    <div class="card">

        <div class="card-body p-0">
            <form class="row g-2 mb-3" method="GET">

                <input
                    type="hidden"
                    name="controller"
                    value="inventory">

                <input
                    type="hidden"
                    name="action"
                    value="kardex">

                <div class="col-md-4">

                    <input
                        type="text"
                        class="form-control"
                        name="buscar"
                        placeholder="Buscar artículo..."
                        value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">

                </div>

                <div class="col-md-3">

                    <select
                        name="tipo"
                        class="form-select">

                        <option
                            value=""
                            <?= empty($filters['tipo']) ? 'selected' : '' ?>>

                            Todos los movimientos

                        </option>

                        <option
                            value="compra"
                            <?= ($filters['tipo'] ?? '') === 'compra' ? 'selected' : '' ?>>

                            Compra

                        </option>

                        <option
                            value="consumo"
                            <?= ($filters['tipo'] ?? '') === 'consumo' ? 'selected' : '' ?>>

                            Consumo

                        </option>

                        <option
                            value="ajuste_entrada"
                            <?= ($filters['tipo'] ?? '') === 'ajuste_entrada' ? 'selected' : '' ?>>

                            Ajuste entrada

                        </option>

                        <option
                            value="ajuste_salida"
                            <?= ($filters['tipo'] ?? '') === 'ajuste_salida' ? 'selected' : '' ?>>

                            Ajuste salida

                        </option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>

                        Buscar

                    </button>

                </div>

                <div class="col-md-2">

                    <a
                        href="index.php?controller=inventory&action=kardex"
                        class="btn btn-secondary w-100">

                        Limpiar

                    </a>

                </div>

            </form>

            <div class="row mb-3">

                <div class="col-md-4">

                    <div class="card border-primary shadow-sm">

                        <div class="card-body text-center">

                            <small class="text-muted">

                                Movimientos encontrados

                            </small>

                            <h2 class="mb-0">

                                <?= number_format($summary['movimientos']) ?>

                            </h2>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-success shadow-sm">

                        <div class="card-body text-center">

                            <small class="text-muted">

                                Unidades ingresadas

                            </small>

                            <h2 class="mb-0 text-success">

                                <?= number_format($summary['entradas']) ?>

                            </h2>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-danger shadow-sm">

                        <div class="card-body text-center">

                            <small class="text-muted">

                                Unidades salidas

                            </small>

                            <h2 class="mb-0 text-danger">

                                <?= number_format($summary['salidas']) ?>

                            </h2>

                        </div>

                    </div>

                </div>

            </div>


            <table class="table table-hover mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>Fecha</th>
                        <th>Artículo</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Stock</th>
                        <th>Caso</th>
                        <th>Usuario</th>
                        <th>Motivo</th>
                        <th>Observación</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($movements)): ?>

                        <tr>

                            <td colspan="9" class="text-center text-muted p-4">

                                <i class="bi bi-search"></i>

                                No se encontraron movimientos.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php foreach ($movements as $m): ?>

                            <tr>

                                <td>

                                    <?= date('d/m/Y H:i', strtotime($m['fecha'])) ?>

                                </td>

                                <td>

                                    <strong><?= htmlspecialchars($m['codigo']) ?></strong><br>

                                    <small><?= htmlspecialchars($m['articulo']) ?></small>

                                </td>

                                <td>

                                    <?php

                                    switch ($m['tipo']) {

                                        case 'compra':

                                            echo '<span class="badge bg-success">
            <i class="bi bi-cart-plus"></i>
            Compra
          </span>';

                                            break;

                                        case 'consumo':

                                            echo '<span class="badge bg-danger">
            <i class="bi bi-tools"></i>
            Consumo
          </span>';

                                            break;

                                        case 'ajuste_entrada':

                                            echo '<span class="badge bg-primary">
            <i class="bi bi-arrow-up-circle"></i>
            Ajuste +
          </span>';

                                            break;

                                        case 'ajuste_salida':

                                            echo '<span class="badge bg-warning text-dark">
            <i class="bi bi-arrow-down-circle"></i>
            Ajuste -
          </span>';

                                            break;
                                    }

                                    ?>

                                </td>

                                <td>

                                    <?= $m['cantidad'] ?>

                                </td>

                                <td>

                                    <span class="badge bg-secondary">

                                        <?= $m['stock_resultante'] ?>

                                    </span>

                                </td>

                                <td>

                                    <?php if ($m['caso']): ?>

                                        <a
                                            href="index.php?controller=mechanic&action=viewCase&case_id=<?= $m['caso'] ?>">

                                            Caso #<?= $m['caso'] ?>

                                        </a>

                                    <?php else: ?>

                                        —

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($m['usuario']) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($m['motivo']) ?>

                                </td>
                                <td>
                                    <?= htmlspecialchars($m['observacion'] ?: '—') ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
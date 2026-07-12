<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="bi bi-box-seam"></i>
            Agregar repuesto al caso
        </h2>

        <a
            href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehId ?>"
            class="btn btn-secondary">

            Volver al caso

        </a>

    </div>

    <form method="GET" class="row g-2 mb-4">

        <input type="hidden" name="controller" value="inventory">
        <input type="hidden" name="action" value="selectForCase">
        <input type="hidden" name="case_id" value="<?= $caseId ?>">
        <input type="hidden" name="veh_id" value="<?= $vehId ?>">

        <div class="col-md-10">

            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Buscar artículo..."
                value="<?= htmlspecialchars($search) ?>">

        </div>

        <div class="col-md-2 d-grid">

            <button class="btn btn-primary">

                Buscar

            </button>

        </div>

    </form>

    <table class="table table-hover">

        <thead>

            <tr>

                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th></th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($parts as $part): ?>

                <tr>

                    <td><?= htmlspecialchars($part['codigo']) ?></td>

                    <td><?= htmlspecialchars($part['nombre']) ?></td>

                    <td>

                        <?php

                        $stock = (float)$part['stock_actual'];

                        if ($stock <= 0) {

                            echo '<span class="badge bg-danger">0</span>';
                        } elseif ($stock <= $part['stock_minimo']) {

                            echo '<span class="badge bg-warning text-dark">' . $stock . '</span>';
                        } else {

                            echo '<span class="badge bg-success">' . $stock . '</span>';
                        }

                        ?>

                    </td>

                    <td>

                        <form
                            method="POST"
                            action="index.php?controller=inventory&action=addToCart"
                            class="d-flex align-items-center gap-2">

                            <input
                                type="hidden"
                                name="case_id"
                                value="<?= $caseId ?>">

                            <input
                                type="hidden"
                                name="veh_id"
                                value="<?= $vehId ?>">

                            <input
                                type="hidden"
                                name="parte_id"
                                value="<?= $part['id'] ?>">

                            <input
                                type="number"
                                name="cantidad"
                                value="1"
                                min="1"
                                max="<?= (int)$part['stock_actual'] ?>"
                                class="form-control form-control-sm"
                                style="width:75px">

                            <button
                                type="submit"
                                class="btn btn-success btn-sm">

                                <i class="bi bi-plus-circle"></i>

                                Agregar

                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <hr>

    <h4>

        <i class="bi bi-cart"></i>

        Repuestos seleccionados

    </h4>

    <?php

    $cart = $_SESSION['case_cart'][$caseId] ?? [];

    if (empty($cart)):

    ?>

        <p class="text-muted">

            Aún no hay artículos seleccionados.

        </p>

    <?php else: ?>

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>Artículo</th>

                    <th>Cantidad</th>

                    <th>Precio</th>

                    <th>Subtotal</th>

                    <th width="80">Acción</th>

                </tr>

            </thead>

            <tbody>

                <?php

                $total = 0;

                foreach ($cart as $item):

                    $subtotal = $item['precio_venta'] * $item['cantidad'];

                    $total += $subtotal;

                ?>

                    <tr>

                        <td><?= htmlspecialchars($item['nombre']) ?></td>

                        <td><?= $item['cantidad'] ?></td>

                        <?= number_format($item['precio_venta'],0,',','.') ?>

                        <td>

                            <strong>

                                $<?= number_format($subtotal, 0, ',', '.') ?>

                            </strong>

                        </td>
                        <td>

                            <form
                                method="POST"
                                action="index.php?controller=inventory&action=removeFromCart">

                                <input
                                    type="hidden"
                                    name="case_id"
                                    value="<?= $caseId ?>">

                                <input
                                    type="hidden"
                                    name="veh_id"
                                    value="<?= $vehId ?>">

                                <input
                                    type="hidden"
                                    name="part_id"
                                    value="<?= $item['part_id'] ?>">

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Eliminar">

                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>


                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

            <tfoot>

                <tr>

                    <th colspan="3">

                        Total

                    </th>

                    <th>

                        $<?= number_format($total, 0, ',', '.') ?>

                    </th>

                </tr>

            </tfoot>

        </table>

<div class="text-end mt-3">

    <form
        method="POST"
        action="index.php?controller=inventory&action=confirmCart">

        <input
            type="hidden"
            name="case_id"
            value="<?= $caseId ?>">

        <input
            type="hidden"
            name="veh_id"
            value="<?= $vehId ?>">

        <button
            type="submit"
            class="btn btn-success btn-lg">

            <i class="bi bi-check-circle"></i>

            Añadir repuestos al caso

        </button>

    </form>

</div>

<?php endif; ?>

</div>
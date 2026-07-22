//_advance_history.php

<?php if (!empty($caseParts)): ?>

    <div class="card border-warning mb-4">

        <div class="card-header bg-warning">

            <strong>

                🔩 Repuestos utilizados

            </strong>

        </div>

        <div class="card-body p-0">

            <table class="table table-sm table-hover mb-0">

                <thead>

                    <tr>

                        <th>Artículo</th>

                        <th class="text-center">Cant.</th>

                        <th class="text-end">P. Unit.</th>

                        <th class="text-end">Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($caseParts as $part): ?>

                        <tr>

                            <td>

                                <strong>

                                    <?= htmlspecialchars($part['nombre']) ?>

                                </strong>

                                <br>

                                <small class="text-muted">

                                    <?= htmlspecialchars($part['marca']) ?>

                                </small>

                            </td>

                            <td class="text-center">

                                <?= $part['cantidad'] ?>

                            </td>

                            <td class="text-end">

                                $<?= number_format($part['precio_unitario'], 0, ",", ".") ?>

                            </td>

                            <td class="text-end">

                                <strong>

                                    $<?= number_format($part['subtotal'], 0, ",", ".") ?>

                                </strong>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

<?php endif; ?>

<h4 class="mt-4">Avances del caso</h4>

<?php if (!empty($avances)): ?>

    <ul class="list-group">

        <?php foreach ($avances as $a): ?>

            <?php
            $badge = ($a['tipo'] === 'Mano de obra')
                ? 'primary'
                : 'warning';

            $icono = ($a['tipo'] === 'Mano de obra')
                ? '🔧'
                : '📦';
            ?>

            <li class="list-group-item">

                <div class="d-flex justify-content-between align-items-center">

                    <strong>
                        <?= htmlspecialchars($a['mecanico']) ?>
                    </strong>

                    <span class="badge bg-<?= $badge ?>">
                        <?= $icono ?>
                        <?= htmlspecialchars($a['tipo']) ?>
                    </span>

                </div>

                <div class="mt-2">
                    <?= nl2br(htmlspecialchars($a['descripcion'])) ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <strong class="text-success">
                        $<?= number_format($a['valor'], 0, ",", ".") ?>
                    </strong>

                    <small class="text-muted">
                        <?= $a['fecha'] ?>
                    </small>

                </div>

                <div class="text-end mt-3">

                    <button
                        type="button"
                        class="btn btn-outline-primary btn-sm editar-avance"

                        data-bs-toggle="modal"
                        data-bs-target="#modalEditarAvance"

                        data-id="<?= $a['id'] ?>"
                        data-descripcion="<?= htmlspecialchars($a['descripcion'], ENT_QUOTES) ?>"
                        data-tipo="<?= htmlspecialchars($a['tipo'], ENT_QUOTES) ?>"
                        data-valor="<?= $a['valor'] ?>">

                        ✏ Editar

                    </button>

                    <form
                        method="post"
                        action="index.php?controller=mechanic&action=deleteAdvance"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de eliminar este avance?');">

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $a['id'] ?>">

                        <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm">

                            🗑 Eliminar

                        </button>

                    </form>

                </div>

            </li>

        <?php endforeach; ?>

    </ul>

<?php else: ?>

    <div class="alert alert-warning">

        No hay avances registrados.

    </div>

<?php endif; ?>
<?php if (!empty($caseParts)): ?>

    <section class="case-parts-section mb-4">

        <div class="case-parts-heading">
            <div>
                <div class="case-parts-eyebrow">DETALLE DEL SERVICIO</div>
                <h5 class="case-parts-title">🔩 Repuestos utilizados</h5>
                <p class="case-parts-subtitle">
                    Piezas y materiales registrados en este caso
                </p>
            </div>

            <span class="case-parts-count">
                <?= count($caseParts) ?>
                <?= count($caseParts) === 1 ? 'artículo' : 'artículos' ?>
            </span>
        </div>

        <div class="table-responsive">
            <table class="table case-parts-table">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end">Precio unitario</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($caseParts as $part): ?>
                        <tr>
                            <td>
                                <div class="case-part-name">
                                    <?= htmlspecialchars(
                                        $part['nombre'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>

                                <div class="case-part-brand">
                                    <?= htmlspecialchars(
                                        $part['marca'] ?? '',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="case-part-quantity">
                                    <?= htmlspecialchars(
                                        (string)$part['cantidad'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </span>
                            </td>

                            <td class="text-end text-nowrap">
                                $<?= number_format(
                                        (float)$part['precio_unitario'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                            </td>

                            <td class="text-end text-nowrap">
                                <strong class="case-part-subtotal">
                                    $<?= number_format(
                                            (float)$part['subtotal'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?>
                                </strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </section>

<?php endif; ?>



<div class="case-section-title">
    <span class="section-icon">🛠️</span>
    Historial de trabajos
</div>

<?php if (!empty($avances)): ?>

    <div class="case-advance-history">

        <?php foreach ($avances as $a): ?>

            <?php
            $isLabor = ($a['tipo'] === 'Mano de obra');

            $badgeClass = $isLabor
                ? 'case-advance-labor'
                : 'case-advance-part';

            $icono = $isLabor
                ? '🔧'
                : '📦';
            ?>

            <div class="case-advance-item">

                <div class="case-advance-card">

                    <div class="case-advance-header">

                        <div>
                            <div class="case-advance-mechanic">
                                <?= htmlspecialchars($a['mecanico']) ?>
                            </div>

                            <div class="case-advance-date">
                                <?= htmlspecialchars($a['fecha']) ?>
                            </div>
                        </div>

                        <span class="case-advance-type <?= $badgeClass ?>">
                            <?= $icono ?>
                            <?= htmlspecialchars($a['tipo']) ?>
                        </span>

                    </div>

                    <div class="case-advance-description">
                        <?= nl2br(
                            htmlspecialchars(
                                $a['descripcion'],
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ) ?>
                    </div>

                    <div class="case-advance-footer">

                        <strong class="case-advance-value">
                            $<?= number_format(
                                    $a['valor'],
                                    0,
                                    ",",
                                    "."
                                ) ?>
                        </strong>

                        <div class="case-actions">

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-sm editar-avance"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarAvance"
                                data-id="<?= $a['id'] ?>"
                                data-descripcion="<?= htmlspecialchars(
                                                        $a['descripcion'],
                                                        ENT_QUOTES
                                                    ) ?>"
                                data-tipo="<?= htmlspecialchars(
                                                $a['tipo'],
                                                ENT_QUOTES
                                            ) ?>"
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

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

<?php else: ?>

    <div class="alert alert-warning">

        No hay avances registrados.

    </div>

<?php endif; ?>
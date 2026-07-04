//_advance_history.php
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
                        $<?= number_format($a['valor'],0,",",".") ?>
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
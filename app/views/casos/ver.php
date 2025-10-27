<h3>Avances del caso</h3>

<?php if (!empty($avances)): ?>
    <ul class="list-group mb-3">
        <?php foreach ($avances as $a): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($a['mecanico']) ?>:</strong>
                <?= nl2br(htmlspecialchars($a['descripcion'])) ?>
                <br><small class="text-muted"><?= htmlspecialchars($a['fecha']) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay avances registrados aún.</p>
<?php endif; ?>

<!-- Formulario para añadir nuevo avance -->
<form method="POST" action="index.php?controller=case&action=add">
    <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id']) ?>">
    <div class="mb-3">
        <label for="descripcion" class="form-label">Nuevo avance:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agregar avance</button>
</form>

<hr class="my-4">

<hr class="my-4">

<h4>Historial del vehículo</h4>
<?php if (!empty($historial)): ?>
    <ul class="list-group">
        <?php foreach ($historial as $h): ?>
            <?php
                $isCurrent = ($h['id'] == $caso['id']); // 🔍 Es el caso actual
                $badgeColor = ($h['estado'] === 'abierto') ? 'success' : 'secondary';
                $itemClass = $isCurrent ? 'list-group-item-info border-primary' : '';
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center <?= $itemClass ?>">
                <div>
                    <a href="index.php?controller=case&action=ver&id=<?= htmlspecialchars($h['id']) ?>" class="text-decoration-none <?= $isCurrent ? 'fw-bold text-primary' : '' ?>">
                        <?php if ($isCurrent): ?>
                            🔹 Caso actual:
                        <?php else: ?>
                            Caso #<?= htmlspecialchars($h['id']) ?> –
                        <?php endif; ?>
                        <?= htmlspecialchars($h['causa'] ?? 'Sin causa') ?>
                    </a>
                    <br>
                    <small class="text-muted">
                        <?= htmlspecialchars($h['fecha_ingreso']) ?> – 
                        Mecánico: <?= htmlspecialchars($h['mecanico_nombre'] ?? 'N/D') ?>
                    </small>
                </div>
                <span class="badge bg-<?= $badgeColor ?>">
                    <?= htmlspecialchars(ucfirst($h['estado'])) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-muted">Este vehículo no tiene historial de casos anteriores.</p>
<?php endif; ?>



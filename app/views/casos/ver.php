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

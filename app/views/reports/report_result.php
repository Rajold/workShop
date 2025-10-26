<h2>Resultado del reporte</h2>

<?php if (empty($grouped)): ?>
  <div class="alert alert-info">Sin datos</div>
<?php else: ?>
  <?php foreach ($grouped as $r): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">
          Caso #<?= htmlspecialchars($r['caso_id'] ?? '') ?> - 
          <?= htmlspecialchars($r['placa'] ?? '') ?> 
          (<?= htmlspecialchars($r['marca'] ?? '') ?> <?= htmlspecialchars($r['modelo'] ?? '') ?>)
        </h5>

        <p class="card-text mb-1"><strong>Color:</strong> <?= htmlspecialchars($r['color'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Propietario:</strong> <?= htmlspecialchars($r['propietario'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Mecánico:</strong> <?= htmlspecialchars($r['mecanico'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Fecha ingreso:</strong> <?= htmlspecialchars($r['fecha_ingreso'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Hora ingreso:</strong> <?= htmlspecialchars($r['hora_ingreso'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Causa:</strong> <?= htmlspecialchars($r['causa'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Diagnóstico:</strong> <?= htmlspecialchars($r['diagnostico'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Observaciones:</strong> <?= htmlspecialchars($r['observaciones'] ?? '') ?></p>
        <p class="card-text mb-1"><strong>Estado:</strong> <?= htmlspecialchars($r['estado'] ?? '') ?></p>

        <!-- 🔹 Cambié esta línea -->
        <p class="card-text mb-1">
          <strong>Tiempo total invertido:</strong> <?= htmlspecialchars($r['tiempo_legible'] ?? '0h 00min') ?>
        </p>

        <?php if (!empty($r['avances'])): ?>
          <h6 class="mt-3">Avances</h6>
          <ul>
            <?php foreach ($r['avances'] as $a): ?>
              <li>
                <em><?= htmlspecialchars($a['fecha'] ?? '') ?>:</em>
                <?= nl2br(htmlspecialchars($a['descripcion'] ?? '')) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted">Sin avances registrados.</p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>

  <a class="btn btn-sm btn-outline-secondary" href="#" onclick="window.print();return false">Imprimir / Guardar</a>
<?php endif; ?>

<h2>Resultado de reporte</h2>
<?php if (empty($rows)): ?>
  <div class="alert alert-info">Sin datos</div>
<?php else: ?>
  <table class="table">
    <thead><tr><th>ID caso</th><th>Placa</th><th>Mecánico</th><th>Fecha</th><th>Duración (min)</th><th>Diagnóstico</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr>
        <td><?=htmlspecialchars($r['id'])?></td>
        <td><?=htmlspecialchars($r['placa'] ?? '')?></td>
        <td><?=htmlspecialchars($r['mecanico'] ?? '')?></td>
        <td><?=htmlspecialchars($r['fecha_ingreso'] ?? '')?></td>
        <td><?=htmlspecialchars($r['duracion'] ?? '')?></td>
        <td><?=htmlspecialchars($r['diagnostico'] ?? '')?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <a class="btn btn-sm btn-outline-secondary" href="#" onclick="window.print();return false">Imprimir / Guardar HTML</a>
<?php endif; ?>

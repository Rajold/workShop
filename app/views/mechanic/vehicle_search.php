<h2>Resultado búsqueda</h2>
<form method="post" action="index.php?controller=mechanic&action=searchVehicle" class="row g-2 mb-3">
  <div class="col-4"><input name="placa" class="form-control" placeholder="ABC123" required></div>
  <div class="col-auto"><button class="btn btn-primary">Buscar</button></div>
</form>

<?php if ($vehicle): ?>
  <h4>Vehículo: <?=htmlspecialchars($vehicle['placa'])?></h4>
  <p>Marca: <?=htmlspecialchars($vehicle['marca'])?> | Modelo: <?=htmlspecialchars($vehicle['modelo'])?></p>
  <a class="btn btn-sm btn-warning" href="index.php?controller=mechanic&action=viewCase&veh_id=<?=$vehicle['id']?>">Ver ficha</a>
<?php else: ?>
  <div class="alert alert-info">No se encontró. Puedes agregar uno nuevo.</div>
  <form method="post" action="index.php?controller=mechanic&action=saveVehicle" onsubmit="return validateVehicleForm(this)">
  <div class="mb-2">
    <input name="placa" placeholder="Placa" class="form-control" required>
  </div>
  <div class="mb-2">
    <input name="marca" placeholder="Marca" class="form-control">
  </div>
  <div class="mb-2">
    <input name="modelo" placeholder="Modelo" class="form-control">
  </div>
  <div class="mb-2">
    <input name="color" placeholder="Color" class="form-control">
  </div>
  <div class="mb-2">
    <input name="propietario" placeholder="Propietario" class="form-control">
  </div>
  <div class="mb-2">
    <textarea name="causa" placeholder="Describa la falla reportada por el propietario" class="form-control" rows="3" required></textarea>
  </div>
  <button class="btn btn-success">Guardar vehículo y registrar caso</button>
</form>

<?php endif; ?>

<?php if (!empty($cases)): ?>
  <h5 class="mt-3">Casos anteriores</h5>
  <ul>
    <?php foreach ($cases as $c): ?>
      <li>Fecha: <?=htmlspecialchars($c['fecha_ingreso'])?> - Estado: <?=htmlspecialchars($c['estado'])?> - <a href="index.php?controller=mechanic&action=viewCase&case_id=<?=$c['id']?>&veh_id=<?=$vehicle['id']?>">Abrir</a></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

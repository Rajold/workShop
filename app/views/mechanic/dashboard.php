<h2>Panel Mecánico</h2>
<p>Buscar vehículo</p>
<form method="post" action="index.php?controller=mechanic&action=searchVehicle" class="row g-2">
  <div class="col-auto">
    <select name="criterio" class="form-control" required>
      <option value="placa" selected>Placa</option>
      <option value="propietario">Propietario</option>
      <option value="marca">Marca</option>
      <option value="estado">Estado</option>
    </select>
  </div>
  <div class="col-auto">
    <input name="valor" class="form-control" placeholder="Ingrese valor" required>
  </div>
  <div class="col-auto">
    <button class="btn btn-primary">Buscar</button>
  </div>
</form>
<hr>
<a class="btn btn-secondary" href="index.php?controller=mechanic&action=searchVehicle">Gestionar vehículos</a>

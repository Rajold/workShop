<h2>Generar Reporte</h2>
<form method="get" action="index.php">
  <input type="hidden" name="controller" value="report">
  <input type="hidden" name="action" value="generate">
  <div class="mb-2"><label>Tipo</label>
    <select name="type" class="form-select">
      <option value="vehiculo">Por vehículo</option>
      <option value="mecanico">Por mecánico</option>
    </select>
  </div>
  <div class="mb-2"><label>Placa (opcional)</label><input name="placa" class="form-control"></div>
  <div class="mb-2"><label>Fecha desde</label><input type="date" name="from" class="form-control"></div>
  <div class="mb-2"><label>Fecha hasta</label><input type="date" name="to" class="form-control"></div>
  <button class="btn btn-primary">Generar</button>
</form>

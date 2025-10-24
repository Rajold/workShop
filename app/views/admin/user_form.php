<h2>Crear Usuario</h2>
<form method="post" action="index.php?controller=admin&action=createUser" onsubmit="return validateUserForm(this)">
  <div class="mb-3"><label class="form-label">Nombre</label><input name="nombre" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Usuario</label><input name="usuario" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Contraseña</label><input name="password" type="password" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Rol</label>
    <select name="rol" class="form-select"><option value="mecanico">Mecánico</option><option value="admin">Administrador</option></select>
  </div>
  <button class="btn btn-primary">Guardar</button>
</form>

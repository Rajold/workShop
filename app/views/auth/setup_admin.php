<h2>Crear primer administrador</h2>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
<?php endif; ?>
<form method="post" action="index.php?controller=auth&action=setup" onsubmit="return validateSetup(this)">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Usuario</label>
    <input name="usuario" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input name="password" type="password" class="form-control" required>
  </div>
  <button class="btn btn-success">Crear administrador</button>
</form>

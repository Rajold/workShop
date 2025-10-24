<h2>Login</h2>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
<?php endif; ?>
<form method="post" action="index.php?controller=auth&action=login" onsubmit="return validateLogin(this)">
  <div class="mb-3">
    <label class="form-label">Usuario</label>
    <input name="usuario" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input name="password" type="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Ingresar</button>
</form>

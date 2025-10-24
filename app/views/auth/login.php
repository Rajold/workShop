<?php
// app/views/auth/login_view.php
?>

<!-- Cargar Bootstrap desde CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="max-width: 400px; width: 100%; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Login</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?controller=auth&action=login" onsubmit="return validateLogin(this)">
            <div class="mb-3">
                <label class="form-label" for="usuario">Usuario</label>
                <input id="usuario" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Contraseña</label>
                <input id="password" name="password" type="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100" type="submit">Ingresar</button>
        </form>

        <div class="text-center mt-3">
            <a href="index.php?controller=auth&action=forgotPassword" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<!-- Cargar Bootstrap JS y Popper.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

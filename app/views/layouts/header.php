<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WorkShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="/css/style.css"> -->
   <link rel="stylesheet" href="/projects/workShop/public/css/style.css">
   <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Taller</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <?php if (!empty($_SESSION['user_id'])): ?>
          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="index.php?controller=admin&action=dashboard">Admin</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=mechanic&action=dashboard">Panel</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=report&action=form">Reportes</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=inventory&action=index"><i class="bi bi-box-seam"></i> Inventario</a></li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if (!empty($_SESSION['user_id'])): ?>
          <li class="nav-item"><span class="nav-link">Logueado como: <?=htmlspecialchars($_SESSION['user_name'])?></span></li>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=auth&action=logout">Cerrar sesión</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php if (!empty($_SESSION['success'])): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= htmlspecialchars($_SESSION['success']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if (!empty($_SESSION['error'])): ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <?= htmlspecialchars($_SESSION['error']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<?php if (!empty($_SESSION['warning'])): ?>

    <div class="alert alert-warning alert-dismissible fade show">

        <?= htmlspecialchars($_SESSION['warning']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    <?php unset($_SESSION['warning']); ?>

<?php endif; ?>


<?php if (!empty($_SESSION['info'])): ?>

    <div class="alert alert-info alert-dismissible fade show">

        <?= htmlspecialchars($_SESSION['info']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    <?php unset($_SESSION['info']); ?>

<?php endif; ?>

<div class="container mt-4">

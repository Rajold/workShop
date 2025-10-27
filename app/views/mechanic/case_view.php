<?php
// app/views/mechanic/case_view.php
?>

<!-- Cargar Bootstrap desde CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2 class="mb-4">Ficha del vehículo</h2>

    <?php if ($vehicle): ?>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Placa:</strong> <?= htmlspecialchars($vehicle['placa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Marca:</strong> <?= htmlspecialchars($vehicle['marca'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Modelo:</strong> <?= htmlspecialchars($vehicle['modelo'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Color:</strong> <?= htmlspecialchars($vehicle['color'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Propietario:</strong> <?= htmlspecialchars($vehicle['propietario'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Ningún vehículo seleccionado.</div>
    <?php endif; ?>

    <h3>Casos del vehículo</h3>
    <?php if (!empty($cases)): ?>
        <ul class="list-group mb-4">
            <?php foreach ($cases as $c): ?>
                <li class="list-group-item">
                    <a href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>&case_id=<?= $c['id'] ?>" class="text-decoration-none">
                        Caso #<?= htmlspecialchars($c['id']) ?> – <?= htmlspecialchars($c['causa'] ?? 'Sin causa') ?> 
                        <span class="badge bg-<?= ($c['estado'] === 'abierto' ? 'success' : 'secondary') ?> float-end"><?= htmlspecialchars($c['estado'] ?? 'Desconocido') ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info">El vehículo no tiene casos registrados.</div>
    <?php endif; ?>

    <h2 class="mt-4">Ficha del caso</h2>

    <?php if ($caso): ?>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Causa:</strong> <?= htmlspecialchars($caso['causa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Observaciones:</strong> <?= htmlspecialchars($caso['observaciones'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Diagnóstico:</strong> <?= htmlspecialchars($caso['diagnostico'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($caso['estado'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>

<?php if ($caso['estado'] === 'abierto'): ?>
    <div class="alert alert-info">
        <?php if (empty($activeSession)): ?>
            <form method="post" action="index.php?controller=mechanic&action=startSession" class="mb-3">
                <input type="hidden" name="case_id" value="<?= $caso['id'] ?>">
                <button type="submit" class="btn btn-primary">Iniciar sesión de trabajo</button>
            </form>
        <?php else: ?>
            <p><strong>Sesión activa</strong></p>

            <h4>Agregar avance</h4>
            <form method="post">
                <div class="mb-3">
                    <textarea name="nuevo_avance" rows="4" class="form-control" placeholder="Describa el avance..."></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar avance</button>
            </form>

            <form method="post" action="index.php?controller=mechanic&action=endSession" class="mt-3">
                <input type="hidden" name="session_id" value="<?= $activeSession['id'] ?>">
                <button type="submit" class="btn btn-danger">Terminar sesión de trabajo</button>
            </form>
        <?php endif; ?>
    </div>
    

    <!-- Botón para cerrar caso -->
    <form method="post" action="index.php?controller=case&action=cerrar" class="mt-3">
        <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id']) ?>">
        <button type="submit" class="btn btn-warning w-100">
            🏁 Cerrar caso
        </button>
    </form>


<?php else: ?>
    <div class="alert alert-secondary">
        El caso está cerrado. No se pueden agregar avances.
    </div>
    <p class="text-success mt-2"><strong>✅ Caso cerrado</strong></p>
<?php endif; ?>

<?php if ($caso['estado'] === 'cerrado'): ?>
    <form method="POST" action="index.php?controller=case&action=nuevoDesdeExistente">
        <input type="hidden" name="vehiculo_id" value="<?= htmlspecialchars($caso['vehiculo_id']) ?>">
        <input type="hidden" name="referencia_anterior" value="<?= htmlspecialchars($caso['id']) ?>">
        <button type="submit" class="btn btn-success mt-3">
            🆕 Nuevo caso
        </button>
    </form>
<?php endif; ?>

        <h4 class="mt-4">Avances del caso</h4>
        <?php if (!empty($avances)): ?>
            <ul class="list-group">
                <?php foreach ($avances as $a): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($a['mecanico'] ?? 'Desconocido', ENT_QUOTES, 'UTF-8') ?>:</strong>
                        <?= nl2br(htmlspecialchars($a['descripcion'] ?? '', ENT_QUOTES, 'UTF-8')) ?>
                        <br><small class="text-muted"><?= $a['fecha'] ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-warning">No hay avances registrados para este caso.</div>
        <?php endif; ?>

    <?php else: ?>
        <div class="alert alert-warning">No hay caso seleccionado.</div>
    <?php endif; ?>
</div>


<!-- Cargar Bootstrap JS y Popper.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Caso</title>
    <link rel="stylesheet" href="/projects/workShop/public/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h2>Ficha de reparación del vehículo</h2>
        <hr>
        <p><strong>Placa:</strong> <?= htmlspecialchars($repairCase['placa'] ?? '') ?></p>
        <p><strong>Diagnóstico actual:</strong> <?= htmlspecialchars($repairCase['diagnostico'] ?? '') ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($repairCase['estado'] ?? '') ?></p>

        <hr>
        <h4>Avances del caso</h4>
        <?php if (!empty($avances)): ?>
            <ul class="list-group mb-3">
                <?php foreach ($avances as $av): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($av['mecanico_nombre']) ?></strong>
                        (<?= $av['fecha'] ?>):<br>
                        <?= nl2br(htmlspecialchars($av['descripcion'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay avances registrados todavía.</p>
        <?php endif; ?>

        <?php if ($repairCase['estado'] === 'abierto'): ?>
            <form method="post">
                <div class="form-group">
                    <label for="nuevo_avance">Añadir nuevo avance:</label>
                    <textarea name="nuevo_avance" id="nuevo_avance" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Guardar avance</button>
            </form>
        <?php else: ?>
            <div class="alert alert-secondary mt-3">El caso está cerrado. No se pueden agregar avances.</div>
        <?php endif; ?>
    </div>
</body>
</html>

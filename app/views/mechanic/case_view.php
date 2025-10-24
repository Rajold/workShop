<?php
// app/views/mechanic/case_view.php
?>

<h2>Ficha del vehículo</h2>

<?php if ($vehicle): ?>
    <p><strong>Placa:</strong> <?= htmlspecialchars($vehicle['placa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Marca:</strong> <?= htmlspecialchars($vehicle['marca'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Modelo:</strong> <?= htmlspecialchars($vehicle['modelo'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Color:</strong> <?= htmlspecialchars($vehicle['color'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Propietario:</strong> <?= htmlspecialchars($vehicle['propietario'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
<?php else: ?>
    <p>No hay vehículo seleccionado.</p>
<?php endif; ?>

<!-- NUEVO BLOQUE: lista de casos del vehículo -->
<h3>Casos del vehículo</h3>
<?php if (!empty($cases)): ?>
    <ul>
        <?php foreach ($cases as $c): ?>
            <li>
                <a href="index.php?controller=mechanic&action=viewCase&veh_id=<?= $vehicle['id'] ?>&case_id=<?= $c['id'] ?>">
                    Caso #<?= htmlspecialchars($c['id']) ?> – <?= htmlspecialchars($c['causa'] ?? 'Sin causa') ?> 
                    (<?= htmlspecialchars($c['estado'] ?? 'Desconocido') ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Este vehículo no tiene casos registrados.</p>
<?php endif; ?>
<!-- FIN NUEVO BLOQUE -->

<h2>Ficha del caso</h2>

<?php if ($caso): ?>
    <p><strong>Causa:</strong> <?= htmlspecialchars($caso['causa'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Observaciones:</strong> <?= htmlspecialchars($caso['observaciones'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Diagnóstico:</strong> <?= htmlspecialchars($caso['diagnostico'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Estado:</strong> <?= htmlspecialchars($caso['estado'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

    <?php if ($caso['estado'] === 'abierto'): ?>
        <!-- Sesión de trabajo -->
        <?php if (empty($activeSession)): ?>
            <form method="post" action="index.php?controller=mechanic&action=startSession">
                <input type="hidden" name="case_id" value="<?= $caso['id'] ?>">
                <button type="submit">Iniciar sesión de trabajo</button>
            </form>
        <?php else: ?>
            <p><strong>Sesión activa</strong></p>

            <!-- Formulario de nuevo avance -->
            <h3>Agregar avance</h3>
            <form method="post">
                <textarea name="nuevo_avance" rows="4" cols="50" placeholder="Describa el avance..."></textarea><br>
                <button type="submit">Guardar avance</button>
            </form>

            <form method="post" action="index.php?controller=mechanic&action=endSession">
                <input type="hidden" name="session_id" value="<?= $activeSession['id'] ?>">
                <button type="submit">Terminar sesión de trabajo</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <p>El caso está cerrado. No se pueden agregar avances.</p>
    <?php endif; ?>

    <!-- Lista de avances -->
    <h3>Avances del caso</h3>
    <?php if (!empty($avances)): ?>
        <ul>
            <?php foreach ($avances as $a): ?>
                <li>
                    <strong><?= htmlspecialchars($a['mecanico'] ?? 'Desconocido', ENT_QUOTES, 'UTF-8') ?>:</strong>
                    <?= nl2br(htmlspecialchars($a['descripcion'] ?? '', ENT_QUOTES, 'UTF-8')) ?>
                    <em>(<?= $a['fecha'] ?>)</em>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay avances registrados para este caso.</p>
    <?php endif; ?>

<?php else: ?>
    <p>No hay caso seleccionado.</p>
<?php endif; ?>

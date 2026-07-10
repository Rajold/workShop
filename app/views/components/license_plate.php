<?php
$plate = strtoupper(trim($plate ?? ''));
?>

<div class="license-plate">
    <div class="plate-number">
        <?= htmlspecialchars($plate) ?>
    </div>

    <div class="plate-country">
        COLOMBIA
    </div>
</div>
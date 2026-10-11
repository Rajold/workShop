<?php
$categorias = [
    'alimentacion' => 'Alimentación',
    'operativo' => 'Gastos operativos',
    'herramientas' => 'Herramientas',
    'transporte' => 'Transporte',
    'imprevisto' => 'Imprevistos',
    'otro' => 'Otro',
];

$form = [
    'descripcion' => '',
    'categoria' => 'otro',
    'valor' => '',
    'fecha_gasto' => date('Y-m-d\TH:i'),
    'forma_pago' => 'caja',
    'proveedor' => '',
    'observacion' => '',
];
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= htmlspecialchars($title ?? 'Registrar gasto', ENT_QUOTES, 'UTF-8') ?></h2>
        <a href="index.php?controller=expense&action=index"
           class="btn btn-outline-secondary">
            Volver a gastos
        </a>
    </div>

    <div class="alert alert-info">
        El gasto quedará pendiente de aprobación. Si utilizaste dinero
        personal, el reembolso solo debe registrarse cuando realmente se pague.
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST"
                  action="index.php?controller=expense&action=store">

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <input type="text"
                           class="form-control"
                           id="descripcion"
                           name="descripcion"
                           maxlength="255"
                           required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoría *</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <?php foreach ($categorias as $valor => $etiqueta): ?>
                                <option value="<?= $valor ?>">
                                    <?= htmlspecialchars($etiqueta, ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="valor" class="form-label">Valor en COP *</label>
                        <input type="number"
                               class="form-control"
                               id="valor"
                               name="valor"
                               min="0.01"
                               step="0.01"
                               required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_gasto" class="form-label">Fecha y hora *</label>
                        <input type="datetime-local"
                               class="form-control"
                               id="fecha_gasto"
                               name="fecha_gasto"
                               value="<?= $form['fecha_gasto'] ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="forma_pago" class="form-label">Forma de pago *</label>
                        <select class="form-select" id="forma_pago" name="forma_pago" required>
                            <option value="caja">Caja del taller</option>
                            <option value="transferencia">Transferencia</option>
                            <option value="dinero_personal">Dinero personal</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="proveedor" class="form-label">Proveedor (opcional)</label>
                    <input type="text"
                           class="form-control"
                           id="proveedor"
                           name="proveedor"
                           maxlength="255">
                </div>

                <div class="mb-3">
                    <label for="observacion" class="form-label">Observaciones (opcional)</label>
                    <textarea class="form-control"
                              id="observacion"
                              name="observacion"
                              rows="3"></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Registrar gasto
                    </button>
                    <a href="index.php?controller=expense&action=index"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
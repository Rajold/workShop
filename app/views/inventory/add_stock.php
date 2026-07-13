<div class="container mt-4">

    <h2>

        <i class="bi bi-box-arrow-in-down"></i>

        Agregar stock

    </h2>

    <hr>

    <div class="card">

        <div class="card-body">

            <h5><?= htmlspecialchars($part['nombre']) ?></h5>

            <p>

                <strong>Código:</strong>

                <?= htmlspecialchars($part['codigo']) ?>

            </p>

            <p>

                <strong>Stock actual:</strong>

                <?= $part['stock_actual'] ?>

            </p>

            <form
                method="POST"
                action="index.php?controller=inventory&action=saveStock">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $part['id'] ?>">

                <div class="mb-3">

                    <label class="form-label">

                        Cantidad que ingresa

                    </label>

                    <input
                        type="number"
                        name="cantidad"
                        min="1"
                        required
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Costo unitario

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="costo"
                        value="<?= $part['costo'] ?>"
                        class="form-control">

                </div>
                <div class="mb-3">

    <label class="form-label">

        Motivo

    </label>

    <select
        name="motivo"
        class="form-select"
        required>

        <option value="Compra inicial">
            Compra inicial
        </option>

        <option value="Compra a proveedor">
            Compra a proveedor
        </option>

        <option value="Ajuste de inventario">
            Ajuste de inventario
        </option>

        <option value="Devolución">
            Devolución
        </option>

        <option value="Otro">
            Otro
        </option>

    </select>

</div>

                <div class="mb-3">

                    <label class="form-label">

                        Observación

                    </label>

                    <textarea
                        name="observacion"
                        class="form-control"></textarea>

                </div>

                <button
                    class="btn btn-success">

                    Guardar entrada

                </button>

            </form>

        </div>

    </div>

</div>
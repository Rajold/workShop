<div class="container mt-4">

    <h2>

        <i class="bi bi-sliders"></i>

        Ajuste de inventario

    </h2>

    <hr>

    <div class="card">

        <div class="card-body">

            <h4>

                <?= htmlspecialchars($part['nombre']) ?>

            </h4>

            <p>

                <strong>Stock actual:</strong>

                <?= $part['stock_actual'] ?>

            </p>

            <form
                method="POST"
                action="index.php?controller=inventory&action=saveAdjustment">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $part['id'] ?>">

                <div class="mb-3">

                    <label class="form-label">

                        Tipo de ajuste

                    </label>

                    <select
                        name="tipo"
                        class="form-select">

                        <option value="entrada">

                            Entrada

                        </option>

                        <option value="salida">

                            Salida

                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Cantidad

                    </label>

                    <input
                        type="number"
                        min="1"
                        name="cantidad"
                        required
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Motivo

                    </label>

                    <input
                        type="text"
                        name="motivo"
                        required
                        class="form-control">

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
                    class="btn btn-warning">

                    Guardar ajuste

                </button>

            </form>

        </div>

    </div>

</div>
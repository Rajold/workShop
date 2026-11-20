<?php
require_once __DIR__ . '/../models/RepairCase.php';
require_once __DIR__ . '/../models/Avance.php';
require_once __DIR__ . '/../models/WorkSession.php';
require_once __DIR__ . '/../models/CasePurchase.php';
require_once __DIR__ . '/../models/MovimientoFinanciero.php';

class CaseController
{
    private PDO $pdo;
    private RepairCase $caseModel;
    private Avance $avanceModel;
    private CasePurchase $casePurchaseModel;
    private MovimientoFinanciero $movimientoModel;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->pdo = $pdo;
        $this->caseModel = new RepairCase($pdo);
        $this->avanceModel = new Avance($pdo);
        $this->casePurchaseModel = new CasePurchase($pdo);
        $this->movimientoModel = new MovimientoFinanciero($pdo);
    }

    private function ensureLogged(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    // Mostrar detalles del caso y formulario de avances
    // Mostrar detalles del caso, avances, pagos e historial
    public function ver(): void
    {
        $this->ensureLogged();

        if (empty($_GET['id'])) {
            echo "ID de caso no especificado";
            return;
        }

        $id = (int) $_GET['id'];

        $caso = $this->caseModel->findById($id);

        if (!$caso) {
            echo "Caso no encontrado";
            return;
        }

        $avances = $this->avanceModel->getByCase($id);

        $historial = $this->caseModel->getHistoryByVehicleId(
            (int) $caso['vehiculo_id']
        );

        // Cuentas activas para recibir abonos
        $cuentasPago = $this->movimientoModel->cuentas();

        // Historial de pagos de esta reparación
        $stmt = $this->pdo->prepare("
        SELECT
            p.id,
            p.monto,
            p.fecha_pago,
            p.observacion,
            c.nombre AS cuenta_nombre,
            u.nombre AS usuario_nombre
        FROM pagos_casos p
        INNER JOIN cuentas_financieras c
            ON c.id = p.cuenta_id
        INNER JOIN usuarios u
            ON u.id = p.registrado_por
        WHERE p.caso_id = :caso_id
        ORDER BY p.fecha_pago DESC, p.id DESC
    ");

        $stmt->execute([':caso_id' => $id]);

        $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total abonado
        $totalPagado = 0.0;

        foreach ($pagos as $pago) {
            $totalPagado += (float) $pago['monto'];
        }

        // Valor neto y saldo pendiente
        $valorNeto = null;
        $saldoPendiente = null;

        if ($caso['estado'] === 'cerrado') {
            $valorNeto =
                (float) $caso['precio_cobrado']
                - (float) $caso['descuento'];

            $saldoPendiente = $valorNeto - $totalPagado;
        }

        // Token para evitar que un mismo envío se procese dos veces
        $tokenPago = bin2hex(random_bytes(16));

        require __DIR__ . '/../views/casos/ver.php';
    }


    // Guardar nuevo avance
    public function add(): void
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caso_id = (int)$_POST['caso_id'];
            $descripcion = trim($_POST['descripcion']);

            $this->avanceModel->add($caso_id, $_SESSION['user_id'], $descripcion);

            header('Location: index.php?controller=case&action=ver&id=' . $caso_id);
            exit;
        }

        echo "Error al procesar el avance";
    }

    //  Cerrar caso
    public function cerrar(): void
    {
        $this->ensureLogged();

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST' ||
            empty($_POST['caso_id'])
        ) {
            echo "<div class='alert alert-danger'>Solicitud inválida.</div>";
            return;
        }

        $caseId = (int) $_POST['caso_id'];
        $mechanicId = (int) ($_SESSION['user_id'] ?? 0);

        $precioCobrado = (int) ($_POST['precio_cobrado'] ?? 0);
        $descuento = (int) ($_POST['descuento'] ?? 0);

        // 1. Validar datos económicos
        if ($caseId <= 0 || $mechanicId <= 0) {
            echo "<div class='alert alert-danger'>El caso o el usuario no son válidos.</div>";
            return;
        }

        if ($precioCobrado < 0) {
            echo "<div class='alert alert-danger'>El precio cobrado no puede ser negativo.</div>";
            return;
        }

        if ($descuento < 0 || $descuento > $precioCobrado) {
            echo "<div class='alert alert-danger'>El descuento no es válido.</div>";
            return;
        }

        try {
            $this->pdo->beginTransaction();

            // 2. Obtener el vehículo y comprobar que el caso siga abierto
            $stmt = $this->pdo->prepare("
            SELECT vehiculo_id
            FROM casos
            WHERE id = :id
              AND estado = 'abierto'
            LIMIT 1
            FOR UPDATE
        ");

            $stmt->execute([
                ':id' => $caseId
            ]);

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (
                !$resultado ||
                empty($resultado['vehiculo_id']) ||
                (int) $resultado['vehiculo_id'] <= 0
            ) {
                $this->pdo->rollBack();

                echo "<div class='alert alert-danger'>
                El caso no existe, ya está cerrado o no tiene un vehículo válido asociado.
            </div>";
                return;
            }

            $vehiculoId = (int) $resultado['vehiculo_id'];

            // 3. Calcular el costo de los repuestos del inventario
            $stmt = $this->pdo->prepare("
            SELECT COALESCE(
                SUM(cantidad * costo_unitario),
                0
            )
            FROM caso_repuestos
            WHERE caso_id = :caso_id
        ");

            $stmt->execute([
                ':caso_id' => $caseId
            ]);

            $costoRepuestosInventario = (float) $stmt->fetchColumn();

            // 4. Calcular el costo de las compras directas del caso
            $stmt = $this->pdo->prepare("
            SELECT COALESCE(
                SUM(cantidad * costo_unitario),
                0
            )
            FROM compras_caso
            WHERE caso_id = :caso_id
        ");

            $stmt->execute([
                ':caso_id' => $caseId
            ]);

            $costoComprasDirectas = (float) $stmt->fetchColumn();

            // 5. Calcular el costo total de los repuestos
            $costoTotalRepuestos =
                $costoRepuestosInventario +
                $costoComprasDirectas;

            // 6. Calcular el ingreso neto y la utilidad bruta
            $ingresoReal = $precioCobrado - $descuento;

            // Comprobar que los anticipos no superen el valor neto
            $stmt = $this->pdo->prepare("
    SELECT COALESCE(SUM(monto), 0)
    FROM pagos_casos
    WHERE caso_id = :caso_id
");

            $stmt->execute([':caso_id' => $caseId]);

            $totalAbonado = (float) $stmt->fetchColumn();

            if ($totalAbonado > $ingresoReal) {
                throw new RuntimeException(
                    'No se puede cerrar la reparación: los anticipos recibidos '
                        . 'superan el valor neto que se va a cobrar.'
                );
            }

            $utilidad = $ingresoReal - $costoTotalRepuestos;

            // 7. Cerrar el caso y guardar los valores económicos
            $stmt = $this->pdo->prepare("
            UPDATE casos
            SET
                estado = 'cerrado',
                precio_cobrado = :precio,
                descuento = :descuento,
                utilidad = :utilidad,
                fecha_cierre = NOW(),
                cerrado_por = :cerrado_por
            WHERE id = :id
              AND estado = 'abierto'
        ");

            $stmt->execute([
                ':precio' => $precioCobrado,
                ':descuento' => $descuento,
                ':utilidad' => $utilidad,
                ':cerrado_por' => $mechanicId,
                ':id' => $caseId
            ]);

            if ($stmt->rowCount() !== 1) {
                throw new RuntimeException(
                    'No se pudo cerrar el caso. Verifica si ya fue cerrado.'
                );
            }

            // 8. Finalizar la sesión de trabajo activa, si existe
            $workSession = new WorkSession($this->pdo);

            $active = $workSession->getActiveByCaseAndMechanic(
                $caseId,
                $mechanicId
            );

            if ($active) {
                $workSession->end((int) $active['id']);
            }

            // 9. Registrar el avance automático del cierre
            $this->avanceModel->add(
                $caseId,
                $mechanicId,
                'Caso cerrado por el mecánico.',
                'Mano de obra',
                0
            );

            // 10. Confirmar todos los cambios
            $this->pdo->commit();

            // 11. Volver a la pantalla del caso
            header(
                'Location: index.php?controller=mechanic&action=viewCase&case_id='
                    . $caseId
                    . '&veh_id='
                    . $vehiculoId
            );

            exit;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            error_log(
                'Error al cerrar el caso #' . $caseId . ': ' . $e->getMessage()
            );

            echo "<div class='alert alert-danger'>
            Ocurrió un error al cerrar el caso. Revisa el registro de errores del servidor.
        </div>";
        }
    }

    // 🔓 Reabrir un caso cerrado
    public function reabrir(): void
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error_message'] = 'Solicitud inválida.';
            header('Location: index.php');
            exit;
        }

        $caseId = (int)($_POST['caso_id'] ?? 0);
        $mechanicId = (int)$_SESSION['user_id'];

        $motivo = trim($_POST['motivo'] ?? '');
        $comentario = trim($_POST['comentario'] ?? '');

        if ($caseId <= 0) {
            $_SESSION['error_message'] = 'Caso no válido.';
            header('Location: index.php');
            exit;
        }

        if ($motivo === '') {
            $_SESSION['error_message'] = 'Debe indicar el motivo de la reapertura.';
            header(
                "Location: index.php?controller=mechanic&action=viewCase&case_id={$caseId}"
            );
            exit;
        }

        // Obtener el caso para conocer el vehículo
        $caso = $this->caseModel->findById($caseId);

        if (!$caso) {
            $_SESSION['error_message'] = 'El caso no existe.';
            header('Location: index.php');
            exit;
        }

        try {

            $this->caseModel->reabrir(
                $caseId,
                $mechanicId,
                $motivo,
                $comentario
            );

            $_SESSION['success_message'] =
                'El caso #' . $caseId . ' fue reabierto correctamente.';
        } catch (Throwable $e) {

            $_SESSION['error_message'] = $e->getMessage();
        }

        header(
            "Location: index.php?controller=mechanic" .
                "&action=viewCase" .
                "&veh_id={$caso['vehiculo_id']}" .
                "&case_id={$caseId}"
        );

        exit;
    }

    // 🆕 Crear un nuevo caso desde uno cerrado
    public function nuevoDesdeExistente(): void
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vehiculo_id = (int)($_POST['vehiculo_id'] ?? 0);
            $referencia_anterior = (int)($_POST['referencia_anterior'] ?? 0);
            $tipo_ingreso = $_POST['tipo_ingreso'] ?? '';
            $motivo_ingreso = trim($_POST['motivo_ingreso'] ?? '');
            $observaciones = trim($_POST['observaciones'] ?? '');

            $mecanico_id = (int)$_SESSION['user_id'];

            // Validaciones básicas
            if (!$vehiculo_id || !$referencia_anterior || !$motivo_ingreso) {

                $_SESSION['error_message'] = "Debe indicar el motivo del nuevo ingreso.";

                header(
                    "Location: index.php?controller=mechanic&action=viewCase" .
                        "&veh_id={$vehiculo_id}&case_id={$referencia_anterior}"
                );

                exit;
            }

            // 1️⃣ Verificar si el vehículo ya tiene un caso abierto
            $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM casos
            WHERE vehiculo_id = :vehiculo_id
            AND estado = 'abierto'
        ");

            $stmt->execute([
                'vehiculo_id' => $vehiculo_id
            ]);

            $abiertos = (int)$stmt->fetchColumn();

            if ($abiertos > 0) {

                $_SESSION['error_message'] =
                    "El vehículo ya tiene un caso abierto. Debe cerrarse antes de crear uno nuevo.";

                header(
                    "Location: index.php?controller=mechanic&action=viewCase" .
                        "&veh_id={$vehiculo_id}&case_id={$referencia_anterior}"
                );

                exit;
            }

            // 2️⃣ Obtener información del caso anterior
            $stmt = $this->pdo->prepare("
            SELECT causa, diagnostico, observaciones
            FROM casos
            WHERE id = :id
        ");

            $stmt->execute([
                'id' => $referencia_anterior
            ]);

            $anterior = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$anterior) {

                $_SESSION['error_message'] = "El caso anterior no existe.";

                header(
                    "Location: index.php?controller=mechanic&action=viewCase" .
                        "&veh_id={$vehiculo_id}&case_id={$referencia_anterior}"
                );

                exit;
            }

            /*
         * 3️⃣ Determinar si el nuevo caso continúa el anterior
         *
         * Si es una falla diferente, el nuevo caso es independiente.
         * Si es una continuación, conservamos la referencia mediante
         * las observaciones del nuevo caso.
         */

            if ($tipo_ingreso === 'relacionado') {

                $observacionesCaso = "Continuación del caso #{$referencia_anterior}";

                if ($observaciones !== '') {
                    $observacionesCaso .= ". " . $observaciones;
                }
            } else {

                $observacionesCaso = $observaciones;
            }

            // 4️⃣ Crear el nuevo caso
            $stmt = $this->pdo->prepare("
    INSERT INTO casos
    (
        vehiculo_id,
        mecanico_id,
        causa,
        diagnostico,
        observaciones,
        estado,
        fecha_ingreso,
        hora_ingreso
    )
    VALUES
    (
        :vehiculo_id,
        :mecanico_id,
        :causa,
        :diagnostico,
        :observaciones,
        'abierto',
        CURDATE(),
        CURTIME()
    )
");


            $stmt->execute([
                'vehiculo_id' => $vehiculo_id,
                'mecanico_id' => $mecanico_id,
                'causa' => $motivo_ingreso,
                'diagnostico' => '',
                'observaciones' => $observacionesCaso
            ]);

            $nuevoCasoId = (int)$this->pdo->lastInsertId();

            // 5️⃣ Registrar avance automático
            $descripcionAvance = "🆕 Caso creado";

            if ($tipo_ingreso === 'relacionado') {
                $descripcionAvance .=
                    " como continuación del caso anterior #{$referencia_anterior}";
            } else {
                $descripcionAvance .=
                    " por falla o servicio diferente";
            }

            $this->avanceModel->add(
                $nuevoCasoId,
                $mecanico_id,
                $descripcionAvance,
                'Mano de obra',
                0
            );

            // 6️⃣ Redirigir al nuevo caso
            header(
                "Location: index.php?controller=mechanic&action=viewCase" .
                    "&veh_id={$vehiculo_id}&case_id={$nuevoCasoId}"
            );

            exit;
        }

        echo "Solicitud inválida.";
    }


public function registrarCompraDirecta(): void
{
    $this->ensureLogged();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['error_message'] = 'Solicitud inválida.';
        header('Location: index.php');
        exit;
    }

    $caseId = (int)($_POST['caso_id'] ?? 0);

    $descripcion = trim($_POST['descripcion'] ?? '');
    $proveedor = trim($_POST['proveedor'] ?? '');
    $observacion = trim($_POST['observacion'] ?? '');

    $cantidad = (float)($_POST['cantidad'] ?? 0);
    $costoUnitario = (float)($_POST['costo_unitario'] ?? 0);
    $precioUnitario = (float)($_POST['precio_unitario'] ?? 0);

    $usuarioId = (int)$_SESSION['user_id'];

    if (
        $caseId <= 0 ||
        $descripcion === '' ||
        !is_finite($cantidad) ||
        !is_finite($costoUnitario) ||
        !is_finite($precioUnitario) ||
        $cantidad <= 0 ||
        $costoUnitario < 0 ||
        $precioUnitario < 0
    ) {
        $_SESSION['error_message'] =
            'Debe completar correctamente los datos de la compra.';

        header('Location: index.php');
        exit;
    }

    $vehiculoId = 0;

    try {

        /*
         * Las columnas cantidad y costo_unitario son DECIMAL(10,2).
         * Calculamos el costo con la misma precisión que se almacenará.
         */
        $cantidad = round($cantidad, 2);
        $costoUnitario = round($costoUnitario, 2);

        $costoTotal = round($cantidad * $costoUnitario, 2);

        /*
         * Obtener las fuentes de financiación enviadas por el formulario.
         */
        $financiacion = $_POST['financiacion'] ?? null;

        if (!is_array($financiacion) || empty($financiacion)) {
            throw new RuntimeException(
                'Debe indicar cómo se financiará la compra.'
            );
        }

        /*
         * Validar y normalizar cada fuente.
         */
        $fuentes = [];
        $totalFinanciado = 0;

        foreach ($financiacion as $fila) {

            if (!is_array($fila)) {
                throw new RuntimeException(
                    'Los datos de financiación no son válidos.'
                );
            }

            $origen = trim($fila['origen'] ?? '');

            $montoTexto = trim((string)($fila['monto'] ?? ''));

            if (!is_numeric($montoTexto)) {
                throw new RuntimeException(
                    'Debe indicar un monto válido para cada fuente.'
                );
            }

            $monto = (float)$montoTexto;

            if (!is_finite($monto) || $monto <= 0) {
                throw new RuntimeException(
                    'Todos los montos de financiación deben ser mayores que cero.'
                );
            }

            $montoCentavos = (int)round($monto * 100);

            if ($montoCentavos <= 0) {
                throw new RuntimeException(
                    'El monto de financiación es demasiado pequeño.'
                );
            }

            if (!in_array(
                $origen,
                ['caja', 'banco', 'personal', 'credito'],
                true
            )) {
                throw new RuntimeException(
                    'La fuente de financiación seleccionada no es válida.'
                );
            }

            $cuentaId = null;

            if ($origen === 'caja' || $origen === 'banco') {

                $cuentaId = (int)($fila['cuenta_id'] ?? 0);

                if ($cuentaId <= 0) {
                    throw new RuntimeException(
                        'Debe seleccionar una cuenta para Caja o Banco.'
                    );
                }

                /*
                 * Verificar que la cuenta corresponda al origen elegido.
                 */
                $stmtCuenta = $this->pdo->prepare("
                    SELECT id
                    FROM cuentas_financieras
                    WHERE id = :id
                      AND tipo = :tipo
                      AND activa = 1
                ");

                $stmtCuenta->execute([
                    ':id' => $cuentaId,
                    ':tipo' => $origen
                ]);

                if (!$stmtCuenta->fetchColumn()) {
                    throw new RuntimeException(
                        'La cuenta seleccionada no corresponde al medio de financiación.'
                    );
                }
            }

            $totalFinanciado += $montoCentavos;

            $fuentes[] = [
                'origen' => $origen,
                'cuenta_id' => $cuentaId,
                'monto_centavos' => $montoCentavos,
                'observacion' => trim($fila['observacion'] ?? '')
            ];
        }

        /*
         * La suma de las fuentes debe coincidir exactamente
         * con el costo real de adquisición.
         */
        $costoCentavos = (int)round($costoTotal * 100);

        if ($totalFinanciado !== $costoCentavos) {
            throw new RuntimeException(
                'La financiación debe sumar exactamente el costo de adquisición: $' .
                number_format($costoTotal, 2, ',', '.')
            );
        }

        /*
         * Iniciar transacción.
         */
        $this->pdo->beginTransaction();

        /*
         * Bloquear el caso para impedir registrar compras
         * si fue cerrado mientras se procesaba la solicitud.
         */
        $stmtCaso = $this->pdo->prepare("
            SELECT id, vehiculo_id, estado
            FROM casos
            WHERE id = :id
            FOR UPDATE
        ");

        $stmtCaso->execute([
            ':id' => $caseId
        ]);

        $caso = $stmtCaso->fetch(PDO::FETCH_ASSOC);

        if (!$caso) {
            throw new RuntimeException('El caso no existe.');
        }

        $vehiculoId = (int)$caso['vehiculo_id'];

        if ($caso['estado'] !== 'abierto') {
            throw new RuntimeException(
                'No se pueden registrar compras directas en un caso cerrado.'
            );
        }

        /*
         * Registrar la compra directa.
         */
        $compraId = $this->casePurchaseModel->add([
            'caso_id' => $caseId,
            'usuario_id' => $usuarioId,
            'descripcion' => $descripcion,
            'proveedor' => $proveedor,
            'cantidad' => $cantidad,
            'costo_unitario' => $costoUnitario,
            'precio_unitario' => $precioUnitario,
            'observacion' => $observacion
        ]);

        /*
         * Preparar inserción de fuentes de financiación.
         */
        $stmtFinanciacion = $this->pdo->prepare("
            INSERT INTO financiacion_compras_caso
            (
                compra_id,
                origen,
                cuenta_id,
                movimiento_id,
                monto,
                usuario_id,
                fecha_registro,
                observacion
            )
            VALUES
            (
                :compra_id,
                :origen,
                :cuenta_id,
                :movimiento_id,
                :monto,
                :usuario_id,
                NOW(),
                :observacion
            )
        ");

        /*
         * Registrar cada fuente.
         */
        foreach ($fuentes as $fuente) {

            $movimientoId = null;

            /*
             * Caja y Banco representan dinero que sale realmente
             * de las cuentas del taller en el momento de la compra.
             */
            if (
                $fuente['origen'] === 'caja' ||
                $fuente['origen'] === 'banco'
            ) {

                $monto = $fuente['monto_centavos'] / 100;

                $movimientoId = $this->movimientoModel->registrar(
                    $fuente['cuenta_id'],
                    'egreso',
                    'salida',
                    $monto,
                    'Compra directa: ' . $descripcion,
                    $usuarioId,
                    $caseId,
                    'Caso #' . $caseId,
                    null,
                    'compra_caso:' . $compraId
                );
            }

            /*
             * Personal y Crédito proveedor no generan egresos
             * en este momento. Se registra la obligación pendiente.
             */
            $stmtFinanciacion->execute([
                ':compra_id' => $compraId,
                ':origen' => $fuente['origen'],
                ':cuenta_id' => $fuente['cuenta_id'],
                ':movimiento_id' => $movimientoId,
                ':monto' => $fuente['monto_centavos'] / 100,
                ':usuario_id' => $usuarioId,
                ':observacion' => $fuente['observacion'] !== ''
                    ? $fuente['observacion']
                    : null
            ]);
        }

        /*
         * Confirmar compra, financiación y movimientos juntos.
         */
        $this->pdo->commit();

        $_SESSION['success_message'] =
            'Compra directa y financiación registradas correctamente.';

    } catch (Throwable $e) {

        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }

        error_log(
            'Error registrando compra directa: ' . $e->getMessage()
        );

        $_SESSION['error_message'] =
            'No fue posible registrar la compra: ' . $e->getMessage();
    }

    /*
     * Regresar a la vista del caso.
     */
    if ($vehiculoId > 0) {

        header(
            'Location: index.php?controller=mechanic&action=viewCase' .
            '&veh_id=' . $vehiculoId .
            '&case_id=' . $caseId
        );

    } else {

        header('Location: index.php');
    }

    exit;
}


    public function imprimir(): void
    {
        $this->ensureLogged();

        $caseId = (int)($_GET['case_id'] ?? 0);

        if (!$caseId) {
            die("Caso no válido.");
        }

        require_once __DIR__ . '/../models/Avance.php';
        require_once __DIR__ . '/../pdf/CasePdf.php';

        $avanceModel = new Avance($this->pdo);

        require_once __DIR__ . '/../models/CasePart.php';

        $casePartModel = new CasePart($this->pdo);

        require_once __DIR__ . '/../models/CasePurchase.php';

        $casePurchaseModel = new CasePurchase($this->pdo);

        $caso = $this->caseModel->findById($caseId);
        $avances = $avanceModel->getByCase($caseId);
        $totales = $avanceModel->getTotalesPorCaso($caseId);
        $caseParts = $casePartModel->findByCase($caseId);
        $casePurchases = $casePurchaseModel->findByCase($caseId);

        $pdf = new CasePdf();

        $pdf->AliasNbPages();

        $pdf->generate(
            $caso,
            $avances,
            $totales,
            $caseParts,
            $casePurchases
        );
    }

    // Registrar un abono del cliente
    public function pagar(): void
    {
        $this->ensureLogged();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Solicitud inválida.";
            return;
        }

        $caseId = (int) ($_POST['caso_id'] ?? 0);
        $cuentaId = (int) ($_POST['cuenta_id'] ?? 0);
        $usuarioId = (int) ($_SESSION['user_id'] ?? 0);

        $montoTexto = trim($_POST['monto'] ?? '');
        $montoTexto = str_replace(',', '.', $montoTexto);

        $observacion = trim($_POST['observacion'] ?? '');
        $token = trim($_POST['token_pago'] ?? '');

        // Validaciones iniciales
        if (
            $caseId <= 0 ||
            $cuentaId <= 0 ||
            $usuarioId <= 0
        ) {
            echo "Los datos del pago no son válidos.";
            return;
        }

        if (!preg_match('/^\d+(?:\.\d{1,2})?$/', $montoTexto)) {
            echo "El monto del abono no es válido.";
            return;
        }

        $monto = (float) $montoTexto;
        $montoCentavos = (int) round($monto * 100);

        if ($montoCentavos <= 0) {
            echo "El abono debe ser mayor que cero.";
            return;
        }

        if (strlen($observacion) > 255) {
            echo "La observación no puede superar 255 caracteres.";
            return;
        }

        if (!preg_match('/^[a-f0-9]{32}$/', $token)) {
            echo "El identificador de la operación no es válido.";
            return;
        }

        $vehiculoId = (int) ($_POST['veh_id'] ?? 0);

        try {
            $this->pdo->beginTransaction();

            // Bloquear el caso mientras se procesa el abono
            $stmt = $this->pdo->prepare("
            SELECT
                id,
                vehiculo_id,
                estado,
                precio_cobrado,
                descuento
            FROM casos
            WHERE id = :id
            FOR UPDATE
        ");

            $stmt->execute([':id' => $caseId]);

            $caso = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$caso) {
                throw new RuntimeException(
                    'La reparación no existe.'
                );
            }

            $vehiculoId = (int) $caso['vehiculo_id'];

            // Comprobar si este mismo envío ya fue procesado
            $referencia = 'PAGO-' . $token;

            $stmt = $this->pdo->prepare("
            SELECT id
            FROM movimientos_financieros
            WHERE referencia = :referencia
            LIMIT 1
        ");

            $stmt->execute([':referencia' => $referencia]);

            if ($stmt->fetchColumn()) {
                $this->pdo->commit();

                header(
                    'Location: index.php?controller=mechanic&action=viewCase&case_id='
                        . $caseId . '&veh_id=' . $vehiculoId
                );
                exit;
            }

            // Calcular los abonos anteriores
            $stmt = $this->pdo->prepare("
            SELECT COALESCE(SUM(monto), 0)
            FROM pagos_casos
            WHERE caso_id = :caso_id
        ");

            $stmt->execute([':caso_id' => $caseId]);

            $totalPagadoCentavos = (int) round(
                (float) $stmt->fetchColumn() * 100
            );

            // Si está cerrado, comprobar el saldo pendiente
            if ($caso['estado'] === 'cerrado') {
                $valorNetoCentavos = (
                    (int) $caso['precio_cobrado']
                    - (int) $caso['descuento']
                ) * 100;

                $saldoCentavos =
                    $valorNetoCentavos - $totalPagadoCentavos;

                if ($saldoCentavos <= 0) {
                    throw new RuntimeException(
                        'Esta reparación ya está completamente pagada.'
                    );
                }

                if ($montoCentavos > $saldoCentavos) {
                    throw new RuntimeException(
                        'El abono supera el saldo pendiente de la reparación.'
                    );
                }
            }

            // Registrar el ingreso en Caja o Banco
            $movimientoId = $this->movimientoModel->registrar(
                $cuentaId,
                'ingreso',
                'entrada',
                $montoCentavos / 100,
                'Abono de reparación #' . $caseId,
                $usuarioId,
                $caseId,
                'Caso #' . $caseId,
                null,
                $referencia
            );

            // Registrar el pago asociado al movimiento financiero
            $stmt = $this->pdo->prepare("
            INSERT INTO pagos_casos (
                caso_id,
                caso_referencia,
                monto,
                cuenta_id,
                registrado_por,
                movimiento_id,
                observacion
            ) VALUES (
                :caso_id,
                :caso_referencia,
                :monto,
                :cuenta_id,
                :registrado_por,
                :movimiento_id,
                :observacion
            )
        ");

            $stmt->execute([
                ':caso_id' => $caseId,
                ':caso_referencia' => 'Caso #' . $caseId,
                ':monto' => number_format($montoCentavos / 100, 2, '.', ''),
                ':cuenta_id' => $cuentaId,
                ':registrado_por' => $usuarioId,
                ':movimiento_id' => $movimientoId,
                ':observacion' => $observacion !== ''
                    ? $observacion
                    : null,
            ]);

            // Confirmar ambas operaciones
            $this->pdo->commit();

            header(
                'Location: index.php?controller=mechanic&action=viewCase&case_id='
                    . $caseId . '&veh_id=' . $vehiculoId
            );
            exit;
        } catch (Throwable $e) {

            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            error_log(
                'Error al registrar pago del caso #'
                    . $caseId . ': ' . $e->getMessage()
            );

            $_SESSION['error_message'] = $e->getMessage();

            header(
                'Location: index.php?controller=mechanic&action=viewCase&case_id='
                    . $caseId . '&veh_id=' . $vehiculoId
            );
            exit;
        }
    }
}

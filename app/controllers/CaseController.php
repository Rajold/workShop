<?php
require_once __DIR__ . '/../models/RepairCase.php';
require_once __DIR__ . '/../models/Avance.php';
require_once __DIR__ . '/../models/WorkSession.php';
require_once __DIR__ . '/../models/CasePurchase.php';

class CaseController
{
    private PDO $pdo;
    private RepairCase $caseModel;
    private Avance $avanceModel;
    private CasePurchase $casePurchaseModel;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->pdo = $pdo;
        $this->caseModel = new RepairCase($pdo);
        $this->avanceModel = new Avance($pdo);
        $this->casePurchaseModel = new CasePurchase($pdo);
    }

    private function ensureLogged(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    // Mostrar detalles del caso y formulario de avances
    public function ver(): void
    {
        $this->ensureLogged();

        if (empty($_GET['id'])) {
            echo "ID de caso no especificado";
            return;
        }

        $id = (int)$_GET['id'];
        $caso = $this->caseModel->findById($id);
        $avances = $this->avanceModel->getByCase($id);

        if (!$caso) {
            echo "Caso no encontrado";
            return;
        }

        // ✅ Obtener el historial de casos del mismo vehículo
        $historial = $this->caseModel->getHistoryByVehicleId((int)$caso['vehiculo_id']);

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

    // ✅ Cerrar caso
    // ✅ Cerrar caso
public function cerrar(): void
{
    $this->ensureLogged();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['caso_id'])) {
        echo "<div class='alert alert-danger'>Solicitud inválida.</div>";
        return;
    }

    $caseId = (int)$_POST['caso_id'];
    $mechanicId = (int)$_SESSION['user_id'];

    $precioCobrado = (int)($_POST['precio_cobrado'] ?? 0);
    $descuento = (int)($_POST['descuento'] ?? 0);

    // Validaciones económicas
    if ($precioCobrado < 0) {
        echo "<div class='alert alert-danger'>El precio cobrado no puede ser negativo.</div>";
        return;
    }

    if ($descuento < 0) {
        echo "<div class='alert alert-danger'>El descuento no puede ser negativo.</div>";
        return;
    }

    if ($descuento > $precioCobrado) {
        echo "<div class='alert alert-danger'>El descuento no puede ser mayor que el precio cobrado.</div>";
        return;
    }

    // 🔍 Obtener el caso y el vehículo asociado
    $stmt = $this->pdo->prepare("
        SELECT vehiculo_id
        FROM casos
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $caseId
    ]);

    $vehiculoId = $stmt->fetchColumn();

    if (!$vehiculoId) {
        echo "<div class='alert alert-danger'>No se encontró el vehículo asociado al caso.</div>";
        return;
    }

    /*
     * ==========================================================
     * CÁLCULO ECONÓMICO DEL CASO
     * ==========================================================
     *
     * La mano de obra es ingreso, no costo.
     *
     * El costo real del caso está compuesto por:
     *
     * 1. Costo de los repuestos provenientes del inventario.
     * 2. Costo de las compras directas realizadas para el caso.
     *
     * La utilidad se calcula:
     *
     * ingreso real - costo de repuestos
     */

    // 🧾 Costo de repuestos provenientes del inventario
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

    $costoRepuestosInventario = (float)$stmt->fetchColumn();


    // 🛒 Costo de compras directas realizadas para el caso
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

    $costoComprasDirectas = (float)$stmt->fetchColumn();


    // 💰 Costo total real de repuestos
    $costoTotalRepuestos =
        $costoRepuestosInventario +
        $costoComprasDirectas;


    // 💵 Ingreso realmente recibido
    $ingresoReal =
        $precioCobrado -
        $descuento;


    // 📈 Utilidad bruta del caso
    $utilidad =
        $ingresoReal -
        $costoTotalRepuestos;


    // 🕓 Finalizar sesión activa si existe
    $workSession = new WorkSession($this->pdo);

    $active = $workSession->getActiveByCaseAndMechanic(
        $caseId,
        $mechanicId
    );

    if ($active) {
        $workSession->end((int)$active['id']);
    }


    // ==========================================================
    // Cerrar caso y guardar información económica
    // ==========================================================

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
    ");

    $stmt->execute([
        ':precio' => $precioCobrado,
        ':descuento' => $descuento,
        ':utilidad' => $utilidad,
        ':cerrado_por' => $mechanicId,
        ':id' => $caseId
    ]);


    // 📝 Registrar avance automático
    $this->avanceModel->add(
        $caseId,
        $mechanicId,
        '✅ Caso cerrado por el mecánico.',
        'Mano de obra',
        0
    );


    // 🔁 Redirigir correctamente
    header(
        'Location: index.php?controller=mechanic&action=viewCase&case_id='
        . $caseId
        . '&veh_id='
        . $vehiculoId
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
                fecha_ingreso
            )
            VALUES
            (
                :vehiculo_id,
                :mecanico_id,
                :causa,
                :diagnostico,
                :observaciones,
                'abierto',
                NOW()
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

    /*
     * Primero verificamos que el caso exista.
     * De esta forma obtenemos también el vehículo asociado
     * y podemos conservar correctamente la ficha seleccionada
     * al regresar a la vista.
     */
    $caso = $this->caseModel->findById($caseId);

    if (!$caso) {
        $_SESSION['error_message'] = 'El caso no existe.';
        header('Location: index.php');
        exit;
    }

    $vehiculoId = (int)$caso['vehiculo_id'];

    /*
     * Validar datos recibidos
     */
    if (
        $caseId <= 0 ||
        $descripcion === '' ||
        $cantidad <= 0 ||
        $costoUnitario < 0 ||
        $precioUnitario < 0
    ) {
        $_SESSION['error_message'] =
            'Debe completar correctamente los datos de la compra directa.';

        header(
            'Location: index.php?controller=mechanic&action=viewCase' .
            '&veh_id=' . $vehiculoId .
            '&case_id=' . $caseId
        );
        exit;
    }

    /*
     * El caso debe estar abierto para registrar una compra directa.
     */
    if ($caso['estado'] !== 'abierto') {
        $_SESSION['error_message'] =
            'No se pueden registrar compras directas en un caso cerrado.';

        header(
            'Location: index.php?controller=mechanic&action=viewCase' .
            '&veh_id=' . $vehiculoId .
            '&case_id=' . $caseId
        );
        exit;
    }

    try {

        $this->casePurchaseModel->add([
            'caso_id' => $caseId,
            'usuario_id' => (int)$_SESSION['user_id'],
            'descripcion' => $descripcion,
            'proveedor' => $proveedor,
            'cantidad' => $cantidad,
            'costo_unitario' => $costoUnitario,
            'precio_unitario' => $precioUnitario,
            'observacion' => $observacion
        ]);

        $_SESSION['success_message'] =
            'Compra directa registrada correctamente.';

    } catch (Throwable $e) {

        $_SESSION['error_message'] =
            'No fue posible registrar la compra directa.';
    }

    /*
     * Regresar conservando tanto el vehículo como el caso.
     */
    header(
        'Location: index.php?controller=mechanic&action=viewCase' .
        '&veh_id=' . $vehiculoId .
        '&case_id=' . $caseId
    );
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

$caso = $this->caseModel->findById($caseId);
$avances = $avanceModel->getByCase($caseId);
$totales = $avanceModel->getTotalesPorCaso($caseId);
$caseParts = $casePartModel->findByCase($caseId);

$pdf = new CasePdf();

        $pdf->AliasNbPages();

        $pdf->generate(
    $caso,
    $avances,
    $totales,
    $caseParts
);
    }
}

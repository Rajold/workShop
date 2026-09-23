<?php

declare(strict_types=1);

class Dashboard
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getTotalVehiculos(): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM vehiculos")
            ->fetchColumn();
    }

    public function getCasosAbiertos(): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM casos WHERE estado = 'abierto'")
            ->fetchColumn();
    }

    public function getCasosCerrados(): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM casos WHERE estado = 'cerrado'")
            ->fetchColumn();
    }

    public function getTotalMecanicos(): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM usuarios WHERE rol = 'mecanico'")
            ->fetchColumn();
    }

    public function getFacturacionTotal(): float
    {
        return (float)$this->db
            ->query("
                SELECT COALESCE(
                    SUM(precio_cobrado - descuento),
                    0
                )
                FROM casos
                WHERE estado = 'cerrado'
            ")
            ->fetchColumn();
    }

    public function getFacturacionMes(): float
    {
        return (float)$this->db
            ->query("
            SELECT COALESCE(
                SUM(precio_cobrado - descuento),
                0
            )
            FROM casos
            WHERE estado = 'cerrado'
            AND YEAR(fecha_cierre) = YEAR(CURDATE())
            AND MONTH(fecha_cierre) = MONTH(CURDATE())
        ")
            ->fetchColumn();
    }

    public function getCasosMes(): int
    {
        return (int)$this->db
            ->query("
            SELECT COUNT(*)
            FROM casos
            WHERE estado = 'cerrado'
            AND YEAR(fecha_cierre) = YEAR(CURDATE())
            AND MONTH(fecha_cierre) = MONTH(CURDATE())
        ")
            ->fetchColumn();
    }

    public function getCostoRepuestosTotal(): float
    {
        $stmt = $this->db->query("
        SELECT COALESCE(SUM(costo), 0)
        FROM (
            SELECT
                SUM(cr.cantidad * cr.costo_unitario) AS costo
            FROM caso_repuestos cr
            INNER JOIN casos c
                ON c.id = cr.caso_id
            WHERE c.estado = 'cerrado'
            GROUP BY cr.caso_id

            UNION ALL

            SELECT
                SUM(cc.cantidad * cc.costo_unitario) AS costo
            FROM compras_caso cc
            INNER JOIN casos c
                ON c.id = cc.caso_id
            WHERE c.estado = 'cerrado'
            GROUP BY cc.caso_id
        ) AS costos
    ");

        return (float)$stmt->fetchColumn();
    }


    public function getCostoRepuestosMes(): float
    {
        $stmt = $this->db->query("
        SELECT COALESCE(SUM(costo), 0)
        FROM (
            SELECT
                SUM(cr.cantidad * cr.costo_unitario) AS costo
            FROM caso_repuestos cr
            INNER JOIN casos c
                ON c.id = cr.caso_id
            WHERE c.estado = 'cerrado'
              AND YEAR(c.fecha_cierre) = YEAR(CURDATE())
              AND MONTH(c.fecha_cierre) = MONTH(CURDATE())
            GROUP BY cr.caso_id

            UNION ALL

            SELECT
                SUM(cc.cantidad * cc.costo_unitario) AS costo
            FROM compras_caso cc
            INNER JOIN casos c
                ON c.id = cc.caso_id
            WHERE c.estado = 'cerrado'
              AND YEAR(c.fecha_cierre) = YEAR(CURDATE())
              AND MONTH(c.fecha_cierre) = MONTH(CURDATE())
            GROUP BY cc.caso_id
        ) AS costos
    ");

        return (float)$stmt->fetchColumn();
    }


    public function getUtilidadTotal(): float
    {
        return (float)$this->db
            ->query("
            SELECT COALESCE(
                SUM(utilidad),
                0
            )
            FROM casos
            WHERE estado = 'cerrado'
        ")
            ->fetchColumn();
    }


    public function getUtilidadMes(): float
    {
        return (float)$this->db
            ->query("
            SELECT COALESCE(
                SUM(utilidad),
                0
            )
            FROM casos
            WHERE estado = 'cerrado'
              AND YEAR(fecha_cierre) = YEAR(CURDATE())
              AND MONTH(fecha_cierre) = MONTH(CURDATE())
        ")
            ->fetchColumn();
    }

    /*
    |--------------------------------------------------------------------------
    | DATOS FINANCIEROS
    |--------------------------------------------------------------------------
    */

    /**
     * Venta de mano de obra de todos los casos cerrados.
     */
    public function getManoObraTotal(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(SUM(a.valor), 0)
            FROM avances a
            INNER JOIN casos c
                ON c.id = a.caso_id
            WHERE c.estado = 'cerrado'
              AND a.tipo = 'Mano de obra'
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Venta de mano de obra del mes actual.
     */
    public function getManoObraMes(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(SUM(a.valor), 0)
            FROM avances a
            INNER JOIN casos c
                ON c.id = a.caso_id
            WHERE c.estado = 'cerrado'
              AND a.tipo = 'Mano de obra'
              AND YEAR(c.fecha_cierre) = YEAR(CURDATE())
              AND MONTH(c.fecha_cierre) = MONTH(CURDATE())
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Venta de repuestos provenientes del inventario.
     */
    public function getVentaInventarioTotal(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(SUM(cr.subtotal), 0)
            FROM caso_repuestos cr
            INNER JOIN casos c
                ON c.id = cr.caso_id
            WHERE c.estado = 'cerrado'
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Costo de los repuestos provenientes del inventario.
     */
    public function getCostoInventarioTotal(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(
                SUM(cr.cantidad * cr.costo_unitario),
                0
            )
            FROM caso_repuestos cr
            INNER JOIN casos c
                ON c.id = cr.caso_id
            WHERE c.estado = 'cerrado'
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Ganancia obtenida por la venta de repuestos del inventario.
     */
    public function getGananciaInventarioTotal(): float
    {
        return
            $this->getVentaInventarioTotal()
            -
            $this->getCostoInventarioTotal();
    }


    /**
     * Venta de compras directas realizadas para casos.
     */
    public function getVentaComprasDirectasTotal(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(SUM(cc.subtotal), 0)
            FROM compras_caso cc
            INNER JOIN casos c
                ON c.id = cc.caso_id
            WHERE c.estado = 'cerrado'
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Costo de compras directas realizadas para casos.
     */
    public function getCostoComprasDirectasTotal(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(
                SUM(cc.cantidad * cc.costo_unitario),
                0
            )
            FROM compras_caso cc
            INNER JOIN casos c
                ON c.id = cc.caso_id
            WHERE c.estado = 'cerrado'
        ");

        return (float)$stmt->fetchColumn();
    }


    /**
     * Ganancia obtenida mediante compras directas.
     */
    public function getGananciaComprasDirectasTotal(): float
    {
        return
            $this->getVentaComprasDirectasTotal()
            -
            $this->getCostoComprasDirectasTotal();
    }


    /**
     * Venta total de repuestos.
     *
     * Inventario + compras directas.
     */
    public function getVentaRepuestosTotal(): float
    {
        return
            $this->getVentaInventarioTotal()
            +
            $this->getVentaComprasDirectasTotal();
    }


    /**
     * Costo total de repuestos.
     *
     * Inventario + compras directas.
     */
    public function getCostoRepuestosTotalCalculado(): float
    {
        return
            $this->getCostoInventarioTotal()
            +
            $this->getCostoComprasDirectasTotal();
    }


    /**
     * Ganancia total por venta de repuestos.
     */
    public function getGananciaRepuestosTotal(): float
    {
        return
            $this->getVentaRepuestosTotal()
            -
            $this->getCostoRepuestosTotalCalculado();
    }


    /**
     * Ingreso total real de los casos cerrados.
     *
     * Se obtiene desde precio cobrado - descuento.
     */
    public function getIngresoTotalReal(): float
    {
        return (float)$this->db
            ->query("
                SELECT COALESCE(
                    SUM(precio_cobrado - descuento),
                    0
                )
                FROM casos
                WHERE estado = 'cerrado'
            ")
            ->fetchColumn();
    }


    /**
     * Utilidad calculada a partir de los componentes financieros.
     *
     * Mano de obra se considera ingreso.
     * Los costos corresponden a repuestos.
     */
    public function getUtilidadCalculadaTotal(): float
    {
        return
            $this->getManoObraTotal()
            +
            $this->getGananciaRepuestosTotal();
    }

    public function getStats(): array
    {
        return [
            'totalVehiculos' => $this->getTotalVehiculos(),
            'casosAbiertos' => $this->getCasosAbiertos(),
            'casosCerrados' => $this->getCasosCerrados(),
            'totalMecanicos' => $this->getTotalMecanicos(),

            // =====================================================
            // INGRESOS
            // =====================================================

            'totalFacturado' =>
            $this->getFacturacionTotal(),

            'facturacionMes' =>
            $this->getFacturacionMes(),

            'manoObraTotal' =>
            $this->getManoObraTotal(),

            'manoObraMes' =>
            $this->getManoObraMes(),

            // =====================================================
            // REPUESTOS DE INVENTARIO
            // =====================================================

            'ventaInventarioTotal' =>
            $this->getVentaInventarioTotal(),

            'costoInventarioTotal' =>
            $this->getCostoInventarioTotal(),

            'gananciaInventarioTotal' =>
            $this->getGananciaInventarioTotal(),

            // =====================================================
            // COMPRAS DIRECTAS
            // =====================================================

            'ventaComprasDirectasTotal' =>
            $this->getVentaComprasDirectasTotal(),

            'costoComprasDirectasTotal' =>
            $this->getCostoComprasDirectasTotal(),

            'gananciaComprasDirectasTotal' =>
            $this->getGananciaComprasDirectasTotal(),

            // =====================================================
            // REPUESTOS EN GENERAL
            // =====================================================

            'ventaRepuestosTotal' =>
            $this->getVentaRepuestosTotal(),

            'costoRepuestosTotalCalculado' =>
            $this->getCostoRepuestosTotalCalculado(),

            'gananciaRepuestosTotal' =>
            $this->getGananciaRepuestosTotal(),

            // UTILIDAD


            'utilidadCalculadaTotal' =>
            $this->getUtilidadCalculadaTotal(),

            // Compatibilidad con la vista actual
            'costoRepuestosTotal' =>
            $this->getCostoRepuestosTotalCalculado(),

            'utilidadTotal' =>
            $this->getUtilidadCalculadaTotal(),

            'costoRepuestosMes' =>
            $this->getCostoRepuestosMes(),

            'utilidadMes' =>
            $this->getUtilidadMes(),

            // Actividad
            'casosMes' =>
            $this->getCasosMes(),

        ];
    }

    public function getRevenueStats(): array
    {
        $stmt = $this->db->query("
        SELECT
            COUNT(*) AS casos,
            COALESCE(SUM(precio_cobrado - descuento),0) AS total,
            COALESCE(AVG(precio_cobrado - descuento),0) AS promedio,
            COALESCE(MAX(precio_cobrado - descuento),0) AS mayor
        FROM casos
        WHERE estado='cerrado'
    ");

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMechanicStats(): array
    {
        $stmt = $this->db->query("
        SELECT
            u.nombre,
            COUNT(c.id) AS casos
        FROM usuarios u
        LEFT JOIN casos c
            ON c.mecanico_id = u.id
            AND c.estado='cerrado'
        WHERE u.rol='mecanico'
        GROUP BY u.id
        ORDER BY casos DESC
    ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVehicleStats(): array
    {
        // Total de vehículos registrados
        $total = (int)$this->db
            ->query("SELECT COUNT(*) FROM vehiculos")
            ->fetchColumn();

        // Vehículos que actualmente tienen un caso abierto
        $conCasosAbiertos = (int)$this->db
            ->query("
            SELECT COUNT(DISTINCT vehiculo_id)
            FROM casos
            WHERE estado = 'abierto'
        ")
            ->fetchColumn();

        // Vehículos atendidos este mes
        $atendidosMes = (int)$this->db
            ->query("
            SELECT COUNT(DISTINCT vehiculo_id)
            FROM casos
            WHERE YEAR(fecha_ingreso) = YEAR(CURDATE())
              AND MONTH(fecha_ingreso) = MONTH(CURDATE())
        ")
            ->fetchColumn();

        // Vehículo con más ingresos al taller
        $stmt = $this->db->query("
        SELECT
            v.id,
            v.placa,
            v.marca,
            v.modelo,
            COUNT(c.id) AS visitas
        FROM vehiculos v
        INNER JOIN casos c
            ON c.vehiculo_id = v.id
        GROUP BY v.id
        ORDER BY visitas DESC
        LIMIT 1
    ");

        $vehiculoFrecuente = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'total' => $total,
            'conCasosAbiertos' => $conCasosAbiertos,
            'atendidosMes' => $atendidosMes,
            'vehiculoFrecuente' => $vehiculoFrecuente
        ];
    }
}

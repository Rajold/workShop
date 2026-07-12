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
                AND YEAR(fecha_ingreso) = YEAR(CURDATE())
                AND MONTH(fecha_ingreso) = MONTH(CURDATE())
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
                AND YEAR(fecha_ingreso) = YEAR(CURDATE())
                AND MONTH(fecha_ingreso) = MONTH(CURDATE())
            ")
            ->fetchColumn();
    }

    public function getStats(): array
    {
        return [
            'totalVehiculos' => $this->getTotalVehiculos(),
            'casosAbiertos' => $this->getCasosAbiertos(),
            'casosCerrados' => $this->getCasosCerrados(),
            'totalMecanicos' => $this->getTotalMecanicos(),
            'totalFacturado' => $this->getFacturacionTotal(),
            'facturacionMes' => $this->getFacturacionMes(),
            'casosMes' => $this->getCasosMes(),
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

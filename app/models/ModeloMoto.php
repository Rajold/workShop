<?php

class ModeloMoto extends BaseModel
{
    protected string $table = 'modelos_moto';

    public function all(): array
    {
        $stmt = $this->db->query("
        SELECT
        m.id,
        m.marca_moto_id,
        ma.nombre AS marca,
        m.tipo_moto_id,
        tm.nombre AS tipo,
        m.linea,
        m.cilindrada,
        m.activo
        FROM modelos_moto m
        INNER JOIN marcas_moto ma
        ON ma.id = m.marca_moto_id
        INNER JOIN tipos_moto tm
        ON tm.id = m.tipo_moto_id
        ORDER BY
        ma.nombre,
        m.linea,
        m.cilindrada
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
{
    $stmt = $this->db->prepare("
        SELECT
            id,
            marca_moto_id,
            tipo_moto_id,
            linea,
            cilindrada,
            activo
        FROM modelos_moto
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

public function create(array $data): bool
{
    $stmt = $this->db->prepare("
        INSERT INTO modelos_moto
        (
            marca_moto_id,
            tipo_moto_id,
            linea,
            cilindrada
        )
        VALUES
        (
            :marca,
            :tipo,
            :linea,
            :cilindrada
        )
    ");

    return $stmt->execute([
        ':marca'       => $data['marca_moto_id'],
        ':tipo'        => $data['tipo_moto_id'],
        ':linea'       => trim($data['linea']),
        ':cilindrada'  => $data['cilindrada'] !== ''
                            ? (int)$data['cilindrada']
                            : null
    ]);
}

public function update(array $data): bool
{
    $stmt = $this->db->prepare("
        UPDATE modelos_moto
        SET
            marca_moto_id = :marca,
            tipo_moto_id = :tipo,
            linea = :linea,
            cilindrada = :cilindrada
        WHERE id = :id
    ");

    return $stmt->execute([
        ':id'          => $data['id'],
        ':marca'       => $data['marca_moto_id'],
        ':tipo'        => $data['tipo_moto_id'],
        ':linea'       => trim($data['linea']),
        ':cilindrada'  => $data['cilindrada'] !== ''
                            ? (int)$data['cilindrada']
                            : null
    ]);
}

public function toggle(int $id): bool
{
    $stmt = $this->db->prepare("
        UPDATE modelos_moto
        SET activo = NOT activo
        WHERE id = :id
    ");

    return $stmt->execute([
        ':id' => $id
    ]);
}

public function canDelete(int $id): bool
{
    return true;
}

public function delete(int $id): bool
{
    $stmt = $this->db->prepare("
        DELETE
        FROM modelos_moto
        WHERE id = :id
    ");

    return $stmt->execute([
        ':id' => $id
    ]);
}

public function groupedByBrand(): array
{
    $stmt = $this->db->query("
        SELECT
            mm.id,
            mm.linea,
            mm.cilindrada,
            ma.nombre AS marca
        FROM modelos_moto mm
        INNER JOIN marcas_moto ma
            ON ma.id = mm.marca_moto_id
        WHERE mm.activo = 1
          AND ma.activo = 1
        ORDER BY
            ma.nombre,
            mm.linea,
            mm.cilindrada
    ");

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = [];

    foreach ($rows as $row) {

        $result[$row['marca']][] = $row;

    }

    return $result;
}

public function allForPicker(): array
{
    $stmt = $this->db->query("
        SELECT

            mm.id,

            ma.nombre AS marca,

            tm.nombre AS tipo,

            mm.linea,

            mm.cilindrada,

            CONCAT(
                mm.linea,
                ' ',
                mm.cilindrada
            ) AS short_name,

            CONCAT(
                ma.nombre,
                ' ',
                mm.linea,
                ' ',
                mm.cilindrada
            ) AS display_name

        FROM modelos_moto mm

        INNER JOIN marcas_moto ma
            ON ma.id = mm.marca_moto_id

        INNER JOIN tipos_moto tm
            ON tm.id = mm.tipo_moto_id

        WHERE mm.activo = 1

        ORDER BY
            ma.nombre,
            mm.linea,
            mm.cilindrada
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

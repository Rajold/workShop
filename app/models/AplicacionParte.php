<?php

class AplicacionParte extends BaseModel
{
    /**
     * Devuelve los IDs de los modelos asociados a una parte.
     */
    public function getModelIdsByPart(int $parteId): array
    {
        $stmt = $this->db->prepare("
            SELECT modelo_moto_id
            FROM aplicacion_parte
            WHERE parte_id = :parte_id
        ");

        $stmt->execute([
            ':parte_id' => $parteId
        ]);

        return array_map(
            'intval',
            $stmt->fetchAll(PDO::FETCH_COLUMN)
        );
    }

    /**
     * Elimina todas las aplicaciones de una parte.
     */
    public function deleteByPart(int $parteId): void
    {
        $stmt = $this->db->prepare("
            DELETE
            FROM aplicacion_parte
            WHERE parte_id = :parte_id
        ");

        $stmt->execute([
            ':parte_id' => $parteId
        ]);
    }

    /**
     * Inserta una aplicación.
     */
    public function add(int $parteId, int $modeloId): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO aplicacion_parte
            (
                parte_id,
                modelo_moto_id
            )
            VALUES
            (
                :parte_id,
                :modelo_id
            )
        ");

        $stmt->execute([
            ':parte_id' => $parteId,
            ':modelo_id' => $modeloId
        ]);
    }

    /**
     * Sincroniza completamente las aplicaciones de una parte.
     */
    public function sync(int $parteId, array $modelos): void
    {
        $this->db->beginTransaction();

        try {

            $this->deleteByPart($parteId);

            foreach ($modelos as $modeloId) {

                $this->add(
                    $parteId,
                    (int)$modeloId
                );

            }

            $this->db->commit();

        } catch (Throwable $e) {

            $this->db->rollBack();

            throw $e;

        }
    }
}
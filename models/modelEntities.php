<?php

require_once __DIR__ ."/modelConnection.php";

class ModelEntities {
    private $table;
    private $modelConnection;

    function __construct($table)
    {
        $this->table = $table;
        $this->modelConnection = new ModelConnection();
    }


    public function saveRecord(Entitie $entitie){

        try {
            $properties = $entitie->getProperties();
            $fields = array_keys($properties);
            $values = array_values($properties);

            $placeholders = implode(", ", array_fill(0, count($fields), '?'));

            $sql = "INSERT INTO {$this->table} (" . implode(", ", $fields) . ") VALUES ({$placeholders})";

            $this->modelConnection->executeComandSql($sql,$values);

        } catch (PDOException $e) {
            throw new Exception("Error al guardar en {$this->table}: " . $e->getMessage());
        }
    }

    public function updateRecord($keyPrimary, $value, Entitie $entitie) {

        try {
            $properties = $entitie->getProperties();
            $updates = [];
            $values = [];

            foreach ($properties as $key => $value) {
                if ($key !== $keyPrimary) {
                    $updates[] = "{$key} = ?";
                    $values[] = $value;
                }
            }

            $values[] = $value;
            $fieldStr = implode(", ", $updates);

            $sql = "UPDATE {$this->table} SET {$fieldStr} WHERE {$keyPrimary} = ?";
            $this->modelConnection->executeComandSql($sql, $values);

        } catch (PDOException $e) {
            throw new Exception("Error al actualizar en {$this->table}: " . $e->getMessage());
        }

    }
}
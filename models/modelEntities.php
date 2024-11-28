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

    public function deleteRecord($keyPrimary, $value) {
        $modelConnection = new ModelConnection();
    
        try {
            $sql = "DELETE FROM {$this->table} WHERE {$keyPrimary} = ?";
            $modelConnection->executeComandSql($sql, [$value]);
        } catch (PDOException $e) {
            echo "Error al eliminar en {$this->table}: " . $e->getMessage();
        } 
    }

    public function getForId($keyPrimary, $value) {
        $modelConnection = new ModelConnection();
    
        try {
            $sql = "SELECT * FROM {$this->table} WHERE {$keyPrimary} = ?";
            $resultado = $modelConnection->executeSelectSql($sql, [$value]);
    
            if ($resultado) {
                return new Entitie($resultado[0]); // Devuelve un objeto Entidad si hay resultados.
            } else {
                return null; // Devuelve null si no hay resultados.
            }
        } catch (PDOException $e) {
            echo "Error al buscar en {$this->table}: " . $e->getMessage();
            return null; // Devuelve null en caso de error.
        } 
    }

    public function getForAll() {
        $modelConnection = new ModelConnection();
    
        try {
            $sql = "SELECT * FROM {$this->table}";
            $resultado = $modelConnection->executeSelectSql($sql);
    
            $entidades = []; 
            foreach ($resultado as $fila) {
                $entidad = new Entitie($fila); 
                $entidades[] = $entidad;
            }
    
            return $entidades;
        } catch (PDOException $e) {
            echo "Error al obtener datos de {$this->table}: " . $e->getMessage();
            return [];
        } 
    }
}
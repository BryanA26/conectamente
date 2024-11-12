<?php

class ModelConnection
{

    private $conn;

    function __construct()
    {
        $this->conn;
    }

    // Método para ejecutar comandos SQL que no sean consultas (por ejemplo, INSERT, UPDATE, DELETE).
    function executeComandSql($sql, $params = []) {

        try {
            
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($params);

            return ($result !== false) ? true : throw new Exception("Error en la ejecución del comando SQL.");

        } catch (PDOException $e) {
            echo "Error al ejecutar el comando SQL: " . $e->getMessage() . "\n";
            // Retorna falso (false) en caso de error.
            return false;
        }

    }

    function executeSelectSql($sql, $params = [])
    {

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt = $stmt->execute($params);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            // Retorna false en caso de error.
            return false;
        }
    }

}

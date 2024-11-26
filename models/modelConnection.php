<?php
require_once __DIR__ . "/../connection/DbConnection.php";

class ModelConnection
{
    private $conn;

    // Constructor que inicializa la conexión.
    public function __construct()
    {
        $connectionBd = new ConnectionBd();
        $this->conn = $connectionBd->getConexion(); // Obtener la conexión a la base de datos
    }

    // Método para ejecutar comandos SQL que no sean consultas (por ejemplo, INSERT, UPDATE, DELETE).
    public function executeComandSql($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($params);

            return ($result !== false) ? true : throw new Exception("Error en la ejecución del comando SQL.");
        } catch (PDOException $e) {
            echo "Error al ejecutar el comando SQL: " . $e->getMessage();
            return false;
        }
    }

    // Método para ejecutar consultas SQL y devolver los resultados.
    public function executeSelectSql($sql, $params = [])
    {
        try {
            
            $stmt = $this->conn->prepare($sql); // Preparar la consulta
            
            $stmt->execute($params); // Ejecutar la consulta con los parámetros
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener los resultados

            return $result;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }
}
?>
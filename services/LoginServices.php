<?php
require_once __DIR__ . "/../interfaces/AuthMethod.php";
require_once __DIR__ . "/../models/modelConnection.php";

class Login implements AuthMethod
{

    private $conn;

    public function __construct()
    {
        $this->conn = new ModelConnection();
    }
    public function authenticate($user, $password): bool
    {

        $sql = "SELECT u.nombre, r.nombre AS rol
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                WHERE u.email = :email AND u.contrasena = :contrasena";

        $params = [
            ':email' => $user,
            ':contrasena' => $password
        ];

        try {
            $result =  $this->conn->executeSelectSql($sql, $params);
            if ($result && count($result) > 0) {
                $userData = $result[0];

                session_start();
                $_SESSION['user'] = $userData['nombre'];
                $_SESSION['rol'] = $userData['rol'];
                $_SESSION['logged_in'] = true;
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
            return false;
        }

    }
}

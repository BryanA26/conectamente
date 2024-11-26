<?php
// Inicia la sesión
session_start();

require_once __DIR__ . "/../factory/AuthMethodFactory.php";  // Asegúrate de incluir la fábrica

class LoginController {

    /**
     * Método para manejar la autenticación de usuario
     */
    public function loginAction() {
        // Verificar si el formulario fue enviado
        if (isset($_POST['ingresar'])) {
            $usuario = $_POST['user'];
            $contraseña = $_POST['password'];
            
            // Usamos la fábrica para crear el objeto de autenticación
            $loginMethod = AuthMethodFactory::createAuthMethod('login'); 
            // Verificar las credenciales
            if ($loginMethod->authenticate($usuario, $contraseña)) {
                // Si las credenciales son correctas, redirigir según el rol
                switch ($_SESSION['rol']) {
                    case 'Administrador':
                        header('Location: index.php');
                        break;
                    case 'Estudiante':
                        header('Location: index.php.php');
                        break;
                    case 'Sicologo':
                        header('Location: index.php.php');
                        break;
                    default:
                        header('Location: index.php');
                        break;
                }
                exit(); // Asegúrate de hacer exit después de header para evitar que el script siga ejecutándose
            } else {
                // Si las credenciales son incorrectas
                echo "Usuario o contraseña incorrectos.";
            }
        }
    }

    /**
     * Método para manejar la desconexión del usuario
     */
    public function logoutAction() {
        // Destruir la sesión
        session_start();
        session_destroy();
        header('Location: login.php'); // Redirigir a la página de login
        exit();
    }
}
?>

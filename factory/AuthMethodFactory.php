<?php
require_once __DIR__ ."/../services/LoginServices.php";
class AuthMethodFactory {

    /**
     * Método estático para crear una instancia de AuthMethod
     * @param string $loginType
     * @return AuthMethod
     */
    public static function createAuthMethod(string $loginType): AuthMethod
    {
        switch ($loginType) {
            case 'login':  // Si el tipo de login es 'login', crea una instancia de Login
                return new Login();

            default:
                // Si el tipo no coincide, podrías manejarlo de alguna forma, como lanzar una excepción:
                throw new InvalidArgumentException("Tipo de login no válido: $loginType");
                // O retornar una instancia predeterminada, como 'login'
                return new Login(); 
        }
    }
}

?>

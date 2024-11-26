<?php


/**
 * Interfaz para la gestión de autenticacion
 * @version 1.0.0
 */
interface AuthMethod {

    /**
     * @return bool
     * @version 1.0.0
     */
    public function authenticate($user, $password): bool;
}
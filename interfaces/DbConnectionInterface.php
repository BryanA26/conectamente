<?php

/**
 * Interfaz para la gestión de conexiones PDO
 * @version 1.0.0
 */
interface PDOConnectionInterface {
	/**
	 * Obtener una instancia de conexión PDO
	 * @return PDO
	 * @version 1.0.0
	 */
	public function getConexion(): PDO;

	
}
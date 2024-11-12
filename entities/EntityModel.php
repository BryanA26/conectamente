<?php
class Entitie {
    private $properties = [];

    function __construct($params = []) {
        $this->properties = $params;
    }

    public function __set($name, $value) {
        $this->properties[$name] = $value;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        trigger_error("Propiedad no definida: " . $name, E_USER_NOTICE);
        return null;
    }

    // Método para obtener todas las properties
    public function getProperties() {
        return $this->properties;
    }
}

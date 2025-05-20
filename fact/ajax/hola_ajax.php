<?php

class HolaAjax {
    public $dato = true;

    public function registrar() {
        if ($this->dato == true) {
            echo "Registrado con éxito";
            $this->dato = false;
        }
    }
}

// Ejemplo de uso


?>

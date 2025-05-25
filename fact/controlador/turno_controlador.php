<?php
class turno_controlador {
    public static function crearTurno() {
        // Lógica de creación de turno: por ejemplo, guardarlo en la base de datos
        // Retorna un array o un mensaje
        return [
            "id" => rand(1000, 9999),
            "fecha" => date("Y-m-d H:i:s"),
            "estado" => "pendiente"
        ];
    }
}


?>
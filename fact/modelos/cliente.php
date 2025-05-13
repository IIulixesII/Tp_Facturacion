<?php

class Cliente {
    public $id;
    public $nombre;
    public $telefono;
    public $fecha_nacimiento;
    public $saldo;
    public $consumo_luz;
    public $dni;

    // Constructor
    public function __construct($nombre, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->saldo = $saldo;
        $this->consumo_luz = $consumo_luz;
        $this->dni = $dni;
    }

    // Método para guardar el cliente en la base de datos
    public function guardar($conexion) {
        $sql = "INSERT INTO cliente (Nombre, Telefono, Fecha_Nacimiento, Saldo, Consumo_luz, Dni)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sisdis", $this->nombre, $this->telefono, $this->fecha_nacimiento, $this->saldo, $this->consumo_luz, $this->dni);
        return $stmt->execute();
    }

    // Método estático para obtener todos los clientes
    public static function obtenerTodos($conexion) {
        $sql = "SELECT * FROM cliente";
        $resultado = $conexion->query($sql);
        $clientes = [];

        while ($fila = $resultado->fetch_assoc()) {
            $clientes[] = new Cliente(
                $fila['Nombre'],
                $fila['Telefono'],
                $fila['Fecha_Nacimiento'],
                $fila['Saldo'],
                $fila['Consumo_luz'],
                $fila['Dni'],
                $fila['id']
            );
        }

        return $clientes;
    }
}
?>

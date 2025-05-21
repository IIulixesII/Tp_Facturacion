<?php
require_once __DIR__ . '/../conexion.php';

class Cliente {
    public $id;
    public $nombre;
    public $telefono;
    public $fecha_nacimiento;
    public $saldo;
    public $consumo_luz;
    public $dni;

    // Constructor de la clase Cliente
    public function __construct($nombre, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->saldo = $saldo;
        $this->consumo_luz = $consumo_luz;
        $this->dni = $dni;
    }

    // Método para guardar un cliente en la base de datos
    public function guardar() {
        $conexion = conexion::conectar();

        // Si no hay conexión, lanzar una excepción
        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        // Consulta SQL para insertar un nuevo cliente
        $sql = "INSERT INTO cliente (Nombre, Telefono, Fecha_Nacimiento, Saldo, Consumo_luz, Dni)
                VALUES (:nombre, :telefono, :fecha_nacimiento, :saldo, :consumo_luz, :dni)";

        $stmt = $conexion->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $this->saldo);
        $stmt->bindParam(':consumo_luz', $this->consumo_luz, PDO::PARAM_INT);
        $stmt->bindParam(':dni', $this->dni, PDO::PARAM_STR);

        // Ejecutar la consulta y retornar el resultado
        return $stmt->execute();
    }

    // Método estático para obtener todos los clientes
    public static function obtenerTodos() {
        $conexion = conexion::conectar();

        // Si no hay conexión, lanzar una excepción
        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        // Consulta SQL para obtener todos los clientes
        $sql = "SELECT * FROM cliente";
        $stmt = $conexion->query($sql);
        $clientes = [];

        // Iterar sobre los resultados y crear objetos Cliente
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

    // Método para buscar un cliente por DNI
    public function buscarPorDNI($dni) {
        $conexion = conexion::conectar();

        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        // Consulta SQL para buscar un cliente por DNI
        $stmt = $conexion->prepare("SELECT * FROM cliente WHERE Dni = :dni");
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtener el primer resultado
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new Cliente(
                $fila['Nombre'],
                $fila['Telefono'],
                $fila['Fecha_Nacimiento'],
                $fila['Saldo'],
                $fila['Consumo_luz'],
                $fila['Dni'],
                $fila['id']
            );
        } else {
            return null; // Si no se encuentra el cliente, retornar null
        }
    }
}
?>

<?php
require_once __DIR__ . '/../conexion.php';

class Cliente
{
    public $id;
    public $usuario_id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $fecha_nacimiento;
    public $saldo;
    public $consumo_luz;
    public $dni;

    public function __construct($nombre, $apellido, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $usuario_id, $id = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->saldo = $saldo;
        $this->consumo_luz = $consumo_luz;
        $this->dni = $dni;
        $this->usuario_id = $usuario_id;
        $this->id = $id;
    }

    public function guardar()
    {
        $conexion = conexion::conectar();

        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        $sql = "INSERT INTO cliente (usuario_id, nombre, apellido, telefono, fecha_nacimiento, saldo, consumo_luz, dni)
                VALUES (:usuario_id, :nombre, :apellido, :telefono, :fecha_nacimiento, :saldo, :consumo_luz, :dni)";

        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':usuario_id', $this->usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $this->saldo);
        $stmt->bindParam(':consumo_luz', $this->consumo_luz);
        $stmt->bindParam(':dni', $this->dni, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public static function obtenerTodos()
    {
        $conexion = conexion::conectar();

        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        $sql = "SELECT * FROM cliente";
        $stmt = $conexion->query($sql);
        $clientes = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = new Cliente(
                $fila['nombre'],
                $fila['apellido'],
                $fila['telefono'],
                $fila['fecha_nacimiento'],
                $fila['saldo'],
                $fila['consumo_luz'],
                $fila['dni'],
                $fila['usuario_id'],
                $fila['id']
            );
        }

        return $clientes;
    }

    public static function buscarPorDNI($dni)
    {
        $conexion = conexion::conectar();

        if (!$conexion) {
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        $stmt = $conexion->prepare("SELECT * FROM cliente WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new Cliente(
                $fila['nombre'],
                $fila['apellido'],
                $fila['telefono'],
                $fila['fecha_nacimiento'],
                $fila['saldo'],
                $fila['consumo_luz'],
                $fila['dni'],
                $fila['usuario_id'],
                $fila['id']
            );
        } else {
            return null;
        }
    }
}

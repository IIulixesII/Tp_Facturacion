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

    // Método para guardar usando las propiedades del objeto
    public function guardar() {
        $conexion = conexion::Connect();

        $sql = "INSERT INTO cliente (Nombre, Telefono, Fecha_Nacimiento, Saldo, Consumo_luz, Dni)
                VALUES (:nombre, :telefono, :fecha_nacimiento, :saldo, :consumo_luz, :dni)";

        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $this->saldo);
        $stmt->bindParam(':consumo_luz', $this->consumo_luz, PDO::PARAM_INT);
        $stmt->bindParam(':dni', $this->dni, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Método estático para obtener todos los clientes
    public static function obtenerTodos() {
        $conexion = conexion::Connect();


        $sql = "SELECT * FROM cliente";
        $stmt = $conexion->query($sql);
        $clientes = [];

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
  

    public function buscarPorDNI($dni) {
        $stmt = $this->conexion->prepare("SELECT * FROM clientes WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

}
?>

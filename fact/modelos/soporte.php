<?php
require_once __DIR__ . '/../conexion.php';

class Soporte {
    private $nombre;
    private $email;
    private $telefono;
    private $dni;
    private $mensaje;

    public function __construct($nombre, $email, $telefono, $dni, $mensaje) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->dni = $dni;
        $this->mensaje = $mensaje;
    }

    public function guardarConsulta() {
        try {
            $pdo = Conexion::conectar(); 

            $sql = "INSERT INTO soporte (nombre, email, telefono, dni, mensaje) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            return $stmt->execute([
                $this->nombre,
                $this->email,
                $this->telefono,
                $this->dni,
                $this->mensaje
            ]);
        } catch (PDOException $e) {
            echo "Error al guardar la consulta: " . $e->getMessage();
            return false;
        }
    }
}



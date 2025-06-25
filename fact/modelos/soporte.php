<?php
require_once __DIR__ . '/../conexion.php';

class Soporte
{
    private $nombre;
    private $email;
    private $telefono;
    private $dni;
    private $mensaje;
    private $estado;

    public function __construct($nombre, $email, $telefono, $dni, $mensaje, $estado = 'norecibido')
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->dni = $dni;
        $this->mensaje = $mensaje;
        $this->estado = $estado;
    }

    public function guardarConsulta()
    {
        try {
            $pdo = Conexion::conectar();

            $sql = "INSERT INTO soporte (nombre, email, telefono, dni, mensaje, estado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            $exito = $stmt->execute([
                $this->nombre,
                $this->email,
                $this->telefono,
                $this->dni,
                $this->mensaje,
                $this->estado
            ]);

            if ($exito) {
                return $pdo->lastInsertId();  // Devuelve el ID del nuevo soporte
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al guardar la consulta: " . $e->getMessage();
            return false;
        }
    }

    public static function obtenerTodos()
    {
        try {
            $pdo = Conexion::conectar();
            // ✅ Mostramos los tickets ordenados por ID ascendente (más viejo a más nuevo)
            $stmt = $pdo->query("SELECT * FROM soporte ORDER BY id_soporte ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener soporte: " . $e->getMessage();
            return [];
        }
    }

    public static function actualizarEstado($id_soporte, $nuevoEstado)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("UPDATE soporte SET estado = ? WHERE id_soporte = ?");
            return $stmt->execute([$nuevoEstado, $id_soporte]);
        } catch (PDOException $e) {
            echo "Error al actualizar estado: " . $e->getMessage();
            return false;
        }
    }

    public static function guardarValoracion($id_soporte, $valoracion)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("UPDATE soporte SET valoracion = ? WHERE id_soporte = ?");
            return $stmt->execute([$valoracion, $id_soporte]);
        } catch (PDOException $e) {
            echo "Error al guardar la valoración: " . $e->getMessage();
            return false;
        }
    }
}

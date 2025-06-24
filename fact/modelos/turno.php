<?php
require_once __DIR__ . '/../conexion.php';

class Turno {
    public $estado;
    public $numero;
    public $nombre;

    public function __construct($estado = "", $numero = "", $nombre = "") {
        $this->estado = $estado;
        $this->numero = $numero;
        $this->nombre = $nombre;
    }

    public function guardar() {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO turno (estado, numero, nombre) VALUES (?, ?, ?)");
        return $stmt->execute([$this->estado, $this->numero, $this->nombre]);
    }

    public function contar() {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("SELECT MAX(numero) AS max_num FROM turno");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($row && $row['max_num']) ? $row['max_num'] + 1 : 1;
    }

    public function turnolibre() {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("SELECT id, nombre, numero FROM turno WHERE estado = 'sinatender' ORDER BY numero ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function turnoAtendido() {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("SELECT id, nombre, numero FROM turno WHERE estado = 'atendiendo' LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function marcarComoAtendido($id) {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("UPDATE turno SET estado = 'atendiendo' WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function eliminarPorId($id) {
        $conn = conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM turno WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}

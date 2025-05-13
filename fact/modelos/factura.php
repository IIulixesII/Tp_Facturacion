<?php

class Factura {
    private $cliente_id;
    private $fecha_emision;
    private $monto_total;
    private $detalle;

    public function __construct($cliente_id, $fecha_emision, $monto_total, $detalle) {
        $this->cliente_id = $cliente_id;
        $this->fecha_emision = $fecha_emision;
        $this->monto_total = $monto_total;
        $this->detalle = $detalle;
    }

    // Método para guardar la factura en la base de datos
    public function guardar($conexion) {
        $sql = "INSERT INTO facturas (cliente_id, fecha_emision, monto_total, detalle)
                VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("isds", $this->cliente_id, $this->fecha_emision, $this->monto_total, $this->detalle);
        return $stmt->execute();
    }

    // Getters (si los necesitás)
    public function getClienteId() {
        return $this->cliente_id;
    }

    public function getFechaEmision() {
        return $this->fecha_emision;
    }

    public function getMontoTotal() {
        return $this->monto_total;
    }

    public function getDetalle() {
        return $this->detalle;
    }
}
?>

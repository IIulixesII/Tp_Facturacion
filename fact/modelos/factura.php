<?php
require_once __DIR__ . '/../conexion.php';
class FacturaModelo {
    public static function obtenerFacturaPorDNI($dni) {
        $conexion = conexion::conectar();
        $sql = "SELECT Nombre, Consumo_luz, Saldo FROM cliente WHERE Dni = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$dni]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo
    }
}
<?php
require_once __DIR__ . '/../modelos/factura.php';


class factura_controler {
    public static function buscarPorDNI($dni) {
        return FacturaModelo::obtenerFacturaPorDNI($dni);
    }
}
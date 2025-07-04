<?php
require_once 'includes/sesion.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
$url = Routes::GetRoutes();
?>

<?php
// Lista blanca de módulos permitidos
$modulosPermitidos = [
    "factura", "registrar", "turno", "turnos","nuevo_cliente","soporte","valoracion",
    "iniciar", "administrar", "caja", "inicio",
    "cerrar_sesion", "turnocajero", "editar_usuario", "eliminar_usuario", "agregar_usuario", "ticket","clima"
];
// Sanitizar parámetro ruta
$ruta = isset($_GET["ruta"]) ? explode("/", $_GET["ruta"])[0] : null;

// Verificar si la ruta está permitida
if ($ruta && in_array($ruta, $modulosPermitidos)) {
    // Definir constante para evitar acceso directo a los módulos
    define('ACCESO_PERMITIDO', true);

    // Incluir el módulo correspondiente
    include "modulos/" . $ruta . ".php";

} elseif ($ruta) {
    // Si la ruta no está permitida
    echo '<p class="text-red-500 mt-4">Ruta no encontrada. Verifique la URL.</p>';

} else {
    include "modulos/clima.php";
    include_once "contenidoindex.php";
}
?>
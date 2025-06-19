<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$url = Routes::GetRoutes();
?>


<?php if (!isset($_GET["ruta"])): ?>
 <?php include_once "contenidoindex.php"; ?>
<?php endif; ?>



  <!-- Contenedor principal -->
    <?php
    $routes = array();

    if (isset($_GET["ruta"])) {
        $routes = explode("/", $_GET["ruta"]);

        switch ($routes[0]) {
            case "factura":
                include "modulos/factura.php";
                break;

            case "registrar":
                include "modulos/nuevo_cliente.php";
                break;

            case "turno":
                include "modulos/turno.php";
                break;

            case "soporte":
                include "modulos/soporte.php";
                break;

            default:
                include_once "modulos/clima.php";
                echo '<p class="text-red-500 mt-4">Ruta no encontrada. Verifique la URL.</p>';
                break;
        }
    } else {
        include_once "modulos/clima.php";
    }
    ?>
  </div>


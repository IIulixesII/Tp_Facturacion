<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$url = Routes::GetRoutes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Facturación de Luz</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1E293B] text-[#F1F5F9]">
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

            case "turnos":
                include "modulos/turnos.php";
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

</body>
</html>

<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$url = Routes::GetRoutes(); // Asegúrate que esta clase existe y tiene el método GetRoutes
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Facturación de Luz</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <input type="hidden" value="<?php echo $url; ?>" id="hiddenPath">

    <?php

    
    $routes = array();
    $route = null; // Ignorarla

    // Asegúrate de que el archivo de conexión esté correctamente referenciado
    require_once './conexion.php'; // Verifica que la ruta sea correcta
    require_once './modelos/cliente.php';    // Incluimos la clase Cliente

    // Comprobamos si hay alguna ruta
    if (isset($_GET["ruta"])) {
        $routes = explode("/", $_GET["ruta"]);

        // Verifica si la ruta corresponde a un archivo válido y existe
        if ($routes[0] == "registrar") {
            include "modulos/nuevo_cliente.php";
        } else if ($routes[0] == "factura") {
            include "modulos/factura.php";
        } else if ($routes[0] == "factura") {
            include "modulos/factura.php";
        } else {
            // Mensaje si la ruta no coincide con ninguna opción
            echo '<p>Ruta no encontrada. Verifique la URL.</p>';
        }
    } else {
        // Si no se pasa ninguna ruta, se muestra el mensaje de bienvenida
        echo '<h1 class="text-3xl font-bold text-center mb-6">Bienvenido al sistema de facturación de luz. Elija una opción para continuar.</h1>';
        
    }
    ?>

  <!-- jQuery -->
  <script src="<?php echo $url; ?>/vistas/plugins/jquery/jquery.min.js"></script>
</body>
</html>

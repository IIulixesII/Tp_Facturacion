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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <input type="hidden" value="<?php echo $url; ?>" id="hiddenPath">

  <?php
  $routes = array();

  if (isset($_GET["ruta"])) {
      $routes = explode("/", $_GET["ruta"]);

      if ($routes[0] == "factura") {
          include "modulos/factura.php";
      } else if ($routes[0] == "registrar") {
          include "modulos/nuevo_cliente.php";
      } else {
          echo '<p>Ruta no encontrada. Verifique la URL.</p>';
      }
  } else {

      echo '<h1 class="text-3xl font-bold text-center mb-6 font-serif">Bienvenido al <a class="underline decoration-pink-500 ">sistema</a> <br> de <a class="underline decoration-indigo-500">facturacion</a> de luz.</h1>';
  }
  ?>

  <script src="<?php echo $url; ?>/vistas/plugins/jquery/jquery.min.js"></script>
</body>
</html>

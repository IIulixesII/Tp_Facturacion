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
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Sistema de Facturación de Luz</h1>
    <div class="flex flex-col space-y-4">
      <a href="registros/nuevo_cliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-center">Registrarse</a>
      <a href="factura.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 text-center">Consultar Factura</a>
      <a href="turno.php" class="bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600 text-center">Solicitar Turno</a>
    </div>




  
    <?php

        $routes = array();
        $route = null; //Ignorarla

        if(isset($_GET["ruta"])){
            $routes = explode("/", $_GET["ruta"]);

            if($route != null || $routes[0] == "header"){
                include "modules/header/header.php";
            }else if($routes[0] == "hola"){
                include "modules/hola.php";
            }

        }else{
            echo '<p>Soy el template</p>';
        }
        
    ?>


</body>
</html>

<?php
// Evitar acceso directo
if (!defined('ACCESO_PERMITIDO')) {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Iniciar sesión si no está iniciada
require_once 'includes/sesion.php';



// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'cajero') {
    header('Location: index.php?ruta=iniciar');
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Caja</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Contenedor principal -->
    <div class="flex-grow">
        <div class="h-20"></div>

        <div class="max-w-4xl mx-auto mt-20 p-6 bg-white shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800">Panel de Caja</h1>
            <p class="text-lg text-center text-gray-600 mt-2">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']->nombreUsuario); ?>.</p>

            <div class="flex justify-center space-x-4 mt-6">
                <!-- Botón para ver la tabla de atención -->
                <a href="index.php?ruta=turno" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Ver Tabla de Atención
                </a>
                <!-- Botón para atender -->
                <a href="index.php?ruta=turnocajero" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                    Atender
                </a>
            </div>

            <form method="post" action="index.php?ruta=cerrar_sesion" class="mt-8 text-center">
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-300">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <div class="h-20"></div>
    </div>

  
    
</body>
</html>

<?php
require_once __DIR__ . "/../../modelos/cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $saldo = $_POST['saldo'];
    $consumo_luz = $_POST['consumo_luz'];
    $dni = $_POST['dni'];

    $cliente = new Cliente($nombre, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni);

    if ($cliente->guardar()) {
        header("Location: ../../index.php");
        
        exit;
    } else {
        echo "<script>alert('Error al registrar el cliente.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">



    <!-- FORMULARIO -->
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-md mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-700"> <a class="underline decoration-sky-500">Nuevo  Cliente</a></h2>
    
    <form method="post" action="vistas/modulos/nuevo_cliente.php" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Teléfono</label>
            <input type="number" name="telefono" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Saldo</label>
            <input type="number" step="0.01" name="saldo" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Consumo de Luz</label>
            <input type="number" name="consumo_luz" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">DNI</label>
            <input type="text" name="dni" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="md:col-span-2 text-center">
            <input type="submit" value="Registrar" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
        </div>
    </form>
</div>

</body>
</html>

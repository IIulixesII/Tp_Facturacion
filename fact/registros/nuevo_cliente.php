<?php
require_once '../conexion.php';
require_once '../objetos/cliente.php';    // Incluimos la clase Cliente

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $saldo = $_POST['saldo'];
    $consumo_luz = $_POST['consumo_luz'];
    $dni = $_POST['dni'];

    // Crear objeto Cliente
    $cliente = new Cliente($nombre, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni);

    // Conectar con la base de datos
    $conexion = new mysqli("localhost", "root", "", "fact"); // Cambia los valores

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Guardar cliente en la base de datos
    if ($cliente->guardar($conexion)) {
        echo "Cliente registrado correctamente.";
    } else {
        echo "Error al registrar el cliente: " . $conexion->error;
    }

    $conexion->close();
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

    <!-- NAVBAR -->
    <nav class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white text-lg font-bold">Sistema de Facturación de Luz</a>
            <div>
                <a href="registro.php" class="text-white px-4 hover:underline">Registrarse</a>
                <a href="../factura.php" class="text-white px-4 hover:underline">Consultar Factura</a>
                <a href="turno.php" class="text-white px-4 hover:underline">Solicitar Turno</a>
            </div>
        </div>
    </nav>

    <!-- FORMULARIO -->
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6 text-center text-blue-700">Registrar Nuevo Cliente</h2>
        <form method="post" action="nuevo_cliente.php" class="space-y-4">
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

            <div class="text-center">
                <input type="submit" value="Registrar" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
            </div>
        </form>
    </div>

</body>
</html>

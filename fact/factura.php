<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Consulta de Factura</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
</head>
<body class="bg-gray-100">

<!-- Barra de Navegación -->
<nav class="bg-blue-500 p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="index.php" class="text-white text-lg font-bold">Sistema de Facturación de Luz</a>
        <div>
            <a href="registros/nuevo_cliente.php" class="text-white px-4">Registrarse</a>
            <a href="consulta.php" class="text-white px-4">Consultar Factura</a>
            <a href="turno.php" class="text-white px-4">Solicitar Turno</a>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-md mt-8">
    <h1 class="text-3xl font-bold text-center mb-6">Consulta de Factura</h1>

    <!-- Formulario de búsqueda por DNI -->
    <form action="factura.php" method="POST" class="flex items-center mb-6">
        <input type="text" name="dni" placeholder="Ingrese su DNI" class="w-full p-2 border border-gray-300 rounded" required />
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded ml-2 hover:bg-green-600">Buscar</button>
    </form>

    <?php
    // Datos de ejemplo de facturas
    $facturas = [
        '12345678' => [
            'nombre' => 'Juan Pérez',
            'direccion' => 'Calle Ficticia 123',
            'periodo' => 'Enero 2025',
            'consumo' => 150,
            'total' => 500
        ],
        '87654321' => [
            'nombre' => 'María López',
            'direccion' => 'Avenida Ficticia 456',
            'periodo' => 'Enero 2025',
            'consumo' => 200,
            'total' => 650
        ]
    ];

    // Verificar si se ha enviado el DNI
    if (isset($_POST['dni'])) {
        $dni = $_POST['dni'];

        // Buscar la factura en los datos simulados
        if (isset($facturas[$dni])) {
            $factura = $facturas[$dni];
        } else {
            $factura = null;
        }
    }
    ?>

    <?php if (isset($factura)): ?>
        <!-- Resultados de la factura -->
        <div class="mt-4">
            <h2 class="text-2xl font-semibold mb-4">Detalles de la Factura</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($factura['nombre']); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($factura['direccion']); ?></p>
            <p><strong>Periodo:</strong> <?php echo htmlspecialchars($factura['periodo']); ?></p>
            <p><strong>Consumo:</strong> <?php echo htmlspecialchars($factura['consumo']); ?> kWh</p>
            <p><strong>Total a Pagar:</strong> $<?php echo htmlspecialchars($factura['total']); ?></p>

            <!-- Botón para imprimir la factura -->
            <button onclick="window.print()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4 hover:bg-blue-600">Imprimir Factura</button>
        </div>
    <?php elseif (isset($dni)): ?>
        <!-- Mensaje si no se encuentra la factura -->
        <div class="mt-4 text-red-500">
            <p>No se encontraron facturas para el DNI ingresado.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

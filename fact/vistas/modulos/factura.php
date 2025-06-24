
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Consulta de Factura</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen font-roboto bg-gray-100">

  <!-- Contenido principal -->
  <div id="facturaContenido" class="flex-grow">
    <?php
    require_once __DIR__ . '/../../controlador/factura_controler.php';

    $factura = null;
    $dni = null;
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["dni"])) {
      $dni = $_POST["dni"];
      $factura = factura_controler::buscarPorDNI($dni);
    }
    ?>
    <div class="h-20"></div>

    <div class="max-w-4xl mx-auto bg-[#2c3e50] p-10 rounded-3xl shadow-xl mt-8 text-white">
      <h1 class="text-3xl font-medium text-center mb-8 tracking-normal drop-shadow-md">Consulta de Factura</h1>

      <form action="" method="POST" class="flex flex-col sm:flex-row items-center gap-4 mb-8">
        <input
          type="text"
          name="dni"
          placeholder="Ingrese su DNI"
          class="flex-grow p-3 rounded-lg shadow-inner text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-4 focus:ring-blue-400 transition"
          required
          autocomplete="off"
        />
        <button
          type="submit"
          class="bg-blue-700 hover:bg-blue-800 active:bg-blue-900 transition text-white font-medium py-3 px-8 rounded-lg shadow-md focus:outline-none focus:ring-4 focus:ring-blue-300"
        >
          Buscar
        </button>

      </form>

      <?php if ($factura): ?>

        <table class="w-full text-left mb-8 border-collapse rounded-lg overflow-hidden shadow-md bg-white bg-opacity-20 backdrop-blur-sm">
          <tbody>
            <tr class="border-b border-gray-400">
              <td class="py-4 px-6 font-medium text-blue-200 uppercase tracking-wide">Nombre</td>
              <td class="py-4 px-6"><?= htmlspecialchars($factura['Nombre'] ?? 'No disponible') ?></td>
              <td class="py-4 px-6 font-medium text-blue-200 uppercase tracking-wide">Dirección</td>
              <td class="py-4 px-6"><?= 'No disponible' ?></td>
            </tr>
            <tr class="border-b border-gray-400">
              <td class="py-4 px-6 font-medium text-blue-200 uppercase tracking-wide">Periodo</td>
              <td class="py-4 px-6"><?= 'No disponible' ?></td>
              <td class="py-4 px-6 font-medium text-blue-200 uppercase tracking-wide">Consumo</td>
              <td class="py-4 px-6"><?= isset($factura['Consumo_luz']) ? htmlspecialchars($factura['Consumo_luz']) . ' kWh' : 'No disponible' ?></td>
            </tr>
          </tbody>
        </table>

        <div class="flex justify-center mt-6">
          <div class="bg-blue-800 text-white font-semibold text-xl px-10 py-4 rounded-full shadow-lg drop-shadow-lg">
            Total a Pagar: $<?= isset($factura['Saldo']) ? htmlspecialchars($factura['Saldo']) : 'No disponible' ?>
          </div>
        </div>

        <input type="hidden" id="hiddenPath" value="/fact">
        <input type="hidden" id="nombrePersona" value="<?= htmlspecialchars($factura['Nombre'] ?? '') ?>">

        <div class="flex justify-center mt-8">
          <button
            type="button"
            id="btnImprimir"
            class="bg-blue-700 hover:bg-blue-800 active:bg-blue-900 text-white font-medium py-3 px-8 rounded-lg shadow-md focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
          >
            Imprimir Factura
          </button>
        </div>

      <?php elseif ($dni): ?>
        <div class="mt-6 bg-red-700 bg-opacity-80 text-red-100 p-4 rounded-lg shadow-inner text-center font-medium animate-pulse">
          No se encontraron facturas para el DNI ingresado.
        </div>

    <?php endif; ?>
</div>

  

  <script src="<?php echo $url; ?>/vistas/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo $url; ?>/vistas/js/template.js"></script>
  <style>
    .font-roboto {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</body>
</html>

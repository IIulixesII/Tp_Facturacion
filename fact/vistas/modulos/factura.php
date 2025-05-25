<?php
require_once __DIR__ . '/../../controlador/factura_controler.php';

$factura = null;
$dni = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["dni"])) {
    $dni = $_POST["dni"];
    $factura = factura_controler::buscarPorDNI($dni);
}
?>

<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-md mt-8">
    <h1 class="text-3xl font-bold text-center mb-6">Consulta de Factura</h1>

    <form action="" method="POST" class="flex items-center mb-6">
        <input type="text" name="dni" placeholder="Ingrese su DNI" class="w-full p-2 border border-gray-300 rounded" required />
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded ml-2 hover:bg-green-600">Buscar</button>
    </form>

    <?php if ($factura): ?>
        <table class="w-full text-left mb-6 border-collapse">
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="py-2 pr-8 font-semibold">Nombre:</td>
                    <td class="py-2 pr-8"><?= htmlspecialchars($factura['Nombre'] ?? 'No disponible') ?></td>
                    <td class="py-2 pr-8 font-semibold">Dirección:</td>
                    <td class="py-2"><?= 'No disponible' ?></td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 pr-8 font-semibold">Periodo:</td>
                    <td class="py-2 pr-8"><?= 'No disponible' ?></td>
                    <td class="py-2 pr-8 font-semibold">Consumo:</td>
                    <td class="py-2"><?= isset($factura['Consumo_luz']) ? htmlspecialchars($factura['Consumo_luz']) . ' kWh' : 'No disponible' ?></td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-center mt-6">
            <div class="bg-green-100 text-green-700 font-bold text-xl px-6 py-4 rounded shadow-md">
                Total a Pagar: $<?= isset($factura['Saldo']) ? htmlspecialchars($factura['Saldo']) : 'No disponible' ?>
            </div>
        </div>
    
        <!-- Input hidden para pasar el nombre a JS -->
        <input type="hidden" id="hiddenPath" value="/fact">
        <input type="hidden" id="nombrePersona" value="<?= htmlspecialchars($factura['Nombre'] ?? '') ?>">

        <button type="button" id="btnImprimir" class="bg-blue-500 text-white py-2 px-4 rounded mt-6 hover:bg-blue-600">
            Imprimir Factura
        </button>
    <?php elseif ($dni): ?>
        <div class="mt-4 text-red-500">
            <p>No se encontraron facturas para el DNI ingresado.</p>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo $url;?>/vistas/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $url;?>/vistas/js/template.js"></script>

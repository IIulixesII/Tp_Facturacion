<?php
require_once __DIR__ . '/../../modelos/turno.php';

$turno = new Turno();
$turnos = $turno->turnolibre();
$turnoAtendido = $turno->turnoAtendido();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Turnos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="10">

</head>
<body class="flex flex-col min-h-screen">

  <!-- Contenido principal -->
  <main class="flex-grow container mx-auto px-6 py-8">
    <div class="h-20"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Turnos en espera -->
      <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-red-600 border-b-2 border-red-600 pb-2">
          Turnos en espera
        </h3>
        <?php if (count($turnos) === 0): ?>
          <p class="text-gray-500 italic">No hay turnos en espera.</p>
        <?php else: ?>
          <ul class="divide-y divide-gray-200">
            <?php foreach ($turnos as $fila): ?>
              <li class="py-3 flex justify-between items-center hover:bg-red-50 rounded px-3 transition">
                <span class="font-medium text-gray-900"><?= htmlspecialchars($fila['nombre']) ?></span>
                <span class="text-red-600 font-semibold">Turno <?= $fila['numero'] ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <!-- Turno en atención -->
      <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-green-600 border-b-2 border-green-600 pb-2">
          Turno en atención
        </h3>
        <?php if ($turnoAtendido): ?>
          <div class="text-center py-10">
            <p class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($turnoAtendido['nombre']) ?></p>
            <p class="mt-2 text-green-600 font-semibold text-xl">Turno <?= $turnoAtendido['numero'] ?></p>
          </div>
        <?php else: ?>
          <p class="text-gray-500 italic text-center py-10">
            No hay ningún turno siendo atendido actualmente.
          </p>
        <?php endif; ?>
      </div>
    </div>
  </main>


</body>
</html>

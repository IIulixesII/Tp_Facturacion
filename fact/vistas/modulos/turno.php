<?php
require_once __DIR__ . '/../../modelos/turno.php';

$turno = new Turno();
$turnos = $turno->turnolibre(); // turnos sin atender

// Supongamos que tienes un método para traer el turno que está siendo atendido
// Si no, se puede poner un ejemplo estático o un mensaje vacío
$turnoAtendido = $turno->turnoAtendido(); // devuelve el turno actual atendido o null
?>

<div class="container mx-auto px-6 py-8">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
    
    <!-- Turnos en espera -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4 text-red-600 border-b-2 border-red-600 pb-2">Turnos en espera</h3>
      
      <?php if (count($turnos) === 0): ?>
        <p class="text-gray-500 italic">No hay turnos en espera.</p>
      <?php else: ?>
        <ul class="divide-y divide-gray-200">
          <?php foreach ($turnos as $fila): ?>
            <li class="py-3 flex justify-between items-center hover:bg-red-50 rounded px-3 transition">
              <span class="font-medium text-gray-900"><?php echo htmlspecialchars($fila['nombre']); ?></span>
              <span class="text-red-600 font-semibold">Turno <?php echo $fila['numero']; ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
    
    <!-- Turno en atención -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4 text-green-600 border-b-2 border-green-600 pb-2">Turno en atención</h3>
      
      <?php if ($turnoAtendido): ?>
        <div class="text-center py-10">
          <p class="text-2xl font-bold text-gray-900"><?php echo htmlspecialchars($turnoAtendido['nombre']); ?></p>
          <p class="mt-2 text-green-600 font-semibold text-xl">Turno <?php echo $turnoAtendido['numero']; ?></p>
        </div>
      <?php else: ?>
        <p class="text-gray-500 italic text-center py-10">No hay ningún turno siendo atendido actualmente.</p>
      <?php endif; ?>
    </div>
    
  </div>
</div>

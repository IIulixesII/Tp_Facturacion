<?php
require_once __DIR__ . '/../../modelos/turno.php';

$turno = new Turno();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'], $_POST['id'])) {
    $id = intval($_POST['id']);
    if ($_POST['accion'] === 'atender') {
        $turno->marcarComoAtendido($id);
    } elseif ($_POST['accion'] === 'eliminar') {
        $turno->eliminarPorId($id);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

$turnos = $turno->turnolibre();
$turnoAtendido = $turno->turnoAtendido();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Turnos</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">
<div class="h-40"></div>

  <!-- Contenido principal -->
  <main class="flex-grow container mx-auto px-6 py-8">
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
                <div class="flex items-center space-x-2">
                  <span class="text-red-600 font-semibold">Turno <?= $fila['numero'] ?></span>
                  <form method="post">
                    <input type="hidden" name="accion" value="atender">
                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                    <button type="submit" class="bg-green-500 text-white py-1 px-2 rounded">Atender</button>
                  </form>
                </div>
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
          <div class="text-center py-10 space-y-4">
            <p class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($turnoAtendido['nombre']) ?></p>
            <p class="mt-2 text-green-600 font-semibold text-xl">Turno <?= $turnoAtendido['numero'] ?></p>
            <form method="post">
              <input type="hidden" name="accion" value="eliminar">
              <input type="hidden" name="id" value="<?= $turnoAtendido['id'] ?>">
              <button type="submit" class="bg-red-600 text-white py-1 px-4 rounded">Finalizar turno</button>
            </form>
          </div>
        <?php else: ?>
          <p class="text-gray-500 italic text-center py-10">No hay ningún turno siendo atendido actualmente.</p>
        <?php endif; ?>
      </div>

    </div>

  
  </main>

 

</body>
</html>

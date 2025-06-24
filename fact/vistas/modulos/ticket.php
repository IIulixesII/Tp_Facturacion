<?php
require_once 'modelos/Soporte.php';

$soportes = Soporte::obtenerTodos();
?>

<main class="pt-28 pb-28 px-4 sm:px-8 md:px-16 lg:px-24 xl:px-36 flex-grow">
  <div class="max-w-6xl mx-auto bg-white text-black p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-6 text-center">Gestión de Soporte</h1>

    <!-- Notificación -->
    <?php if (isset($_GET['estado'])): ?>
      <div id="alerta" class="mb-4 p-3 rounded text-white font-semibold
                  <?= $_GET['estado'] === 'ok' ? 'bg-green-500' : 'bg-red-500' ?>">
        <?= $_GET['estado'] === 'ok' ? 'Estado actualizado correctamente.' : 'Error al actualizar el estado.' ?>
      </div>
    <?php endif; ?>

    <!-- Vista en tarjetas para móvil -->
    <div class="sm:hidden space-y-4">
      <?php foreach ($soportes as $s): ?>
        <div class="border rounded-lg p-4 shadow">
          <p><strong>ID:</strong> <?= $s['id_soporte'] ?></p>
          <p><strong>Nombre:</strong> <?= htmlspecialchars($s['nombre']) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($s['email']) ?></p>
          <p><strong>Teléfono:</strong> <?= htmlspecialchars($s['telefono']) ?></p>
          <p><strong>DNI:</strong> <?= htmlspecialchars($s['dni']) ?></p>
          <p><strong>Mensaje:</strong> <?= nl2br(htmlspecialchars($s['mensaje'])) ?></p>
          <p><strong>Fecha:</strong> <?= $s['fecha'] ?></p>
          <p><strong>Valoración:</strong> <?= $s['valoracion'] ?? 'Sin valorar' ?></p>
          <p><strong>Estado:</strong> 
            <span class="inline-block px-3 py-1 rounded-full text-white 
              <?= $s['estado'] === 'recibido' ? 'bg-green-500' : 'bg-yellow-500' ?>">
              <?= ucfirst($s['estado']) ?>
            </span>
          </p>
          <div class="mt-2">
            <?php if ($s['estado'] === 'norecibido'): ?>
              <form method="post" action="controlador/controlador_soporte.php">
                <input type="hidden" name="id_soporte_estado" value="<?= $s['id_soporte'] ?>">
                <input type="hidden" name="nuevo_estado" value="recibido">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                  Marcar recibido
                </button>
              </form>
            <?php else: ?>
              <span class="text-green-700 font-medium">Atendido</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Tabla para pantallas grandes -->
    <div class="overflow-x-auto hidden sm:block mt-6">
      <table class="w-full table-auto border border-gray-300 text-center text-sm sm:text-base">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Nombre</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Teléfono</th>
            <th class="p-2 border">DNI</th>
            <th class="p-2 border">Mensaje</th>
            <th class="p-2 border">Fecha</th>
            <th class="p-2 border">Valoración</th>
            <th class="p-2 border">Estado</th>
            <th class="p-2 border">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($soportes as $s): ?>
            <tr>
              <td class="p-2 border"><?= $s['id_soporte'] ?></td>
              <td class="p-2 border"><?= htmlspecialchars($s['nombre']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($s['email']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($s['telefono']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($s['dni']) ?></td>
              <td class="p-2 border"><?= nl2br(htmlspecialchars($s['mensaje'])) ?></td>
              <td class="p-2 border"><?= $s['fecha'] ?></td>
              <td class="p-2 border"><?= $s['valoracion'] ?? 'Sin valorar' ?></td>
              <td class="p-2 border">
                <span class="inline-block px-3 py-1 rounded-full text-white 
                  <?= $s['estado'] === 'recibido' ? 'bg-green-500' : 'bg-yellow-500' ?>">
                  <?= ucfirst($s['estado']) ?>
                </span>
              </td>
              <td class="p-2 border">
                <?php if ($s['estado'] === 'norecibido'): ?>
                  <form method="post" action="controlador/controlador_soporte.php">
                    <input type="hidden" name="id_soporte_estado" value="<?= $s['id_soporte'] ?>">
                    <input type="hidden" name="nuevo_estado" value="recibido">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                      Marcar recibido
                    </button>
                  </form>
                <?php else: ?>
                  <span class="text-green-700 font-medium">Atendido</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script para ocultar alerta después de 3 segundos -->
  <script>
    setTimeout(() => {
      const alerta = document.getElementById('alerta');
      if (alerta) alerta.remove();
    }, 3000);
  </script>
</main>

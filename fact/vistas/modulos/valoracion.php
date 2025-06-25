<?php
require_once 'includes/sesion.php';
$id_soporte = $_SESSION['id_soporte_valoracion'] ?? '';
?>

<main class="flex-grow text-black pt-28 md:pt-32 px-4 pb-20 flex justify-center items-center">
  <div class="bg-white p-8 rounded-xl shadow-xl text-center max-w-xl w-full mt-16">
    <h2 class="text-2xl font-bold text-green-700 mb-4">Consulta enviada con éxito, aguarde a ser atendido.</h2>
    <p class="text-gray-700 mb-6 text-lg">
      ¡Gracias por contactarte con el sector de Soporte! Por favor, calificá tu experiencia:
    </p>

    <div id="estrellas" class="flex justify-center gap-2 mb-4">
      <span class="estrella" data-value="1">&#9733;</span>
      <span class="estrella" data-value="2">&#9733;</span>
      <span class="estrella" data-value="3">&#9733;</span>
      <span class="estrella" data-value="4">&#9733;</span>
      <span class="estrella" data-value="5">&#9733;</span>
    </div>

    <p id="valoracion" class="text-sm text-gray-600 mb-6"></p>
    <p class="text-gray-500 text-sm mb-6">Tu opinión es muy importante para nosotros.</p>

    <form method="post" action="controlador/controlador_soporte.php" id="formValoracion">
      <input type="hidden" name="valoracion" id="valoracionInput" value="">
      <input type="hidden" name="id_soporte" value="<?php echo htmlspecialchars($id_soporte); ?>">
      <input type="hidden" name="redirect" value="soporte">
      <button type="submit"
        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
        Enviar valoración
      </button>
    </form>

    <?php if (empty($id_soporte)) : ?>
      <p class="text-red-600 mt-4 font-semibold">Error: No se recibió el identificador de la consulta para valorar.</p>
    <?php endif; ?>
  </div>

  <style>
    .estrella {
      font-size: 2.5rem;
      color: #e5e7eb;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .estrella.seleccionada {
      color: #facc15;
    }
  </style>

  <script>
    const estrellas = document.querySelectorAll('.estrella');
    const resultado = document.getElementById('valoracion');
    const valoracionInput = document.getElementById('valoracionInput');
    const form = document.getElementById('formValoracion');

    estrellas.forEach((estrella, index) => {
      estrella.addEventListener('click', () => {
        estrellas.forEach((e, i) => {
          e.classList.toggle('seleccionada', i <= index);
        });

        const valor = index + 1;
        resultado.textContent = `Valoraste con ${valor} estrella${valor > 1 ? 's' : ''}.`;
        valoracionInput.value = valor;
      });
    });

    form.addEventListener('submit', function(e) {
      if (!valoracionInput.value || valoracionInput.value < 1 || valoracionInput.value > 5) {
        e.preventDefault();
        alert('Por favor, seleccioná una valoración antes de enviar.');
      }
    });
  </script>
</main>

<!-- Widget del Clima -->
<div id="weather" class="fixed left-2 sm:left-4 md:left-6 bg-gradient-to-br from-blue-700 to-indigo-900 bg-opacity-70 rounded-lg p-2 sm:p-3 md:p-4 w-32 sm:w-36 md:w-48 text-white shadow-lg font-sans z-50 text-xs sm:text-sm md:text-sm" style="top: 200px;">
  <!-- Botón de Cierre -->
  <button id="close-weather" aria-label="Cerrar clima" class="absolute top-1 right-1 text-white text-sm font-bold hover:text-red-300 focus:outline-none">×</button>

  <h2 class="text-sm sm:text-base md:text-lg font-bold mb-1 text-center">Buenos Aires</h2>
  <div id="weather-content" class="flex flex-col items-center space-y-1 md:space-y-1.5">
    <div id="icon" class="w-8 h-8 sm:w-10 sm:h-10 md:w-14 md:h-14"></div>
    <div id="temp" class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-none"></div>
    <div id="desc" class="capitalize text-xs sm:text-sm md:text-sm text-center"></div>
    <div id="humidity" class="text-[8px] sm:text-xs md:text-xs opacity-80 text-center"></div>
  </div>
  <div id="error" class="text-red-400 mt-1 hidden text-center text-xs"></div>
</div>

<!-- Estilos Adicionales -->
<style>
  @media(min-width: 768px) {
    #weather {
      top: 120px !important;
      opacity: 0.7;
    }
  }
</style>

<!-- Script para Obtener y Mostrar el Clima -->
<script>
  // Iconos SVG para diferentes condiciones climáticas
  const icons = {
    "soleado": `<svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/></svg>`,
    "cielo claro": `<svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/></svg>`,
    "nublado": `<svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 24 24"><ellipse cx="12" cy="15" rx="8" ry="5"/></svg>`,
    "lluvia": `<svg xmlns="http://www.w3.org/2000/svg" fill="lightblue" viewBox="0 0 24 24"><path d="M8 13l2 4 2-4 2 4"/></svg>`,
    "lluvioso": `<svg xmlns="http://www.w3.org/2000/svg" fill="lightblue" viewBox="0 0 24 24"><path d="M8 13l2 4 2-4 2 4"/></svg>`,
    "nieve": `<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>`,
  };

  // Función para obtener y mostrar el clima
  async function fetchWeather() {
    try {
      const response = await fetch('https://wttr.in/Buenos_Aires?format=j1');
      if (!response.ok) throw new Error('No se pudo obtener el clima');
      const data = await response.json();

      const current = data.current_condition[0];
      const temp = current.temp_C;
      const desc = current.weatherDesc[0].value.toLowerCase();
      const humidity = current.humidity;

      // Seleccionar icono basado en la descripción
      let iconSVG = icons["soleado"]; // Valor por defecto
      for (const key in icons) {
        if (desc.includes(key)) {
          iconSVG = icons[key];
          break;
        }
      }

      document.getElementById('icon').innerHTML = iconSVG;
      document.getElementById('temp').textContent = `${temp}°C`;
      document.getElementById('desc').textContent = desc;
      document.getElementById('humidity').textContent = `Humedad: ${humidity}%`;
      document.getElementById('error').classList.add('hidden');
      document.getElementById('weather-content').style.display = 'flex';
    } catch (error) {
      document.getElementById('error').textContent = error.message;
      document.getElementById('error').classList.remove('hidden');
      document.getElementById('weather-content').style.display = 'none';
    }
  }

  // Llamar a la función al cargar la página
  fetchWeather();

  // Funcionalidad del botón de cierre
  document.getElementById('close-weather').addEventListener('click', () => {
    document.getElementById('weather').style.display = 'none';
  });
</script>

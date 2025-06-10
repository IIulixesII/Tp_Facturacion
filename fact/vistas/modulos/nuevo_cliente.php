
<head>
  <meta charset="UTF-8" />
  <title>Nuevo Cliente</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Fuente profesional */
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Fondo con imagen y overlay oscuro para mejor contraste */
    body {
background: url('fondo/fon.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      min-height: 100vh;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(15, 23, 42, 0.7); /* azul oscuro translúcido */
      z-index: -1;
    }

    /* Inputs y botones con sombras para profundidad */
    input, button {
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.15);
    }

    /* Efecto hover más suave */
    button:hover {
      transition: background-color 0.3s ease;
    }
  </style>
</head>

  <div class=" flex items-center justify-center px-4">
    <div class="bg-white bg-opacity-95 rounded-3xl shadow-2xl max-w-3xl w-full p-12 md:p-16">
      <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center tracking-tight">
        Registro de Nuevo Cliente
      </h2>

      <form method="post" action="../../fact/controlador/controlador_cliente.php" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-800">
        <div>
          <label class="block mb-2 font-medium text-gray-700">Nombre</label>
          <input type="text" name="nombre" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div>
          <label class="block mb-2 font-medium text-gray-700">Teléfono</label>
          <input type="tel" name="telefono" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div>
          <label class="block mb-2 font-medium text-gray-700">Fecha de Nacimiento</label>
          <input type="date" name="fecha_nacimiento" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div>
          <label class="block mb-2 font-medium text-gray-700">Saldo</label>
          <input type="number" step="0.01" name="saldo" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div>
          <label class="block mb-2 font-medium text-gray-700">Consumo de Luz (kWh)</label>
          <input type="number" name="consumo_luz" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div>
          <label class="block mb-2 font-medium text-gray-700">DNI</label>
          <input type="text" name="dni" required
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="md:col-span-2 text-center mt-6">
          <button type="submit" 
            class="bg-indigo-600 text-white font-semibold px-12 py-3 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-400">
            Registrar Cliente
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="h-20"></div>

</body>
</html>

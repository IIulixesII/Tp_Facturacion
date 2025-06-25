<?php
require_once 'controlador/controlador_usuario.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = UsuarioControlador::registrarUsuario($_POST);
}
?>

<!-- Formulario -->

<div class="flex justify-center items-start px-4 pt-24 min-h-screen">
  <div class="bg-white bg-opacity-95 rounded-3xl shadow-2xl max-w-3xl w-full p-10 md:p-16">
    <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center tracking-tight">
      Registrarse
    </h2>

    <?php if (!empty($mensaje)) echo $mensaje; ?>

    <form method="post" action="" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-800">

      <div>
        <label class="block mb-2 font-medium">Nombre de Usuario</label>
        <input type="text" name="nombreUsuario" pattern="[a-zA-Z0-9_]+" title="Solo letras, números y guiones bajos." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Nombre</label>
        <input type="text" name="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Apellido</label>
        <input type="text" name="apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Email</label>
        <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Contraseña</label>
        <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Teléfono</label>
        <input type="tel" name="telefono" pattern="[0-9 +]+" title="Solo números, espacios o +" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block mb-2 font-medium">DNI</label>
        <input type="text" name="dni" pattern="\d+" title="Solo números." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div class="md:col-span-2 text-center mt-6">
        <button type="submit" class="bg-indigo-600 text-white font-semibold px-12 py-3 rounded-lg shadow-md hover:bg-indigo-700">
          Continuar
        </button>
      </div>
    </form>
  </div>
</div>
<div class="h-20"> </div> 

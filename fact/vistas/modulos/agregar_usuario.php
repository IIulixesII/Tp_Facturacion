<?php
// Seguridad
if (!defined('ACCESO_PERMITIDO')) {
    header('Location: index.php?ruta=iniciar');
    exit;
}

require_once 'includes/sesion.php';
require_once 'controlador/controlador_usuario.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = UsuarioControlador::registrarUsuario($_POST);

    // Si es exitoso, redirigimos con mensaje en sesión
    if (str_contains($mensaje, 'Registro exitoso')) {
        $_SESSION['mensaje_exito'] = 'Usuario registrado correctamente.';
        header('Location: index.php?ruta=administrar');
        exit;
    }
}
?>

<main class="flex-grow pt-28 px-4 mb-40">
  <div class="p-8 max-w-3xl mx-auto bg-white rounded shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Agregar Usuario</h1>

    <?php if ($mensaje): ?>
      <div class="mb-4"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-6 text-gray-800">
      <div>
        <label class="block mb-2 font-medium">Nombre de Usuario</label>
        <input type="text" name="nombreUsuario" required pattern="[a-zA-Z0-9_]+" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Email</label>
        <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Contraseña</label>
        <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Rol</label>
        <select name="rol" required class="w-full p-3 border border-gray-300 rounded-lg">
          <option value="cliente">Cliente</option>
          <option value="admin">Admin</option>
          <option value="cajero">Cajero</option>
        </select>
      </div>

      <hr class="my-6" />

      <div>
        <label class="block mb-2 font-medium">Nombre</label>
        <input type="text" name="nombre" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Apellido</label>
        <input type="text" name="apellido" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Teléfono</label>
        <input type="tel" name="telefono" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">DNI</label>
        <input type="text" name="dni" required class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div class="text-center">
        <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-lg shadow hover:bg-indigo-700">Registrar Usuario</button>
      </div>
    </form>
  </div>
</main>

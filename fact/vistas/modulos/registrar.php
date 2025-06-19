<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once 'modelos/usuario.php';
  require_once 'modelos/cliente.php';

  $nombreUsuario = trim($_POST['nombreUsuario']);
  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $telefono = trim($_POST['telefono']);
  $fecha_nacimiento = $_POST['fecha_nacimiento'];
  $dni = trim($_POST['dni']);

  $errores = [];

  // Validaciones del lado del servidor
  if (!preg_match("/^[a-zA-Z0-9_]+$/", $nombreUsuario)) {
    $errores[] = "El nombre de usuario solo puede contener letras, números y guiones bajos.";
  }
  if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $nombre)) {
    $errores[] = "El nombre solo puede contener letras.";
  }
  if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $apellido)) {
    $errores[] = "El apellido solo puede contener letras.";
  }
  if (!preg_match("/^[0-9 +]+$/", $telefono)) {
    $errores[] = "El teléfono solo puede contener números y espacios.";
  }
  if (!ctype_digit($dni)) {
    $errores[] = "El DNI debe contener solo números.";
  }

  if (!empty($errores)) {
    // Mostrar errores si los hay
    $mensaje = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4 text-center">';
    $mensaje .= '<strong class="font-bold">Errores en el formulario:</strong><br>';
    foreach ($errores as $e) {
      $mensaje .= htmlspecialchars($e) . "<br>";
    }
    $mensaje .= '</div>';
  } else {
    // Si no hay errores, continuar con el registro
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $usuario = new Usuario($nombreUsuario, $email, $password_hash, 'cliente');

    if ($usuario->existeEmail($email)) {
      $mensaje = "<p class='text-red-600 text-center mt-4'>El email ya está registrado.</p>";
    } elseif ($usuario->existeNombreUsuario($nombreUsuario)) {
      $mensaje = "<p class='text-red-600 text-center mt-4'>El nombre de usuario ya está en uso.</p>";
    } else {
      $id_usuario = $usuario->guardar();

      if ($id_usuario) {
        $cliente = new Cliente($nombre, $apellido, $telefono, $fecha_nacimiento, 0, 0, $dni, $id_usuario);

        if ($cliente->guardar()) {
          $mensaje = "<p class='text-green-600 text-center mt-4'>Registro exitoso. Ya podés ingresar.</p>";
        } else {
          $mensaje = "<p class='text-red-600 text-center mt-4'>Error al guardar datos del cliente.</p>";
        }
      } else {
        $mensaje = "<p class='text-red-600 text-center mt-4'>Error al guardar usuario.</p>";
      }
    }
  }
}
?>

<!-- Formulario -->
<div class="flex justify-center items-start px-4 pt-24 min-h-screen">
  <div class="bg-white bg-opacity-95 rounded-3xl shadow-2xl max-w-3xl w-full p-10 md:p-16">
    <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center tracking-tight">
      Registrarse
    </h2>

    <?php if (isset($mensaje)) echo $mensaje; ?>

    <form method="post" action="index.php?ruta=registrar" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-800">

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

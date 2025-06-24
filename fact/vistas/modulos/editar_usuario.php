<?php
require_once 'controlador/controlador_usuario.php';
require_once 'modelos/Cliente.php';
require_once 'includes/sesion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'admin') {
    header('Location: index.php?ruta=iniciar');
    exit;
}

$mensaje = '';
$usuario_id = $_GET['id'] ?? null;

if (!$usuario_id) {
    echo "<p class='text-red-600 text-center mt-6'>ID de usuario no especificado.</p>";
    exit;
}

$conexion = Conexion::conectar();

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener datos del cliente
$stmtCliente = $conexion->prepare("SELECT * FROM cliente WHERE usuario_id = ?");
$stmtCliente->execute([$usuario_id]);
$cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !$cliente) {
    echo "<p class='text-red-600 text-center mt-6'>Usuario no encontrado.</p>";
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = UsuarioControlador::actualizarUsuario($usuario_id, $_POST);

    // Si la actualización fue exitosa, redirigir
    if (str_contains($mensaje, 'Usuario actualizado correctamente')) {
        header('Location: index.php?ruta=administrar');
        exit;
    }
}
?>

<main class="flex-grow pt-28 px-4">
  <div class="p-8 max-w-3xl mx-auto bg-white rounded shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Editar Usuario</h1>
    
    <?php if ($mensaje) echo $mensaje; ?>

    <form method="post" class="space-y-6 text-gray-800">
      <div>
        <label class="block mb-2 font-medium">Nombre de Usuario</label>
        <input type="text" name="nombreUsuario" required pattern="[a-zA-Z0-9_]+" value="<?= htmlspecialchars($usuario['nombreUsuario']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Email</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($usuario['email']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Rol</label>
        <select name="rol" required class="w-full p-3 border border-gray-300 rounded-lg">
          <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
          <option value="cajero" <?= $usuario['rol'] === 'cajero' ? 'selected' : '' ?>>Cajero</option>
          <option value="cliente" <?= $usuario['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
        </select>
      </div>

      <hr class="my-6">

      <div>
        <label class="block mb-2 font-medium">Nombre</label>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($cliente['nombre']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Apellido</label>
        <input type="text" name="apellido" required value="<?= htmlspecialchars($cliente['apellido']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Teléfono</label>
        <input type="text" name="telefono" required value="<?= htmlspecialchars($cliente['telefono']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" required value="<?= htmlspecialchars($cliente['fecha_nacimiento']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div>
        <label class="block mb-2 font-medium">DNI</label>
        <input type="text" name="dni" required value="<?= htmlspecialchars($cliente['dni']) ?>" class="w-full p-3 border border-gray-300 rounded-lg" />
      </div>

      <div class="text-center pt-4">
        <button type="submit" class="bg-indigo-600 text-white font-semibold px-10 py-3 rounded-lg shadow-md hover:bg-indigo-700">
          Guardar Cambios
        </button>
      </div>
    </form>
  </div>
</main>

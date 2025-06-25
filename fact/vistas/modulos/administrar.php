<?php
// Evitar acceso directo
if (!defined('ACCESO_PERMITIDO')) {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Iniciar sesión si no está iniciada
require_once 'includes/sesion.php';

// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'admin') {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Controlador usuario
require_once 'controlador/controlador_usuario.php';

$mensaje = '';
$conexion = Conexion::conectar();

// Manejar eliminación si se envía POST con id a eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idAEliminar = intval($_POST['id']);
    if (UsuarioControlador::eliminarUsuario($idAEliminar)) {
        $mensaje = "<p class='text-green-600 text-center mt-4'>Usuario eliminado correctamente.</p>";
    } else {
        $mensaje = "<p class='text-red-600 text-center mt-4'>Error al eliminar el usuario.</p>";
    }
}

// Obtener todos los usuarios ordenados por ID ascendente (1,2,3...)
$stmt = $conexion->prepare("SELECT id, nombreUsuario, email, rol FROM usuario ORDER BY id ASC");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="flex-grow pt-28 px-4">
  <div class="p-8 flex flex-col items-center text-center">
    <h1 class="text-3xl font-bold mb-2 text-white">Panel de Administración</h1>
    <p class="text-gray-300 mb-8">
      Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']->nombreUsuario); ?>.
    </p>

    <!-- Tabla de usuarios -->
    <div class="w-full max-w-5xl overflow-x-auto">
      <table class="w-full table-fixed bg-white text-black rounded shadow-md border border-gray-300">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="py-2 px-4 text-center w-12 align-middle">ID</th>
            <th class="py-2 px-4 text-center w-32 align-middle">Usuario</th>
            <th class="py-2 px-4 text-center w-64 align-middle">Email</th>
            <th class="py-2 px-4 text-center w-32 align-middle">Rol</th>
            <th class="py-2 px-4 text-center w-40 align-middle">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($usuarios) === 0): ?>
            <tr>
              <td colspan="5" class="text-center py-6 text-gray-500">No se encontraron usuarios.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($usuarios as $user): ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 w-12 truncate align-middle">
                  <?= htmlspecialchars($user['id']) ?>
                </td>
                <td class="py-2 px-4 w-32 truncate align-middle">
                  <?= htmlspecialchars($user['nombreUsuario']) ?>
                </td>
                <td class="py-2 px-4 w-64 truncate align-middle">
                  <?= htmlspecialchars($user['email']) ?>
                </td>
                <td class="py-2 px-4 w-32 truncate align-middle">
                  <?= htmlspecialchars($user['rol']) ?>
                </td>
                <td class="py-2 px-4 w-40 align-middle">
                  <div class="flex justify-end space-x-2">
                    <a href="index.php?ruta=editar_usuario&id=<?= $user['id'] ?>"
                      class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                      Editar
                    </a>
                    <form action="index.php?ruta=administrar" method="POST"
                      onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                      <input type="hidden" name="id" value="<?= $user['id'] ?>">
                      <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                        Eliminar
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Mensaje debajo de la tabla -->
      <?php if ($mensaje): ?>
        <div class="mt-4">
          <?= $mensaje ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

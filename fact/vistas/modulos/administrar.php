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

// Conexión a la base de datos
require_once __DIR__ . '/../../conexion.php';
$conexion = Conexion::conectar();

// Obtener todos los usuarios
$stmt = $conexion->prepare("SELECT id, nombreUsuario, email, rol FROM usuario");
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
      <h2 class="text-xl font-semibold mb-4 text-white text-left">Lista de Usuarios</h2>

      <table class="w-full table-fixed bg-white text-black rounded shadow-md border border-gray-300">
        <thead class="bg-gray-200 text-gray-700">
          <tr>
            <th class="py-2 px-4 text-center w-12 align-middle">ID</th>
            <th class="py-2 px-4 text-center w-32 align-middle">Usuario</th>
            <th class="py-2 px-4 text-center w-64 align-middle">Email</th>
            <th class="py-2 px-4 text-center w-32 align-middle">Rol</th>
            <th class="py-2 px-4 text-center w-40 align-middle">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $user): ?>
            <tr class="border-b hover:bg-gray-100">
              <td class="py-2 px-4 w-12 truncate align-middle">
                <?php echo htmlspecialchars($user['id']); ?>
              </td>
              <td class="py-2 px-4 w-32 truncate align-middle">
                <?php echo htmlspecialchars($user['nombreUsuario']); ?>
              </td>
              <td class="py-2 px-4 w-64 truncate align-middle">
                <?php echo htmlspecialchars($user['email']); ?>
              </td>
              <td class="py-2 px-4 w-32 truncate align-middle">
                <?php echo htmlspecialchars($user['rol']); ?>
              </td>
              <td class="py-2 px-4 w-40 align-middle">
                <div class="flex justify-end space-x-2">
                  <a href="index.php?ruta=editar_usuario&id=<?php echo $user['id']; ?>"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                    Editar
                  </a>
                  <form action="index.php?ruta=eliminar_usuario" method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit"
                      class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                      Eliminar
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

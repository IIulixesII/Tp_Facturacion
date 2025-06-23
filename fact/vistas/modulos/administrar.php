<?php
// Evitar acceso directo
if (!defined('ACCESO_PERMITIDO')) {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'admin') {
    header('Location: index.php?ruta=iniciar');
    exit;
}
?>

<h1>Panel de Administración</h1>
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']->nombreUsuario); ?>.</p>

<form method="post" action="index.php?ruta=cerrar_sesion" style="margin-top:20px;">
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Cerrar sesión
    </button>
</form>

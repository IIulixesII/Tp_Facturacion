<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'modelos/Usuario.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validación del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "<p class='text-red-600 text-center mt-4'>Formato de email no válido.</p>";
    } else {
        $usuario = Usuario::buscarPorEmail($email);

        if ($usuario && password_verify($password, $usuario->password)) {
            $_SESSION['usuario'] = $usuario;

            // Redirección según el rol
            switch ($usuario->rol) {
                case 'admin':
                    header('Location: index.php?ruta=administrar');
                    exit;
                case 'cajero':
                    header('Location: index.php?ruta=caja');
                    exit;
                case 'cliente':
                    header('Location: index.php?ruta=inicio');
                    exit;
                default:
                    header('Location: index.php');
                    exit;
            }
        } else {
            $mensaje = "<p class='text-red-600 text-center mt-4'>Email o contraseña incorrectos.</p>";
        }
    }
}
?>

<!-- FORMULARIO LOGIN -->
<div class="flex items-center justify-center px-4 min-h-screen">
    <div class="bg-white bg-opacity-95 rounded-3xl shadow-2xl max-w-md w-full p-10 md:p-12">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center tracking-tight">
            Iniciar Sesión
        </h2>

        <?php if (!empty($mensaje)) echo $mensaje; ?>

        <form method="post" action="" class="space-y-6 text-gray-800">
            <div>
                <label class="block mb-2 font-medium">Email</label>
                <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block mb-2 font-medium">Contraseña</label>
                <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div class="text-center">
                <button type="submit" class="bg-indigo-600 text-white font-semibold px-10 py-3 rounded-lg shadow-md hover:bg-indigo-700">
                    Ingresar
                </button>
            </div>
        </form>
    </div>
</div>

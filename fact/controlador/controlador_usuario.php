<?
require_once 'modelos/Usuario.php';
require_once 'modelos/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos todos los campos requeridos
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $dni = trim($_POST['dni']);
    $saldo = 0;
    $consumo_luz = 0;

    // Crear usuario
    $usuario = new Usuario($nombreUsuario, $email, $password, 'cliente');

    // Validar que no exista email ni nombreUsuario
    if ($usuario->existeEmail($email)) {
        die("El email ya está registrado.");
    }
    if ($usuario->existeNombreUsuario($nombreUsuario)) {
        die("El nombre de usuario ya está en uso.");
    }

    // Guardar usuario
    $id_usuario = $usuario->guardar();

    if ($id_usuario) {
        $cliente = new Cliente($nombre, $apellido, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $usuario_id);

        if ($cliente->guardar()) {
            echo "Registro exitoso!";
        } else {
            echo "Error al guardar el cliente.";
        }
    } else {
        echo "Error al guardar el usuario.";
    }
}





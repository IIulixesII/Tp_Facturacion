<?php
require_once 'modelos/Usuario.php';
require_once 'modelos/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $dni = trim($_POST['dni']);
    $saldo = 0;
    $consumo_luz = 0;

    $usuario = new Usuario($nombreUsuario, $email, $password, 'cliente');

    if ($usuario->existeEmail($email)) {
        die("El email ya está registrado.");
    }

    if ($usuario->existeNombreUsuario($nombreUsuario)) {
        die("El nombre de usuario ya está en uso.");
    }

    $id_usuario = $usuario->guardar();

    if ($id_usuario) {
        $cliente = new Cliente($nombre, $apellido, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $id_usuario);

        if ($cliente->guardar()) {
            echo "Registro exitoso!";
        } else {
            echo "Error al guardar el cliente.";
        }
    } else {
        echo "Error al guardar el usuario.";
    }
}

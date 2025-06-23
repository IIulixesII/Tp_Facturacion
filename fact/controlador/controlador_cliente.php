<?php
require_once __DIR__ . "/../modelos/Cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validaciones simples
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento_input = $_POST['fecha_nacimiento'];
    $saldo = floatval($_POST['saldo']);
    $consumo_luz = intval($_POST['consumo_luz']);
    $dni = trim($_POST['dni']);
    $usuario_id = intval($_POST['usuario_id']);

    // Verificar si el cliente es mayor de edad
    $fecha_nacimiento = new DateTime($fecha_nacimiento_input);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento)->y;

    if ($edad < 18) {
        echo "<script>alert('El cliente debe ser mayor de edad (18 años o más).');</script>";
        exit;
    }

    // Crear cliente
    $cliente = new Cliente($nombre, $apellido, $telefono, $fecha_nacimiento->format('Y-m-d'), $saldo, $consumo_luz, $dni, $usuario_id);

    // Guardar cliente en base de datos
    if ($cliente->guardar()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Error al registrar el cliente.');</script>";
    }
}

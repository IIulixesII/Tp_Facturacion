<?php
require_once __DIR__ . "/../modelos/cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validaciones simples
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $saldo = $_POST['saldo'];
    $consumo_luz = $_POST['consumo_luz'];
    $dni = $_POST['dni'];

    // Verificar si el cliente es mayor de edad
    $fecha_nacimiento = new DateTime($fecha_nacimiento); // Convertir la fecha de nacimiento en un objeto DateTime
    $hoy = new DateTime(); // Obtener la fecha actual
    $edad = $hoy->diff($fecha_nacimiento)->y; // Calcular la edad en años

    if ($edad < 18) {
        echo "<script>alert('El cliente debe ser mayor de edad (18 años o más).');</script>";
        exit; // Termina el script si no es mayor de edad
    }

    // Crear cliente
    $cliente = new Cliente($nombre, $telefono, $fecha_nacimiento->format('Y-m-d'), $saldo, $consumo_luz, $dni);

    // Guardar cliente en base de datos
    if ($cliente->guardar()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Error al registrar el cliente.');</script>";
    }
}
?>

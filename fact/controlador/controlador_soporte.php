<?php
require_once __DIR__ . '/../modelos/Soporte.php';
$mensaje_exito = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["telefono"]);
    $dni = trim($_POST["dni"]);
    $mensaje = trim($_POST["mensaje"]);

   
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "<script>alert('Por favor, completá todos los campos obligatorios.'); window.history.back();</script>";
        exit;
    }

    $consulta = new Soporte($nombre, $email, $telefono, $dni, $mensaje);

    if ($consulta->guardarConsulta()) {
    header("Location: ../vistas/modulos/valoracion.php");
    exit;
}
    echo "<script>alert('Error al enviar la consulta. Por favor, intentá nuevamente.'); window.history.back();</script>";
    exit;
}
include '../vistas/modulos/soporte.php';
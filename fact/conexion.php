<?php
$host = 'localhost'; // o '127.0.0.1'
$usuario = 'root'; // tu nombre de usuario de MySQL
$contrasena = ''; // tu contraseña de MySQL
$base_de_datos = 'fact'; // reemplaza con el nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Opcional: establecer el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");

// echo "Conexión exitosa";
?>

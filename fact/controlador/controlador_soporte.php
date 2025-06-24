<?php
require_once __DIR__ . '/../includes/sesion.php';
require_once __DIR__ . '/../modelos/Soporte.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Guardar nueva consulta
    if (isset($_POST["nombre"])) {
        $nombre = trim($_POST["nombre"]);
        $email = trim($_POST["email"]);
        $telefono = trim($_POST["telefono"]);
        $dni = trim($_POST["dni"]);
        $mensaje = trim($_POST["mensaje"]);

        if (empty($nombre) || empty($email) || empty($mensaje)) {
            echo "<script>alert('Por favor, completá todos los campos obligatorios.'); window.history.back();</script>";
            exit;
        }

        $consulta = new Soporte($nombre, $email, $telefono, $dni, $mensaje, 'norecibido');

        $id_soporte = $consulta->guardarConsulta();

        if ($id_soporte !== false) {
            // Guardamos en sesión el ID para usar en la valoración
            $_SESSION['id_soporte_valoracion'] = $id_soporte;

            header("Location: ../index.php?ruta=valoracion");
            exit;
        } else {
            echo "Error al guardar la consulta.";
            exit;
        }
    }
    if (isset($_POST["id_soporte_estado"]) && isset($_POST["nuevo_estado"])) {
        $id_soporte = intval($_POST["id_soporte_estado"]);
        $nuevoEstado = trim($_POST["nuevo_estado"]);

        if (Soporte::actualizarEstado($id_soporte, $nuevoEstado)) {
            header("Location: ../index.php?ruta=ticket&estado=ok");
            exit;
        } else {
            header("Location: ../index.php?ruta=ticket&estado=error");
            exit;
        }
    }
    // Guardar valoración
    if (isset($_POST["valoracion"]) && isset($_POST["id_soporte"])) {
        $valoracion = intval($_POST["valoracion"]);
        $id_soporte = intval($_POST["id_soporte"]);

        if ($valoracion < 1 || $valoracion > 5 || $id_soporte < 1) {
            echo "Valoración o ID de soporte inválidos. Valoración: $valoracion, ID: $id_soporte";
            exit;
        }

        if (Soporte::guardarValoracion($id_soporte, $valoracion)) {
            // Limpiamos la sesión de la valoración ya realizada
            unset($_SESSION['id_soporte_valoracion']);

            header("Location: ../index.php?ruta=soporte");
            exit;
        } else {
            echo "Error al guardar la valoración.";
            exit;
        }
    }
}

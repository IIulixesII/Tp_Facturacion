<?php
require_once __DIR__ . '/../modelos/Soporte.php';
$mensaje_exito = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["valoracion"])) {
        $valoracion = intval($_POST["valoracion"]);

        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->query("SELECT MAX(id_soporte) AS id_soporte FROM soporte");
            $id_soporte = $stmt->fetch(PDO::FETCH_ASSOC)['id_soporte'];

            $stmt = $pdo->prepare("UPDATE soporte SET valoracion = ? WHERE id_soporte = ?");
            $stmt->execute([$valoracion, $id_soporte]);

            header("Location: ../index.php?ruta=soporte");
            exit;

        } catch (PDOException $e) {
            echo "Error al guardar la valoración: " . $e->getMessage();
        }
    }

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

        $consulta = new Soporte($nombre, $email, $telefono, $dni, $mensaje);

        if ($consulta->guardarConsulta()) {
            header("Location: ../vistas/modulos/valoracion.php");
            exit;
        } else {
            echo "<script>alert('Error al enviar la consulta. Por favor, intentá nuevamente.'); window.history.back();</script>";
            exit;
        }
    }
}

include '../vistas/modulos/soporte.php';
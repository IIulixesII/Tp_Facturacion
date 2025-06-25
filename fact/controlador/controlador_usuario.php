<?php
require_once 'modelos/Usuario.php';
require_once 'modelos/Cliente.php';

class UsuarioControlador
{
    public static function registrarUsuario($data)
    {
        // Limpiar y obtener datos
        $nombreUsuario = trim($data['nombreUsuario']);
        $nombre = trim($data['nombre']);
        $apellido = trim($data['apellido']);
        $email = trim($data['email']);
        $password_raw = $data['password'];
        $telefono = trim($data['telefono']);
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $dni = trim($data['dni']);
        $saldo = 0;
        $consumo_luz = 0;

        $errores = [];

        // Validaciones
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $nombreUsuario)) {
            $errores[] = "El nombre de usuario solo puede contener letras, números y guiones bajos.";
        }
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $nombre)) {
            $errores[] = "El nombre solo puede contener letras.";
        }
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $apellido)) {
            $errores[] = "El apellido solo puede contener letras.";
        }
        if (!preg_match("/^[0-9 +]+$/", $telefono)) {
            $errores[] = "El teléfono solo puede contener números, espacios o +.";
        }
        if (!ctype_digit($dni)) {
            $errores[] = "El DNI debe contener solo números.";
        }

        if (!empty($errores)) {
            $mensaje = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4 text-center">';
            $mensaje .= '<strong class="font-bold">Errores en el formulario:</strong><br>';
            foreach ($errores as $e) {
                $mensaje .= htmlspecialchars($e) . "<br>";
            }
            $mensaje .= '</div>';
            return $mensaje;
        }

        $password = password_hash($password_raw, PASSWORD_DEFAULT);

        $usuario = new Usuario($nombreUsuario, $email, $password, 'cliente');

        if ($usuario->existeEmail($email)) {
            return "<p class='text-red-600 text-center mt-4'>El email ya está registrado.</p>";
        }
        if ($usuario->existeNombreUsuario($nombreUsuario)) {
            return "<p class='text-red-600 text-center mt-4'>El nombre de usuario ya está en uso.</p>";
        }

        $id_usuario = $usuario->guardar();

        if ($id_usuario) {
            $cliente = new Cliente($nombre, $apellido, $telefono, $fecha_nacimiento, $saldo, $consumo_luz, $dni, $id_usuario);

            if ($cliente->guardar()) {
                return "<p class='text-green-600 text-center mt-4'>Registro exitoso. Ya podés ingresar.</p>";
            } else {
                return "<p class='text-red-600 text-center mt-4'>Error al guardar datos del cliente.</p>";
            }
        } else {
            return "<p class='text-red-600 text-center mt-4'>Error al guardar usuario.</p>";
        }
    }
    public static function login($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => true, 'mensaje' => 'Formato de email no válido.'];
        }

        $usuario = Usuario::buscarPorEmail($email);
        if ($usuario && password_verify($password, $usuario->password)) {
            $_SESSION['usuario'] = $usuario;
            return ['error' => false, 'usuario' => $usuario];
        } else {
            return ['error' => true, 'mensaje' => 'Email o contraseña incorrectos.'];
        }
    }


    public static function eliminarUsuario($id)
    {
        $conexion = Conexion::conectar();

        // Primero eliminar los datos relacionados en cliente usando la columna correcta
        $stmt = $conexion->prepare("DELETE FROM cliente WHERE usuario_id = ?");
        $stmt->execute([$id]);

        // Después eliminar el usuario
        $stmt = $conexion->prepare("DELETE FROM usuario WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function obtenerUsuarios($filtro = '')
    {
        $conexion = Conexion::conectar();

        if ($filtro) {
            $sql = "SELECT id, nombreUsuario, email, rol FROM usuario 
                WHERE nombreUsuario LIKE :filtro 
                   OR email LIKE :filtro 
                   OR rol LIKE :filtro
                ORDER BY id DESC";
            $stmt = $conexion->prepare($sql);
            $likeFiltro = "%$filtro%";
            $stmt->bindParam(':filtro', $likeFiltro, PDO::PARAM_STR);
        } else {
            $sql = "SELECT id, nombreUsuario, email, rol FROM usuario ORDER BY id DESC";
            $stmt = $conexion->prepare($sql);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function actualizarUsuario($usuario_id, $data)
{
    $conexion = Conexion::conectar();

    try {
        $conexion->beginTransaction();

        // Actualizar usuario
        $stmtUsuario = $conexion->prepare("UPDATE usuario SET nombreUsuario = ?, email = ?, rol = ? WHERE id = ?");
        $stmtUsuario->execute([
            trim($data['nombreUsuario']),
            trim($data['email']),
            trim($data['rol']),
            $usuario_id
        ]);

        // Actualizar cliente
        $stmtCliente = $conexion->prepare("UPDATE cliente SET nombre = ?, apellido = ?, telefono = ?, fecha_nacimiento = ?, dni = ? WHERE usuario_id = ?");
        $stmtCliente->execute([
            trim($data['nombre']),
            trim($data['apellido']),
            trim($data['telefono']),
            $data['fecha_nacimiento'],
            trim($data['dni']),
            $usuario_id
        ]);

        $conexion->commit();
        return "<p class='text-green-600 text-center mt-4'>Usuario actualizado correctamente.</p>";
    } catch (Exception $e) {
        $conexion->rollBack();
        return "<p class='text-red-600 text-center mt-4'>Error al actualizar: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
}

<?php
require_once 'conexion.php';

class Usuario
{
    public $id;
    public $nombreUsuario;
    public $email;
    public $password;
    public $rol;

    public function __construct($nombreUsuario, $email, $password, $rol = 'cliente')
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function existeEmail($email)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function existeNombreUsuario($nombreUsuario)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE nombreUsuario = ?");
        $stmt->execute([$nombreUsuario]);
        return $stmt->fetchColumn() > 0;
    }

    public function guardar()
    {
    $pdo = Conexion::conectar();

    $hash = password_hash($this->password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuario (nombreUsuario, email, password, rol, activo) VALUES (?, ?, ?, ?, 1)");
    if ($stmt->execute([$this->nombreUsuario, $this->email, $hash, $this->rol])) {
        return $pdo->lastInsertId();
    }
    return false;
    }



    public static function buscarPorEmail($email)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM usuario WHERE email = :email AND activo = 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new stdClass();
            $usuario->id = $fila['id'];
            $usuario->nombreUsuario = $fila['nombreUsuario']; 
            $usuario->email = $fila['email'];
            $usuario->password = $fila['password'];
            $usuario->rol = $fila['rol'];
            return $usuario;
        }

        return null;
    }
}

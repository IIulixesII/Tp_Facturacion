<?php
class Conexion {

    private static ?PDO $instancia = null;

    private function __construct() {} 
    public static function conectar(): PDO {
        if (self::$instancia === null) {  
        try {
            self::$instancia =  new PDO("mysql:host=localhost;dbname=fact;charset=utf8", "root", "");
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    return self::$instancia;
    }
}
?>

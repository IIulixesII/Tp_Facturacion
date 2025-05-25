<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../modelos/turno.php';

class HolaAjax {
    public $nombrePersona;

    public function printValue() {
        var_dump($this->nombrePersona);
    }
}

// Instanciar clase de control
$sprintHola = new HolaAjax();
$sprintHola->nombrePersona = $_POST["nombrePersona"] ?? null;

// Capturar para depuración
ob_start();
$sprintHola->printValue();
$mensajeDebug = ob_get_clean();

$turnoCreado = false;
$numeroTurno = null;

if (!empty($sprintHola->nombrePersona)) {
    $turno = new Turno();

    // Obtener el número de turno siguiente
    $numeroTurno = $turno->contar(); // devuelve el mayor + 1

    // Crear y guardar el nuevo turno
    $nuevoTurno = new Turno("sinatender", $numeroTurno, $sprintHola->nombrePersona);
    $turnoCreado = $nuevoTurno->guardar(); // debe devolver true si se guarda correctamente
}

// Respuesta JSON al frontend
echo json_encode([
    "nombrePersona" => $sprintHola->nombrePersona,
    "numeroTurno" => $numeroTurno,
    "debug" => $mensajeDebug,
    "turnoCreado" => $turnoCreado
]);

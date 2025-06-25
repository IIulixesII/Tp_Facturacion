<?php
// Evitar acceso directo
if (!defined('ACCESO_PERMITIDO')) {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Iniciar sesión si no está iniciada
require_once 'includes/sesion.php';

// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'cajero') {
    header('Location: index.php?ruta=iniciar');
    exit;
}

// Clases del patrón Composite (podés separarlas en otro archivo e incluirlo con require_once)
interface ElementoPanel {
    public function render(): string;
}

class TarjetaSimple implements ElementoPanel {
    private $icono, $texto, $enlace, $color;

    public function __construct($icono, $texto, $enlace, $color) {
        $this->icono = $icono;
        $this->texto = $texto;
        $this->enlace = $enlace;
        $this->color = $color;
    }

    public function render(): string {
        return <<<HTML
<div class="bg-white rounded-xl shadow-lg flex flex-col items-center p-8 hover:shadow-xl transition-shadow">
  <lottie-player src="{$this->icono}" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></lottie-player>
  <a href="{$this->enlace}" class="mt-4 bg-{$this->color}-500 hover:bg-{$this->color}-600 text-white font-semibold px-6 py-3 rounded-full transition-colors">{$this->texto}</a>
</div>
HTML;
    }
}

class Panel implements ElementoPanel {
    private $elementos = [];

    public function agregar(ElementoPanel $elemento) {
        $this->elementos[] = $elemento;
    }

    public function render(): string {
        $html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-8">';
        foreach ($this->elementos as $elemento) {
            $html .= $elemento->render();
        }
        $html .= '</div>';
        return $html;
    }
}

$panel = new Panel();
$panel->agregar(new TarjetaSimple('/fact/icon/icon.json', 'Ver Tabla de Atención', 'index.php?ruta=turno', 'blue'));
$panel->agregar(new TarjetaSimple('/fact/icon/icon4.json', 'Atender', 'index.php?ruta=turnocajero', 'green'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel de Caja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-gray-100">

<div class="h-40"></div>

  <!-- Contenido principal -->
  <main class="flex-grow container mx-auto px-4 py-8">
    <?php echo $panel->render(); ?>
  </main>
  <div class="h-20"></div>
</body>
</html>

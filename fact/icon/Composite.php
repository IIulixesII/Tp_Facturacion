
<?
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

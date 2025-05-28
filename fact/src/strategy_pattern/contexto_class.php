<?php
require_once "strategy_interfaz.php"; 

class Contexto {
    private $strategy;

    public function __construct(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function doSomething() {
        echo "Context: Ordenar datos usando strategy\n";
        
        $result = $this->strategy->doAlgorithm(array("a", "b", "c"));
        
        echo implode(", ", $result) . "\n";
    }
}
?>

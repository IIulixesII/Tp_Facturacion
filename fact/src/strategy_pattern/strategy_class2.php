<?php
require_once "strategy_interfaz.php"; 

class StrategyClass2 implements Strategy {

    public function doAlgorithm(array $data):array {
        // Sorting the array
        rsort($data);
        
        // Return the sorted array
        return $data;
    }
}
?>

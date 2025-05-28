<?php
require_once "strategy_interfaz.php"; 

class StrategyClass implements Strategy {

    public function doAlgorithm(array $data):array {
        // Sorting the array
        sort($data);
        
        // Return the sorted array
        return $data;
    }
}
?>

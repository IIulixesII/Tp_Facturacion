<?php

class HolaAjax {
    public $stringValue;

    public function printValue() {
        var_dump($this->stringValue);
    }
}

$sprintHola = new HolaAjax();
$sprintHola->stringValue = $_POST["moduloHola"];  
$sprintHola->printValue();
?>

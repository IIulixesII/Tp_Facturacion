<?php 

class TemplateController {
    public function GetTemplate(): void {
        include "vistas/template.php";
    }


    public function Getheader(): void {
        include "vistas/header.php";
    }


      public function GetFooter(): void {
        include "vistas/footer.php";
    }
}

?>

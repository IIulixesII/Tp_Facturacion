<?php
ini_set('display_errors',  1);
ini_set('log_errors',  1);
ini_set('error_log', 'C:\xampp\htdocs\fact\php_error_log');

require_once "controlador/template_controler.php";
require_once "modelos/routes.php";
require_once 'conexion.php';

$template = new TemplateController();
$template->GetHeader();       // genera <html><head><body>
$template->GetTemplate();     // contenido principal
$template->GetFooter();       // cierre de </body></html> y footer

?>

<?php

ini_set('display_errors',  1);
ini_set('log_errors',  1);
ini_set('error_log', 'C:\xampp2\htdocs\programa\php_error_log');

//Incluri controladores
//Inluir modelos

//Clases necesarias

//Incluir extensiones
require_once "controlador/template_controler.php";
require_once "modelos/routes.php";

$template = new TemplateController();
$template->GetTemplate();

?>

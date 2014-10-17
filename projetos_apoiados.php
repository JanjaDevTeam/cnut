<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('controller/controller_projeto.php');
session_start();

$ct = new ControllerProjeto;
$db = new Database;

$template['projetos'] = $ct->getProjetosApoiados($_SESSION['id']);

$template['menuPerfil'] = 1;
$template['page'] = "user/projetos_apoiados";
require_once('template/main.php');
?>

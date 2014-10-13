<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('controller/controller_projeto.php');
session_start();

$ct = new ControllerProjeto;

$template['projetos'] = $ct->getProjetosByOwner($_SESSION['id']);

$template['menuPerfil'] = 2;
$template['page'] = "user/meus_projetos";
require_once('template/main.php');
?>

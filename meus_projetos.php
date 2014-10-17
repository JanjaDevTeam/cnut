<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('controller/controller_projeto.php');
session_start();

$ct = new ControllerProjeto;
$db = new Database;
$template['projetos'] = $ct->getProjetosByOwner($_SESSION['id']);
//Janja::Debug($template['projetos']); exit;

$template['menuPerfil'] = 2;
$template['page'] = "user/meus_projetos";
require_once('template/main.php');
?>

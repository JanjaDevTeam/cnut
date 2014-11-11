<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('model/projeto.php');

session_start();


$db     = new Database;
$vip = $db->getVipList();

if(!isset($_SESSION['email']) || !in_array($_SESSION['email'], $vip)) {
	header('HTTP/1.0 403 Forbidden');
	echo "<h4>Forbidden<h4>";
	exit;
}


$template['menuAtivo'] = 2;
$nome = explode(" ", $_SESSION['nome']);
$template['username'] = $nome[0];

$template['projetos'] = $db->getAtivosList();
$template['qtdAtivos'] = sizeof($template['projetos']);

$template['page'] = "admin/projetos_ativos";
require_once("template/admin.php");
?>

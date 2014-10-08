<?php
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

session_start();

if (isset($_SESSION['id'])) {
	if (!file_exists('img/userpics/' . $_SESSION['id'] . '.jpg')) {
		$template['alertaFoto'] = true;
	}
}

$ct = new ControllerProjeto;
$template['projetos'] = $ct->getProjetos();

$template['projetos'][0]['pct'] = 35;
$template['projetos'][1]['pct'] = 85;
$template['projetos'][2]['pct'] = 10;



//Janja::Debug($template['projetos'][0]);


$template['menu'] = 'explorar';
$template['page'] = "explorar";
require_once('template/main.php');
?>

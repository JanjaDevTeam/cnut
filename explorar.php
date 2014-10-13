<?php
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

session_start();

if (isset($_SESSION['id'])) {
	if (!file_exists('img/userpics/' . $_SESSION['id'] . '.jpg')) {
		$template['alertaFoto'] = true;
	}
}

$db = new Database;
$template['categorias'] = $db->getCategorias();

$ct = new ControllerProjeto;
if(isset($_GET['idCat'])) {
	$categoria = $db->getCategoria($_GET['idCat']);
	$template['idCat'] = $_GET['idCat'];
	$template['categoria'] = $categoria[0]['categoria'];
	$template['projetos'] = $ct->getProjetos($_GET['idCat'], 1);
} else {
	$template['idCat'] = 0;
	$template['projetos'] = $ct->getProjetos(null, 1);
}



$template['menu'] = 'explorar';
$template['page'] = "explorar";
require_once('template/main.php');
?>

<?php
require_once('model/database.php');
require_once('model/projeto.php');
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

session_start();
if (isset($_POST['nome'])) {
	$proj = new Projeto;

	$proj->setIdUser($_SESSION['id']);
	$proj->setNome($_POST['nome']);
	$proj->setIdCategoria($_POST['categoria']);
	$proj->setDescricao($_POST['descricao']);
	$proj->setFrase($_POST['frase']);
	$proj->setValor((int)$_POST['valor']);
	$proj->setPrazo((int)$_POST['prazo']);
	$proj->setVideo($_POST['video']);
	$proj->setLinks($_POST['links']);
	$proj->setAtivo(0); // precisa passar por aprovação para ativar
	$proj->setAnalise(0);

	// manda pro controlador fazer a validação
	$ctr = new ControllerProjeto;
	$val = $ctr->validarProjeto($proj);
	if ($val === True) {
		$db = new Database;
		$proj = $db->saveProjeto($proj);
		$id = $proj->getId();
		header("Location: projeto.php?id=$id");
	}
	 
} else {
	$db = new Database;
	$template['categorias'] = $db->getCategorias();
	$template['page'] = 'projeto/form_projeto';
	require_once('template/editor.php');	
}


?>

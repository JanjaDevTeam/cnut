<?php
require_once('model/database.php');
require_once('model/projeto.php');
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

session_start();
$db = new Database;
$ct = new ControllerProjeto;

// caso venha do formulário
if(isset($_POST['id'])) {
	
	$db = new Database;
	$proj = $db->getProjeto($_POST['id']);

	$proj->setNome($_POST['nome']);
	$proj->setIdCategoria($_POST['categoria']);
	$proj->setDescricao($_POST['descricao']);
	$proj->setFrase($_POST['frase']);
	$proj->setValor((int)$_POST['valor']);
	$proj->setPrazo((int)$_POST['prazo']);
	$proj->setVideo($_POST['video']);
	$proj->setLinks($_POST['links']);

	// manda pro controlador fazer a validação
	$ctr = new ControllerProjeto;
	$val = $ctr->validarProjeto($proj);
	if ($val === True) {
		$db = new Database;
		$proj = $db->saveProjeto($proj);
		$id = $proj->getId();
		header("Location: projeto.php?id=$id&action=alt");
	}
	 
} else {
	

}


$id = $_GET['id'];
$proj = $ct->getProjetoCompleto($id);

$template['nome'] = $proj['projeto']->getNome();
$template['descricao'] = $proj['projeto']->getDescricao();
$template['frase'] = $proj['projeto']->getFrase();
$template['valor'] = $proj['projeto']->getValor();
$template['prazo'] = $proj['projeto']->getPrazo();
$template['video'] = $proj['projeto']->getVideo();
$template['categoria'] = $proj['projeto']->getIdCategoria();
$template['id'] = $proj['projeto']->getId();

if($template['video'] != "") {
	$template['image'] = $proj['projeto']->getImage();
}


$template['links'] = $proj['projeto']->getLinks();
$template['categorias'] = $db->getCategorias();
$template['page'] = 'projeto/alterar_projeto';


require_once('template/editor.php');

?>

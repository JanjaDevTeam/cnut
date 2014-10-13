<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('model/projeto.php');
require_once('model/colaboracao.php');

//Janja::Debug($_POST);

// caso venha do formulário
if(isset($_POST['valor'])) {
	$valor     = $_POST['valor'];
	$descricao = $_POST['descricao'];
	$qtdTotal  = $_POST['quantidade'];
	$idProjeto = $_POST['idProjeto'];
	
	$db = new Database;

	$colab = new Colaboracao;
	$colab->setValor($valor);
	$colab->setDescricao($descricao);
	$colab->setQtdTotal($qtdTotal);
	$colab->setQtdComprada(0);
	$colab->setIdProjeto($idProjeto);

	$colab = $db->saveColaboracao($colab);
	
	$idProjeto = $colab->getIdProjeto();
	Header("Location: colaboracao.php?id=$idProjeto&msg=1");

} else if(isset($_POST['action'])) {
	if($_POST['action'] == "del") {
		$db = new Database;
		$idColab = $_POST['idColab'];
		$idProjeto = $_POST['idProjeto'];
		
		$colab     = $db->getColaboracao($idColab);
		$db->delColaboracao($colab);
		Header("Location: colaboracao.php?id=$idProjeto&msg=1");
	}

} else {
	$idProjeto = $_GET['id'];
	$db = new Database;
	$proj  = $db->getProjeto($idProjeto);
	
	if(isset($_GET['msg']) && $_GET['msg'] == 1) {
		$template['msg'] = "Sucesso!";
	}
	$template['colab'] = $db->getColaboracaoByProjeto($idProjeto);
	$template['projeto'] = $proj->getNome();
	$template['idProjeto'] = $proj->getId();

	$template['page'] = 'projeto/colaboracao';
	require_once('template/main.php');
}


?>

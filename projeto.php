<?php
require_once('model/database.php');
require_once('model/projeto.php');
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

session_start();
$db = new Database;
$ct = new ControllerProjeto;

$id = $_GET['id'];

$proj = $ct->getProjetoCompleto($id);


$template['nome']          = $proj['projeto']->getNome();
$template['categoria']     = $proj['projeto']->getCategoria();
$template['video']         = $proj['videoId'];
$template['backers']       = $proj['backers'];
$template['arrecadado']    = $proj['projeto']->getValorArrecadado();
$template['diasRestantes'] = $proj['diasRestantes'];
$template['total']         = $proj['projeto']->getValor();
$template['proponente']    = $proj['proponente'];
$template['frase']         = $proj['projeto']->getFrase();
$template['descricao']     = $proj['projeto']->getDescricao();
$template['apoio']         = $proj['projeto']->getColaboracao();
$template['idProjeto']     = $proj['projeto']->getId();
$template['analise']       = $proj['projeto']->getAnalise();
$template['ativo']         = $proj['projeto']->getAtivo();
$template['page']          = "projeto/projeto";

// verifica se é o dono
if (isset($_SESSION['id'])) {
	if($_SESSION['id'] == $proj['idProponente']) {
		$template['session'] = 'owner';
	}
	
	// mensagem
	if($template['ativo'] == 0 && $template['analise'] == 0) {
		$template['msg'] = "Envie seu projeto para análise.";
	}
	
	// verifica se tem colaboração
	$colab = $proj['projeto']->getColaboracao();
	if(sizeof($colab) == 0) {
		$template['bloqueado'] = 1;
		$template['msg'] = "Antes de enviar para análise o projeto, defina os valores de apoio.";
	}
} else {
	// não é dono e não está ativo, redireciona pra index
	if($template['ativo'] == 0) {
		header('location: index.php');
	}
}


$template['menu'] = 'explorar';
require_once('template/main.php');

?>

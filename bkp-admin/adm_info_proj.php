<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('model/projeto.php');
require_once('controller/controller_projeto.php');

session_start();


$db     = new Database;
$vip = $db->getVipList();

if(!isset($_SESSION['email']) || !in_array($_SESSION['email'], $vip)) {
	header('HTTP/1.0 403 Forbidden');
	echo "<h4>Forbidden<h4>";
	exit;
}

$data['menuAtivo'] = $_GET['local'] == "ativos" ? 2 : 1;

$nome = explode(" ", $_SESSION['nome']);
$data['username'] = $nome[0];

$id = $_GET['id'];

$proj = $db->getProjeto($id);

$data['id'] = $id;
$data['nome'] = $proj->getNome();
$data['categoria'] = $proj->getCategoria();
$owner = $db->getOwnerInfo($id);
$data['owner'] = $owner['nome'];
$data['email'] = $owner['email'];
$data['ativo'] = ($proj->getAtivo() == 0) ? "Inativo" : "Ativo";
$data['analise'] = ($proj->getAnalise() == 0) ? "Não enviado" : "Em análise";
$data['projAnalise'] = $proj->getAnalise();
$data['projAtivo'] = $proj->getAtivo();



$ct = new ControllerProjeto;
$projArray = $ct->getProjetoCompleto($id);
$data['diasRestantes']   = $projArray['projeto']->getDiasRestantes();
$data['prazo']           = $projArray['projeto']->getPrazo();
$data['pct']             = $projArray['projeto']->getPorcentagem();


$template['page'] = "admin/info_proj";
require_once("template/admin.php");
?>

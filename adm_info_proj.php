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

$template['menuAtivo'] = $_GET['local'] == "ativos" ? 2 : 1;

$nome = explode(" ", $_SESSION['nome']);
$template['username'] = $nome[0];

$id = $_GET['id'];

$proj = $db->getProjeto($id);

$template['id'] = $id;
$template['nome'] = $proj->getNome();
$template['categoria'] = $proj->getCategoria();
$owner = $db->getOwnerInfo($id);
$template['owner'] = $owner['nome'];
$template['email'] = $owner['email'];
$template['ativo'] = ($proj->getAtivo() == 0) ? "Inativo" : "Ativo";
$template['analise'] = ($proj->getAnalise() == 0) ? "Não enviado" : "Em análise";
$template['projAnalise'] = $proj->getAnalise();
$template['projAtivo'] = $proj->getAtivo();



$ct = new ControllerProjeto;
$projArray = $ct->getProjetoCompleto($id);
$template['diasRestantes']   = $projArray['projeto']->getDiasRestantes();
$template['prazo']           = $projArray['projeto']->getPrazo();
$template['pct']             = $projArray['projeto']->getPorcentagem();


$template['page'] = "admin/info_proj";
require_once("template/admin.php");
?>

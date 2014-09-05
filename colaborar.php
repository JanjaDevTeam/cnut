<?php
require_once('lib/janja.php');
require_once('model/colaboracao.php');
require_once('model/projeto.php');
require_once('model/database.php');
session_start();


$id = $_GET['id'];

$db = new Database;
$colab = $db->getColaboracao($id);
$idProjeto = $colab->getIdProjeto();
$proj = $db->getProjeto($idProjeto);

$template['projeto'] = $proj->getNome();
$template['descricao']  = $colab->getDescricao();
$template['valor'] = $colab->getValor();
$template['qtdTotal'] = $colab->getQtdTotal();
$template['qtdComprada'] = $colab->getQtdComprada();
$template['id'] = $colab->getId();

$template['page'] =  'projeto/colaborar';
require_once('template/main.php');
?>

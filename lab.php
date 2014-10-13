<?php
require_once("model/database.php");
require_once("model/colaboracao.php");
require_once("model/projeto.php");
require_once('lib/janja.php');

$db = new Database;

$colab = $db->getColabBySeed('32501f2d5265220c5c06160ff6a6552d');
$idProj = $colab->getIdProjeto();
$proj   = $db->getProjeto($idProj);


Janja::Debug($proj);

$valor = $colab->getValor();
$valorArrecadado = $proj->getValorArrecadado();
$valorArrecadado += $valor;
$proj->setValorArrecadado($valorArrecadado);
$proj = $db->saveProjeto($proj);

?>

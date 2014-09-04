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
//Janja::Debug($proj);


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
$template['page']          = "projeto/projeto";

require_once('template/main.php');

?>

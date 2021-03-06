<?php
require_once('lib/janja.php');
require_once('lib/moip-php-master/lib/Moip.php');
require_once('lib/moip-php-master/lib/MoipClient.php');
require_once('model/database.php');
require_once('model/colaboracao.php');
require_once('controller/controller_cotas.php');
session_start();
$db = new Database;
$colab = $db->getColaboracao($_POST['id']);
$seed = md5(date("Y-m-d H:i:s") . "JANJA");
$ct = new ControllerCotas;
$idUser = $_SESSION['id'];
$ct->comprarCotas($idUser, $_POST['id'], $seed);

$moip = new MoIP;
$moip->setCredential(array("key"=>"4VQGQOGKWA1QBHJEOR0HTAXNFSYIYNRYK9BDZ6YU", "token"=>"JB2QWDEXN3HKYH28JBZUFKFWHI1PJMJZ"));
$moip->setUniqueId($seed);
$moip->setReason('Solucionatica - Fase de testes');
$moip->setValue($colab->getValor());
$moip->setEnvironment('test');
$moip->setReturnURL('http://177.43.24.135:8081/cnut/projetos_apoiados.php');
$moip->setNotificationURL('http://177.43.24.135:8081/cnut/labmoip.php');
$moip->validate();
$moip->send();



$url = $moip->getAnswer()->payment_url;
Header("Location: $url");

?>

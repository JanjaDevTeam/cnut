<?php
require_once('model/database.php');
require_once('model/user.php');
require_once("controller/controller_login.php");
require_once('lib/janja.php');

session_start();

// caso venha do form
if (isset($_POST['nome'])) {
	$nome   = $_POST['nome'];
	$email  = $_POST['email'];
	$senha  = $_POST['senha'];
	$senha2 = $_POST['senha2'];
	
	$ct = new ControllerLogin;
	$ct->registrar($nome, email, senha, senha2);
	
}

$content = "user/registrar";
require_once('template/main.php');
?>

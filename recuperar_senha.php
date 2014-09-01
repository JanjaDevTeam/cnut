<?php
require_once('controller/controller_login.php');
require_once('model/carteiro.php');
require_once('model/database.php');
require_once('lib/janja.php');
// recebe email do form
if (isset($_POST['email'])) {
	$ct = new ControllerLogin;
	$result = $ct->recuperarSenha($_POST['email']);
	
	$template['page'] = 'user/resultado_senha';
	$template['msg']  = $result;

} else if (isset($_POST['senha'])) {
	$ct = new ControllerLogin;
	$senha  = $_POST['senha'];
	$senha2 = $_POST['senha2'];
	$token  = $_POST['token'];
	
	$db = new Database;
	$token = $db->getTokenByToken($_POST['token']);
	$idUser = $token[0]['idUser'];
	$token  = $token[0]['token'];
	
	// redefine
	$redefinir = $ct->redefinirSenha($idUser, $senha, $senha2, $token);
	if ($redefinir == true) {
		$template['msg']  = 'senha_ok';
	} else if ($redefinir == false) {
		$template['msg']  = 'senha_erro';
	}
	$template['page'] = 'user/resultado_senha';


// recebe token
} else if (isset($_GET['t'])) {
	$ct = new ControllerLogin;
	$result = $ct->recuperarSenhaToken($_GET['t']);
	
	if ($result == true) {
		// token existe, formulário para redefinir senha
		$template['token'] = $_GET['t'];
		$template['page']  = 'user/form_senha';
	}else if ($result == false) {
		// não existe ou expirou
		$template['page'] = 'user/resultado_senha';
		$template['msg'] = 'expirou';
	}
	
	
} else {
// formulário de email	
	$template['page'] = 'user/form_email';
}


require_once('template/main.php');
?>

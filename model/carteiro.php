<?php
class Carteiro {
	
	// email para ativação de conta
	static function emailCadastro($email, $token) {
		$app = explode("/", $_SERVER['REQUEST_URI'])[1];
		
		$assunto = "[Coconut] Bem vindo!";

		$msg = "Bem vindo à Solucionática\n\n" .
		"Para completar seu cadastro clique aqui: \n" .
		"http://" . $_SERVER['HTTP_HOST'] . "/" . $app . "/ativar.php?t=$token" .
		"\n\nEste link é válido por 24 horas.";

		mail ( $email , $assunto , $msg );

	}

	//email para recuperar senha
	static function emailSenha($email, $token) {
		$app = explode("/", $_SERVER['REQUEST_URI'])[1];
		
		$assunto = "[Coconut] Redefinir senha";

		$msg = "Solucionática\n\n" .
		"Para redefinir sua senha clique aqui: \n" .
		"http://" . $_SERVER['HTTP_HOST'] . "/" . $app . "/nova_senha.php?t=$token" .
		"\n\nEste link é válido por 24 horas.";

		mail ( $email , $assunto , $msg );

	}
}
?>

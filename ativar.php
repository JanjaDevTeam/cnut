<?php
require_once('model/database.php');
require_once('lib/janja.php');

if (!isset($_GET['t'])) {
	// redireciona para index
	header("location: index.php");
} else {
	// caso receba token por GET
	if (isset($_GET['t'])) {
		$db = new Database;
		
		//verifica se o token existe
		$token = $db->getTokenByToken($_GET['t']);
		
		if (sizeof($token) == 1) {
			$reg = $token[0]['dataRegistro'];
			$now = date("Y-m-d H:i:s");
			$segundos = strtotime($now) - strtotime($reg);
			
			// menos de 24 horas, ativa o cadastro.
			if ($segundos < 86400) {
				// ativa o cadastro
				$user = $db->getUserById($token[0]['idUser']);
				$user->setAtivo(1);
				$user = $db->saveUser($user);
				
				// solução temporária
				$db->deleteToken($token[0]['token']);
				$template['page'] = "logar";
				$template['bemvindo'] = true;
				require_once('template/main.php');
				
			// mais de 24 horas, apaga o token
			} else {
				$db->deleteOldTokens();
				// token não existe ou já expirou
				$template['page'] = "user/token_nao_existe";
				require_once('template/main.php');
			}
		} else {
			// token não existe ou já expirou
			$template['page'] = "user/token_nao_existe";
			require_once('template/main.php');		
		}	
		
	}
	
	
}
?>

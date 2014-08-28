<?php
class ControllerLogin {
	
	// loga pelo facebook
	public function loginFb($fbemail, $fbfullname, $fbid) {
		$db = new Database;
		
		// verifica se já está cadastrado
		$user = $db->getUserByEmail($fbemail);
		
		
		if ($user != null) {
			// já cadastrado, atualiza foto e acesso
			$user->setDataAcesso($user->getNow());
			// copia foto do fb para pasta img/userpics
			$url = "https://graph.facebook.com/" .  $fbid . "/picture?type=square";
			$img = "img/userpics/" . $user->getId() . "-fb.jpg";
			copy($url, $img);
			
		} else {
			echo "usuario não existe, cadastrar";
			$user = new User;
			
			// cadastra o usuário
			$user->setNome($fbfullname);
			$user->setEmail($fbemail);
			$user->setFbId($fbid);
			$user->setDataRegistro($user->getNow());
			$user->setDataAcesso($user->getNow());
			$user->setAtivo(1);
			$user = $db->saveUser($user);
			
			// copia foto do fb para pasta img/userpics
			$url = "https://graph.facebook.com/" .  $fbid . "/picture?type=square";
			$img = "img/userpics/" . $user->getId() . "-fb.jpg";
			copy($url, $img);
					
		}
		
		// registra na sessão
		$_SESSION = array();
		$_SESSION['id']    = $user->getId();
		$_SESSION['nome']  = $fbfullname;
		$_SESSION['email'] = $fbemail;
		$_SESSION['fbId']  = $fbid;
		
		// redireciona para index
		header('location: index.php');
	}
	
	// loga pelo formulário de login
	public function loginAccount() {
		// implementar
	}
	
	// registra usuário pelo formulário
	public function registrar($nome, $email, $senha, $senha2) {
		$user = new User;
		$user->setNome($nome);
		$user->setEmail($email);
		$user->setSenha($senha);
		$user->setDataRegistro($user->getNow());
		$user->setDataAcesso($user->getDataRegistro());
		$user->setAtivo(0);
		
		$db = new Database;
		$user = $db->saveUser($user);
		
		Janja::Debug($user);
	}

}
?>

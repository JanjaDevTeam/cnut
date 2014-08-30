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
			$user = $db->saveUser($user);
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
			$user->setAtivo(0);
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
	public function loginForm($user) {
		$db = new Database;
		$logar = $db->logar($user);
		
		if ($logar == true) {
			$user = $db->getUserByEmail($user->getEmail());
			$_SESSION['id']    = $user->getId();
			$_SESSION['nome']  = $user->getNome();
			$_SESSION['email'] = $user->getEmail();
			return true;
		} else {
			return false;
		}
	}
	
	// registra usuário pelo formulário
	public function registrar($nome, $email, $senha, $senha2) {
		$erro = array();
		// valida senha
		if ($senha != $senha2) {
			$erro[] = "As senhas não batem.";
			return $erro;
		}
		
		// verifica se existe
		$db = new Database;
		$user = $db->getUserByEmail($email);
		
		// caso exista o usuário
		if ($user != null) {
			// se a senha estiver em branco, cadastrou pelo facebook
			if ($user->getAtivo() == 1) {
				$erro[] = "Este email já está cadastrado.";
				return $erro;
			// caso contrário, seta senha e salva
			} else {
				$user->setSenha($senha);
				$user->setNome($nome);
				$user = $db->saveUser($user);
			}
		// caso não exista, cadastra
		} else {
		
			$user = new User;
			$user->setNome($nome);
			$user->setEmail($email);
			$user->setSenha($senha);
			$user->setDataRegistro($user->getNow());
			$user->setDataAcesso($user->getDataRegistro());
			$user->setAtivo(0);
			
			$user = $db->saveUser($user);
		}
		
		//registra token de ativação
		$token  = $this->genToken();
		$idUser = $user->getId();
		$now    = $user->getNow();
		$motivo = "cadastro";
		$db->saveToken($idUser, $now, $token, $motivo);
		
		// envia email, 24 horas para ativar.
		Carteiro::emailCadastro($email, $token);

		return $erro;
	}
	
	// gera token para cadastro de conta e recuperação de senha
	public function genToken() {
		$gen = "J4NJ4D3VT34M-Coconut2014" . date("Y-m-d H:i:s");
		return md5($gen);
	}

}
?>

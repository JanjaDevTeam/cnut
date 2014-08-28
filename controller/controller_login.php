<?php
class ControllerLogin {
	
	public function loginFb($fbemail, $fbfullname, $fbid) {
		$db = new Database;
		// verifica se já está cadastrado
		$user = $db->getUserByEmail($fbemail);
		if ($user != null) {
			Janja::Debug($user);
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
			
			// registra na sessão
			$_SESSION = array();
			$_SESSION['id']    = $user->getId();
			$_SESSION['nome']  = $fbfullname;
			$_SESSION['email'] = $fbemail;
			$_SESSION['fbId']  = $fbid;
			
			// redireciona para index
			header('location: index.php');
			
			
		}
	}

}
?>

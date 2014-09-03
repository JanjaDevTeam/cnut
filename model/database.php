<?php
require_once('model/user.php');

class Database extends PDO {
	public function __construct() {
		
		// servidor local
		$config = array(
			'db_type' => 'mysql',
			'db_host' => 'localhost',
			'db_name' => 'Coconut',
			'db_username' => 'janjaCoconut',
			'db_password' => 'janjaCoconut'
		);

		// servidor janja
		/*
		$config = array(
			'db_type' => 'mysql',
			'db_host' => 'localhost',
			'db_name' => 'rc2co684_coconut',
			'db_username' => 'rc2co684_coconut',
			'db_password' => 'janja2099'
		);
		*/
		
		try {
			parent::__construct($config['db_type'].':host='.$config['db_host'].';dbname='.$config['db_name'],$config['db_username'],$config['db_password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){				
				die('ERROR: '. $e->getMessage());
		}
	}


	#### USER
	public function saveUser($user) {
		$id           = $user->getId();
		$nome         = $user->getNome();
		$email        = $user->getEmail();
		$senha        = $user->getSenha();
		$fbId         = $user->getFbId();
		$dataRegistro = $user->getDataRegistro();
		$dataAcesso   = $user->getDataAcesso();
		$ativo        = $user->getAtivo();
		
		
		if ($id == null) {
			$sql = "INSERT INTO user (nome, email, senha, fbId, dataRegistro, dataAcesso, ativo) 
			VALUES ('$nome', '$email', '$senha', '$fbId', '$dataRegistro', '$dataAcesso', $ativo)";
			$stmt = $this->prepare($sql);
			$result = $stmt->execute();
			$id = $this->lastInsertId();
			$user->setId($id);
		} else {
			$sql = "UPDATE user SET nome='$nome', email='$email', fbId='$fbId', 
			dataRegistro='$dataRegistro', dataAcesso='$dataAcesso', ativo=$ativo   
			WHERE id = " . $id;
			$stmt = $this->prepare($sql);
			$result = $stmt->execute();
		}
		return $user;
	}
	
	public function saveToken($idUser, $dataRegistro, $token, $motivo) {
		$sql = "INSERT INTO token (idUser, dataRegistro, token, motivo) 
		VALUES ($idUser, '$dataRegistro', '$token', '$motivo')";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();

		return true;
	}
	
	public function getUserById($id) {
		$sql = "SELECT nome, email, senha, fbId, dataRegistro, dataAcesso, ativo FROM user 
		WHERE id = " . $id;
		$stmt = $this->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$user = new User;
		$user->setId($id);
		$user->setFbId($result[0]['fbId']);
		$user->setNome($result[0]['nome']);
		$user->setEmail($result[0]['email']);
		$user->setSenha($result[0]['senha']);
		$user->setDataRegistro($result[0]['dataRegistro']);
		$user->setDataAcesso($result[0]['dataAcesso']);
		$user->setAtivo($result[0]['ativo']);
		
		
		return $user;

	}
	public function getUserByEmail($email) {
		$sql = "SELECT id FROM user WHERE email = '$email'";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (sizeof($result) > 0) {
			$id = $result[0]['id'];
			$user = $this->getUserById($id);
			return $user;
		}
		return False;
	}
	
	public function getTokenByToken($token) {
		$sql = "SELECT idUser, dataRegistro, token, motivo 
		FROM token where token='$token'";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function verificarToken($idUser, $motivo) {
		$sql = 'SELECT COUNT(id) as total FROM token WHERE idUser = ' . $idUser . 
		' AND motivo = \'' . $motivo . '\' AND dataRegistro > (NOW() - INTERVAL 1 DAY)';
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result['0']['total'];
	}
	
	public function deleteOldTokens() {
		$sql = "delete from token where dataRegistro < (NOW() - INTERVAL 1 DAY)";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		
		return true;
	}
	
	public function deleteToken($token) {
		$sql = "DELETE FROM token WHERE token = '$token'";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		
		return true;
	}
	
	#### /USER
	
	#### LOGIN
	public function logar($user) {
		$email = $user->getEmail();
		$senha = $user->getSenha();
		$sql = "SELECT id FROM user WHERE email = '$email' AND senha = '$senha'";
		
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (sizeof($result) == 0) {
			return false;
		} else if(sizeof($result) == 1) {
			$user = $this->getUserByEmail($email);
			
			return $user;
		}
	}
	
	// redefine senha
	public function redefinirSenha($user) {
		$sql = "UPDATE user SET senha = '" . $user->getSenha() . "' 
		WHERE id = " . $user->getId();
		
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		
		return true;
		
	}
	
	#### PROJETOS
	
	public function getCategorias() {
		$sql = "SELECT id, categoria FROM categoria";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getProjeto($id) {

		// implementar
		$sql = 'SELECT idUser, idCategoria, nome, descricao, frase, valor, valorArrecadado, prazo, video, links, ativo, analise, dataRegistro, categoria 
		FROM projeto, categoria WHERE projeto.idCategoria = categoria.id AND projeto.id = ' . $id;
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$projeto = new Projeto;

		$projeto->setId($id);
		$projeto->setIdUser($result[0]['idUser']);
		$projeto->setIdCategoria($result[0]['idCategoria']);
		$projeto->setCategoria($result[0]['categoria']);
		$projeto->setNome(stripslashes($result[0]['nome']));
		$projeto->setDescricao(stripslashes($result[0]['descricao']));
		$projeto->setFrase(stripslashes($result[0]['frase']));
		$projeto->setValor(stripslashes($result[0]['valor']));
		$projeto->setValorArrecadado(stripslashes($result[0]['valorArrecadado']));
		$projeto->setPrazo(stripslashes($result[0]['prazo']));
		$projeto->setVideo(stripslashes($result[0]['video']));
		$projeto->setLinks(stripslashes($result[0]['links']));
		$projeto->setDataRegistro($result[0]['dataRegistro']);
		$projeto->setAtivo($result[0]['ativo']);
		$projeto->setAnalise($result[0]['analise']);

		return $projeto;


	}
	
	public function saveProjeto($projeto) {
		$id          = $projeto->getId();
		$idUser      = $projeto->getIdUser();
		$idCategoria = $projeto->getIdCategoria();
		$nome        = addslashes($projeto->getNome());
		$descricao   = addslashes($projeto->getDescricao());
		$frase       = addslashes($projeto->getFrase());
		$valor       = addslashes($projeto->getValor());
		$valorArrecadado = addslashes($projeto->getValorArrecadado());
		$prazo       = addslashes($projeto->getPrazo());
		$video       = addslashes($projeto->getVideo());
		$links       = addslashes($projeto->getLinks());
		$ativo       = $projeto->getAtivo();
		$analise     = $projeto->getAnalise();
		
		Janja::Debug($projeto);


		if ($id == null) {
			$valorArrecadado = 0;
			# grava o projeto no banco
			$sql = "INSERT INTO projeto 
			(idUser, idCategoria, nome, descricao, frase, valor, valorArrecadado, prazo, video, links, ativo, analise) 
			VALUES ($idUser, $idCategoria, '$nome', '$descricao', '$frase', $valor, $valorArrecadado,  $prazo, '$video', '$links', $ativo, $analise)";
			print "<br/><br/>$sql<br/><br/>";
			$stmt = $this->prepare($sql);
			$result = $stmt->execute();
			$projeto->setId($this->lastInsertId());

			return $projeto;

			

		} else {

			// testar após getProjeto

			$sql = "UPDATE projeto SET 
			idCategoria = $idCategoria, nome ='$nome', descricao='$descricao', frase='$frase', 
			valor=$valor, valorArrecadado = $valorArrecadado, prazo='$prazo', video='$video', 
			links='$links', ativo=$ativo, analise=$analise  
			WHERE id = $id";

			$stmt = $this->prepare($sql);
			$result = $stmt->execute();

			return $projeto;

		}


	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

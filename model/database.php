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

	public function select($sql) {
        try {
            $stmt = $this->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
            return false;
            
        }
    }
    
    public function execute($sql) {
        try {
            $stmt = $this->prepare($sql);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
            return false;
            
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
			$result = $this->execute($sql);
			$id = $this->lastInsertId();
			$user->setId($id);
		} else {
			$sql = "UPDATE user SET nome='$nome', email='$email', fbId='$fbId', 
			dataRegistro='$dataRegistro', dataAcesso='$dataAcesso', ativo=$ativo   
			WHERE id = " . $id;
			$result = $this->execute($sql);
		}
		return $user;
	}
	
	public function saveToken($idUser, $dataRegistro, $token, $motivo) {
		$sql = "INSERT INTO token (idUser, dataRegistro, token, motivo) 
		VALUES ($idUser, '$dataRegistro', '$token', '$motivo')";
		$result = $this->execute($sql);

		return true;
	}
	
	public function getUserById($id) {
		$sql = "SELECT nome, email, senha, fbId, dataRegistro, dataAcesso, ativo FROM user 
		WHERE id = " . $id;

		$result = $this->select($sql);
		
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
		$result = $this->select($sql);
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
		$sql = "SELECT id FROM user WHERE email = '$email' AND senha = '$senha' AND ativo=1";
		
		$result = $this->select($sql);

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
	public function toggleAnalise($proj) {
		$analise = ($proj->getAnalise() == 0) ? 1 : 0;
		$id = $proj->getId();
		$sql = "UPDATE projeto set analise = $analise WHERE id = $id";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();

		$proj->setAnalise($analise);

		return $proj;
		
	}

	public function toggleAtivo($proj) {
		$ativo = ($proj->getAtivo() == 0) ? 1 : 0;
		$id = $proj->getId();
		$sql = "UPDATE projeto set ativo = $ativo WHERE id = $id";
		$result = $this->execute($sql);

		// caso null, dataAtivacao
		if($proj->getDataAtivacao() == null) {
			$sql = "UPDATE projeto SET dataAtivacao=NOW() WHERE id = $id";
			$result = $this->execute($sql);
		}

		$proj->setAtivo($ativo);

		return $proj;
		
	}
	
	public function getCategorias() {
		$sql = "SELECT id, categoria FROM categoria";
		$result = $this->select($sql);
		
		return $result;
	}

	public function getCategoria($id) {
		$sql = "SELECT id, categoria FROM categoria WHERE id = " . $id;
		$result = $this->select($sql);
		
		return $result;
	}

	public function getProjetos($idCat=null, $ativo = null) {
		if ($idCat != null) {
			$sql = "SELECT id FROM projeto WHERE idCategoria = " . $idCat;
			if ($ativo !== null) {
				$sql .= " AND ativo = " . $ativo;
			}
		} else {
			$sql = "SELECT id FROM projeto";
			if ($ativo !== null) {
				$sql .= " WHERE ativo = " . $ativo;
			}
		}
		$result = $this->select($sql);
		return $result;
	}
	
	public function getProjeto($id) {

		// implementar
		$sql = 'SELECT idUser, idCategoria, nome, descricao, frase, valor, valorArrecadado, prazo, video, links, ativo, analise, dataRegistro, dataAtivacao, categoria 
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
		$projeto->setDataAtivacao($result[0]['dataAtivacao']);
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


		if ($id == null) {
			$valorArrecadado = 0;
			# grava o projeto no banco
			$sql = "INSERT INTO projeto 
			(idUser, idCategoria, nome, descricao, frase, valor, valorArrecadado, prazo, video, links, ativo, analise) 
			VALUES ($idUser, $idCategoria, '$nome', '$descricao', '$frase', $valor, $valorArrecadado,  $prazo, '$video', '$links', $ativo, $analise)";
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
	
	#### COLABORAÇÃO

	public function getColaboracao($id) {
		$sql = 'SELECT idProjeto, valor, descricao, qtdTotal, qtdComprada 
		FROM colaboracao WHERE id = ' . $id;
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$colaboracao = new Colaboracao;
		$colaboracao->setId($id);
		$colaboracao->setIdProjeto($result[0]['idProjeto']);
		$colaboracao->setValor($result[0]['valor']);
		$colaboracao->setDescricao($result[0]['descricao']);
		$colaboracao->setQtdTotal($result[0]['qtdTotal']);
		$colaboracao->setQtdComprada($result[0]['qtdComprada']);

		return $colaboracao;
	}
	
	public function getColaboracaoByProjeto($idProjeto) {
		$sql = 'SELECT id, valor, descricao, qtdTotal, qtdComprada 
		FROM colaboracao WHERE idProjeto = ' . $idProjeto;
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$colArray = array();
		foreach($result as $col) {
			$colaboracao = new Colaboracao;
			$colaboracao->setId($col['id']);
			$colaboracao->setIdProjeto($idProjeto);
			$colaboracao->setValor($col['valor']);
			$colaboracao->setDescricao($col['descricao']);
			$colaboracao->setQtdTotal($col['qtdTotal']);
			$colaboracao->setQtdComprada($col['qtdComprada']);
			
			$colArray[] = $col;
		}
		
		return $colArray;
	}


	public function saveColaboracao($colaboracao) {


		$id          = $colaboracao->getId();
		$idProjeto   = $colaboracao->getIdProjeto();
		$valor       = $colaboracao->getValor();
		$descricao   = $colaboracao->getDescricao();
		$qtdTotal    = $colaboracao->getQtdTotal();
		$qtdComprada = $colaboracao->getQtdComprada();
		if ($id == NULL) {
			$sql = "INSERT INTO colaboracao 
			(idProjeto, valor, descricao, qtdTotal, qtdComprada) 
			values ($idProjeto, $valor, '$descricao', $qtdTotal, $qtdComprada)";

			$stmt = $this->prepare($sql);
			$result = $stmt->execute();

			$id = $this->lastInsertId();
			$colaboracao->setId($id);

		} else {
			$colaboracao->setId($id);
			$sql = "UPDATE colaboracao 
			SET valor=$valor, descricao='$descricao', qtdTotal=$qtdTotal 
			WHERE id = $id";

			$stmt = $this->prepare($sql);
			$result = $stmt->execute();
			
		}


		return $colaboracao;
	}

	public function delColaboracao($colab) {
		$id = $colab->getId();

		$erro = array();
		//verifica se tem vendas amarradas
		$sql = 'SELECT COUNT(id) as count FROM user_colaboracao 
		WHERE idColaboracao =' . $id;
		$stmt   = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count  = $result[0]['count'];

		if ($count > 0) {
			$erro[] = 0;
			return $erro;
		}

		$sql = 'DELETE FROM colaboracao WHERE id=' . $id;
		print $sql;

		$stmt = $this->prepare($sql);
		$result = $stmt->execute();

		return $erro;
	}

	function getColabBySeed($seed) {
		$sql = "SELECT idColaboracao FROM user_colaboracao WHERE seed = '$seed'";
		$stmt   = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$idColab = $result[0]['idColaboracao'];

		$colab = $this->getColaboracao($idColab);
		return $colab;
	}
	
	#### USER COLABORAÇÃO
	function saveUserColaboracao($idUser, $idColaboracao, $seed) {
		$sql = "INSERT INTO user_colaboracao 
		(idUser, idColaboracao, seed) VALUES 
		($idUser, $idColaboracao, '$seed')";

		$stmt = $this->prepare($sql);
		$result = $stmt->execute();

		return True;

	}

	function updateUserColaboracaoBySeed($seed, $statusPagamento) {
		$sql = "UPDATE user_colaboracao SET statusMoip=$statusPagamento WHERE seed='$seed'";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();

		return True;

	}

	function getUserColaboracao($id) {
		$sql = 'SELECT idUser, idColaboracao, dataRegistro 
		FROM user_colaboracao WHERE id = ' . $id;

		$stmt  = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$uc = new UserColaboracao;
		$uc->setId($id);
		$uc->setIdUser($result[0]['idUser']);
		$uc->setIdColaboracao($result[0]['idColaboracao']);
		$uc->setDataRegistro($result[0]['dataRegistro']);

		return $uc;
	}
	
	#moip
	function insertMoipNasp($data){
		$idTransacao      = $data['idTransacao'];
		$valor            = $data['valor'];
		$statusPagamento  = $data['statusPagamento'];
		$codMoip          = $data['codMoip'];
		$formaPagamento   = $data['formaPagamento'];
		$tipoPagamento    = $data['tipoPagamento'];
		$emailConsumidor  = $data['emailConsumidor'];

		$sql = "INSERT INTO moip_nasp 
		(idTransacao, valor, statusPagamento, codMoip, formaPagamento, tipoPagamento, emailConsumidor) 
		VALUES ('$idTransacao', $valor, $statusPagamento, '$codMoip', $formaPagamento, '$tipoPagamento', '$emailConsumidor')";

		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
	}
	
	
	#### ADMIN
	public function getVipList() {
		$sql = "SELECT email FROM vip";
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$vip = array();
		foreach ($result as $v) {
			$vip[] = $v['email'];
		}

		return $vip;
	}
	
	public function getAbertosList() {
		$sql = 'SELECT projeto.id as id, idCategoria, categoria, nome 
		FROM projeto, categoria 
		WHERE analise = 1 AND projeto.idCategoria = categoria.id';
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getAtivosList() {
		$sql = 'SELECT projeto.id as id, idCategoria, categoria, nome 
		FROM projeto, categoria 
		WHERE ativo = 1 AND projeto.idCategoria = categoria.id';
		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getOwnerInfo($idProjeto) {
		$sql = 'SELECT user.nome as nome, email FROM user, projeto 
		WHERE projeto.idUser = user.id AND projeto.id = ' . $idProjeto;

		$stmt = $this->prepare($sql);
		$result = $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result[0];
	}


	######## PERFIL ##########

	public function getProjetosApoiados($idUser) {
		$sql = "select distinct projeto.id as id from user, projeto, 
		user_colaboracao, colaboracao where user_colaboracao.idUser = user.id 
		AND user_colaboracao.idColaboracao = colaboracao.id AND colaboracao.idProjeto = projeto.id 
		AND user.id = " . $idUser;

		$result = $this->select($sql);

		return $result;
	}

	public function getProjetosByOwner($idUser) {
		$sql = "select id from projeto where idUser = " . $idUser;

		$result = $this->select($sql);

		return $result;
	}
}
	
	


<?php

require_once('model/user.php');
require_once('model/projeto.php');
require_once('model/colaboracao.php');
require_once('model/database.php');
require_once('lib/janja.php');

class ControllerProjeto {
	public function getProjetoCompleto($id) {
		$db   = new Database;
		$proj = $db->getProjeto($id);
		$colaboracao = $db->getColaboracaoByProjeto($id);
		
		// dados do usuário que criou o projeto
		$user = $db->getUserById($proj->getIdUser());
				
		// calcula quantas colaborações foram compradas
		$backers = $db->getBackersByProjeto($id);
		$proj->setColaboracao($colaboracao);
		
		// id do video para embed

		$data['backers'] = $backers;
		$data['projeto'] = $proj;
		$data['idProponente'] = $user->getId();
		$data['proponente'] = $user;
		

		// foto
		$fotoPath = "img/userpics/" . $user->getId() . ".jpg";
		if (file_exists($fotoPath)) {
			$data['foto'] = $fotoPath;
		} else {
			$data['foto'] = "img/user.jpg";
		}
		
		
		return $data;
	}

	public function getProjetos($idCat = null, $ativo = null) {
		$db = new Database;
		$proj_array = array();
		$projetos = $db->getProjetos($idCat, $ativo);

		foreach($projetos as $proj) {
			$id = $proj['id'];
			$projeto = $this->getProjetoCompleto($id);
			$proj_array[] = $projeto;
		}

		return $proj_array;
	}

	public function getProjetosApoiados($id) {
		$db = new Database;
		$proj_array = array();
		$projetos = $db->getProjetosApoiados($id);

		foreach($projetos as $proj) {
			$id = $proj['id'];
			$projeto = $this->getProjetoCompleto($id);
			$proj_array[] = $projeto;
		}

		return $proj_array;
	}

	public function getProjetosByOwner($id) {
		$db = new Database;
		$proj_array = array();
		$projetos = $db->getProjetosByOwner($id);

		foreach($projetos as $proj) {
			$id = $proj['id'];
			$projeto = $this->getProjetoCompleto($id);
			$proj_array[] = $projeto;
		}

		return $proj_array;
	}

	public function validarProjeto($proj) {
		$erros = array();
		// verifica campos em branco
		if($proj->getNome() == "") { $erros[] = "nome"; }
		if($proj->getIdCategoria() == "") {$erros[] = "categoria";}
		if($proj->getDescricao()=="") {$erros[] = "descrição";}
		if($proj->getFrase()=="") {$erros[] = "frase";}
		if($proj->getValor()=="") { $erros[] = "valor";}
		if($proj->getPrazo()=="") {$erros[] = "prazo";}
		if($proj->getVideo()=="") {$erros[] = "video";}
		if($proj->getLinks()=="") {$erros[] = "links";}

		return (sizeof($erros) == 0) ? True : $erros; 
	}
}

?>

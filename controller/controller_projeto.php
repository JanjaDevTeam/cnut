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
		$nome = $user->getNome();
		$nome = explode(' ', $nome);
		$nome = $nome[0];		
		// calcula quantas colaborações foram compradas
		$backers = 0;
		foreach ($colaboracao as $col) {
			$backers += $col['qtdComprada'];
		}
		$proj->setColaboracao($colaboracao);
		
		// id do video para embed
		$exp = explode('?v=', $proj->getVideo());
		$videoId = explode("&", $exp[1]);
		$data['videoId'] = $videoId[0];
		$data['coverArt'] = $proj->getImage();
		$data['backers'] = $backers;
		$data['projeto'] = $proj;
		$data['diasRestantes'] = $proj->getDiasRestantes();
		$data['idProponente'] = $user->getId();
		$data['proponente'] = $nome;
		$data['pct'] = $proj->getPorcentagem();
		$data['categoria'] = $proj->getCategoria();
		$data['prazo'] = $proj->getPrazo();
		$data['nome'] = $proj->getNome();
		$data['frase'] = $proj->getFrase();
		$data['valor'] = $proj->getValor();
		$data['valorArrecadado'] = $proj->getValorArrecadado();
		$data['id'] = $proj->getId();
		$data['categoria'] = $proj->getCategoria();

		// foto
		$fotoPath = "img/userpics/" . $user->getId() . ".jpg";
		if (file_exists($fotoPath)) {
			$data['foto'] = $fotoPath;
		} else {
			$data['foto'] = "img/user.jpg";
		}
		
		
		return $data;
	}

	public function getProjetos() {
		$db = new Database;
		$proj_array = array();
		$projetos = $db->getProjetos();

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

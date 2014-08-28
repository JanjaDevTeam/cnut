<?php
class User {
	
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $fbId;
	private $dataRegistro;
	private $dataAcesso;
	private $ativo;
	
	
	// setters
	public function setId($id) {
		$this->id = $id;
	}
	public function setFbId($fbid) {
		$this->fbId = $fbid;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function setSenha($senha) {
		$this->senha = md5($senha);
	}
	public function setDataRegistro($data) {
		$this->dataRegistro = $data;
	}
	public function setDataAcesso($data) {
		$this->dataAcesso = $data;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}

	

	// getters
	public function getId() {
		return $this->id;
	}
	public function getFbId() {
		return $this->fbId;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function getDataRegistro() {
		return $this->dataRegistro;
	}
	public function getDataAcesso() {
		return $this->dataAcesso;
	}
	public function getAtivo() {
		return $this->ativo;
	}
	
	// funções especiais
	public function getNow() {
		return date("Y-m-d H:i:s");
	}

}
?>

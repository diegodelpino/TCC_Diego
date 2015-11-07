<?php

class Usuario {

	public $id_usuario;

	public $cpf;

	public $login;

	public $senha;

	public $nome;

	public $telefone;
	
	public $unidade;
	
	public function getId() {

		return $this->id_usuario;
	}

	public function setId($id_usuario) {

		$this->id_usuario = $id_usuario;
		return $this;
	}

	public function getCpf() {

		return $this->cpf;
	}

	public function setCpf($cpf) {

		$this->cpf = $cpf;
		return $this;
	}

	public function getSenha() {

		return $this->senha;
	}

	public function setSenha($senha) {

		$this->senha = $senha;
		return $this;
	}

	public function getLogin() {

		return $this->login;
	}

	public function setLogin($login) {

		$this->login = $login;
		return $this;
	}

	public function getNome() {

		return $this->nome;
	}

	public function setNome($nome) {

		$this->nome = $nome;
		return $this;
	}

	public function getTelefone() {

		return $this->telefone;
	}

	public function setTelefone($telefone) {

		$this->telefone = $telefone;
		return $this;
	}

	public function getUnidade() {

		return $this->unidade;
	}

	public function setUnidade($unidade) {

		$this->unidade = $unidade;
		return $this;
	}
}
?>
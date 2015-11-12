<?php

class Fornecedor {
	private $id_fornecedor;
	private $nome;
	private $endereco;
	private $cpf;
	private $cnpj;
	private $telefone;
	private $detalhes;

	public function getIdFornecedor() {
		return $this->id_fornecedor;
	}

	public function setIdFornecedor($id_fornecedor) {
		$this->id_fornecedor = $id_fornecedor;
		return $this;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}
	
	public function getEndereco() {
		return $this->endereco;
	}

	public function setEndereco($endereco) {
		$this->endereco = $endereco;
		return $this;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function setCpf($cpf) {
		$this->cpf = $cpf;
		return $this;
	}

	public function getTelefone() {
		return $this->telefone;
	}

	public function setTelefone($telefone) {
		$this->telefone = $telefone;
		return $this;
	}

	public function getDetalhes() {
		return $this->detalhes;
	}

	public function setDetalhes($detalhes) {
		$this->detalhes = $detalhes;
		return $this;
	}
	
	?>
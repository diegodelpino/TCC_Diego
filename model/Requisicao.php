<?php

class Requisicao {

	private $id;

	private $titulo;

	private $prioridade;

	private $descricao;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
		return $this;
	}

	public function getPrioridade() {
		return $this->prioridade;
	}

	public function setPrioridade($prioridade) {
		$this->prioridade = $prioridade;
		return $this;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
}

?>
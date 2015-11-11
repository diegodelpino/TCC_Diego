<?php

class Requisicao {

	public $id_requisicao;
	public $titulo;
	public $prioridade;
	public $descricao;
	public $historicoArray;
	public $categoriaArray;

	function __construct() {
		//$this->subitemArray = array ();
		$this->historicoArray = array ();
		$this->categoriaArray = array ();
	} 

	public function getIdRequisicao() {
		return $this->id_requisicao;
	}

	public function setIdRequisicao($id_requisicao) {
		$this->id_requisicao = $id_requisicao;
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
	
	//Aqui vai retornar a lista de Historico
	public function getHistoricoArray() {
		return $this->historicoArray;
	}

	public function setHistoricoArray($historicoArray) {
		$this->historicoArray = $historicoArray;
		return $this;
	}

	//Aqui vai retornar a lista de Categorias
	public function getCategoriaArray() {
		return $this->categoriaArray;
	}

	public function setCategoriaArray($categoriaArray) {
		$this->categoriaArray = $categoriaArray;
		return $this;
	}

	
	/*public function addProduto(ListaAlteracoes $listaAlteracoes) {
		array_push ( $this->historicoArray, $listalteracoes );
	}*/
}

?>
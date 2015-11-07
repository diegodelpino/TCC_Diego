<?php

class Voo {

	public $id;

	public $data;

	public $preco;

	public $origem;

	public $destino;
	
	public function __construct(){
	
	}

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
		return $this;
	}

	public function getData() {

		return $this->data;
	}

	public function setData($data) {

		$this->data = $data;
		return $this;
	}

	public function getPreco() {

		return $this->preco;
	}

	public function setPreco($preco) {

		$this->preco = $preco;
		return $this;
	}

	public function getOrigem() {

		return $this->origem;
	}

	public function setOrigem($origem) {

		$this->origem = $origem;
		return $this;
	}

	public function getDestino() {

		return $this->destino;
	}

	public function setDestino($destino) {

		$this->destino = $destino;
		return $this;
	}
}
?>
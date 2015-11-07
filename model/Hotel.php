<?php

class Hotel {

	public $id;

	public $nome;

	public $categoria;

	public $cidade;

	public $diaria;

	public $dtIn;

	public $dtOut;
	
	public function __construct(){
		
	}

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
		return $this;
	}

	public function getNome() {

		return $this->nome;
	}

	public function setNome($nome) {

		$this->nome = $nome;
		return $this;
	}

	public function getCategoria() {

		return $this->categoria;
	}

	public function setCategoria($categoria) {

		$this->categoria = $categoria;
		return $this;
	}

	public function getCidade() {

		return $this->cidade;
	}

	public function setCidade($cidade) {

		$this->cidade = $cidade;
		return $this;
	}

	public function getDiaria() {

		return $this->diaria;
	}

	public function setDiaria($diaria) {

		$this->diaria = $diaria;
		return $this;
	}

	public function getDtIn() {

		return $this->dtIn;
	}

	public function setDtIn($dtIn) {

		$this->dtIn = $dtIn;
		return $this;
	}

	public function getDtOut() {

		return $this->dtOut;
	}

	public function setDtOut($dtOut) {

		$this->dtOut = $dtOut;
		return $this;
	}
	
	public function getTotalDiarias(){
		$dataOut = new DateTime( $this->dtOut );
		$dataIn = new DateTime( $this->dtIn );
		
		$diarias =  $dataIn->diff( $dataOut )->days;
		
		return $diarias * $this->diaria;
	}
}

?>
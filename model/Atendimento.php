<?php

class Atendimento {

	private $id_atend;
	private $id_cat;
	private $id_fornecedor;

	public function getIdAtendimento() {
		return $this->id_atend;
	}

	public function setIdAtendimento($id_atend) {
		$this->id_atend = $id_atend;
		return $this;
	}

	public function getIdCategoria() {
		return $this->id_cat;
	}

	public function setIdCategoria($id_cat) {
		$this->id_cat = $id_cat;
		return $this;
	}
	
	public function getIdFornecedor() {
		return $this->id_fornecedor;
	}

	public function setIdFornecedor($id_fornecedor) {
		$this->id_fornecedor = $id_fornecedor;
		return $this;
	}	
	
}

?>
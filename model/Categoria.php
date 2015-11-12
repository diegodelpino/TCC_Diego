<?php

class Categoria {
	public $id_cat;
	public $nome;

	public function getIdCategoria() {
		return $this->id_cat;
	}

	public function setIdCategoria($id_cat) {
		$this->id_cat = $id_cat;
		return $this;
	}
}

?>
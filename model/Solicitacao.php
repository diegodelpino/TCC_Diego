<?php

class Solicitacao {

	private $idCategoria;
	private $idRequisicao;

	public function getIdCategoria() {
		return $this->idCategoria;
	}

	public function setIdCategoria($idCategoria) {
		$this->idCategoria = $idCategoria;
		return $this;
	}

	public function getRequisicao() {
		return $this->idRequisicao;
	}

	public function setRequisicao($idRequisicao) {
		$this->idRequisicao = $idRequisicao;
		return $this;
	}
}

?>
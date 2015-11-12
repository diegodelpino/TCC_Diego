<?php

class Historico {

	public $id_hist;
	public $id_requisicao;
	public $id_usuario;
	public $usuario;
	public $data_atualizacao;
	public $id_status;
	public $detalhes;

	public function getIdHist() {
		return $this->id_hist;
	}

	public function setId($id_hist) {
		$this->id_hist = $id_hist;
		return $this;
	}

	public function getIdRequisicao() {
		return $this->id_requisicao;
	}

	public function setIdRequisicao($id_requisicao) {
		$this->id_requisicao = $id_requisicao;
		return $this;
	}

	public function getIdUsuario() {
		return $this->id_usuario;
	}

	public function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
		return $this;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}

	public function setUsuario($usuario) {
		$this->usuario = $usuario;
		return $this;
	}

	public function getDataAtualizacao() {
		return $this->data_atualizacao;
	}

	public function setDataAtualizacao($data_atualizacao) {
		$this->data_atualizacao = $data_atualizacao;
		return $this;
	}

	public function getStatus() {
		return $this->id_status;
	}

	public function setStatus($id_status) {
		$this->id_status = $id_status;
		return $this;
	}			

	public function getDetalhes() {
		return $this->detalhes;
	}

	public function setDetalhes($detalhes) {
		$this->detalhes = $detalhes;
		return $this;
	}			
}

?>
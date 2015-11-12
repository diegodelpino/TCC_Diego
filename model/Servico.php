<?php

class Servico {

	private $id_servico;
	private $id_fornecedor;
	private $id_requisicao;
	private $detalhes;

	public function getIdServico() {
		return $this->id_servico;
	}

	public function setIdServico($id_servico) {
		$this->id_servico = $id_servico;
		return $this;
	}

	public function getFornecedor() {
		return $this->id_fornecedor;
	}

	public function setIdFornecedor($id_fornecedor) {
		$this->id_fornecedor = $id_fornecedor;
		return $this;
	}

	public function getIdRequisicao() {
		return $this->id_requisicao;
	}

	public function setIdRequisicao($id_requisicao) {
		$this->id_requisicao = $id_requisicao;
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
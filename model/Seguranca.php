<?php

class Seguranca {

	private $id_permissao;
	private $id_usuario;

	public function getIdPermissao() {
		return $this->id_permissao;
	}

	public function setIdPermissao($id_permissao) {
		$this->id_permissao = $id_permissao;
		return $this;
	}

	public function getIdUsuario() {
		return $this->id_usuario;
	}

	public function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
		return $this;
	}
}

?>
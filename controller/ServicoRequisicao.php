<?php
include_once 'Logger.php';
include_once '../dao/RequisicaoDAO.php';

class SrvRequisicao {

	private $requisicaodao;

	public function __construct() {
		$this->$requisicaodao = new RequisicaoDAO ();
	}

	public function buscaRequisicao() {
		try {
			
			// TODO Refactor this code, to use json_encode
			
			$json = '[';
			
			$result = $this->produtodao->Lista ();
			
			foreach ( $result as $value ) {
				
				$descricao = str_replace ( '\\', '\\\\', $value->descricao );
				$descricao = str_replace ( '"', '\"', $descricao );
				
				$json .= '{"idProduto"   :"' . $value->idProduto . '"
						  ,"descricao"   :"' . $descricao . '"
				 		  ,"unidade"     :"' . $value->unidade . '"
				 		  ,"custoUnit"   :"' . number_format ( $value->custoUnit, 2, '.', '' ) . '"
				 		  ,"categoria"   :"' . $value->categoria . '"
				 		  ,"fabricante"  :"' . $value->fabricante . '"
				 		  ,"fornecedor"  :"' . $value->fornecedor . '"
				 		  ,"ativo"       :"' . $value->ativo . '"},';
			}
			
			$json = rtrim ( $json, "," );
			$json .= ']';
			
			echo $json;
		} catch ( Exception $e ) {
			Logger ( "(file:" . $e->getFile () . ",line:" . $e->getLine () . ") buscaProduto : " . $e->getMessage () );
		}
	}

	public function salvaRequisicao() {
		try {
			
			Logger ( "salvaProduto : Inserindo produto . " );
			
			$produto = new Produto ();
			
			$produto->setDescricao ( addslashes ( $_REQUEST ["descricao"] ) );
			$produto->setUnidade ( $_REQUEST ["unidade"] );
			$produto->setCustoUnit ( $_REQUEST ["custoUnit"] );
			if (isset ( $_REQUEST ["categoria"] )) $produto->setCategoria ( $_REQUEST ["categoria"] );
			if (isset ( $_REQUEST ["fabricante"] )) $produto->setFabricante ( $_REQUEST ["fabricante"] );
			if (isset ( $_REQUEST ["fornecedor"] )) $produto->setFornecedor ( $_REQUEST ["fornecedor"] );
			isset ( $_REQUEST ["ativo"] ) ? $active = $_REQUEST ["ativo"] : $active = 't';
			$produto->setAtivo ( $active );
			
			$this->produtodao->Insere ( $produto );
			
			echo json_encode ( array (
					'success' => true,
					'idProduto' => mysql_insert_id (),
					'descricao' => stripslashes ( $produto->getDescricao () ),
					'unidade' => $produto->getUnidade (),
					'custoUnit' => $produto->getCustoUnit (),
					'categoria' => $produto->getCategoria (),
					'fabricante' => $produto->getFabricante (),
					'fornecedor' => $produto->getFornecedor (),
					'ativo' => $produto->getAtivo () 
			) );
		} catch ( Exception $e ) {
			Logger ( "(file:" . $e->getFile () . ",line:" . $e->getLine () . ") salvaProduto : " . $e->getMessage () );
		}
	}

	public function editaRequisicao($idRequisicao) {
		try {
			
			Logger ( "editaProduto : Editando produto . idProduto : " . $idProduto );
			
			$produto = new Produto ();
			
			$id = intval ( $idProduto );
			
			$produto->setIdProduto ( $id );
			
			$produto->setDescricao ( addslashes ( $_REQUEST ["descricao"] ) );
			$produto->setUnidade ( $_REQUEST ["unidade"] );
			$produto->setCustoUnit ( $_REQUEST ["custoUnit"] );
			if (isset ( $_REQUEST ["categoria"] )) $produto->setCategoria ( $_REQUEST ["categoria"] );
			if (isset ( $_REQUEST ["fabricante"] )) $produto->setFabricante ( $_REQUEST ["fabricante"] );
			if (isset ( $_REQUEST ["fornecedor"] )) $produto->setFornecedor ( $_REQUEST ["fornecedor"] );
			isset ( $_REQUEST ["ativo"] ) ? $active = $_REQUEST ["ativo"] : $active = 't';
			$produto->setAtivo ( $active );
			
			$this->produtodao->altera ( $produto );
			
			echo json_encode ( array (
					'success' => true,
					'idProduto' => $produto->getIdProduto (),
					'descricao' => stripslashes ( $produto->getDescricao () ),
					'unidade' => $produto->getUnidade (),
					'custoUnit' => $produto->getCustoUnit (),
					'categoria' => $produto->getCategoria (),
					'fabricante' => $produto->getFabricante (),
					'fornecedor' => $produto->getFornecedor (),
					'ativo' => $produto->getAtivo () 
			) );
		} catch ( Exception $e ) {
			Logger ( "(file:" . $e->getFile () . ",line:" . $e->getLine () . ") editaProduto : " . $e->getMessage () );
		}
	}

	public function removeRequisicao($idRequisicao) {
		try {
			
			Logger ( "removeProduto : Removendo produto " . $idProduto );
			
			if ($this->produtodao->remove ( $idProduto )) {
				
				echo json_encode ( array (
						'success' => true,
						'idProduto' => $idProduto 
				) );
				
				Logger ( "Produto " . $idProduto . " removido." );
			}
		} catch ( Exception $e ) {
			
			Logger ( "Produto " . $idProduto . " n�o pode ser removido por estar sendo usado em uma proposta comercial." );
			Logger ( "(file:" . $e->getFile () . ",line:" . $e->getLine () . ") removeProduto : " . $e->getMessage () );
			echo json_encode ( array (
					'success' => false,
					'msg' => 'Esse item não pode ser removido porque está sendo usado em uma proposta comercial.',
					'idProduto' => $idProduto 
			) );
		}
	}
}

$srvRequisicao = new SrvRequisicao ();

if (isset ( $_GET ["buscaProduto"] )) {
	$srvProduto->buscaProduto ();
}

if (isset ( $_GET ["salvaProduto"] )) {
	$srvProduto->salvaProduto ();
}

if (isset ( $_GET ["editaProduto"] )) {
	$srvProduto->editaProduto ( $_REQUEST ['idProduto'] );
}

if (isset ( $_GET ["removeProduto"] )) {
	$srvProduto->removeProduto ( $_REQUEST ['id'] );
}


?>
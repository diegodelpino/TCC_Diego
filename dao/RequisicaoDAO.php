<?php
include "../controller/Sessao.php";
include '../controller/Conexao.php';
include_once '../model/Requisicao.php';

class RequisicaoDAO {
	
	public function insere(Requisicao $requisicao) {
		
			mysql_query ( "INSERT INTO requisicao( descricao
											  , unidade
											  , custounit
					 						  , categoria
											  , fabricante
											  , fornecedor
											  , ativo)
									  VALUES ('" . $requisicao->getDescricao () . "'
									  		 ,'" . $requisicao->getUnidade () . "'
									  		 ,'" . $requisicao->getCustoUnit () . "'
									  		 ,'" . $requisicao->getCategoria () . "'
									  		 ,'" . $requisicao->getFabricante () . "'
									  		 ,'" . $requisicao->getFornecedor () . "'
									  		 ,'" . $requisicao->getAtivo () . "')" );
			
			if(mysql_errno()){
				throw new Exception(mysql_error());
			}
	
	}

	public function remove($idRequisicao) {

		$result = mysql_query ( "update requisicao set ativo = 'f' where idRequisicao = $idRequisicao" );
		
		if(mysql_errno()){
			throw new Exception(mysql_error(). " - RequisicaoDAO:remove:sql - SQL : " . $sql);
		}
		
		return true;
	}

	public function altera(Requisicao $requisicao) {
		
		mysql_query ( "UPDATE requisicao SET   descricao 	= 	'" . $requisicao->getDescricao () . "'
										  , unidade 	= 	'" . $requisicao->getUnidade () . "'
	 								      , custounit 	= 	'" . $requisicao->getCustoUnit () . "'
										  , categoria   = 	'" . $requisicao->getCategoria () . "'
										  , fabricante 	= 	'" . $requisicao->getFabricante () . "'
										  , fornecedor 	=	'" . $requisicao->getFornecedor () . "'
										  , ativo       =   '" . $requisicao->getAtivo () . "'
								   WHERE idRequisicao = " . $requisicao->getIdRequisicao () );
		
		if(mysql_errno()){
			throw new Exception(mysql_error());
		}
		
	}
	
	public function lista() {
			
		$rs = mysql_query ( "select * from requisicao where ativo <> 'f'" );
		
		if(mysql_errno()){
			throw new Exception(mysql_error());
		}
		
		$result = array ();
		while ( $row = mysql_fetch_object ( $rs ) ) {
			array_push ( $result, $row );
		}
		return $result;
			
	}
	
	public function buscaRequisicaoCalculado($idRequisicao,$quantidade){

		$result = mysql_query( "select aliquota from tributo where nome = 'mg_materiais'");
		
		if(mysql_errno()){
			throw new Exception(mysql_error());
		}
		
		$row = mysql_fetch_assoc($result);
		$mg_requisicao = $row["aliquota"];
	
		$result = mysql_query( "select custoUnit from requisicao where idRequisicao = $idRequisicao") ;
		
		if(mysql_errno()){
			throw new Exception(mysql_error());
		}
		
		$row = mysql_fetch_assoc($result);
		$custoUnit = $row["custoUnit"];
	
		$valorUnit = $custoUnit + ($custoUnit * ($mg_requisicao/100));
		$custoTotal = $quantidade * $custoUnit;
		$valorTotal= $quantidade * ($custoUnit + ($custoUnit * ($mg_requisicao/100)));
	
		$prdlista = array('valorUnit' =>$valorUnit
				,'valorTotal'=>$valorTotal
				,'custoUnit' =>$custoUnit
				,'custoTotal'=>$custoTotal
				,'margen'	  =>$mg_requisicao);
	
		return $prdlista;
	}

}

?>

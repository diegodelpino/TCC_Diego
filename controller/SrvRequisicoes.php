<?php
include_once '../model/Requisicao.php';
include_once '../model/Historico.php';
include_once '../model/Categoria.php';
include_once 'ConfDB.php';
include_once 'Logger.php';
include_once 'Sessao.php';

class SrvRequisicoes{
	
	public function listaRequisicoes($titulo, $prioridade, $status, $data_atualizacao){
		try{
		//	echo("{teste:dlalal}");		
			$conexao = conn_mysql ();
			mysql_set_charset("utf8");
			//echo json_encode(array("requisicao" =>array("titulo"=>"aham","prioridade"=>"aham")));
				
			$SQLSelect = "SELECT req.id_requisicao,req.titulo as titulo,req.prioridade as prioridade, st.status as status, hist.data_atualizacao as data_atualizacao
							FROM requisicao req
							inner join historico hist on req.id_requisicao = hist.id_requisicao
							and hist.id_hist = 
									( SELECT historico.id_hist
										FROM historico
										WHERE historico.id_requisicao = req.id_requisicao
										order by data_atualizacao desc
										limit 1)
							inner join status st on hist.id_status = st.id_status
							where 1=1";
							
			if ($prioridade != null) {
				$SQLSelect .= " AND UPPER(req.prioridade) LIKE UPPER('%$prioridade%') ";
			}
			
			if ($titulo != null) {
				$SQLSelect .= " AND UPPER(req.titulo) LIKE UPPER('%$titulo%') ";
			}
			
			if ($status != null) {
				$SQLSelect .= " AND UPPER(st.status) LIKE UPPER('%$status%') ";
			}
			
			if ($data_atualizacao != null) {
				$SQLSelect .= " AND UPPER(hist.data_atualizacao) LIKE UPPER('%$data_atualizacao%') ";
			}
			
			Logger($SQLSelect);
			$operacao = $conexao->prepare ( $SQLSelect );
			$pesquisar = $operacao->execute ();
			$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
	
			$conexao = null;
			
			echo json_encode($resultados);
			
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}

	public function buscaRequisicaoPorId($id_requisicao){
		try{
			$conexao = conn_mysql ();
			$SQLSelectRequisicao = "SELECT * FROM requisicao WHERE id_requisicao = ?";
			$operacao = $conexao->prepare ( $SQLSelectRequisicao );
			$result = $operacao->execute ( array (
				$id_requisicao 
			) );
			$operacao->setFetchMode ( PDO::FETCH_CLASS, 'Requisicao' );
			$requisicao = $operacao->fetch ();
		
	
			// CARREGA HISTORICO
			
			$SQLSelectHist = "SELECT * FROM historico WHERE id_requisicao = :id_requisicao";
			$operacao = $conexao->prepare ( $SQLSelectHist );
			$result = $operacao->execute ( array (
					":id_requisicao" => $id_requisicao 
			) );
			$operacao->setFetchMode ( PDO::FETCH_CLASS, 'Historico' );
			$historicoArray = $operacao->fetchAll();
			
			// CARREGA Usuario
			$SQLSelectUsuario = " SELECT * from usuario WHERE  id_usuario= :id_usuario ";
		
			foreach ( $historicoArray as $historico ) {
				
				// Usuario do historico
				$operacaoSubitem = $conexao->prepare ( $SQLSelectUsuario );
				$result = $operacaoSubitem->execute ( array (
						":id_usuario" => $historico->getIdUsuario () 
				) );
				$operacaoSubitem->setFetchMode ( PDO::FETCH_CLASS, 'Usuario' );
				$usuario = $operacaoSubitem->fetch ();
				$historico->setUsuario ( $usuario );
			}
		
		// CARREGA Categorias
		
			$SQLSelectCategoria = "select * from categoria
					inner join solicitacao on solicitacao.id_cat = categoria.id_cat 
					inner join requisicao on solicitacao.id_requisicao = requisicao.id_requisicao
					where requisicao.id_requisicao = :id_requisicao";
			$operacao = $conexao->prepare ( $SQLSelectCategoria );
			$result = $operacao->execute ( array (
					":id_requisicao" => $id_requisicao 
			) );
			$operacao->setFetchMode ( PDO::FETCH_CLASS, 'Categoria' );
			$categoriaArray = $operacao->fetchAll();
			
			$requisicao->setCategoriaArray($categoriaArray);
			$requisicao->setHistoricoArray($historicoArray);
/* 		
		//  VERIFICA COMO O GERA PDF EST? BUSCANDO OS DADOS NO OBJETO REQUISICAO
		 
		foreach ( $requisicao->getHistoricoArray () as $historico ) {
			echo "</br>======================ITEM======================</br>";
			print_r ( $historico );
			echo "</br>============================================</br>";
		
			echo "</br>=====================SUBITEM=======================</br>";
			print_r ( $historico->getUsuario ());
			echo "</br>============================================</br>";
		
		}
		
		foreach ( $requisicao->getCategoriaArray () as $categoria ) {
			echo "</br>======================ITEM======================</br>";
			print_r ( $categoria );
			echo "</br>============================================</br>";
		}

		echo "</br>============================================</br>";
		print_r ( $requisicao );
		echo "</br>============================================</br>";				
	
		echo "</br>============================================</br>";
		echo json_encode( $requisicao );
		echo "</br>============================================</br>";
 */		 
		
		// fecha a conex?o (os resultados j? est?o capturados)
			
			
			$conexao = null;
			
			echo json_encode($requisicao);
			} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
 
	public function listaHistorico($id_requisicao){
		try{
			$conexao = conn_mysql ();
			$SQLSelect = "select * from historico  hist 
							inner join status st on st.id_status = hist.id_status
							inner join usuario us on us.cpf = hist.cpf 
							where id_requisicao =$id_requisicao order by data_atualizacao desc";
			Logger($SQLSelect);
			$operacao = $conexao->prepare ( $SQLSelect );
			$pesquisar = $operacao->execute ();
			$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
			$conexao = null;
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}

	public function listaFornecedores($categorias){
		try{
			Logger($prioridade);
			Logger($status);
			Logger($data_atualizacao);
			Logger($titulo);

			$conexao = conn_mysql ();
			$SQLSelect = "SELECT * from dual";
			Logger($SQLSelect);
			$operacao = $conexao->prepare ( $SQLSelect );
			$pesquisar = $operacao->execute ();
			$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
			$conexao = null;
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}

	public function listaCategorias($id_requisicao){
		try{
			Logger($prioridade);
			Logger($status);
			Logger($data_atualizacao);
			Logger($titulo);
			$conexao = conn_mysql ();
			$SQLSelect = "SELECT * from dual";
			$lista_categorias=mysqli_query($conn,"select * from categoria");
			$lista_categorias_selecionadas=mysqli_query($conn,"select sc.id_cat,cat.nome from solicitacao sc
					inner join requisicao req on sc.id_requisicao = req.id_requisicao
					inner join categoria cat on sc.id_cat = cat.id_cat where req.id_requisicao = $id_requisicao");
			Logger($SQLSelect);
			$operacao = $conexao->prepare ( $SQLSelect );
			$pesquisar = $operacao->execute ();
			$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
			$conexao = null;
			
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	} 
}


$srvRequisicoes = new SrvRequisicoes();

	if(isset($_GET["listaRequisicoes"])){
		$srvRequisicoes->listaRequisicoes($_POST["titulo"],$_POST["prioridade"],$_POST["status"],$_POST["data_atualizacao"]);
	}
	
	if(isset($_GET["listaHistorico"])){
	$srvRequisicoes->listaHistorico($_POST["id_requisicao"]);
	}
	
	if(isset($_GET["listaFornecedores"])){
	$srvRequisicoes->listaFornecedores($_POST["categorias"]);
	}	

	if(isset($_GET["listaCategorias"])){
	$srvRequisicoes->listaCategorias($_POST["id_requisicao"]);
	}
	
	if(isset($_GET["buscaRequisicaoPorId"])){
	$srvRequisicoes->buscaRequisicaoPorId($_POST["id_requisicao"]);
	}
	
	?>
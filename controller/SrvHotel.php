<?php
include_once 'ConfDB.php';
include_once 'Logger.php';

class SrvHotel{
	
	public function listaHotel($cidadeOrigem, $nomeHotel, $categoria, $preco){
		
		try{
			
			// instancia objeto PDO, conectando no mysql
			$conexao = conn_mysql ();
				
			// instrução SQL básica (sem restrição de nome)
			$SQLSelect = "SELECT 
						    hotel_Cod,
						    hotel_Nome,
							hotel_Diaria,
						    (SELECT 
						            cidade_Nome
						        FROM
						            cidades
						        WHERE
						            cidade_Cod = ht.hotel_Cidade) AS hotel_Cidade,
						    CASE hotel_Categoria
						        WHEN 1 THEN 'Luxo'
						        ELSE 'Básico'
						    END AS hotel_Categoria
						FROM
						    hoteis ht, cidades cd
						WHERE
							cd.cidade_Cod = ht.hotel_Cidade
						AND
							ht.hotel_Cod NOT IN (SELECT reservasHotel_Hotel as hotel_Cod FROM reservashotel)";
			
			if ($cidadeOrigem != null) {
				$SQLSelect .= " AND UPPER(cd.cidade_Nome) LIKE UPPER('%$cidadeOrigem%') ";
			}
			
			if ($nomeHotel != null) {
				$SQLSelect .= " AND UPPER(ht.hotel_Nome) LIKE UPPER('%$nomeHotel%') ";
			}
			
			if ($categoria == 'Luxo') {
				$SQLSelect .= " AND hotel_Categoria = 1 ";
			}
			
			if ($categoria == 'Básico') {
				$SQLSelect .= " AND hotel_Categoria = 2 ";
			}
			
			if ($preco != null) {
				$SQLSelect .= " AND hotel_Diaria < $preco ";
			}
		
			// prepara a execução da sentença
			$operacao = $conexao->prepare ( $SQLSelect );
				
			// executa a sentença SQL com o valor passado por parâmetro
			$pesquisar = $operacao->execute ();
				
			// captura TODOS os resultados obtidos
			$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
				
			// fecha a conexão (os resultados já estão capturados)
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
}

$srvHotel = new SrvHotel();

if(isset($_GET["listaHotel"])){
	$srvHotel->listaHotel($_POST["cidadeOrigem"],$_POST["nomeHotel"],$_POST["categoria"],$_POST["preco"]);
}
?>
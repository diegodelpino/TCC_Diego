<?php
include_once 'ConfDB.php';
include_once 'Logger.php';

class SrvVoo {

	public function listaVoo() {
		// instancia objeto PDO, conectando no mysql
		$conexao = conn_mysql ();
			
		// instrução SQL básica (sem restrição de nome)
		$SQLSelect = 'SELECT 
					    voo_Cod,
					    voo_Data,
					    voo_Preco,
					    (SELECT 
					            cidade_Nome
					        FROM
					            cidades
					        WHERE
					            cidade_Cod = v.voo_CidadeOrigem) AS voo_CidadeOrigem,
					    (SELECT 
					            cidade_Nome
					        FROM
					            cidades
					        WHERE
					            cidade_Cod = v.voo_CidadeDestino) AS voo_CidadeDestino
					FROM
					    voos v
					WHERE
						v.voo_Cod NOT IN (SELECT reservasVoo_Voo as voo_Cod FROM reservasvoo)';
			
		// prepara a execução da sentença
		$operacao = $conexao->prepare ( $SQLSelect );
			
		// executa a sentença SQL com o valor passado por parâmetro
		$pesquisar = $operacao->execute ();
			
		// captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll (PDO::FETCH_ASSOC);
			
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
		echo json_encode($resultados);
	}

}

$srvVoos = new SrvVoo();

if(isset($_GET["listaVoo"])){
	$srvVoos->listaVoo();
}
?>
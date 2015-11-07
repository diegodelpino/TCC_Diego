<?php
include_once '../model/Cliente.php';
include_once 'SrvUsuario.php';
include_once 'ConfDB.php';
include_once 'Logger.php';

Logger ( "Verificando existencia do cookie : " . isset ( $_COOKIE ["rdpassagens"] ) );

if (isset ( $_COOKIE ["rdpassagens"] )) { // existe um cookie com nome senha --> login autom�tico
	
	$dataCookie = explode ( "|", $_COOKIE ["rdpassagens"] );
	$login = $dataCookie [0];
	$senha = $dataCookie [1];
	Logger ( "Carregando informações do cookie  : login = " . $login . ", senha = " . $senha );
	
try {
			// instancia objeto PDO, conectando no mysql
			$conexao = conn_mysql ();
			
			// instrução SQL básica (sem restrição de nome)
			$SQLSelect = 'SELECT `cliente_Cod` as id,
								`cliente_Email` as email,
								`cliente_Senha` as senha,
								`cliente_Cidade` as cidade,
								`cliente_Nome` as nome,
								`cliente_Foto` as foto,
								(SELECT 
						            cidade_Nome
						        FROM
						            cidades
						        WHERE
						            cidade_Cod = cl.cliente_Cidade) AS nomeCidade
								FROM clientes cl WHERE cliente_Email = ? AND cliente_Senha = MD5(?)';
			
			// prepara a execução da sentença
			$operacao = $conexao->prepare ( $SQLSelect );
			
			// executa a sentença SQL com o valor passado por parâmetro
			$pesquisar = $operacao->execute ( array (
					$login,
					$senha 
			) );
			
			$cliente = $operacao->fetchObject("Cliente");
			
			// fecha a conexão (os resultados já estão capturados)
			$conexao = null;
				
			if (!$cliente) {
				Logger("Usuário ou senha inválido : login = " . $login . ", senha = ". $senha);
				header ( "location:../view/Logar.php?err=1" );
				die ();
			} else {	

				setcookie ( 'rdpassagens', $login . "|" . $senha, time () +60*60*24*90 );
				
				Logger("Iniciando uma sessão para o usuário : " .utf8_decode($login));
				session_start (); // inicia a sessao
				$_SESSION ['logado'] = true;
				$_SESSION ['login'] = $login;
				$_SESSION ['cliente']= $cliente;
				
				header ( "Location: ../view/Principal.php" );

				die ();
			}
			
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
}
?>
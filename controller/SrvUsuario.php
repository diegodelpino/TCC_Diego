<?php
include_once '../model/Usuario.php';
include_once 'ConfDB.php';
include_once 'Logger.php';
include_once 'Sessao.php';

class SrvUsuario {
	
/* 	public function __construct(){
		date_default_timezone_set('America/Sao_Paulo');
	} */
	
	public static function autenticaUsuario($login, $senha) {
		try {
			$conexao = conn_mysql ();
			$SQLSelect = "SELECT * FROM usuario WHERE login = ? and senha = ?";
			$operacao = $conexao->prepare ( $SQLSelect );
			$pesquisar = $operacao->execute ( array ($login,$senha) );
			$usuario = $operacao->fetchObject("Usuario");
			$conexao = null;
			
			Logger("AUT : " . $aut);
				
			if (!$usuario) {
				Logger("Usuário ou senha inválido : login = " . $login . ", senha = ". $senha);
				header ( "location:../view/Logar.php?err=1" );
				die ();
			} else {
				Logger("Iniciando uma sessão para o usuário : " .utf8_decode($login));
				session_start (); // inicia a sessao
				$_SESSION ['logado'] = true;
				$_SESSION ['login'] = $login;
				$_SESSION ['usuario']= $usuario;
				$_SESSION ['id_usuario'] =  $usuario->getId();
				
				Logger($usuario->getNome());
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
	
	public function buscaPorId($id_usuario){
		try{
			$conexao = conn_mysql ();
			$SQLSelect = "SELECT * FROM usuario WHERE id_usuario = ?";
			$operacao = $conexao->prepare ( $SQLSelect );
			
			$pesquisar = $operacao->execute ( array (
				 $id_usuario
			) );			
			$usuario = $operacao->fetchObject("Usuario");
			$conexao = null;
			
			echo json_encode($usuario);
			} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
	
	public function alteraUsuario($id_usuario,$nome,$cpf,$unidade,$telefone,$login,$senha) {
		try {
		$conexao = conn_mysql ();
		$SQLUpdate = "UPDATE usuario SET cpf = :cpf , nome = :nome , telefone =:telefone ,	unidade = :unidade ,login = :login ,senha = :senha 
						WHERE id_usuario = :id_usuario ";
		$stmt = $conexao->prepare ( $SQLUpdate );

		$params = array (
		':id_usuario' => $id_usuario,
		':nome' => $nome,
		':cpf' => $cpf,
		':unidade' => $unidade,
		':telefone' => $telefone,
		':login' => $login,
		':senha' => $senha,
		);
	  
		$inserted = $stmt->execute ( $params );
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

$srvUsuario = new SrvUsuario ();

if (isset ( $_GET ["autenticaUsuario"] )) {
	Logger("Autenticando usuário : login = " . $_POST ["username"] . ", password= ". $_POST ["password"] );
	if (isset ( $_POST ["username"] ) && isset ( $_POST ["password"] )) {
		Logger("hdisidj");
		$srvUsuario->autenticaUsuario ( $_POST ["username"], $_POST ["password"]);
	} else {
		Logger ( "Usuário ou senha em branco." );
		header ( "location:../index.php?err=1" );
	}
}

if(isset($_GET["buscaPorId"])){
	$srvUsuario->buscaPorId($_POST["id_usuario"]);
}


if(isset($_GET["alteraUsuario"])){
	$srvUsuario->alteraUsuario($_POST["id_usuario"], $_POST["nome"], $_POST["cpf"], $_POST["unidade"], $_POST["telefone"], $_POST["login"], $_POST["senha"]);
}

?>
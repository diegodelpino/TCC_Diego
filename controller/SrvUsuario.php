<?php
include_once '../model/Hotel.php';
include_once '../model/Voo.php';
include_once '../model/Usuario.php';
include_once 'ConfDB.php';
include_once 'Logger.php';
include_once 'Sessao.php';

class SrvUsuario {
	
	public function __construct(){
		date_default_timezone_set('America/Sao_Paulo');
	}
	
	public static function autenticaUsuario($login, $senha) {
		try {
			// instancia objeto PDO, conectando no mysql
			$conexao = conn_mysql ();
			
			// instrução SQL básica (sem restrição de nome)
			
			$SQLSelect = "SELECT nome FROM usuario WHERE login = ? and senha = ?";
			
			// prepara a execução da sentença
			$operacao = $conexao->prepare ( $SQLSelect );
						
			// executa a sentença SQL com o valor passado por parâmetro
			Logger("sssssss");
			   $pesquisar = $operacao->execute ( array (
				 $login,
				 $senha 
			   ) );			
			Logger("Aaaaa");			
			$usuario = $operacao->fetchObject("Usuario");
			Logger("fffff");
			// fecha a conexão (os resultados já estão capturados)
			$conexao = null;
			
			Logger("AUT : " . $aut);
				
			if (!$usuario) {
				Logger("Usuário ou senha inválido : login = " . $login . ", senha = ". $senha);
				header ( "location:../view/Logar.php?err=1" );
				die ();
			} else {
				
				// Keep logging
/* 				if ($lembrar) {
					Logger("Criando cookie para o usuário : " .$login);
					setcookie ( 'rdpassagens', $login . "|" . $senha, time () +60*60*24*90 );
				} */
				
				Logger("Iniciando uma sessão para o usuário : " .utf8_decode($login));
				session_start (); // inicia a sessao
				$_SESSION ['logado'] = true;
				$_SESSION ['login'] = $login;
				$_SESSION ['usuario']= $usuario;
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
	
	public function addHotel($idItem, $dtIn, $dtOut){
		
		try{
			
			$conexao = conn_mysql ();
			$sth = $conexao->prepare("SELECT hotel_Cod as id, hotel_Nome as nome, hotel_Categoria as categoria, hotel_Cidade as cidade, hotel_Diaria as diaria, '$dtIn' as dtIn, '$dtOut' as dtOut  FROM hoteis ht WHERE hotel_Cod = ?");
			$sth->execute(array($idItem));
			$hotel = $sth->fetchObject("Hotel");
			$_SESSION["hotel"][$idItem] = $hotel;
		
			echo $this->countItemsNoCarrinho();
			
			Logger("Item no array hotel : " . count($_SESSION["hotel"])); 
		
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
	
	public function addVoo($idItem){
		
		try{
			
			$conexao = conn_mysql ();
			$sth = $conexao->prepare("SELECT voo_Cod as id, voo_Data as data, voo_Preco as preco, voo_CidadeOrigem as origem, voo_CidadeDestino as destino  FROM voos v WHERE voo_Cod = ?");
			$sth->execute(array($idItem));
			$voo = $sth->fetchObject("Voo");
			$_SESSION["voo"][$idItem] = $voo;
		
			echo $this->countItemsNoCarrinho();
			
			Logger("Add voo no array : " . count($_SESSION["voo"]));
		
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
	
	public function removeHotel($idItem){
		unset($_SESSION["hotel"][$idItem]);
		echo $this->countItemsNoCarrinho();
		Logger("Remove hotel no array: " . count($_SESSION["hotel"]));
	}
	
	public function removeVoo($idItem){
		unset($_SESSION["voo"][$idItem]);
		echo $this->countItemsNoCarrinho();
		Logger("Remove voo do array : " . count($_SESSION["voo"]));
	}
	
	public function countItemsNoCarrinho(){
		if ( count($_SESSION["hotel"]) > 0 || count($_SESSION["voo"]) > 0) {
			return count($_SESSION["hotel"]) + count($_SESSION["voo"]);
		}else {
			return 0;
		}
	}
	
	public function listaItemsCarrinho(){
		echo json_encode(array("hotel" => $_SESSION["hotel"], "voo" => $_SESSION["voo"]) );
	}
	
	public function total(){
		$total = 0;
		
		foreach ($_SESSION["hotel"] as $hotel){
			$total = $total + $hotel->getDiaria();
		}
		
		foreach ($_SESSION["voo"] as $hotel){
			$total = $total + $hotel->getPreco();
		}
		
		echo $total;
	}
	
	public function confirmaReservas(){
		
		try{
			
			if($_SESSION ['logado'] == false && !isset($_SESSION ['login'])){
				header ( "location:../view/Logar.php" );
			}else{
				
				$conexao = conn_mysql ();
					
				//prepara a execuÃ§Ã£o
				$insertHotel = $conexao->prepare('INSERT INTO reservashotel
												(`reservasHotel_Cliente`,
												`reservasHotel_Hotel`,
												`reservasHotel_DataEntrada`,
												`reservasHotel_DataSaida`,
												`reservasHotel_PrecoTotal`)
												VALUES	(?,?,?,?,?)');
				
				$insertVoo = $conexao->prepare('INSERT INTO `reservasvoo`
												(`reservasVoo_Cliente`,
												`reservasVoo_Voo`,
												`reservasVoo_QuantPassageiros`,
												`reservasVoo_PrecoTotal`)
												VALUES(?,?,?,?)');
				
				$usuario = $_SESSION["usuario"];
				
				foreach ($_SESSION["hotel"] as $hotel){
					$inserir = $insertHotel->execute(array($usuario->getId(), $hotel->getId(), $hotel->getDtIn(), $hotel->getDtOut(), $hotel->getTotalDiarias()));
				}
				
				foreach ($_SESSION["voo"] as $voo){
					$inserir = $insertVoo->execute(array($usuario->getId(), $voo->getId(), 200, $voo->getPreco()));
				}
				
				unset($_SESSION["voo"]);
				unset($_SESSION["hotel"]);
				
				header ( "location:../view/Perfil.php" );
				
				$conexao = null;
			}
		
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
	
	function salvaCadastro($nome, $email, $senha, $cidade){
		
		try{
		
			Logger ( "Salvando : " . $nome . " - " . $email . " - " . $senha . " - " . $cidade . " - " . $_FILES ['arquivo'] ['error']  );
			
			$conexao = conn_mysql ();
			
			$SQLSelect = 'SELECT `cliente_Cod` as id,
								`cliente_Email` as email,
								`cliente_Senha` as senha,
								`cliente_Cidade` as cidade,
								`cliente_Nome` as nome,
								`cliente_Foto` as foto 
								FROM clientes WHERE cliente_Email = ? ';
			
			// prepara a execução da sentença
			$operacao = $conexao->prepare ( $SQLSelect );
			
			$pesquisar = $operacao->execute ( array ( $email ) );
			
			$conexao = null;
			
			$cliente = $operacao->fetchObject ( "Cliente" );
			
			if ($cliente) {
				Logger ( "Usuário já cadastrado." );
				header ( "location:../view/Cadastro.php?err=2" );
				die ();
				exit (); // Para a execu��o do script
			
			} else {
				
				// Tratamento logo
				// Pasta onde o arquivo vai ser salvo
				$_UP ['pasta'] = '../images/';
				// Tamanho m�ximo do arquivo (em Bytes)
				$_UP ['tamanho'] = 1024 * 1024 * 2; // 2Mb
				                                   // Array com as extens�es permitidas
				$_UP ['extensoes'] = array ('jpg' ,'png' ,'gif' );
				// Renomeia o arquivo? (Se true, o arquivo ser� salvo como .jpg e um nome �nico)
				$_UP ['renomeia'] = false;
				
				// Array com os tipos de erros de upload do PHP
				$_UP ['erros'] [0] = 'Não houve erro';
				$_UP ['erros'] [1] = 'O arquivo no upload é maior do que o limite do PHP';
				$_UP ['erros'] [2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
				$_UP ['erros'] [3] = 'O upload do arquivo foi feito parcialmente';
				$_UP ['erros'] [4] = 'Não foi feito o upload do arquivo';
				
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES ['arquivo'] ['error'] != 0 && $_FILES ['arquivo'] ['error'] != 4) {
					die ( "Não foi possível fazer o upload, erro:<br />" . $_UP ['erros'] [$_FILES ['arquivo'] ['error']] );
					exit (); // Para a execu��o do script
				}
				
				if ($_FILES ['arquivo'] ['error'] != 4) {
					
					$value = explode ( ".", $_FILES ['arquivo'] ['name'] );
					$extensao = strtolower ( array_pop ( $value ) ); // Line 32
					                                           // the file name is before the last "."
					$fileName = array_shift ( $value ); // Line 34
					
					if (array_search ( $extensao, $_UP ['extensoes'] ) === false) {
						echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
					} 				
	
					// Faz a verifica��o do tamanho do arquivo
					else if ($_UP ['tamanho'] < $_FILES ['arquivo'] ['size']) {
						echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
					} 				
	
					// O arquivo passou em todas as verifica��es, hora de tentar mov�-lo para a pasta
					else {
						// Primeiro verifica se deve trocar o nome do arquivo
						if ($_UP ['renomeia'] == true) {
							// Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o .jpg
							$nome_final = time () . '.jpg';
						} else {
							// Mant�m o nome original do arquivo
							$nome_final = $_FILES ['arquivo'] ['name'];
						}
						
						// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
						if (move_uploaded_file ( $_FILES ['arquivo'] ['tmp_name'], $_UP ['pasta'] . $nome_final )) {
							// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
							Logger ( "Upload efetuado com sucesso!" );
							// echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
						} else {
							// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
							echo "Não foi possível enviar o arquivo, tente novamente";
						}
					}
					
					$conexao = conn_mysql ();
					
					Logger ("Insert : ". $nome . " - " . $email . " - " . $senha . " - " . $cidade . " - " . $_FILES ['arquivo'] ['error']." - ".$nome_final  );
					
					$insertCliente = $conexao->prepare ( 'INSERT INTO `clientes`(`cliente_Email`,
													`cliente_Senha`,
													`cliente_Cidade`,
													`cliente_Nome`,
													`cliente_Foto`)
													VALUES(?,MD5(?),?,?,?)' );
					
					$insertCliente->execute ( array ( $email,$senha,$cidade,$nome,$nome_final) );
					
					$conexao = null;
					
					header ( "location:../view/Principal.php?confirm=1" );
				}
			}
		
		} catch ( PDOException $e ) {
			Logger ( "(file:" . $e->getFile () . " ,line:" . $e->getLine () . " ,message:" . $e->getMessage ().")" );
			die ();
		} catch (Exception $ex){
			Logger ( "(file:" . $ex->getFile () . " ,line:" . $ex->getLine () . " ,message:" . $ex->getMessage ().")" );
			die ();
		}
	}
	
	function listaCidades(){
		// instancia objeto PDO, conectando no mysql
		$conexao = conn_mysql ();
			
		// instrução SQL básica (sem restrição de nome)
		$SQLSelect = 'select * from cidades';
			
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
	
	function listaRescentes(){
		
		$conexao = conn_mysql ();
	
		$SQLSelectHotel = "SELECT 
						    hotel_Cod,
						    hotel_Nome as nome,
						    hotel_Diaria as diaria,
						    (SELECT 
						            cidade_Nome
						        FROM
						            cidades
						        WHERE
						            cidade_Cod = ht.hotel_Cidade) AS cidade,
						    CASE hotel_Categoria
						        WHEN 1 THEN 'Luxo'
						        ELSE 'Básico'
						    END AS categoria,
							(SELECT  rh.reservasHotel_DataEntrada AS hotel_Cod FROM reservashotel rh WHERE  rh.reservasHotel_Hotel = ht.hotel_Cod) as dtIn,
							(SELECT  rh.reservasHotel_DataSaida AS hotel_Cod FROM reservashotel rh WHERE  rh.reservasHotel_Hotel = ht.hotel_Cod) as dtOut
						FROM
						    hoteis ht
						WHERE
						    ht.hotel_Cod IN (SELECT 
						            rh.reservasHotel_Hotel AS hotel_Cod
						        FROM
						            reservashotel rh
						        WHERE
						            rh.reservasHotel_Cliente = ?)";
		
		$SQLSelectVoo = 'SELECT 
					    v.voo_Preco as preco,
					    v.voo_Data as data,
					    (SELECT 
					            cidade_Nome
					        FROM
					            cidades
					        WHERE
					            cidade_Cod = v.voo_CidadeOrigem) AS origem,
					    (SELECT 
					            cidade_Nome
					        FROM
					            cidades
					        WHERE
					            cidade_Cod = v.voo_CidadeDestino) AS destino
					FROM
					    voos v
					WHERE
					    v.voo_Cod IN (SELECT 
					            rv.reservasVoo_Voo AS voo_Cod
					        FROM
					            reservasvoo rv
					        WHERE
					            rv.reservasVoo_Cliente = ?)';
		
		$cliente = $_SESSION ['cliente'];
		
		$operacaoHotel = $conexao->prepare ( $SQLSelectHotel );
		$pesquisar = $operacaoHotel->execute (array($cliente->getId()));
		$hoteis = $operacaoHotel->fetchAll (PDO::FETCH_ASSOC);
		
		$operacaoVoo = $conexao->prepare ( $SQLSelectVoo );
		$pesquisar = $operacaoVoo->execute (array($cliente->getId()));
		$voos = $operacaoVoo->fetchAll (PDO::FETCH_ASSOC);

		$conexao = null;
		
		echo json_encode(array("hotel" => $hoteis, "voo" => $voos) );
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

if(isset($_GET["addHotel"])){	
	if (isset($_POST["hotel"])) {
		$srvUsuario->addHotel($_POST["hotel"], $_POST["dtIn"], $_POST["dtOut"]);
	}
}

if(isset($_GET["addVoo"])){
	if (isset($_POST["voo"])) {
		$srvUsuario->addVoo($_POST["voo"]);
	}
}

if(isset($_GET["removeHotel"])){
	if (isset($_POST["hotel"])) {
		$srvUsuario->removeHotel($_POST["hotel"]);
	}
}

if(isset($_GET["removeVoo"])){
	if (isset($_POST["voo"])) {
		$srvUsuario->removeVoo($_POST["voo"]);
	}
}

if(isset($_GET["countItems"])){
	echo $srvUsuario->countItemsNoCarrinho();
}

if(isset($_GET["listaItemsCarrinho"])){
	$srvUsuario->listaItemsCarrinho();
}

if (isset($_GET["total"])) {
	$srvUsuario->total();
}

if (isset($_GET["confirmaReservas"])) {
	$srvUsuario->confirmaReservas();
}

if(isset($_GET["salvaCadastro"])){
	$srvUsuario->salvaCadastro($_POST["nome"], $_POST["email"], $_POST["senha"], $_POST["cidade"]);
}

if(isset($_GET["listaCidades"])){
	$srvUsuario->listaCidades();
}

if(isset($_GET["listaRescentes"])){
	$srvUsuario->listaRescentes();
}

?>
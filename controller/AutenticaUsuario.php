<html>
<head>
<?php
	include "Conexao.php";
	
	//Keep loging
	//if($_POST["loginkeeping"] == "loginkeeping"){
		//setcookie('localizagora',$_POST["username"]."|".$_POST["password"],time()+3600);
	//}
	
	//check usuário
	$user = mysql_query("SELECT * FROM usuario WHERE login='".$_POST["username"]."' AND senha='".md5($_POST["password"])."'" ) or die(mysql_error());
	
	$result = mysql_fetch_array($user);
		
	if( mysql_num_rows($user) == 1){
				
				session_start();// inicia a sessao
				$_SESSION["login"] = $_POST["username"];
				$_SESSION["senha"] = $_POST["password"];
				$_SESSION["idUsuario"] = $result["idUsuario"];

				
				header("location:../view/principal.php");
				/* if($_SESSION["login"] == "admin"){
					header("location:../view/ListaDevices.php");
				}else{
					header("location:../view/Principal.php");
				}	 */
				
		}else{
				header("location:../index.php?err=1");
		}
?>
</head>
<body>

</body>
</html> 

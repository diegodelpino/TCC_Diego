
<?php

	include "../model/Usuario.php";
	include "../dao/UsuarioDAO.php";
	
	$usuario = new Usuario();
	
	$usuario->setNome($_POST["usernamesignup"]);
	$usuario->setEmail($_POST["emailsignup"]);
	$usuario->setCpf($_POST["cpfsignup"]);
	$usuario->setNasc($data = implode("-",array_reverse(explode("/",$_POST["nascsignup"]))));
	$usuario->setSexo($_POST["sexosignup"]);
	$usuario->setLogin($_POST["loginsignup" ]);
	$usuario->setSenha(md5($_POST["passwordsignup"]));
	
	$usuariodao = new UsuarioDAO();
	$usuariodao->insere($usuario);		
	
?>

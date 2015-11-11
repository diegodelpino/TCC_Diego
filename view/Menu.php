<?php
include_once '../model/Usuario.php';
include_once '../controller/Sessao.php';
include_once '../model/Requisicao.php';

if (isset ( $_SESSION ['logado'] )) {
	if ($_SESSION ['logado'] == true) {
		echo '<a class="navbar-brand" href="Perfil.php">' . $_SESSION ['login'] . '</a>';
		echo '<input type="hidden" id="id_usuario" value="'.$_SESSION ["id_usuario"].'" />';
		echo '<input type="hidden" id="edita" value="'.$_GET["edita"].'" />';
		echo '<input type="hidden" id="id_requisicao" value="'.$_GET["id_requisicao"].'" />';
		
	} else{
		echo '<a class="navbar-brand" href="Logar.php">Logar</a>';
	}
}else{
	$_SESSION ['logado'] = false;
}
//<a class="navbar-brand" href="javascript:window.history.go(-1)">Voltar</a>

?>

<a class="navbar-brand" href="../controller/Logout.php">Sair</a>


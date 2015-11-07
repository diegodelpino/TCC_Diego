<?php
include_once '../model/Cliente.php';
include_once '../controller/Sessao.php';

if (isset ( $_SESSION ['logado'] )) {
	if ($_SESSION ['logado'] == true) {
		echo '<a class="navbar-brand" href="Perfil.php">' . $_SESSION ['login'] . '</a>';
	} else{
		echo '<a class="navbar-brand" href="Logar.php">Logar</a>';
	}
}else{
	$_SESSION ['logado'] = false;
}
//<a class="navbar-brand" href="javascript:window.history.go(-1)">Voltar</a>

?>

<a class="navbar-brand" href="../controller/Logout.php">Sair</a>

<a class="navbar-brand" href="Carrinho.php">Carrinho : </a>
<label class="navbar-brand" id="countItems">0</label>

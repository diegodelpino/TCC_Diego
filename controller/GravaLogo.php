<?php
//Tratamento logo
// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../images/';
// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
// Array com as extens�es permitidas
$_UP['extensoes'] = array('jpg', 'png', 'gif');
// Renomeia o arquivo? (Se true, o arquivo ser� salvo como .jpg e um nome �nico)
$_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
	die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
	exit; // Para a execu��o do script
}
// Caso script chegue a esse ponto, n�o houve erro com o upload e o PHP pode continuar

// Faz a verifica��o da extens�o do arquivo

$value = explode(".", $_FILES['arquivo']['name']);
$extensao = strtolower(array_pop($value));   //Line 32
// the file name is before the last "."
$fileName = array_shift($value);  //Line 34

if (array_search($extensao, $_UP['extensoes']) === false) {
	echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
}

// Faz a verifica��o do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
	echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
}

// O arquivo passou em todas as verifica��es, hora de tentar mov�-lo para a pasta
else {
	// Primeiro verifica se deve trocar o nome do arquivo
	if ($_UP['renomeia'] == true) {
		// Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o .jpg
		$nome_final = time().'.jpg';
	} else {
		// Mant�m o nome original do arquivo
		$nome_final = $_FILES['arquivo']['name'];
	}

	// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
	if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
		// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
		header("location:../view/gestaoCliente.php");
	//	echo "Upload efetuado com sucesso!";
	//	echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
	} else {
		// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
		echo "Não foi possível enviar o arquivo, tente novamente";
	}
}
//header("location:../view/ListaDevices.php");
?>
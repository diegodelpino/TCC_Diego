<?php
include 'conexao.php';
$cpf=$_GET['cpf'];
$id_requisicao=1;
$res_req=mysqli_query($conn,"select * from condominio.requisicao where id_requisicao=$id_requisicao");
$lista_categorias=mysqli_query($conn,"select * from categoria");
$lista_categorias_selecionadas=mysqli_query($conn,"select sc.id_cat,cat.nome from solicitacao sc
					inner join requisicao req on sc.id_requisicao = req.id_requisicao
					inner join categoria cat on sc.id_cat = cat.id_cat where req.id_requisicao = $id_requisicao");

if (!mysqli_query($conn,"select * from requisicao where id_requisicao=$id_requisicao"))
  {
  echo("Error description: " . mysqli_error($conn));
  }
  
if (mysqli_num_rows($res_req)<=0) {
    echo 'id inexistente! <br>';
} else {

	}
mysqli_close(); 
?>

<html>
<head><meta charset="UTF-8">
<title>Cadastrar Fornecedor </title>
	<style>	label{display: block;}</style>
</head>
	<body>
		<form name = "cad_fornecedor" action="salvar_fornecedor.php" method="post">
			<label for="dvenda">Nome: </label>
			<input type="text" name="titulo" id="titulo" value = <?=$titulo?>>
			
			<label for="descricao">Endereço: </label>
			<textarea name="descricao" id="decricao"><?=$descricao?></textarea> <br>
		
			<label for="dvenda">CPF/CNPJ: </label>
			<input type="text" name="titulo" id="titulo" value = <?=$titulo?>>
			
			<label for="dvenda">Telefone: </label>
			<input type="text" name="titulo" id="titulo" value = <?=$titulo?>>
		
			<label for="detalhes">Detalhes: </label>
			<textarea name="detalhes" id="detalhes"></textarea> <br>

			<fieldset>
                <legend>Categorias associadas a este fornecedor:</legend>
						<?php while ($linha = mysqli_fetch_assoc($lista_categorias)) {
						$id_cat=$linha["id_cat"];
						$nome=$linha["nome"];
						echo "<input type='checkbox' name='categoria' value=$id_cat />$nome	<br />";
						}
						?>
						
			</fieldset>
			
			<input type="submit" value="Cadastrar">

			<input type="hidden" id = "id_requisicao" name = "id_requisicao" value="<?=$id_requisicao?>" />
			<input type="hidden" id = "cpf" name = "cpf" value="<?=$cpf?>" />
		</form>
	</body>
</html>

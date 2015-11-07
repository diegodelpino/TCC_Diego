<?php
include 'conexao.php';
$cpf=$_GET['cpf'];
$id_requisicao=$_GET['id_requisicao'];
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
	$requisicao = mysqli_fetch_assoc($res_req); 
	$titulo= $requisicao['titulo'];
	$prioridade= $requisicao['prioridade'];
	$descricao= $requisicao['descricao'];
	$lista_status=mysqli_query($conn, "select * from status");
	$ultimo_status=mysqli_query($conn, 
		"SELECT st.id_status,st.status FROM requisicao req
				inner join historico hist on req.id_requisicao = hist.id_requisicao
				and hist.id_hist = (SELECT historico.id_hist FROM historico WHERE historico.id_requisicao = req.id_requisicao
							order by data_atualizacao desc limit 1)
				inner join status st on hist.id_status = st.id_status
				where req.id_requisicao=$id_requisicao");
	$historico=mysqli_query($conn,"select * from historico  hist inner join status st on st.id_status = hist.id_status
			inner join usuario us on us.cpf = hist.cpf where id_requisicao =$id_requisicao order by data_atualizacao desc");
	$cpf_criador=mysqli_query($conn,"select cpf from historico where id_requisicao=$id_requisicao order by data_atualizacao asc limit 1");
	}
mysqli_close(); 

//TODO: Função Atualizar - gerar registro no histórico e salvar
//TODO: testar se o usuário logado é o usuário criador da requisição ou o síndico
//TODO: Auto-selecionar o último status
//TODO: Seleção de categorias deve ser conjunto de checkbuttons
//TODO: Seleção de fornecedores - preciso de idéias
//TODO: Função Inativar/Reativar

?>

<html>
<head><meta charset="UTF-8">
<title> Detalhes requisição </title>
	<style>	label{display: block;}</style>
</head>
	<body>
		<form name = "pedido" action="salvar_pedido.php" method="post">
			<label for="dvenda">Título: </label>
			<input type="text" name="titulo" id="titulo" value = <?=$titulo?>>
			
			<label for="descricao">Descrição: </label>
			<textarea name="descricao" id="decricao"><?=$descricao?></textarea> <br>
			
			<input type="submit" value="Inativar">
			
			<label for="detalhes">Detalhes: </label>
			<textarea name="detalhes" id="detalhes"></textarea> <br>
			
			<label for="prioridade">Prioridade:</label>
			<select name="prioridade"> 
				<option value= 1 selected>EMERGENCIAL</option>
				<option value= 2>URGENTE</option>
				<option value= 3>IMPORTANTE</option>
				<option value= 4>NORMAL</option>
				<option value= 5>BAIXA</option>
			</select>

			<label for="fpag">Status:</label>
			<select name="clientes"> 
			<?php while ($linha = mysqli_fetch_assoc($lista_status)) {
				$id_status=$linha["id_status"]; 
				if($ultimo_status==$id_status){
					echo "<option value='$id_status' selected>";
				}
				else{
					echo "<option value='$id_status'>";
				}
				echo $linha["status"]."</option>";
			} ?> </select>

			
			<fieldset>
                <legend>Categorias deste fornecedor:</legend>
						<?php 
						while ($linha = mysqli_fetch_assoc($lista_categorias)) {
						$cat_sel="false";
						$id_cat=$linha["id_cat"];
						$nome=$linha["nome"];
						while ($catsel = mysqli_fetch_assoc($lista_categorias_selecionadas)) {
							if($id_cat==$catsel["id_cat"]){
								echo "<input type='checkbox' name='categoria' value=$id_cat checked/>$nome	<br />";
								$cat_sel="true";
							}
						}
						if($cat_sel=="false"){
								echo "<input type='checkbox' name='categoria' value=$id_cat />$nome	<br />";
						}
						}?>
			</fieldset>

			<label for="endereco">Associar Fornecedor/Lista de fornecedores: </label>
			<textarea name="endereco" id="endereco"><?=$end?></textarea> <br>
			<br>

			<input type="submit" value="Atualizar">

			<?php 
			if (mysqli_num_rows($historico)>0) {
			echo "<h2>Histórico</h2>";
			echo "<table border='1'><tr><td>Data da atualização:</td><td>Status</td><td>Detalhes</td><td>Responsável</td>";
			
			while ($linha = mysqli_fetch_assoc($historico)) {
			   	$data_atualizacao=$linha["data_atualizacao"];
				$status=$linha["status"];
				$detalhes=$linha["detalhes"];
				$nome=$linha["nome"];
				echo "<tr><td>$data_atualizacao</td><td>$status</td><td>$detalhes</td><td>$nome</td></tr>";
			}
			echo " </table>";
		} 
			?>
			<input type="hidden" id = "id_requisicao" name = "id_requisicao" value="<?=$id_requisicao?>" />
			<input type="hidden" id = "cpf" name = "cpf" value="<?=$cpf?>" />
		</form>
	</body>
</html>

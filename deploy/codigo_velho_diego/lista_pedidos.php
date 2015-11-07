<?php
include 'conexao.php';



    $res_req=mysqli_query($conn,
	"SELECT req.id_requisicao,req.titulo,req.prioridade, st.status, hist.data_atualizacao
			FROM requisicao req
			inner join historico hist on req.id_requisicao = hist.id_requisicao
			and hist.id_hist = 
					( SELECT historico.id_hist
						FROM historico
						WHERE historico.id_requisicao = req.id_requisicao
						order by data_atualizacao desc
						limit 1)
			inner join status st on hist.id_status = st.id_status");
	if (mysqli_num_rows($res_req)>0) {
			echo "<h2><center> Livraria - Lista de Pedidos </center></h2>";
			echo "<table border='1'><tr><td>titulo Pedido:</td><td>CPF-Usuário Cliente:</td><td>Endereço de entrega:</td>";
			echo "<td>Forma de Pagamento:</td><td>Atualizar</td><td>Excluir</td></tr>";
			
			while ($linha = mysqli_fetch_assoc($res_req)) {
			   	$id_requisicao=$linha["id_requisicao"];
				$titulo=$linha["titulo"];
				$prioridade=$linha["prioridade"];
				$status=$linha["status"];
				$data_atualizacao=$linha["data_atualizacao"];
				echo "<tr>";
				echo "<td>";
				echo $titulo;
				echo "</td>";
				echo "<td>";
				echo $prioridade;
				echo "</td>";
				echo "<td>";
				echo $status;
				echo "</td>";
				echo "<td>";
				echo $data_atualizacao;
				echo "</td>";
				echo "<td><a href=detalhes_requisicao.php?id_requisicao=$id_requisicao".">[Detalhes]</a></td>";
				echo "<td><a href="."excluir_pedido.php?id_requisicao=$id_requisicao".">[Excluir]</a></td></tr>";
				echo "</tr>";
			}
			echo " </table>";
			echo "<br> <a href='principal_pedidos.html'>Voltar ao principal</a>"	;
		} 
		else {
			echo "Pedidos ainda não cadastrados!";
		}
	 mysql_close();	  
?>

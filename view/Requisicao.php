
<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>EDITAR REQUISIÇÃO</title>

<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/shop-homepage.css" rel="stylesheet">
<link href="../css/jquery-ui.min.css" rel="stylesheet">

<script type="text/javascript" src="../dist/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../dist/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/Requisicao.js"></script>

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="Principal.php">Início</a>
				<a class="navbar-brand" id="menuHotel" href="#">Hotéis</a>
				<a class="navbar-brand" id="menuVoo"  href="#">Voos</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<div class="pull-right">
					<?php include_once 'Menu.php';?>
				</div>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>

	<!-- Page Content -->
	<div class="container">
		
		 <div class="form-group">
		    <label for="titulo">Titulo</label>
		    <input type="text" required="true" class="form-control" id="titulo" name="titulo">
		  </div>
		  
		   <div class="form-group">
		    <label for="descricao">Descrição:</label>
			<textarea class="form-control" rows="5" id="descricao"></textarea>
		  </div>
		  
		  <div class="form-group">
		    <label for="detalhes">Detalhes:</label>
			<textarea class="form-control" rows="5" id="detalhes"></textarea>
		  </div>
		  
		   <div class="form-group">
		    <label for="prioridade">Prioridade:</label>
			<select class="form-control" name="prioridade" id = "prioridade"> 
				<option value= 1 selected>Emergencial</option>
				<option value= 2>Urgente</option>
				<option value= 3>Importante</option>
				<option value= 4>Normal</option>
				<option value= 5>Baixa</option>
			</select>
		  </div>

		   <div class="form-group">
		    <label for="status">Status:</label>
			<select class="form-control" name="status" id = "status"> 
				<option value= 1 selected>Inicial</option>
				<option value= 2>Andamento</option>
				<option value= 3>Concluída</option>
				<option value= 4>Inativa</option>
				<option value= 5>Arquivada</option>
			</select>
		  </div>

		  <div class="form-group">
		  <fieldset class="scheduler-border">
				<legend class="scheduler-border">Categorias desta requisição</legend>
					<div class="checkbox">
						<label><input type="checkbox" value="">Categoria 1</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Categoria 2</label>
					</div>	
			</fieldset>
			</div>

			<div class="form-group">
				<button type="button" id="botaoAlteraUsuario" class="btn btn-default">Salvar</button>
			</div>
			
			<div class="form-group">
				<label for="titulo">Histórico</label>
				<table class="table table-bordered">
				<thead><tr><th>Data da atualização:</th><th>Status</th><th>Detalhes</td><td>Responsável</th></tr></thead>
				<tbody>
					<tr><td>dddddd</td><td>aaaa</td><td>ddddd</td><td>eeeee</td></tr>
				</tbody>
				</table>
			</div>
			
			 <div class="form-group">
		    <label for="senha">Senha</label>
		    <input type="hidden" required="true" class="form-control" id="senha" name="senha" placeholder="Password">
			</div>
 
			
			
	</div>
	<!-- /.container -->

	<div class="container">

		<hr>

		<!-- Footer -->
		<footer>
			<div class="row">
				<div class="col-lg-12">
					<p>Copyright &copy; Your Website 2014</p>
				</div>
			</div>
		</footer>

	</div>

	<!-- Bootstrap Core JavaScript -->
	<script src="../dist/js/bootstrap.min.js"></script>

</body>

</html>

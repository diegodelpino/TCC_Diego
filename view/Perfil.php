
<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Perfil</title>

<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/shop-homepage.css" rel="stylesheet">
<link href="../css/jquery-ui.min.css" rel="stylesheet">

<script type="text/javascript" src="../dist/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../dist/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/Perfil.js"></script>

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
		 <div class="col-md-3">
         	<div class="list-group">
                <a href="#" class="list-group-item">Editar Perfil</a>
                <a href="#" class="list-group-item">Remover Perfil</a>
            </div>
         </div>
         
         <div class="col-md-9">
	         <?php 
	        	$cliente = $_SESSION["cliente"];
	         	echo '<img alt="Perfil" src="../images/'.$cliente->getFoto().'" width="200px" height="200px" style="float : left; margin-right : 12px;" >';
	         	echo '<ul style="list-style-type:none">';
	         	echo '<li><label for="nome">Nome : </label>';
	         	echo '<span id="nome">'.$cliente->getNome().'</span></li>';
	         	echo '<li><label for="nome">Email : </label>';
	         	echo '<span id="nome">'.$cliente->getEmail().'</span></li>';
	         	echo '<li><label for="nome">Cidade : </label>';
	         	echo '<span id="nome">'.$cliente->getNomeCidade().'</span></li>';
	         	
	         ?>
			</ul>	
			<div style="clear: left;">
				<h3>Hotéis</h3>
				<table class="table table-hover table-striped table-bordered ">
					<thead id="listaHoteisRescentes" >
						<tr>
							<th>Produto</th>
							<th>Cidade</th>
							<th>Entrada</th>
							<th>Saída</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody id="listaHoteis"></tbody>
				</table>
				
				<h3>Voos</h3>
				<table class="table table-hover table-striped table-bordered">
					<thead id="listaVoosRescentes">
						<tr>
							<th>Origem</th>
							<th>Destino</th>
							<th>Data</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody id="listaVoos"></tbody>	
				</table>
			</div>
         </div>
         
	</div>
	

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
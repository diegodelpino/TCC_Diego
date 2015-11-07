
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
<script type="text/javascript" src="../js/Cadastro.js"></script>

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
		<form method="post" action="../controller/SrvUsuario.php?salvaCadastro=true" enctype="multipart/form-data">
		 <div class="form-group">
		    <label for="nome">Nome</label>
		    <input type="text" required="true" class="form-control" id="nome" name="nome" placeholder="Nome">
		  </div>
		  <div class="form-group">
		    <label for="email">Email</label>
		    <input type="email" required="true" class="form-control" id="email" name="email" placeholder="Email">
		  </div>
		  <div class="form-group">
		    <label for="senha">Senha</label>
		    <input type="password" required="true" class="form-control" id="senha" name="senha" placeholder="Password">
		  </div>
		  <div class="form-group">
		 	<label for="cidade">Cidade</label>
		   <select id="cidades" required="true" name="cidade" class="form-control"></select>
		  </div>
		  <div class="form-group">
			<label for="arquivo">Foto</label>
	    	<input type="file" required="true" id="arquivo" name="arquivo">
	    	<p class="help-block"></p>
		  </div>

		  <button type="submit" class="btn btn-default">Submit</button>
		</form>

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

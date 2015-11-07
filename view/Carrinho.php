
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Página de produtos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/shop-homepage.css" rel="stylesheet">
    
    <script type="text/javascript" src="../dist/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/Carrinho.js"></script>
 	 	
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Principal.php">Início</a>
            </div>
             <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="pull-right" ><?php include_once 'Menu.php';?> </div>
            </div>
            <!-- /.navbar-collapse -->
      
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
    
    	<h3>Hotéis</h3>
		<table class="table table-hover table-striped table-bordered ">
			<thead id="headListaHoteis" >
				<tr>
					<th>Produto</th>
					<th>Valor</th>
					<th>Entrada</th>
					<th>Saída</th>
					<th></th>
				
				</tr>
			</thead>
			<tbody id="listaHoteis"></tbody>
			
		</table>
		
		<h3>Voos</h3>
		<table class="table table-hover table-striped table-bordered">
			<thead id="headListaVoos">
				<tr>
					<th>Origem</th>
					<th>Destino</th>
					<th>Data</th>
					<th>Valor</th>
					<th></th>	
				</tr>
			</thead>
			<tbody id="listaVoos"></tbody>
			
		</table>
		
		 <hr>
		 
		 <div class="pull-left">
			<h3>Total : <small id="total"></small></h3>
		</div>
		<div class="pull-right">
			<form method="post"  class="form-signin" role="form" method="post" action="../controller/SrvUsuario.php?confirmaReservas=true">
				<button type="submit" id="btnConfirma" class="btn btn-success">Confirma</button>
			</form>
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

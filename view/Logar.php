<?php
//TODO:IGNORE
   echo "Cookie " . isset($_COOKIE["rdpassagens"]);
   if(isset($_COOKIE["rdpassagens"])){ //se existir um cookie de senha, pula direto para a p�gina de verifica��o 
     include("./controller/VerificaCookie.php");  //"login autom�tico"
     die();
   }
   
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
  
    <link rel="shortcut icon" href="./../assets/ico/favicon.ico">

    <title>Formulário de Login </title>

	<!-- Boostrap minified CSS -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../dist/css/bootstrap-theme.min.css">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
    
    <script type="text/javascript" src="../dist/js/jquery-1.11.3.min.js"></script>

  </head>

  <body>

    <div class="container">

      <form method="post"  class="form-signin" role="form" method="post" action="../controller/SrvUsuario.php?autenticaUsuario=true">
      	
        <h2 class="form-signin-heading text-center">Faça seu login</h2>
        
        <?php 
        	if(isset($_GET["err"])){
        		echo '<p style="float : left; margin-right : 12px;">Usuário ou senha inválida</p>';
        		echo '<a href="/Cadastro.php" style=" margin : 12px;">Cadastro</a>';
        	}
        ?>
        
		<input type="text" name="username" class="form-control" required autofocus>
        
		<input type="password" name="password" class="form-control" placeholder="Senha" required>
        
		<label class="checkbox">
          <input type="checkbox" name="lembrar" value="lembrar-login"> Lembrar login
        </label>
        
		<button class="btn btn-lg btn-success btn-block" type="submit">Enviar</button>
      </form>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="../dist/js/bootstrap.min.js"></script>
  </body>
</html>

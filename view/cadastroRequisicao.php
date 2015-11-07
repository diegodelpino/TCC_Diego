<?php 
include("../controller/Sessao.php");
?>
<!DOCTYPE html>
<html>
    <head>
	   	 <meta charset="UTF-8">
	    
		 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		 <link rel="stylesheet" type="text/css" href="../css/menuStyles.css">   	 
	   
	    <link rel="stylesheet" type="text/css" href="../jqueryeasyui/themes/default/easyui.css">
	    <link rel="stylesheet" type="text/css" href="../jqueryeasyui/themes/icon.css">
	    <link rel="stylesheet" type="text/css" href="../css/layout.css">
	    
	    <script type="text/javascript" src="../libs/jquery-1.11.3.min.js"></script>
	    
		<title>Gestão de Requisição</title>
		
		<script type="text/javascript">

		$(function(){

			$("#botaoSubmete").click(function(){
				submete();
			});
		});

		function submete(){ 
			alert("aham");

			document.requisicao.action="../controller/ServicoRequisicao.php?listaRequisicao=true";
			document.forms.requisicao.submit();
		}
		
		</script>
		
    </head>
    <body>
	
   		<form  name="requisicao" method="post" action="" >
	   		 <input type="button" value="submit" id="botaoSubmete"/>
   		 </form>
	   	
	</body>
</html>
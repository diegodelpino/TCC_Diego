<?php

 		function Logger($msg){
 		
 			date_default_timezone_set('America/Sao_Paulo');
 			
 			$data = date("d-m-y");
 			$hora = date("H:i:s");
 			$ip = $_SERVER['REMOTE_ADDR'];
 		
 			//Nome do arquivo:
 			$arquivo = "../logs/Logger_$data.txt";
 		
 			//Texto a ser impresso no log:
 			$texto = "[$hora][$ip]> $msg \n";
 		
 			$manipular = fopen("$arquivo", "a+b");
 			fwrite($manipular, $texto);
 			fclose($manipular);
 	}
 

 
?>
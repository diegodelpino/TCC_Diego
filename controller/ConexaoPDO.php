<?php
 function conn_mysql(){

   $servidor = 'localhost';
   $porta = 3307;
   $banco = "propostacomercial";
   $usuario = "root";
   $senha = "rdsd@2016";
   
      $conn = new PDO("mysql:host=$servidor;
	                   port=$porta;
					   dbname=$banco", 
					   $usuario, 
					   $senha,
					   array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
					   );
      
      return $conn;
   }
?>
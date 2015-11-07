<?php
 function conn_mysql(){

   $servidor = 'localhost';
   $banco = "condominio";
   $usuario = "root";
   $senha = "Bool21KZ";
   
      $conn = new PDO("mysql:host=$servidor;
					   dbname=$banco", 
					   $usuario, 
					   $senha,
					   array(PDO::ATTR_PERSISTENT => true)
					   );
      return $conn;
   }
?>
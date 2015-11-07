<?php
//configura��es do banco

$conexao = mysql_connect("localhost","root","rdsd@2016") or die (mysql_error());
//$conexao->set_charset('utf-8');
mysql_select_db("propostacomercial" , $conexao) or die (mysql_error());

?>
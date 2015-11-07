<?php
//configura��es do banco

$conexao = mysql_connect("localhost","root","<senha>") or die (mysql_error());
//$conexao->set_charset('utf-8');
mysql_select_db("condominio" , $conexao) or die (mysql_error());

?>
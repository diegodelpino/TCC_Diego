<?php

@session_start ();
session_destroy ();
session_unset ();

@session_start ();
$_SESSION ['logado'] = false;

header ( "location:../index.php" );

?>
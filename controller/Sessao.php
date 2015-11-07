<?php
	
	@session_start();
	if(isset($_SESSION["login"])){
		$_SESSION["debug"] = false;
	}else{
		header("location:../index.php");
	}
	
	
?>
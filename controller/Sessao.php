<?php
	
	@session_start();
	if(isset($_SESSION["login"])){
		
	}else{
		header("location:../index.php");
	}
	
	
?>
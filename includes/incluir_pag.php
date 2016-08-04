<?php
	 if ($_GET["pg"]=="") {	 
	 
		$_GET["pg"]=base64_encode("visao/home/home.php?modulo=Principal&titulo=Painel");
		include base64_decode($_GET["pg"]);	
					
		 }else{			 		
		
		include base64_decode($_GET["pg"]);
	 }	
?>
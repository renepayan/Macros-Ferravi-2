<?php
      $file=fopen("CRM_Admin", "r");
	  $usuario =preg_replace ("[\n|\r|\n\r]","",fgets($file));
	  $password=preg_replace ("[\n|\r|\n\r]","",fgets($file));	
	  if($usuario==null|$password==null){
	     $file=fopen("CRM_Admin", "w");
	     $usuario=$_POST['usuario'];
	     $password=$_POST['password'];
		 fwrite($file, base64_encode(base64_encode($usuario))."\n".base64_encode(base64_encode($password)). PHP_EOL);
		 header("Location: index.php");
	  }else{
    	  session_destroy();
		  header("Location: index.php");
	  }
?>
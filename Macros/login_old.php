<?php
	  session_start();
	  if($_SESSION["logueado"]==null){
	     session_destroy();
	  }else{
	     header("Location: main.php"); 
	  }
      $file=fopen("CRM_Admin", "r");
	  $usuario=base64_decode(base64_decode(preg_replace ("[\n|\r|\n\r]","",fgets($file))));
	  $password=base64_decode(base64_decode(preg_replace ("[\n|\r|\n\r]","",fgets($file))));	
	  if($usuario==null|$password==null||$_POST["usuario"]==null||$_POST["password"]==null){
	      header("Location: init.php");
	  }else{
         	  if(strcmp($usuario, $_POST["usuario"])==0){
		     if(strcmp($password, $_POST["password"])==0){
			     session_start();
				 $_SESSION["logueado"]=true;
				 $_SESSION["tipo"]=0;
				 $_SESSION["id"]=0;
			     header("Location: main.php");
		     }else{
			    header("Location: index.php?mensaje=1");
		     }
		  }else{
			require_once("CRM_Conexion.php");
			$ConexionCRM=new Conexion(1);
			$ConexionCRM->Open();
			$result=mysql_query("select id from tbl_Usuario where usuario='".base64_encode(base64_encode($_POST["usuario"]))."' and password='".base64_encode(base64_encode($_POST["password"]))."' limit 1",$ConexionCRM->cn); 

			if($row = mysql_fetch_assoc($result)){
				session_start();
				$_SESSION["logueado"]=true;
				$_SESSION["tipo"]=1;
				$_SESSION["id"]=$row["id"];
			    header("Location: main.php");
			}else{
				$result=mysql_query("select id from tbl_Usuario_Saldos where usuario='".base64_encode(base64_encode($_POST["usuario"]))."' and password='".base64_encode(base64_encode($_POST["password"]))."' limit 1",$ConexionCRM->cn); 
				if($row = mysql_fetch_assoc($result)){
					session_start();
					$_SESSION["logueado"]=true;
					$_SESSION["tipo"]=2;
					$_SESSION["id"]=$row["id"];
					header("Location: main.php");
				}else{
					header("Location: index.php?mensaje=0");
				}
			}
		  }
	  }
?>
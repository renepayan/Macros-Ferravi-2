<?php
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $auxid=$_POST["id"];
	  $Nombre=$_POST["usuario"];
	  $Password=$_POST["password"];
	  if(strcmp($Nombre,"")==0||strcmp($Password,"")==0){
	     $ConexionCRM->Close();
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Campo Nulo\");window.location=\"usuarios_saldos.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		  if($auxid!="0"){
			  $result=mysql_query("UPDATE tbl_Usuario_Saldos SET usuario='".base64_encode(base64_encode(addslashes($Nombre)))."', password='".base64_encode(base64_encode(addslashes($Password)))."' where id='$auxid'",$ConexionCRM->cn);
		  }else{
		      $result=mysql_query("select id from tbl_Usuario_Saldos order by id desc limit 1",$ConexionCRM->cn);
			  if($result){
			     $row = mysql_fetch_assoc($result);
			     $auxidd=$row["id"];
				 $auxidd++;
			  }else{
			     $auxidd=1;
			  }
			  $result=mysql_query("INSERT into tbl_Usuario_Saldos (id,usuario,password) values($auxidd,'".base64_encode(base64_encode(addslashes($Nombre)))."','".base64_encode(base64_encode(addslashes($Password)))."')",$ConexionCRM->cn);
		  }
		 $ConexionCRM->Close();
		 header("Location: usuarios_saldos.php?tipo=".$_GET["tipo"]);
	  }
?>
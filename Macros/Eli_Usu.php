<?php
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $auxid=$_POST["valor"];
	  mysql_query("delete from tbl_Usuario where id='$auxid'",$ConexionCRM->cn);
	  $ConexionCRM->Close();
	  header("Location: usuarios.php?tipo=".$_GET["tipo"]);
?>
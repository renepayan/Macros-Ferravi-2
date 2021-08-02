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
	  mysql_query("Delete from tbl_Campana_Campo where Id='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana_Campo_Registro where Id_Campana_Campo='$auxid'",$ConexionCRM->cn);
	  $ConexionCRM->Close();
	  header("Location: Per_Camp.php?tipo=".$_GET["tipo"]);
?>
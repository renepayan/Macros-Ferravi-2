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
	  mysql_query("Delete from tbl_Registro where Id='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana_Campo_Registro where Id_Registro='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Pago_Registro where Id_Registro='$auxid'",$ConexionCRM->cn);
	  $ConexionCRM->Close();
	  header("Location: Con_Reg.php?tipo=".$_GET["tipo"]);
?>
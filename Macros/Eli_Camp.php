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
	  mysql_query("Delete from tbl_Pago_Registro where Id_Registro IN (Select Id from tbl_Registro where Id_Campana='$auxid')",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana_Campo_Registro where Id_Registro IN (Select Id from tbl_Registro where Id_Campana='$auxid')",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Registro where Id_Campana='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana_Colores where Id_Campana='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana_Campo where Id_Campana='$auxid'",$ConexionCRM->cn);
	  mysql_query("Delete from tbl_Campana where Id='$auxid'",$ConexionCRM->cn);
	  $ConexionCRM->Close();
	  header("Location: Ges_Camp.php?tipo=".$_GET["tipo"]);
?>
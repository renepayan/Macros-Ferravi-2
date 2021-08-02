<?php
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  mysql_query("delete from tbl_Pago_Registro where fecha LIKE '%AJU%'",$ConexionCRM->cn);
      $ConexionCRM->Close();
	  header("Location: Imp_pag.php?tipo=".$_GET["tipo"]."&y=Se han borrado los pagos AJU");
?>
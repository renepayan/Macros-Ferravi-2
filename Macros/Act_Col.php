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
	  $Encabezado=$_POST["Encabezado"];
	  $Titulos=$_POST["Titulos"];
	  $Fondo=$_POST["Fondo"];
	  $Historicos=$_POST["Historicos"];
	  if(strcmp($Historicos,"")==0||strcmp($Fondo,"")==0||strcmp($Titulos,"")==0||strcmp($Encabezado,"")==0||strcmp($auxid,"")==0){
	     $ConexionCRM->Close();
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Campo Nulo\");window.location=\"Per_Camp.php\";}</script><body onload=\"func()\"></html>");
	  }else{
		  $result=mysql_query("UPDATE tbl_Campana_Colores SET Encabezado='".addslashes($Encabezado)."' where Id_campana='$auxid'",$ConexionCRM->cn);
		  $result=mysql_query("UPDATE tbl_Campana_Colores SET Historicos='".addslashes($Historicos)."' where Id_campana='$auxid'",$ConexionCRM->cn);
		  $result=mysql_query("UPDATE tbl_Campana_Colores SET Titulos='".addslashes($Titulos)."' where Id_campana='$auxid'",$ConexionCRM->cn);
		  $result=mysql_query("UPDATE tbl_Campana_Colores SET Fondo='".addslashes($Fondo)."' where Id_campana='$auxid'",$ConexionCRM->cn);
		  if(!$result){
			echo("<html><script type=\"text/javascript\">function func(){alert(\"Error Fatal\");window.location=\"Per_Camp.php\";}</script><body onload=\"func()\"></html>");
		  }else{
			 $ConexionCRM->Close();
		     header("Location: Per_Camp.php?tipo=".$_GET["tipo"]);
		  }
	  }
?>
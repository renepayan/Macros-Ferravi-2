<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if($_POST["valor_camp"]==null){
	     header("Location: index.php");
	  }	  
	  $result=mysql_query("select * from tbl_Campana where Id=".$_POST["valor_camp"],$ConexionCRM->cn);
	  $row = mysql_fetch_assoc($result);
	  $extencion = substr($_FILES["file"]["name"],$auxtam-3,3);
	  if(strcmp(strtolower($extencion),"jpg")!=0&&strcmp(strtolower($extencion),"gif")!=0&&strcmp(strtolower($extencion),"bmp")!=0&&strcmp(strtolower($extencion),"ico")&&strcmp(strtolower($extencion),"png")!=0){
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Extension incorrecta\");window.location=\"Per_Camp.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		 $nombre=$row["Nombre"].".".$extencion;
	     move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$nombre);
		 mysql_query("update tbl_Campana set FOTO='$nombre' where Id=".$_POST["valor_camp"]." limit 1",$ConexionCRM->cn);
		 header("Location: Per_Camp.php?tipo=".$_GET["tipo"]);
	  }
?>
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
	  $Nombre=$_POST["Nombre"];
	  if(strcmp($Nombre,"")==0){
	     $ConexionCRM->Close();
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Campo Nulo\");window.location=\"Ges_Camp.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		  if($auxid!="0"){
			  $result=mysql_query("UPDATE tbl_Campana SET nombre='".addslashes($Nombre)."' where id='$auxid'",$ConexionCRM->cn);
		  }else{
		      $result=mysql_query("select id from tbl_Campana order by id desc limit 1",$ConexionCRM->cn);
			  if($result){
			     $row = mysql_fetch_assoc($result);
			     $auxidd=$row["id"];
				 $auxidd++;
			  }else{
			     $auxidd=1;
			  }
			  $result=mysql_query("INSERT into tbl_Campana (id,nombre,id_usuario_saldo) values($auxidd,'".addslashes($Nombre)."','".$_SESSION["id"]."')",$ConexionCRM->cn);
		  }
			 $ConexionCRM->Close();
		     header("Location: Ges_Camp.php?tipo=".$_GET["tipo"]);
	  }
?>
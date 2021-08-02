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
	  $auxidc=$_POST["id_campana"];
	  $Nombre=$_POST["Nombre"];
	  $Visualizar=$_POST["Visualizar"];
	  if(strcmp($Nombre,"")==0){
	     $ConexionCRM->Close();
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Campo Nulo\");window.location=\"Per_Camp.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		  if($auxid!="0"){
			  $result=mysql_query("UPDATE tbl_Campana_Campo SET Nombre='".addslashes($Nombre)."' where Id='$auxid'",$ConexionCRM->cn);
			  $result=mysql_query("UPDATE tbl_Campana_Campo SET Visible='".addslashes($Visualizar)."' where Id='$auxid'",$ConexionCRM->cn);
		  }else{
		      $result=mysql_query("select Id from tbl_Campana_Campo order by Id desc limit 1",$ConexionCRM->cn);
			  if($result){
			     $row = mysql_fetch_assoc($result);
			     $auxidd=$row["Id"];
				 $auxidd++;
			  }else{
			     $auxidd=1;
			  }		      
			  $result=mysql_query("INSERT into tbl_Campana_Campo (Id,Id_Campana,Nombre,Visible) values($auxidd,'".addslashes($auxidc)."','".addslashes($Nombre)."','".addslashes($Visualizar)."')",$ConexionCRM->cn);
		  }
		  if(!$result){
			echo("<html><script type=\"text/javascript\">function func(){alert(\"Error o campo ya existente\");window.location=\"Per_Camp.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
		  }else{
                   if($auxid=="0"){
					  $result=mysql_query("select Id from tbl_Campana_Campo_Registro order by Id desc limit 1",$ConexionCRM->cn);
					  if($result){
						 $row = mysql_fetch_assoc($result);
						 $auxidd=$row["Id"];
						 $auxidd++;
					  }else{
						 $auxidd=1;
					  }					   
                      $result=mysql_query("Select tbl_Campana_Campo.Id from tbl_Campana_Campo where tbl_Campana_Campo.Id_Campana='".addslashes($auxidc)."' order by tbl_Campana_Campo.Id desc limit 1",$ConexionCRM->cn);
                      $row = mysql_fetch_assoc($result);
                      $result=mysql_query("Select tbl_Registro.Id from tbl_Registro where tbl_Registro.Id_Campana='".addslashes($auxidc)."'",$ConexionCRM->cn);
			 // echo("Select tbl_Registro.Id from tbl_Registro where tbl_Registro.Id_Campana='".addslashes($auxidc)."' <BR>");
			  while($fila=mysql_fetch_assoc($result)){
                          $ar=mysql_query("INSERT into tbl_Campana_Campo_Registro(Id,Id_Campana_Campo,Id_Registro) values($auxidd,'".$row["Id"]."','".$fila["Id"]."')",$ConexionCRM->cn);
			             // echo("INSERT into tbl_Campana_Campo_Registro(Id,Id_Campana_Campo,Id_Registro) values($auxidd,'".$row["Id"]."','".$fila["Id"]."')");
			     //echo("INSERT into tbl_Campana_Campo_Registro(Id_Campana_Campo,Id_Registro) values('".$row["Id"]."','".$fila["Id"]."')");
				       $auxidd++;
                       }
                   }
		     $ConexionCRM->Close();
		     header("Location: Per_Camp.php?tipo=".$_GET["tipo"]);
		  }
	  }
?>
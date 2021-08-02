<?php
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $resulti=mysql_query("select list_name from vicidial_lists",$ConexionCRM->cn);
	  $ConexionCRM->Close();
	  $ConexionCRM=new Conexion($_GET["tipo"]);
	  $ConexionCRM->Open();
	  $result=mysql_query("select Id from tbl_Campana Order By Id desc limit 1",$ConexionCRM->cn);
	  if($result){
		 $row = mysql_fetch_assoc($result);
		 $auxilid=$row["Id"];
		 $auxilid++;
	  }else{
		 $auxilid=1;
	  }
	  while($rowi=mysql_fetch_assoc($resulti)){
		  $Nombre=$rowi["list_name"];
		  $result=mysql_query("INSERT into tbl_Campana (Id,Nombre) values($auxilid,'$Nombre')",$ConexionCRM->cn);
		  echo("INSERT into tbl_Campana (Id,Nombre) values($auxilid,'$Nombre')<BR>");
		  if($result){ 
		     $resultii=mysql_query("select Id from tbl_Campana_Colores Order By Id desc limit 1",$ConexionCRM->cn);
			 if($resultii){
			    $roww = mysql_fetch_assoc($resultii);
				$auxid=$roww["Id"];
				$auxid++;
			 }else{
				$auxid=1;
			 }
			if($_GET["tipo"]==1){
				mysql_query("Insert into tbl_Campana_Colores (Id,Id_Campana,Fondo,Historicos,Encabezado,Titulos) Values($auxid,$auxilid,'#FCFCFC','#67C560','#295BB0','#628CD1')",$ConexionCRM->cn);
			}else{
				if($_GET["tipo"]==2){
					mysql_query("Insert into tbl_Campana_Colores (Id,Id_Campana,Fondo,Historicos,Encabezado,Titulos) Values($auxid,$auxilid,'#FCFCFC','#99CCCC','#2D3956','#2D3956')",$ConexionCRM->cn);
				}else{
					if($_GET["tipo"]==3){
						mysql_query("Insert into tbl_Campana_Colores (Id,Id_Campana,Fondo,Historicos,Encabezado,Titulos) Values($auxid,$auxilid,'#FCFCFC','#CC9900','#CC6601','#CC9900')",$ConexionCRM->cn);
					}else{
						if($_GET["tipo"]==4){
							mysql_query("Insert into tbl_Campana_Colores (Id,Id_Campana,Fondo,Historicos,Encabezado,Titulos) Values($auxid,$auxilid,'#FCFCFC','#A5CD9A','#33572D','#33572D')",$ConexionCRM->cn);
						}
					}
				}			
			}
			$auxilid++;
		  }
	  }
	  $ConexionCRM->Close();
	  header("Location: Ges_Camp.php?tipo=".$_GET["tipo"]);
?>
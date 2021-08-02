<?php
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  if(strcmp($_POST["idRegistro"],"")==0){
	     $ConexionCRM->Close();
	     echo("<h1>ERROR</h1>");
	  }else{ 
		     $resultii=mysql_query("select Id from tbl_Calificacion_Registro Order By Id desc limit 1",$ConexionCRM->cn);
			 if($resultii){
			    $roww = mysql_fetch_assoc($resultii);
				$auxid=$roww["Id"];
				$auxid++;
			 }else{
				$auxid=1;
			 }
			 $result=mysql_query("select * from tbl_Registro where Id=".$_POST["idRegistro"]." limit 1",$ConexionCRM->cn);
			// echo("select * from tbl_Registro where Id=".$_POST["idRegistro"]." limit 1<BR>");
			 $row = mysql_fetch_assoc($result);
			 $resulti=mysql_query("select * from tbl_Campana where Id=".$row["Id_Campana"]." limit 1",$ConexionCRM->cn);
			 $rowi = mysql_fetch_assoc($resulti);
			 if($_GET["tipo"]==1){
			 mysql_query("INSERT into tbl_Calificacion_Registro (Id,Campana,LLAVE,ESTATUS,EST_TEL,CUENTA,CELULAR,FOLIO,CICLO,Cve_Gestion,MNP,Comentario,Extra,Fecha) values($auxid,'".$rowi["Nombre"]."','".$row["LLAVE"]."','".$row["ESTATUS"]."','".$row["EST_TEL"]."','".$row["CUENTA"]."','".$row["CELULAR"]."','".$row["FOLIO"]."','".$row["CICLO"]."','".$_POST["Cve_Gestion"]."','".$_POST["MNP"]."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Comentario"]))."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Extra"]))."',Now())",$ConexionCRM->cn);
			}else{
				if($_GET["tipo"]==2){
					mysql_query("INSERT into tbl_Calificacion_Registro (Id,Campana,LLAVE,CUENTA,CELULAR,IVR,ASIG,Cve_Gestion,Comentario,Extra,Fecha) values($auxid,'".$rowi["Nombre"]."','".$row["LLAVE"]."','".$row["CUENTA"]."','".$row["CELULAR"]."','".$row["IVR"]."','".$row["ASIG"]."','".$_POST["Cve_Gestion"]."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Comentario"]))."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Extra"]))."',Now())",$ConexionCRM->cn);
				}else{
					if($_GET["tipo"]==3){
						mysql_query("INSERT into tbl_Calificacion_Registro (Id,Campana,LLAVE,CLIENTE,REFERENCIA,CONTRATO,Cve_Gestion,Comentario,Extra,Fecha) values($auxid,'".$rowi["Nombre"]."','".$row["LLAVE"]."','".$row["CLIENTE"]."','".$row["REFERENCIA"]."','".$row["CONTRATO"]."','".$_POST["Cve_Gestion"]."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Comentario"]))."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Extra"]))."',Now())",$ConexionCRM->cn);
					}else{
						if($_GET["tipo"]==4){
							mysql_query("INSERT into tbl_Calificacion_Registro (Id,Campana,LLAVE,Cuenta,Cve_Gestion,Comentario,Extra,Fecha) values($auxid,'".$rowi["Nombre"]."','".$row["LLAVE"]."','".$row["Cuenta"]."','".$_POST["Cve_Gestion"]."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Comentario"]))."','".addslashes(preg_replace ('["|,|\n|\r|\n\r]'," ",$_POST["Extra"]))."',Now())",$ConexionCRM->cn);
						}					
					}
				}
			}			
			$ConexionCRM->Close();
		     header("Location: consulta.php?tipo=".$_GET["tipo"]."&idRegistro=".$_POST["idRegistro"]);
	  }
?>
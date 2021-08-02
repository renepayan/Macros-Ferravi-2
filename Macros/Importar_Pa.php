<?php
	  set_time_limit(0);
	  error_reporting (E_ALL ^ E_NOTICE);
     // echo(date('l jS \of F Y h:i:s A - '));
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	//   mysql_query("optimize table tbl_calificacion_registro",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_campana",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_campana_campo",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_campana_campo_registro",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_campana_colores",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_pago_registro",$ConexionCRM->cn);
	//	mysql_query("optimize table tbl_registro",$ConexionCRM->cn);	  
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $handle = fopen("archivo.csv", "r");
	  $rescvs=fgetcsv($handle,5000000,',');
	  $resulti=mysql_query("select Id from tbl_Pago_Registro order by Id desc limit 1",$ConexionCRM->cn);
	  if($resulti){
		 $rowi = mysql_fetch_assoc($resulti);
		 $auxid=$rowi["Id"];
		 $auxid++;
	  }else{
		 $auxid=1;
	  } 
	  $auxcont=0;
	  $auxy=0;
	  $auxz=0;
	  while($rescvs=fgetcsv($handle,5000000,',')){
		if($_GET["tipo"]==1){
			$result=mysql_query("select Id from tbl_Registro where LLAVE='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["LLAVE"]]))."'",$ConexionCRM->cn);	 
			$namesaldoactual="saldoact";
		}else{
			if($_GET["tipo"]==2){
				$result=mysql_query("select Id from tbl_Registro where LLAVE='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["LLAVE"]]))."'",$ConexionCRM->cn);				
				$namesaldoactual="Saldoact";
			}else{
				if($_GET["tipo"]==3){
					$result=mysql_query("select Id from tbl_Registro where LLAVE='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["LLAVE"]]))."'",$ConexionCRM->cn);				
					$namesaldoactual="Saldoact";
				}else{
					if($_GET["tipo"]==4){
						$result=mysql_query("select Id from tbl_Registro where LLAVE='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["LLAVE"]]))."'",$ConexionCRM->cn);				
						$namesaldoactual="SALDO_ACTUAL";
					}				
				}
			}
		}
		$auxcont++;
		$ver=0;
		 while($row=mysql_fetch_assoc($result)){
		    if($ver==0){
			   $ver++;
			   $auxy++;
			}
		 mysql_query("insert into tbl_Pago_Registro (Id,Id_Registro,Pago,Fecha) values($auxid,".$row["Id"].",'".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["PAGO"]]))."','".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["FECHA"]]))."')",$ConexionCRM->cn);	 		 
         //echo("insert into tbl_Pago_Registro (Id,Id_Registro,Pago,Fecha) values($auxid,".$row["Id"].",'".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["PAGO"]]))."','".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["FECHA"]]))."')");
		// $resulti=mysql_query("select Id from tbl_Pago_Registro where Id=$auxid limit 1",$ConexionCRM->cn);	
	//	 if($resulti){
		    $auxid++;
			
			mysql_query("UPDATE tbl_Registro SET $namesaldoactual='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["SALDO"]]))."' where Id=".$row["Id"]." limit 1");
		// }
	  }}
	         // $fp = fopen("archivo.txt","a");
         // fwrite($fp, "Vicidial" . PHP_EOL);
	  $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
	  $ConexionCRM->Open();
	  $handle2 = fopen("archivo.csv", "r");
	  while($rescvs=fgetcsv($handle2,5000000,',')){
		 if(strcmp((string)$rescvs[$_POST["SALDO"]],"0.00")==0||strcmp((string)$rescvs[$_POST["SALDO"]],"0")==0){
			 $auxz++;
			 mysql_query("UPDATE vicidial_list SET vicidial_list.status='DNC',country_code='SG' where vendor_lead_code='".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST["LLAVE"]]))."'");
		 }
	  }
	   $ConexionCRM->Close();
         //echo(date('l jS \of F Y h:i:s A'));
	  header("Location: Imp_pag.php?tipo=".$_GET["tipo"]."&x=".$auxcont."&yy=".$auxy."&z=".$auxz);
?>
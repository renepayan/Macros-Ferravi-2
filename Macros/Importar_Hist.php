<?php
	  set_time_limit(0);
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php");
	  }
		if($_GET["tipo"]==1){
			$cad=array("LLAVE","ESTATUS","EST_TEL","CUENTA","CELULAR","FOLIO","CICLO","Cve_Gestion","MNP","Comentario","Extra","Fecha","Campana");
		}else{
			if($_GET["tipo"]==2){
				$cad=array("LLAVE","CUENTA","CELULAR","IVR","ASIG","Cve_Gestion","Comentario","Extra","Fecha","Campana");
			}else{
				if($_GET["tipo"]==3){
					$cad=array("LLAVE","CLIENTE","CONTRATO","REFERENCIA","Cve_Gestion","Comentario","Extra","Fecha","Campana");
				}else{
					if($_GET["tipo"]==4){
						$cad=array("LLAVE","Cuenta","Cve_Gestion","Comentario","Extra","Fecha","Campana");
					}				
				}
			}
		}
		$tamcad=count($cad);
	  $handle = fopen("archivo.csv", "r");
	  $rescvs=fgetcsv($handle,5000000,',');
	  $resulti=mysql_query("select Id from tbl_Calificacion_Registro order by Id desc limit 1",$ConexionCRM->cn);
	  if($resulti){
		 $rowi = mysql_fetch_assoc($resulti);
		 $auxid=$rowi["Id"];
		 $auxid++;
	  }else{
		 $auxid=1;
	  }
      $asquery="insert into tbl_Calificacion_Registro (";
	  $auxc=0;
	  while($auxc<$tamcad){
	     $asquery=$asquery.$cad[$auxc].",";
		 $auxc++;
	  }
	  $asquery=$asquery."Id) values(";
	  $auxcont=0;
	  while($rescvs=fgetcsv($handle,5000000,',')){
	     $auxcont++;
	     $squery=$asquery;
         $auxc=0;
		 while($auxc<$tamcad){
		    if($_POST[$cad[$auxc]]==null){
			   $squery=$squery."'',";
			}else{
		       $squery=$squery."'".addslashes(preg_replace ('["|,]',"",$rescvs[$_POST[$cad[$auxc]]]))."',";
			}
			$auxc++;
		 }
		 $squery=$squery."'$auxid')";
		 //echo ($squery);
		 mysql_query($squery,$ConexionCRM->cn);
		 $auxid++;
	  }
	  $ConexionCRM->Close();
	  header("Location: Imp_Hist.php?tipo=".$_GET["tipo"]."&x=".$auxcont);
?>
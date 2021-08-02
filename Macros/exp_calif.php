<?
    error_reporting (E_ALL ^ E_NOTICE);  
    set_time_limit(0);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if($_SESSION["query_cal"]==null&&$_POST["inicial"]==null&&$_POST["final"]==null){
	     header("Location: main.php");
	  }
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Exportacion_Historial_Calificacion.csv');	  
	if($_GET["tipo"]==1){
		$cad=array("Id","LLAVE","ESTATUS","EST_TEL","CUENTA","CELULAR","FOLIO","CICLO","Cve_Gestion","MNP","Comentario","Extra","Fecha","Campana");
	}else{
		if($_GET["tipo"]==2){
			$cad=array("Id","LLAVE","CUENTA","CELULAR","IVR","ASIG","Cve_Gestion","Comentario","Extra","Fecha","Campana");
		}else{
			if($_GET["tipo"]==3){
			    $cad=array("Id","LLAVE","CLIENTE","CONTRATO","REFERENCIA","Cve_Gestion","Comentario","Extra","Fecha","Campana");
			}else{
				if($_GET["tipo"]==4){
					$cad=array("Id","LLAVE","Cuenta","Cve_Gestion","Comentario","Extra","Fecha","Campana");
				}			
			}	
		}
	}
	if($_POST["inicial"]!=null&&$_POST["final"]!=null){
		if($_GET["tipo"]==1){
			$result=mysql_query("select Id,LLAVE,ESTATUS,EST_TEL,CUENTA,CELULAR,FOLIO,CICLO,Cve_Gestion,MNP,Comentario,Extra,Fecha,Campana from tbl_Calificacion_Registro where Fecha>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and Fecha<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and Campana='".$_POST["id_campana"]."'",$ConexionCRM->cn);
		}else{
			if($_GET["tipo"]==2){
				$result=mysql_query("select Id,LLAVE,CUENTA,CELULAR,IVR,ASIG,Cve_Gestion,Comentario,Extra,Fecha,Campana from tbl_Calificacion_Registro where Fecha>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and Fecha<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and Campana='".$_POST["id_campana"]."'",$ConexionCRM->cn);
			}else{
				if($_GET["tipo"]==3){
					$result=mysql_query("select Id,LLAVE,CLIENTE,CONTRATO,REFERENCIA,Cve_Gestion,Comentario,Extra,Fecha,Campana from tbl_Calificacion_Registro where Fecha>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and Fecha<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and Campana='".$_POST["id_campana"]."'",$ConexionCRM->cn);			
				}else{
					if($_GET["tipo"]==4){
						$result=mysql_query("select Id,LLAVE,Cuenta,Cve_Gestion,Comentario,Extra,Fecha,Campana from tbl_Calificacion_Registro where Fecha>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and Fecha<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and Campana='".$_POST["id_campana"]."'",$ConexionCRM->cn);
					}
				}		
			}
		}	
	}else{
	   $result=mysql_query($_SESSION["query_cal"],$ConexionCRM->cn);
	}
	$j=1;
	for($i=0;$i<(sizeof($cad)-1);$i++){
		echo("\"".$cad[$i]."\",");
	}
	echo($cad[(sizeof($cad)-1)]."\n");
	if($result){
		while($row = mysql_fetch_row($result)){
			$j++;
			for($i=0;$i<(sizeof($cad)-1);$i++){
				echo("\"".$row[$i]."\",");
			}
			echo("\"".$row[(sizeof($cad)-1)]."\"\n");			
		}
	}
?>
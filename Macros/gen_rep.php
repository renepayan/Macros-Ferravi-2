<?
    error_reporting (E_ALL ^ E_NOTICE);  
    set_time_limit(0);
    require_once("CRM_Conexion.php");
    $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
    $ConexionCRM->Open();
	session_start();
	if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	}
	if($_POST["inicial"]==null||$_POST["final"]==null){
	     header("Location: main.php");
	}
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename="Reporte_'.$_POST["inicial"].'_'.$_POST["final"].'.csv"');	
	if($_GET["tipo"]==1){
	    $cad=array("TELEFONO","FECHA CONTACTO","HORA","DURACION","STATUS","CODIGO GESTOR","ESTATUS","EST_TEL","CUENTA","CELULAR","FOLIO","CICLO","COD_GESTION","MNP","GESTION");
	}else{
	    if($_GET["tipo"]==2){
			$cad=array("TELEFONO","FECHA CONTACTO","HORA","DURACION","STATUS","CODIGO GESTOR","CUENTA","IVR","COD_GESTION","GESTION");
		}else{
			if($_GET["tipo"]==3){
				$cad=array("TELEFONO","FECHA CONTACTO","HORA","DURACION","STATUS","CODIGO GESTOR","NOCLIENTE","CONTRATO","COD_GESTION","GESTION");			
			}else{
				if($_GET["tipo"]==4){
					$cad=array("TELEFONO","FECHA CONTACTO","HORA","DURACION","STATUS","CODIGO GESTOR","Cuenta","COD_GESTION","GESTION");			
				}			
			}
		}
	}
	$result=mysql_query("select vicidial_log.phone_number,DATE(vicidial_log.call_date),TIME(vicidial_log.call_date),CONCAT('00:',TIME_FORMAT(SEC_TO_TIME(vicidial_log.length_in_sec),'%i:%s')),vicidial_log.status,vicidial_log.user,vicidial_log.call_date,TIME(ADDTIME(vicidial_log.call_date,SEC_TO_TIME(vicidial_log.length_in_sec+1800))),vicidial_list.vendor_lead_code, vicidial_lists.list_name,TIME(ADDTIME(vicidial_log.call_date,SEC_TO_TIME(-3600)))  from vicidial_log,vicidial_list,vicidial_lists where vicidial_log.call_date>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and vicidial_log.call_date<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and vicidial_log.lead_id=vicidial_list.lead_id and vicidial_list.source_id='".$_GET["tipo"]."' and vicidial_lists.list_id=vicidial_list.list_id",$ConexionCRM->cn);	
	//echo("select phone_number,DATE(call_date),TIME(call_date),TIME_FORMAT(SEC_TO_TIME(length_in_sec),'%i:%s'),status,user,call_date,TIME(ADDTIME(call_date,SEC_TO_TIME(length_in_sec+300))) from vicidial_log where call_date>STR_TO_DATE('".$_POST["inicial"]."', '%m/%d/%Y') and call_date<DATE_ADD(STR_TO_DATE('".$_POST["final"]."', '%m/%d/%Y'),INTERVAL 1 DAY) and lead_id IN(select lead_id from vicidial_list where source_id='".$_GET["tipo"]."')");
	$ConexionCRM->Close();
	$ConexionCRM=new Conexion($_GET["tipo"]);
	$ConexionCRM->Open();
	$j=1;
       //$archivo = fopen(str_replace("gen_rep.php", "", $_SERVER["SCRIPT_FILENAME"]).'Reporte_'.str_replace("/", "_", $_POST["fecha"]).'.csv', 'w');                 
	for($i=0;$i<count($cad);$i++){
          //fprintf($archivo,"\"%s\",",$cad[$i]);
          echo("\"$cad[$i]\",");
	}
       echo("\"".$cad[count($cad)]."\"\n");
	if($result){
		while($row = mysql_fetch_row($result)){
			for($i=0;$i<6;$i++){
                            echo("\"$row[$i]\",");
				//fprintf($archivo,"\"%s\",",$row[$i]);
			}	
                     if(strcmp($row[3],"00:00:00")!=0){
						if($_GET["tipo"]==1){
							$resulta=mysql_query("select ESTATUS,EST_TEL,CUENTA,CELULAR,FOLIO,CICLO,Cve_Gestion,MNP,Comentario from tbl_Calificacion_Registro where LLAVE='$row[8]' and DATE(Fecha)=DATE('$row[6]') and TIME(Fecha)<'$row[7]' and TIME(Fecha)>='$row[10]' order by Fecha DESC limit 1",$ConexionCRM->cn);
//							echo("select TCP,AREA,Cve_Gestion,Cve_Aclaracion,Comentario from tbl_Calificacion_Registro where LLAVE='$row[8]' and DATE(Fecha)=DATE('$row[6]') and TIME(Fecha)<'$row[7]' order by Fecha DESC  limit 1");
//break;
						}else{
						    if($_GET["tipo"]==2){
								$resulta=mysql_query("select CUENTA,IVR,Cve_Gestion,Comentario from tbl_Calificacion_Registro where LLAVE='$row[8]' and DATE(Fecha)=DATE('$row[6]') and TIME(Fecha)<'$row[7]' and TIME(Fecha)>='$row[10]' order by Fecha DESC  limit 1",$ConexionCRM->cn);
							}else{
								if($_GET["tipo"]==3){
									$resulta=mysql_query("select CLIENTE,CONTRATO,Cve_Gestion,Comentario from tbl_Calificacion_Registro where LLAVE='$row[8]' and DATE(Fecha)=DATE('$row[6]') and TIME(Fecha)<'$row[7]' and TIME(Fecha)>='$row[10]' order by Fecha DESC  limit 1",$ConexionCRM->cn);
								}else{
									if($_GET["tipo"]==4){
										$resulta=mysql_query("select Cuenta,Cve_Gestion,Comentario from tbl_Calificacion_Registro where LLAVE='$row[8]' and DATE(Fecha)=DATE('$row[6]') and TIME(Fecha)<'$row[7]' and TIME(Fecha)>='$row[10]' order by Fecha DESC limit 1",$ConexionCRM->cn);
									}
								}
							}
						}
			  if($resulta){
				if($rowi = mysql_fetch_row($resulta)){
				    for($i=0;$i<count($rowi);$i++){
                                      echo("\"$rowi[$i]\",");
					   //fprintf($archivo,"\"%s\",",$rowi[$i]);
				    }
                                echo("\"$rowi[$i]\"\n");
				    //fprintf($archivo,"\"%s\"\n",$rowi[4]);
                            }else{
                                echo("\n");
                                //fprintf($archivo,"\"\",\"\",\"\",\"\",\"\"\n");
                            }
			   }else{
                           echo("\n");
			      //fprintf($archivo,"\"\",\"\",\"\",\"\",\"\"\n");
			   }
 		    }else{
			if($_GET["tipo"]==1){
				$resulta=mysql_query("select ESTATUS,EST_TEL,CUENTA,CELULAR,FOLIO,CICLO from tbl_Registro where LLAVE='$row[8]' and Id_Campana In (select Id from tbl_Campana where nombre='$row[9]')limit 1",$ConexionCRM->cn);
			}else{
				if($_GET["tipo"]==2){
					$resulta=mysql_query("select CUENTA,IVR from tbl_Registro where LLAVE='$row[8]' limit 1",$ConexionCRM->cn);
				}else{
					if($_GET["tipo"]==3){
						$resulta=mysql_query("select CLIENTE,CONTRATO from tbl_Registro where LLAVE='$row[8]' limit 1",$ConexionCRM->cn);
					}else{
						if($_GET["tipo"]==4){
							$resulta=mysql_query("select Cuenta from tbl_Registro where LLAVE='$row[8]' limit 1",$ConexionCRM->cn);
						}					
					}
				}
			}
			  if($resulta){
				if($rowi = mysql_fetch_row($resulta)){
				    for($i=0;$i<count($rowi);$i++){
                                      echo("\"$rowi[$i]\",");
					   //fprintf($archivo,"\"%s\",",$rowi[$i]);
				    }
                                echo("\"$rowi[$i]\"\n");
				    //fprintf($archivo,"\"%s\"\n",$rowi[4]);
                            }else{
                                echo("\n");
                                //fprintf($archivo,"\"\",\"\",\"\",\"\",\"\"\n");
                            }
			  }else{
                           echo("\n");
			      //fprintf($archivo,"\"\",\"\",\"\",\"\",\"\"\n");
			}
                   //  echo("\n");
	              //fprintf($archivo,"\"\",\"\",\"\",\"\",\"\"\n");
		    }
		}
	}
	$ConexionCRM->Close();
?>
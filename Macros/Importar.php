<?php
function dohttp($url,$npost,$post,$curl){
	curl_setopt($curl, CURLOPT_URL,$url);
	curl_setopt($curl, CURLOPT_POST, $npost);
	curl_setopt($curl, CURLOPT_POSTFIELDS,$post);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);//seguimiento
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSLVERSION, 6);
	curl_setopt($curl, CURLOPT_COOKIEFILE, "c:/cookies/cookie.txt");
	curl_setopt($curl, CURLOPT_COOKIEJAR, "-");
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_VERBOSE, true);
	$respuesta = curl_exec ($curl);
	return $respuesta;
}
	set_time_limit(0);
    error_reporting (E_ALL ^ E_NOTICE);
    require_once("CRM_Conexion.php");
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    session_start();
    if($_SESSION["logueado"]!=true){
	   session_destroy();
	  header("Location: index.php");
    }
	$cad=null;
	$ncad=null;
	if(strcmp($_GET["tipo"],"Visita en Campo")==0){
		$cad=Array("Codigo de Solucion 1","Codigo de Solucion 2","Latitud","Longitud","Tarjeta Inteligente");
		$ncad=Array("selCodSol1","selCodSol2","latitud","longitud","tarjetai");
	}else{
		$cad=Array("Codigo de Solucion 1","Codigo de Solucion 2","Codigo de Solucion 3","Comentarios de Solucion","Equipos que reactivo");
		$ncad=Array("selCodSol1","selCodSol2","selCodSol3","selectcomm","txtEquipos");
	}
	$contcad=count($ncad);
	$contcierre=7+$contcad;
	$result=mysql_query("select usuario,password,date(now()) as 'fecha' from tbl_Usuario where id='".addslashes($_POST["id_usuario"])."'",$ConexionCRM->cn);
	$row = mysql_fetch_assoc($result);
	$usuario=base64_decode(base64_decode($row["usuario"]));
	$password=base64_decode(base64_decode($row["password"]));
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Cierre_'.$_GET["tipo"].'_'.$row["fecha"].'.csv');	
	echo('"Solicitud","Respuesta"');
	echo("\n");	
	$curl = curl_init();
	//INICIAR SESION
	dohttp("https://heat.sky.com.mx/recuperaciones/login.php",3,"txtUsuario=".$usuario."&txtContrasena=".$password."&btnAccesar=Accesar",$curl);
	
    $handle = fopen("archivo.csv", "r");
	$rescvs=fgetcsv($handle,5000000,',');
	$auxcont=0;
	$auxefect=0;
	
	while($rescvs=fgetcsv($handle,5000000,',')){
	    $auxcont++;     
		$solicitud=$rescvs[$_POST["solicitud"]];
		echo('"'.$solicitud.'"');
		$url=dohttp("https://heat.sky.com.mx/recuperaciones/solicitud.php",13,"selStatus=Abierta&txtSolicitud=".$solicitud."&txtCuenta=&selGestor&selSubtipo=&selTipoOrden=".$_GET["tipo"]."&selSubtipo=&dateInicio=&dateFin=&txtColonia=&txtMunicipio=&txtCP=&selPrioridad=&btnFiltro=Aplicar Filtro",$curl);
		$posurl=strpos($url,"solicitud_detalle.php?id=".$solicitud);
		if($posurl!==false){
			$auxefect++;
			$url=substr($url,$posurl);
			$posurl=strpos($url,'"');
			$url="https://heat.sky.com.mx/recuperaciones/".substr($url,0,$posurl);
			// echo $url."\n";
			// echo("Iniciando procesamiento de solicitud\n");
			dohttp($url,0,"",$curl);
			// echo("Procesamiento de solicitud Iniciada\n");
			$urlcierre="https://heat.sky.com.mx/recuperaciones/solicitud_cerrar.php";
			$cadenacierre="txtTipoSolicitud=".$tipo."&txtStatus=Abierta&txtDate=&txtTime=&btnCerrar=Cerrar Solicitud&hdnCodigo=&hdnCerrar=1";
			for($i=0;$i<$contcad;$i++){
				$cadenacierre=$cadenacierre."&".$ncad[$i]."=".$rescvs[$_POST[$ncad[$i]]];
			}
			// echo("Cerrando solicitud\n");
			$cadenares= dohttp($urlcierre,$contcierre,$cadenacierre,$curl);
			$poscadenares=strpos($cadenares,"\n");
			if($poscadenares!==false){
				$cadenares=substr($cadenares,$poscadenares+1);
				$poscadenares=strpos($cadenares,"<html");
				$cadenares=substr($cadenares,0,$poscadenares);
				$cadenares=str_replace("<br>"," ",$cadenares);
				$cadenares=preg_replace ("[\n|\r|\n\r]","",$cadenares);
				echo(',"'.$cadenares.'"');
				echo("\n");				
			}else{
				echo(',"Error al momento de cerrar"');
				echo("\n");
			}
			// echo("Solicitud Cerrada\n");
		}else{
			echo(',"La solicitud no existe o no esta abierta"');
			echo("\n");
		}
	}
	curl_close ($curl);		
	$ConexionCRM->Close();
?>
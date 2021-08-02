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
	curl_setopt($curl, CURLOPT_VERBOSE, false);
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
	$cad=Array("Cuenta");
	$ncad=Array("cuenta");
	$contcad=count($ncad);
	$resulti=mysql_query("select id from tbl_Registro order by id desc limit 1",$ConexionCRM->cn);
	if($resulti){
		$rowi = mysql_fetch_assoc($resulti);
		$auxid=$rowi["id"];
		$auxid++;
	}else{
		$auxid=1;
	}
	$auxidc=$auxid;
	$handle = fopen("archivo".$_POST["id_usuario"].".csv", "r");
	$rescvs=fgetcsv($handle,5000000,',');	
	while($rescvs=fgetcsv($handle,5000000,',')){
		 mysql_query("insert into tbl_Registro (id,id_campana,cuenta) values('$auxid',".$_GET["tipo"].",'".$rescvs[$_POST["cuenta"]]."')",$ConexionCRM->cn);
		 $auxid++;
	}
	$result=mysql_query("select usuario,password,date(now()) as 'fecha' from tbl_Usuario_Saldos where id='".addslashes($_POST["id_usuario"])."'",$ConexionCRM->cn);
	$row = mysql_fetch_assoc($result);
	$usuario=base64_decode(base64_decode($row["usuario"]));
	$password=base64_decode(base64_decode($row["password"]));
	// echo('"Cuenta","Estatus de cuenta","Estatus de recarga","Saldo total","Total de pagos","Zona","Recargas realizadas","Recargas faltantes","Tarjeta1","Equipo1","Estatus1","Tarjeta2","Equipo2","Estatus2","Tarjeta3","Equipo3","Estatus3","Tarjeta4","Equipo4","Estatus4"');
	// echo("\n");	
	$curl = curl_init();
	//INICIAR SESION
	$cadenainicio= dohttp("https://recsaldos.sky.com.mx/IniciarSesion.aspx",0,"",$curl);
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="');
	$VIEWSTATE="";
	if($pos!==false){
		$pos+=64;
		$VIEWSTATE=substr($cadenainicio,$pos);
		$pos=strpos($VIEWSTATE,'"');
		$VIEWSTATE=substr($VIEWSTATE,0,$pos);	
		$VIEWSTATE= str_replace("+", "%2B", $VIEWSTATE);
	}
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="');
	$VIEWSTATEGENERATOR="";
	if($pos!==false){	
		$pos+=82;	
		$VIEWSTATEGENERATOR=substr($cadenainicio,$pos);
		$pos=strpos($VIEWSTATEGENERATOR,'"');
		$VIEWSTATEGENERATOR=substr($VIEWSTATEGENERATOR,0,$pos);	
		$VIEWSTATEGENERATOR= str_replace("+", "%2B", $VIEWSTATEGENERATOR);
	}
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="');
	$EVENTVALIDATION="";
	if($pos!==false){
		$pos+=76;	
		$EVENTVALIDATION=substr($cadenainicio,$pos);
		$pos=strpos($EVENTVALIDATION,'"');
		$EVENTVALIDATION=substr($EVENTVALIDATION,0,$pos);		
		$EVENTVALIDATION= str_replace("+", "%2B", $EVENTVALIDATION);
	}
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="');
	$LASTFOCUS="";
	if($pos!==false){
		$pos+=64;	
		$LASTFOCUS=substr($cadenainicio,$pos);
		$pos=strpos($LASTFOCUS,'"');
		$LASTFOCUS=substr($LASTFOCUS,0,$pos);	
		$LASTFOCUS= str_replace("+", "%2B", $LASTFOCUS);		
	}	
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="');
	$EVENTTARGET="";
	if($pos!==false){
		$pos+=68;	
		$EVENTTARGET=substr($cadenainicio,$pos);
		$pos=strpos($EVENTTARGET,'"');
		$EVENTTARGET=substr($EVENTTARGET,0,$pos);	
		$EVENTTARGET= str_replace("+", "%2B", $EVENTTARGET);
	}		
	
	$pos=strpos($cadenainicio,'<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="');
	$EVENTARGUMENT="";
	if($pos!==false){
		$pos+=72;	
		$EVENTARGUMENT=substr($cadenainicio,$pos);
		$pos=strpos($EVENTARGUMENT,'"');
		$EVENTARGUMENT=substr($EVENTARGUMENT,0,$pos);		
		$EVENTARGUMENT= str_replace("+", "%2B", $EVENTARGUMENT);
	}		
	$cad="__LASTFOCUS=".$LASTFOCUS."&__EVENTARGUMENT=".$EVENTARGUMENT."&__EVENTTARGET=".$EVENTTARGET."&__VIEWSTATE=".$VIEWSTATE."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".$EVENTVALIDATION."&ctl00"."$"."ContentPlaceHolder1"."$"."TxtBUsuario=".$usuario."&ctl00"."$"."ContentPlaceHolder1"."$"."TxtBContrasena=".$password."&ctl00"."$"."ContentPlaceHolder1"."$"."BtnIniciarSesion=Iniciar Sesion";
	// echo($cad);
	$cadenainicio= dohttp("https://recsaldos.sky.com.mx/IniciarSesion.aspx",9,$cad,$curl);
	$cadenacentral= dohttp("https://recsaldos.sky.com.mx/Consulta.aspx",0,"",$curl);
    $handle = fopen("archivo".$_POST["id_usuario"].".csv", "r");
	$rescvs=fgetcsv($handle,5000000,',');	
	while($rescvs=fgetcsv($handle,5000000,',')){
		$cuenta=$rescvs[$_POST["cuenta"]];
	    $pos=strpos($cadenacentral,'<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="');
		$VIEWSTATE="";
		if($pos!==false){
			$pos+=64;
			$VIEWSTATE=substr($cadenacentral,$pos);
			$pos=strpos($VIEWSTATE,'"');
			$VIEWSTATE=substr($VIEWSTATE,0,$pos);	
			$VIEWSTATE= str_replace("+", "%2B", $VIEWSTATE);
		}
		
		$pos=strpos($cadenacentral,'<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="');
		$VIEWSTATEGENERATOR="";
		if($pos!==false){	
			$pos+=82;	
			$VIEWSTATEGENERATOR=substr($cadenacentral,$pos);
			$pos=strpos($VIEWSTATEGENERATOR,'"');
			$VIEWSTATEGENERATOR=substr($VIEWSTATEGENERATOR,0,$pos);	
			$VIEWSTATEGENERATOR= str_replace("+", "%2B", $VIEWSTATEGENERATOR);
		}
		
		$pos=strpos($cadenacentral,'<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="');
		$EVENTVALIDATION="";
		if($pos!==false){
			$pos+=76;	
			$EVENTVALIDATION=substr($cadenacentral,$pos);
			$pos=strpos($EVENTVALIDATION,'"');
			$EVENTVALIDATION=substr($EVENTVALIDATION,0,$pos);		
			$EVENTVALIDATION= str_replace("+", "%2B", $EVENTVALIDATION);
		}
		
		$pos=strpos($cadenacentral,'<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="');
		$LASTFOCUS="";
		if($pos!==false){
			$pos+=64;	
			$LASTFOCUS=substr($cadenacentral,$pos);
			$pos=strpos($LASTFOCUS,'"');
			$LASTFOCUS=substr($LASTFOCUS,0,$pos);	
			$LASTFOCUS= str_replace("+", "%2B", $LASTFOCUS);			
		}	
		
		$pos=strpos($cadenacentral,'<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="');
		$EVENTTARGET="";
		if($pos!==false){
			$pos+=68;	
			$EVENTTARGET=substr($cadenacentral,$pos);
			$pos=strpos($EVENTTARGET,'"');
			$EVENTTARGET=substr($EVENTTARGET,0,$pos);
			$EVENTTARGET= str_replace("+", "%2B", $EVENTTARGET);			
		}		
		
		$pos=strpos($cadenacentral,'<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="');
		$EVENTARGUMENT="";
		if($pos!==false){
			$pos+=72;	
			$EVENTARGUMENT=substr($cadenacentral,$pos);
			$pos=strpos($EVENTARGUMENT,'"');
			$EVENTARGUMENT=substr($EVENTARGUMENT,0,$pos);
			$EVENTARGUMENT= str_replace("+", "%2B", $EVENTARGUMENT);			
		}		
		$cad="__LASTFOCUS=".$LASTFOCUS."&__EVENTARGUMENT=".$EVENTARGUMENT."&__EVENTTARGET=".$EVENTTARGET."&__VIEWSTATE=".$VIEWSTATE."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".$EVENTVALIDATION."&ctl00"."$"."ContentPlaceHolder1"."$"."txt_cta=".$cuenta."&ctl00"."$"."ContentPlaceHolder1"."$"."cmd_consulta=Consultar";
		// echo($cad);
		$cadenacentral= dohttp("https://recsaldos.sky.com.mx/Consulta.aspx",8,$cad,$curl);
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvestatuscuenta"');
		$vtvestatuscuenta="";
		if($pos!==false){
			$pos+=76;	
			$vtvestatuscuenta=substr($cadenacentral,$pos);
			$pos=strpos($vtvestatuscuenta,'"');
			$vtvestatuscuenta=substr($vtvestatuscuenta,0,$pos);		
		}
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvestatusrecarga"');
		$vtvestatusrecarga="";
		if($pos!==false){
			$pos+=77;	
			$vtvestatusrecarga=substr($cadenacentral,$pos);
			$pos=strpos($vtvestatusrecarga,'"');
			$vtvestatusrecarga=substr($vtvestatusrecarga,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvsaldo"');
		$vtvsaldo="";
		if($pos!==false){
			$pos+=68;	
			$vtvsaldo=substr($cadenacentral,$pos);
			$pos=strpos($vtvsaldo,'"');
			$vtvsaldo=substr($vtvsaldo,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvtotalpagos"');
		$vtvtotalpagos="";
		if($pos!==false){
			$pos+=73;	
			$vtvtotalpagos=substr($cadenacentral,$pos);
			$pos=strpos($vtvtotalpagos,'"');
			$vtvtotalpagos=substr($vtvtotalpagos,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvzona"');
		$vtvzona="";
		if($pos!==false){
			$pos+=67;	
			$vtvzona=substr($cadenacentral,$pos);
			$pos=strpos($vtvzona,'"');
			$vtvzona=substr($vtvzona,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvrecargas"');
		$vtvrecargas="";
		if($pos!==false){
			$pos+=71;	
			$vtvrecargas=substr($cadenacentral,$pos);
			$pos=strpos($vtvrecargas,'"');
			$vtvrecargas=substr($vtvrecargas,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'vtvfaltantes"');
		$vtvfaltantes="";
		if($pos!==false){
			$pos+=72;	
			$vtvfaltantes=substr($cadenacentral,$pos);
			$pos=strpos($vtvfaltantes,'"');
			$vtvfaltantes=substr($vtvfaltantes,0,$pos);		
		}	

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'demstatcta"');
		$demstatcta="";
		if($pos!==false){
			$pos+=70;	
			$demstatcta=substr($cadenacentral,$pos);
			$pos=strpos($demstatcta,'"');
			$demstatcta=substr($demstatcta,0,$pos);		
		}
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_fechacan"');
		$txt_fechacan="";
		if($pos!==false){
			$pos+=72;	
			$txt_fechacan=substr($cadenacentral,$pos);
			$pos=strpos($txt_fechacan,'"');
			$txt_fechacan=substr($txt_fechacan,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_fechaact"');
		$txt_fechaact="";
		if($pos!==false){
			$pos+=72;	
			$txt_fechaact=substr($cadenacentral,$pos);
			$pos=strpos($txt_fechaact,'"');
			$txt_fechaact=substr($txt_fechaact,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtAplica"');
		$txtAplica="";
		if($pos!==false){
			$pos+=69;	
			$txtAplica=substr($cadenacentral,$pos);
			$pos=strpos($txtAplica,'"');
			$txtAplica=substr($txtAplica,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_fechablo"');
		$txt_fechablo="";
		if($pos!==false){
			$pos+=72;	
			$txt_fechablo=substr($cadenacentral,$pos);
			$pos=strpos($txt_fechablo,'"');
			$txt_fechablo=substr($txt_fechablo,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_sldototmcxfac"');
		$txt_sldototmcxfac="";
		if($pos!==false){
			$pos+=77;	
			$txt_sldototmcxfac=substr($cadenacentral,$pos);
			$pos=strpos($txt_sldototmcxfac,'"');
			$txt_sldototmcxfac=substr($txt_sldototmcxfac,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_porrsreac"');
		$txt_porrsreac="";
		if($pos!==false){
			$pos+=73;	
			$txt_porrsreac=substr($cadenacentral,$pos);
			$pos=strpos($txt_porrsreac,'"');
			$txt_porrsreac=substr($txt_porrsreac,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtapartir"');
		$txtapartir="";
		if($pos!==false){
			$pos+=70;	
			$txtapartir=substr($cadenacentral,$pos);
			$pos=strpos($txtapartir,'"');
			$txtapartir=substr($txtapartir,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_xfacal"');
		$txt_xfacal="";
		if($pos!==false){
			$pos+=70;	
			$txt_xfacal=substr($cadenacentral,$pos);
			$pos=strpos($txt_xfacal,'"');
			$txt_xfacal=substr($txt_xfacal,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_saldactmin"');
		$txt_saldactmin="";
		if($pos!==false){
			$pos+=74;	
			$txt_saldactmin=substr($cadenacentral,$pos);
			$pos=strpos($txt_saldactmin,'"');
			$txt_saldactmin=substr($txt_saldactmin,0,$pos);		
		}
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txt_ctastat"');
		$txt_ctastat="";
		if($pos!==false){
			$pos+=71;	
			$txt_ctastat=substr($cadenacentral,$pos);
			$pos=strpos($txt_ctastat,'"');
			$txt_ctastat=substr($txt_ctastat,0,$pos);		
		}		
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'demtotpag"');
		$demtotpag="";
		if($pos!==false){
			$pos+=69;	
			$demtotpag=substr($cadenacentral,$pos);
			$pos=strpos($demtotpag,'"');
			$demtotpag=substr($demtotpag,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'dempromo"');
		$dempromo="";
		if($pos!==false){
			$pos+=68;	
			$dempromo=substr($cadenacentral,$pos);
			$pos=strpos($dempromo,'"');
			$dempromo=substr($dempromo,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtRazon"');
		$txtRazon="";
		if($pos!==false){
			$pos+=68;	
			$txtRazon=substr($cadenacentral,$pos);
			$pos=strpos($txtRazon,'"');
			$txtRazon=substr($txtRazon,0,$pos);		
		}	

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'demrazon"');
		$demrazon="";
		if($pos!==false){
			$pos+=68;	
			$demrazon=substr($cadenacentral,$pos);
			$pos=strpos($demrazon,'"');
			$demrazon=substr($demrazon,0,$pos);		
		}		

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'demtxtapartir"');
		$demtxtapartir="";
		if($pos!==false){
			$pos+=73;	
			$demtxtapartir=substr($cadenacentral,$pos);
			$pos=strpos($demtxtapartir,'"');
			$demtxtapartir=substr($demtxtapartir,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtDiasActivos"');
		$txtDiasActivos="";
		if($pos!==false){
			$pos+=74;	
			$txtDiasActivos=substr($cadenacentral,$pos);
			$pos=strpos($txtDiasActivos,'"');
			$txtDiasActivos=substr($txtDiasActivos,0,$pos);		
		}

		$pos=strpos($cadenacentral,'<span id="ctl00_ContentPlaceHolder1_txttipo">');
		$txttipo="";
		if($pos!==false){
			$pos+=45;	
			$txttipo=substr($cadenacentral,$pos);
			$pos=strpos($txttipo,'<');
			$txttipo=substr($txttipo,0,$pos);		
		}	
		
		$pos=strpos($cadenacentral,'<span id="ctl00_ContentPlaceHolder1_lblerror"');
		$lblerror="";
		if($pos!==false){
			$pos+=76;	
			$lblerror=substr($cadenacentral,$pos);
			$pos=strpos($lblerror,'<');
			$lblerror=substr($lblerror,0,$pos);		
		}	

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtDiasInactivos"');
		$txtDiasInactivos="";
		if($pos!==false){
			$pos+=76;	
			$txtDiasInactivos=substr($cadenacentral,$pos);
			$pos=strpos($txtDiasInactivos,'"');
			$txtDiasInactivos=substr($txtDiasInactivos,0,$pos);		
		}	

		$pos=strpos($cadenacentral,'<input name="ctl00'.'$'.'ContentPlaceHolder1'.'$'.'txtplazoforzoso"');
		$txtplazoforzoso="";
		if($pos!==false){
			$pos+=75;	
			$txtplazoforzoso=substr($cadenacentral,$pos);
			$pos=strpos($txtplazoforzoso,'"');
			$txtplazoforzoso=substr($txtplazoforzoso,0,$pos);		
		}			
		
		$pos=strpos($cadenacentral,'<th scope="col">TARJETA</th><th scope="col">EQUIPO</th><th scope="col">ESTATUS</th>');
		$tes="";
		$tarjeta=Array("","","","");
		$equipo=Array("","","","");
		$status=Array("","","","");
		$iact=0;
		if($pos!==false){
			$pos+=83;	
			$tes=substr($cadenacentral,$pos);
			$pos=strpos($tes,'</table>');
			$tes=substr($tes,0,$pos);
			
			$pos=strpos($tes,'<td>');
			while($pos!==false&&$iact<4){
				$tes=substr($tes,$pos+4);
				$pos=strpos($tes,'</td>');
				$tarjeta[$iact]=substr($tes,0,$pos);
				
				$pos=strpos($tes,'<td>');	
				$tes=substr($tes,$pos+4);
				$pos=strpos($tes,'</td>');
				$equipo[$iact]=substr($tes,0,$pos);	
				
				$pos=strpos($tes,'<td>');	
				$tes=substr($tes,$pos+4);
				$pos=strpos($tes,'</td>');
				$status[$iact]=substr($tes,0,$pos);	
				
				$pos=strpos($tes,'<td>');	
				$iact++;
			}
			
		}
				
		
		$cadmysql="update tbl_Registro set ";
		$cadmysql.="estatus_cuenta='$vtvestatuscuenta".$demstatcta.$txt_ctastat."' ";
		$cadmysql.=",estatus_recarga='$vtvestatusrecarga' ";
		$cadmysql.=",saldo_total='$vtvsaldo' ";
		$cadmysql.=",total_pagos='$vtvtotalpagos".$demtotpag."' ";
		$cadmysql.=",zona='$vtvzona' ";
		$cadmysql.=",recargas_realizadas='$vtvrecargas' ";
		$cadmysql.=",recargas_faltantes='$vtvfaltantes' ";
		$cadmysql.=",aplica_promocion='$dempromo".$txtAplica."' ";
		$cadmysql.=",razon='$demrazon".$txtRazon."' ";
		$cadmysql.=",a_partir_de='$demtxtapartir".$txtapartir."' ";
		$cadmysql.=",dias_activos='$txtDiasActivos' ";
		$cadmysql.=",dias_inactivos='$txtDiasInactivos' ";
		$cadmysql.=",plazo_forzozo='$txtplazoforzoso' ";
		$cadmysql.=",fecha_cancelacion='$txt_fechacan' ";
		$cadmysql.=",fecha_bloqueo='$txt_fechablo' ";
		$cadmysql.=",saldo_actual_minimo='$txt_saldactmin' ";
		$cadmysql.=",prorrateo='$txt_porrsreac' ";
		$cadmysql.=",fecha_activacion='$txt_fechaact' ";
		$cadmysql.=",por_facturar_al='$txt_xfacal' ";
		$cadmysql.=",saldo_total_cargos='$txt_sldototmcxfac' ";
		$cadmysql.=",tipo='$txttipo".$lblerror."' ";
		for($ii=1;$ii<=4;$ii++){
			$cadmysql.=",tarjeta$ii='".$tarjeta[$ii]."' ";
			$cadmysql.=",equipo$ii='".$equipo[$ii]."' ";
			$cadmysql.=",estatus$ii='".$status[$ii]."' ";
		}
		$cadmysql.=" where id_campana='".$_GET["tipo"]."' and cuenta='$cuenta'";
		// echo($cadmysql);
		mysql_query($cadmysql,$ConexionCRM->cn);	
	}
	$cadenafin= dohttp("https://recsaldos.sky.com.mx/CerrarSesion.aspx",0,"",$curl);
	curl_close ($curl);		
	$ConexionCRM->Close();
	header("Location: main.php");
?>
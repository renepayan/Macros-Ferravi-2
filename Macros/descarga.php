<?
    error_reporting (E_ALL ^ E_NOTICE);  
    set_time_limit(0);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion(1);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
  	$result=mysql_query("select date(now()) as 'fecha'",$ConexionCRM->cn);
	$row = mysql_fetch_assoc($result);
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Saldos_'.$_GET["campana"].'_'.$row["fecha"].'.csv');
	$cad=array("Cuenta","Tipo","Estatus de cuenta","Estatus de recarga","Saldo total","Total de pagos","Zona","Recargas realizadas","Recargas faltantes","Tarjeta1","Equipo1","Estatus1","Tarjeta2","Equipo2","Estatus2","Tarjeta3","Equipo3","Estatus3","Tarjeta4","Equipo4","Estatus4","Aplica promocion","Razon","A partir de","Dias activos","Dias inactivos","Plazo Forzozo","Fecha de cancelacion","Fecha de bloqueo","Saldo Actual Minimo","Prorrateo si se reactiva","Fecha de activacion","Por facturar al","Saldo total mas cargos");
	$ncad=array("cuenta","tipo","estatus_cuenta","estatus_recarga","saldo_total","total_pagos","zona","recargas_realizadas","recargas_faltantes","tarjeta1","equipo1","estatus1","tarjeta2","equipo2","estatus2","tarjeta3","equipo3","estatus3","tarjeta4","equipo4","estatus4","aplica_promocion","razon","a_partir_de","dias_activos","dias_inactivos","plazo_forzozo","fecha_cancelacion","fecha_bloqueo","saldo_actual_minimo","prorrateo","fecha_activacion","por_facturar_al","saldo_total_cargos");
	$j=1;
	for($i=0;$i<(sizeof($cad));$i++){
	  echo("\"".$cad[$i]."\",");
	}
	echo("\n");
	$result=mysql_query("select * from tbl_Registro where id_campana='".addslashes($_GET["campana"])."'",$ConexionCRM->cn);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			$j++;
			for($i=0;$i<(sizeof($ncad));$i++){
			    echo("\"".$row[$ncad[$i]]."\",");
			}
			echo("\n");
		}
	}
?>
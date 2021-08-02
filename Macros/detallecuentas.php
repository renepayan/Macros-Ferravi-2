<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  date_default_timezone_set('America/Mexico_City');
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r")))); 
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $result=mysql_query("select distinct user from vicidial_log",$ConexionCRM->cn);
	  $tamausu=0;
	  while($rowini = mysql_fetch_assoc($result)){
	     $usuarios[$rowini["user"]]=0;
		 $nombres[$tamausu]=$rowini["user"];
		 $tamausu++;
	  }
	  if((int)$_POST["valor"]==1){
		 if((int)date("H")<=14){
			$fecha=date("Y-m-d",time()-86400);
			$Turno="Verpertinas";
			$Signo=">'14";
		 }else{
			$fecha=date("Y-m-d");
			$Turno="Matutinas";
			$Signo="<'15";
		 }
	  }else{
	     $fecha=date("Y-m-d");
		 if((int)date("H")<=14){
			$fecha=date("Y-m-d");
			$Turno="Matutinas";
			$Signo="<'15";
		 }else{
			$Turno="Verpertinas";
			$Signo=">'14";
		 }
	  } 
	  $ConexionCRM=new Conexion($_GET["tipo"]); 
	  $ConexionCRM->Open();
	  $cadenaq="select Telefono,time(fecha) from tbl_Calificacion_Registro where (Cve_Gestion=2 or Cve_Gestion=13) and date(fecha)='$fecha' and time(fecha)$Signo:00'";
	  $resulta=mysql_query($cadenaq,$ConexionCRM->cn);	 	
	  $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));  
	  $ConexionCRM->Open();	 
	  $Sa=0;
	  while($row = mysql_fetch_assoc($resulta)){
	     if($result=mysql_query("select user from vicidial_log where phone_number='".$row["Telefono"]."' and date(call_date)='$fecha' and time(call_date)<='".$row["time(fecha)"]."' and time(date_add(call_date,Interval length_in_sec+120 SECOND))>='".$row["time(fecha)"]."' limit 1",$ConexionCRM->cn)){
		    if($rowus = mysql_fetch_assoc($result)){
			   $usuarios[$rowus["user"]]++;
			}else{
			   $Sa++;
			}
		 }else{
		    $Sa++;
		 }
	  }
?>
<html>
<head> 
	<title>Detalle de Cuentas</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Promesas <?echo($Turno." ".$fecha);?></I></B></FONT></H2>
		<P align="center">
		<p align="center">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Lista</p></td>
					<th><p align="center">Promesas</p></td>
				</tr>
				<?$cont=0;
				while($cont<$tamausu){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p align="center"><?echo $nombres[$cont];?></p></td>
						<td><p align="center"><?echo $usuarios[$nombres[$cont]];?></p></td>
					</tr>
				<?$cont++;}?>
				<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
					<td><p align="center">Sin asignar</p></td>
					<td><p align="center"><?echo $Sa;?></p></td>
				</tr>				
			</table>
		</p>
		<P align="center"> <I> <?echo date("d/m/Y H:i:s");?></i></P>
		<a href="Cuentas.php?tipo=<?echo($_GET["tipo"]);?>"><p align="center">Cuentas</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  date_default_timezone_set('America/Mexico_City');
      require_once("CRM_Conexion.php"); 
	  session_start();
	  $_GET["tipo"]=addslashes($_GET["tipo"]);
	  $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
	  $ConexionCRM->Open();	  
	  $result=mysql_query("select distinct province from vicidial_list where province<>'' and source_id='2'",$ConexionCRM->cn);
  
?>
<html>
<head> 
	<title>Consulta de Contacto</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Resultado de la busqueda:</I></B></FONT></H2>
		<P align="center">
		<p align="center">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">IVR</p></td>
					<th><p align="center">Cuentas</p></td>
					<th><p align="center">Contacto</p></td>
					<th><p align="center">N/Contacto</p></td>
					<th><p align="center">PTO</p></td>
					<th><p align="center">S/Marcar</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><a href="DetalleContactoinbursa.php?list_id=<?echo $row["province"]?>"><p align="center"><?echo $row["province"];?></p></a></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=2 and province='".$row["province"]."'",$ConexionCRM->cn);$TOTAL=mysql_num_rows($res);echo $TOTAL;?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=2 and province='".$row["province"]."' and status='C'",$ConexionCRM->cn);$C=mysql_num_rows($res);if($TOTAL!=0){echo $C." ".number_format((($C*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=2 and province='".$row["province"]."' and status<>'C' and status<>'DNC' and status<>'NEW'",$ConexionCRM->cn);$NC=mysql_num_rows($res);if($TOTAL!=0){echo $NC." ".number_format((($NC*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=2 and province='".$row["province"]."' and status='DNC'",$ConexionCRM->cn);$PTO=mysql_num_rows($res);if($TOTAL!=0){echo $PTO." ".number_format((($PTO*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=2 and province='".$row["province"]."' and status='NEW'",$ConexionCRM->cn);$NEW=mysql_num_rows($res);if($TOTAL!=0){echo $NEW." ".number_format((($NEW*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
				</tr>
				<?$cont++;}?>
			</table>
		</p>
		 <P align="center"> <I> <?echo date("d/m/Y H:i:s");?></i></P>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
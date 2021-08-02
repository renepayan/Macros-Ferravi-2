<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  date_default_timezone_set('America/Mexico_City');
      require_once("CRM_Conexion.php"); 
	  session_start();
	  if($_GET["tipo"]!=null){
		  if($_GET["tipo"]==1){
			header("Location: Contactotelmex.php"); 
		  }else{
		  	if($_GET["tipo"]==2){
				header("Location: Contactoinbursa.php"); 
			}else{
		  	    $_GET["tipo"]=addslashes($_GET["tipo"]);
			    $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
			    $ConexionCRM->Open();	  
			    $result=mysql_query("select distinct vicidial_lists.list_id,vicidial_lists.list_name,vicidial_lists.campaign_id from vicidial_lists,vicidial_list where vicidial_list.list_id=vicidial_lists.list_id and vicidial_list.source_id=".$_GET["tipo"],$ConexionCRM->cn);
		    }
		  }
	  }	  
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
		<? if($_GET["tipo"]!=null){?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Resultado de la busqueda:</I></B></FONT></H2>
		<P align="center">
		<p align="center">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Lista</p></td>
					<th><p align="center">Cuentas</p></td>
					<th><p align="center">Contacto</p></td>
					<th><p align="center">N/Contacto</p></td>
					<th><p align="center">PTO</p></td>
					<th><p align="center">S/Marcar</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><a href="DetalleContacto.php?tipo=<?echo($_GET["tipo"]);?>&list_id=<?echo $row["list_id"]?>"><p align="center"><?echo $row["list_name"];?></p></a></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=".$_GET["tipo"]." and list_id=".$row["list_id"],$ConexionCRM->cn);$TOTAL=mysql_num_rows($res);echo $TOTAL;?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=".$_GET["tipo"]." and list_id=".$row["list_id"]." and status='C'",$ConexionCRM->cn);$C=mysql_num_rows($res);if($TOTAL!=0){echo $C." ".number_format((($C*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=".$_GET["tipo"]." and list_id=".$row["list_id"]." and status<>'C' and status<>'DNC' and status<>'NEW'",$ConexionCRM->cn);$NC=mysql_num_rows($res);if($TOTAL!=0){echo $NC." ".number_format((($NC*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=".$_GET["tipo"]." and list_id=".$row["list_id"]." and status='DNC'",$ConexionCRM->cn);$PTO=mysql_num_rows($res);if($TOTAL!=0){echo $PTO." ".number_format((($PTO*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where source_id=".$_GET["tipo"]." and list_id=".$row["list_id"]." and status='NEW'",$ConexionCRM->cn);$NEW=mysql_num_rows($res);if($TOTAL!=0){echo $NEW." ".number_format((($NEW*100)/$TOTAL),2)."%";}else{echo("-");}?></p></td>
				</tr>
				<?$cont++;}?>
			</table>
		</p>
		 <P align="center"> <I> <?echo date("d/m/Y H:i:s");?></i></P>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</P>
		<?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Contacto.php" align="center">
			<SELECT name="tipo">
			<?$file=fopen("Tipos", "r");
			$i=1;
			while (!feof($file)){
			   echo("<OPTION value=\"$i\">CRM ".preg_replace ("[\n|\r|\n\r]","",fgets($file))."</OPTION>");
			   $i++;
			}?>
			</SELECT>
			<input type="submit" value="Siguiente">
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</p>		
		<?}?>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
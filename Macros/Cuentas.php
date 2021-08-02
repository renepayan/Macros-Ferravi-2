<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  date_default_timezone_set('America/Mexico_City');
      require_once("CRM_Conexion.php");
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if($_GET["tipo"]!=null){
		  $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
		  $ConexionCRM->Open();	  
		  $result=mysql_query("select list_id,list_name,campaign_id from vicidial_lists",$ConexionCRM->cn);
	  }
?>
<html>
<head> 
	<title>Consulta de Cuentas</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	<?if($_GET["tipo"]!=null){?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Cuentas:</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" method="post" action="detallecuentas.php?tipo=<?echo($_GET["tipo"]);?>" align="center">
		<p align="center">
		    <input type="hidden" name="valor" value="">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Lista</p></td>
					<th><p align="center">Por marcar</p></td>
					<th><p align="center">Reciclados</p></td>
					<th><p align="center">Velocidad</p></td>
					<th><p align="center">Contestadas</p></td>
					<th><p align="center">Abandonadas</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p align="center"><?echo $row["list_name"];?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where list_id=".$row["list_id"]." and status='NEW'",$ConexionCRM->cn);echo mysql_num_rows($res);?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where list_id=".$row["list_id"]." and status='PU'",$ConexionCRM->cn);echo mysql_num_rows($res);?></p></td>
						<td><p align="center"><?$res=mysql_query("select auto_dial_level from vicidial_campaigns where campaign_id='".$row["campaign_id"]."' limit 1",$ConexionCRM->cn);$arows=mysql_fetch_assoc($res);echo $arows["auto_dial_level"];?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where list_id=".$row["list_id"]." and status='C'",$ConexionCRM->cn);echo mysql_num_rows($res);?></p></td>
						<td><p align="center"><?$res=mysql_query("select * from vicidial_list where list_id=".$row["list_id"]." and status='DROP'",$ConexionCRM->cn);echo mysql_num_rows($res);?></p></td>
					</tr>
				<?$cont++;}?>
			</table>
		</p>
		   <P align="center">
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Cambu(formulario,1)" value="Promesas <?
		     if((int)date("H")<=14){
			    echo("Vespertinas ".date("d/m/Y",time()-86400));
			 }else{
			    echo("Matutinas ".date("d/m/Y"));
			 }?>">
		   <input type="submit" name="boton2" onclick="Cambu(formulario,2)" value="Promesas <?
		     if((int)date("H")<=14){
			    echo("Matutinas ".date("d/m/Y"));
			 }else{
			    echo("Vespertinas ".date("d/m/Y"));
			 }?>">			 
		   </P>
		 <P align="center"> <I> <?echo date("d/m/Y H:i:s");?></i></P>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
		<?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Cuentas.php" align="center">
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
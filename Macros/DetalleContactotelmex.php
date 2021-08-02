<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  date_default_timezone_set('America/Mexico_City');
      require_once("CRM_Conexion.php");
	  session_start();
	  $_GET["list_id"]=addslashes($_GET["list_id"]);
	  $ConexionCRM=new Conexion(preg_replace ("[\n|\r|\n\r]","",fgets(fopen("vicidial", "r"))));
	  $ConexionCRM->Open();	  
?>
<html>
<head> 
	<title>Detalle de Contacto</title>
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
			<table cellspacing="1" cellpadding="1" border=1; >
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">TCP</p></td>
					<th><p align="center">Lista</p></td>
					<th><p align="center">Area</p></td>
					<th><p align="center">Casos</p></td>
					<th><p align="center">Contacto</p></td>
					<th><p align="center">%Contacto</p></td>
					<th><p align="center">N/Contacto</p></td>
					<th><p align="center">%N/Contacto</p></td>					
					<th><p align="center">PTO</p></td>					
					<th><p align="center">%PTO</p></td>		
					<th><p align="center">S/M</p></td>					
					<th><p align="center">%S/M</p></td>							
				</tr>
				<?$row = mysql_fetch_assoc($result);
				$auxnombre=$_GET["list_id"];
				$result=mysql_query("select distinct list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."'",$ConexionCRM->cn);
				$ROWS=mysql_num_rows($result);
				while($row = mysql_fetch_assoc($result)){
					$res=mysql_query("select distinct address3 from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					$ROWS=$ROWS+mysql_num_rows($res)+1;
				}
				$Gainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."'",$ConexionCRM->cn);
				$GTOTAL=mysql_num_rows($Gainfo);
				$Gainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and status='C'",$ConexionCRM->cn);
				$GC=mysql_num_rows($Gainfo);
				$Gainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and status<>'C' and status<>'DNC' and status<>'NEW'",$ConexionCRM->cn);
				$GNC=mysql_num_rows($Gainfo);
				$Gainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and status='DNC'",$ConexionCRM->cn);
				$GPTO=mysql_num_rows($Gainfo);
				$Gainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and status='NEW'",$ConexionCRM->cn);
				$GSM=mysql_num_rows($Gainfo);
				if($GTOTAL!=0){				
					$GPC=number_format((($GC*100)/$GTOTAL),2);
					$GPNC=number_format((($GNC*100)/$GTOTAL),2);
					$GPPTO=number_format((($GPTO*100)/$GTOTAL),2);
					$GPSM=number_format((($GSM*100)/$GTOTAL),2);		
				}		
				?>
				<tr style="background-color:#FFFFFF;"><td rowspan="<?echo $ROWS+1;?>"><p><?echo $auxnombre;?></p></td></tr>
				<?
				$result=mysql_query("select distinct list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."'",$ConexionCRM->cn);
				while($row = mysql_fetch_assoc($result)){
					$res=mysql_query("select distinct address3 from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					$Rres=mysql_num_rows($res);
					$resultname=mysql_query("select list_name from vicidial_lists where list_id=".$row["list_id"]." limit 1",$ConexionCRM->cn);
					$rowname=mysql_fetch_assoc($resultname);
					?><TR style="background-color:#FFFFFF;"><td rowspan="<?echo $Rres+1;?>"><p><?echo $rowname["list_name"];?></p></td></TR><?
					while($rowres = mysql_fetch_assoc($res)){?>
					   <TR style="background-color:#FFFFFF;">
					   <td><p align="center"><?echo $rowres["address3"];?></p></td>
					   <td><p align="center"><?
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and address3='".$rowres["address3"]."' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $TOTAL=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and address3='".$rowres["address3"]."' and status='C' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $C=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and address3='".$rowres["address3"]."' and status<>'C' and status<>'DNC' and status<>'NEW' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $NC=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and address3='".$rowres["address3"]."' and status='DNC' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $PTO=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and address3='".$rowres["address3"]."' and status='NEW' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $SM=mysql_num_rows($ainfo);					   
					   if($TOTAL!=0){
					      $PC=number_format((($C*100)/$TOTAL),2);
					      $PNC=number_format((($NC*100)/$TOTAL),2);
					      $PPTO=number_format((($PTO*100)/$TOTAL),2);
					      $PSM=number_format((($SM*100)/$TOTAL),2);
						  if($PC<$GPC){
						     $PC="style=\"color: red\">".$PC."%";
						  }else{
							 $PC=">".$PC."%";
						  }
						  if($PNC<$GPNC){
						     $PNC="style=\"color: red\">".$PNC."%";
						  }else{
						     $PNC=">".$PNC."%";
						  }
						  if($PPTO<$GPPTO){
						     $PPTO="style=\"color: red\">".$PPTO."%";
						  }else{
						     $PPTO=">".$PPTO."%";
						  }
						  if($PSM<$GPSM){
						     $PSM="style=\"color: red\">".$PSM."%";
						  }else{
						     $PSM=">".$PSM."%";
						  }
					   }else{
						  $PC=">-";
					      $PNC=">-";
					      $PPTO=">-";
					      $PSM=">-";
					   }
					   echo $TOTAL;
					   ?></p></td>
					   <td><p align="center"><?echo($C);?></p></td>
					   <td><p align="center"<?echo($PC);?></p></td>
					   <td><p align="center"><?echo($NC);?></p></td>
					   <td><p align="center"<?echo($PNC);?></p></td>
					   <td><p align="center"><?echo($PTO);?></p></td>
					   <td><p align="center"<?echo($PPTO);?></p></td>
					   <td><p align="center"><?echo($SM);?></p></td>
					   <td><p align="center"<?echo($PSM);?></p></td>					   
					   </TR>
					<?}?>
					<TR style="background-color:#FFFFFF;"><td colspan="2"><p align="center">TOTAL <?echo $row["address1"];?></p></td>
					   <td><p align="center"><?
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."'",$ConexionCRM->cn);
					   $TOTAL=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."' and status='C'",$ConexionCRM->cn);
					   $C=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."' and status<>'C' and status<>'DNC' and status<>'NEW'",$ConexionCRM->cn);
					   $NC=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."' and status='DNC'",$ConexionCRM->cn);
					   $PTO=mysql_num_rows($ainfo);
					   $ainfo=mysql_query("select list_id from vicidial_list where source_id='1' and address1='".$_GET["list_id"]."' and list_id='".$row["list_id"]."' and status='NEW'",$ConexionCRM->cn);
					   $SM=mysql_num_rows($ainfo);					   
					   if($TOTAL!=0){
					      $PC=number_format((($C*100)/$TOTAL),2);
					      $PNC=number_format((($NC*100)/$TOTAL),2);
					      $PPTO=number_format((($PTO*100)/$TOTAL),2);
					      $PSM=number_format((($SM*100)/$TOTAL),2);					   
						  if($PC<$GPC){
						     $PC="style=\"color: red\">".$PC."%";
						  }else{
							 $PC=">".$PC."%";
						  }
						  if($PNC<$GPNC){
						     $PNC="style=\"color: red\">".$PNC."%";
						  }else{
						     $PNC=">".$PNC."%";
						  }
						  if($PPTO<$GPPTO){
						     $PPTO="style=\"color: red\">".$PPTO."%";
						  }else{
						     $PPTO=">".$PPTO."%";
						  }
						  if($PSM<$GPSM){
						     $PSM="style=\"color: red\">".$PSM."%";
						  }else{
						     $PSM=">".$PSM."%";
						  }
					   }else{
						  $PC=">-";
					      $PNC=">-";
					      $PPTO=">-";
					      $PSM=">-";
					   }
					   echo $TOTAL;
					   ?></p></td>
					   <td><p align="center"><?echo($C);?></p></td>
					   <td><p align="center" <?echo($PC);?></p></td>
					   <td><p align="center"><?echo($NC);?></p></td>
					   <td><p align="center" <?echo($PNC);?></p></td>
					   <td><p align="center"><?echo($PTO);?></p></td>
					   <td><p align="center" <?echo($PPTO);?></p></td>
					   <td><p align="center"><?echo($SM);?></p></td>
					   <td><p align="center" <?echo($PSM);?></p></td>					   					
					</TR>
				<?}?>
				<TR style="background-color:#FFFFFF;"><td colspan="3"><p align="center">TOTAL <?echo $auxnombre;?></p></td>
				<?
				if($GTOTAL!=0){?>		
					<td><p align="center"><?echo($GTOTAL);?></p></td>
					<td><p align="center"><?echo($GC);?></p></td>
					<td><p align="center"><?echo($GPC."%");?></p></td>
					<td><p align="center"><?echo($GNC);?></p></td>
					<td><p align="center"><?echo($GPNC."%");?></p></td>
					<td><p align="center"><?echo($GPTO);?></p></td>
					<td><p align="center"><?echo($GPPTO."%");?></p></td>
					<td><p align="center"><?echo($GSM);?></p></td>
					<td><p align="center"><?echo($GPSM."%");?></p></td>							
				<?}else{?>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>
					<td><p align="center">-</p></td>					
				<?}				
				?></TR>
			</table>
		</p>
		<P align="center"> <I> <?echo date("d/m/Y H:i:s");?></i></P>
		<a href="Contacto.php"><p align="center">Regresar</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
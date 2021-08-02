<html>
<head> 
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" src="js/enviar.js"></script>
</head>
<body 

oncontextmenu="return false" 
ondragstart="return false" 

onselect="return false"
oncopy="return false" 
onbeforecopy="return false"
onmouseup="return false"

 onLoad="body_onLoad()" onKeyUp="return bloquear()" onKeyDown="return bloquear()">

<form name="frm" method="post" action="bin.php?tipo=<?echo($_GET["tipo"]);?>" style="margin:0px;">
<input type="hidden" name="idRegistro" value="<?php echo $_GET["idRegistro"]?>"> 
<input type="hidden" name="AGENTE" value=""> 
<table cellspacing=1 cellpadding=3 align=center  bgColor="#FFFFFF">
<?if($tbl_Campana["FOTO"]!=NULL){?>
<td colspan=2><img src="images/<?echo($tbl_Campana["FOTO"]);?>" width="652px" height="180px"></td>
<?}?>
<tr>
	<td height=40 colspan=2 class="Titulos" style="background-color:<?echo $tbl_Campana_Colores["Encabezado"];?>;">
		<table width=100% cellspacing=0 cellpadding=0>
		<tr>
			<td rowspan=2  width=100%>
			<table cellspacing=0 cellpadding=0 width="100%">
			<tr>				
				<td align="center">
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td style="color:#FFFFFF" align="center">Esta llamada proviene de:</td>						
					</tr><tr>
						<td valign=top align="center"><h2 style="padding:0px;margin-top:2px;margin-bottom:0px;"><?echo $tbl_Registro["TCP"];?></h2></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			</td>			
		</tr>
		</table>
	</td>
	

</tr><tr>
	<td width=400 nowrap class="Subtitulos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>;" >Datos personales del cliente</td>
	<td width=100 nowrap class="Subtitulos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>;">Historiales</td>
	
</tr><tr style="background-color:<?echo $tbl_Campana_Colores["Fondo"];?>;">
	<td height=270 class="tdTablas" valign="top">
		<table cellspacing=0 cellpadding=2>
		<tr>
			<td width="80" class="campo">T. Fact.</td>
			<td>
				<table cellspacing=0 cellpadding=0 >
				<tr>
					<td class="valorSimple" style="width:90px;"><?echo $tbl_Registro["TEL_FACT"];?></td>

					<td class="campoSimple"  style="width:40px;">T.Cont.</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["TEL_CONT"];?></td>
										<td class="campoSimple"  style="width:40px;">Gestor:</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["Ges"];?></td>
				</tr>
				</table>
			</td>
		</tr>
	
		<tr><td colspan=4 class="Separador"></td></tr>
	
		<tr>
			<td class="campo">Razon Social</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["RAZON_SOCIAL"];?></td>			
		</tr>
		<tr>
			<td class="campo">Nombre Comercial:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["NOMBRE_COMERCIAL"];?></td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
			<td class="campo">No. Marcado:</td>
			<td class="valor" colspan=3><?echo "Aqui va N.M";?></td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>				
		<tr>
			<td width="80" class="campo">Estado</td>
			<td>
				<table cellspacing=0 cellpadding=0 >
				<tr>
					<td class="valorSimple" style="width:90px;"><?echo $tbl_Registro["ESTADO"];?></td>

					<td class="campoSimple"  style="width:40px;">Meses Vencidos</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["Vencido"];?></td>
				</tr>
				</table>
			</td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
			<td class="campo">Referencia:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["REFERENCIA"];?></td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
			<td class="campo">Division:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["DIVISION"];?></td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
			<td class="campo">Agencia:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["AGENCIA"];?></td>
		</tr>			
			<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">Contrato:</td>
					<td width="195"><?echo $tbl_Registro["CONTRATO"];?></td>					
					<td class="campo">Cliente:</td>
					<td class="valorSimple"><?echo $tbl_Registro["CLIENTE"];?></td>					
				</tr>	
				<tr>
					<td class="campo">Producto:</td>
					<td class="valorSimple"><?echo $tbl_Registro["PRODUCTO"];?></td>			
					<td class="campo">Edicion:</td>
					<td class="valorSimple"><?echo $tbl_Registro["EDICION"];?></td>							
				</tr>			
				<tr>
					<td class="campo">Mensualidades:</td>
					<td class="valorSimple"><?echo "Aqui va mensualidades";?></td>			
					<td class="campo">No. Contratos:</td>
					<td class="valorSimple"><?echo "Aqui va NC";?></td>							
				</tr>					
				<tr>
				<tr>
					<td class="campo">Imp. Mensual:</td>
					<td class="valorSimple"><?echo $tbl_Registro["IMP_MENS"];?></td>			
					<td class="campo">Valor Cont.:</td>
					<td class="valorSimple"><?echo $tbl_Registro["VALOR_CONT"];?></td>							
				</tr>	
				<tr>				
					<td class="campo">Ultimo Pago:</td>
					<td class="valorSimple"><?echo $tbl_Registro["FEC_ULT_PAG"];?></td>									
				</tr>		
				</table>
			</td>
		</tr> 
		<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
		<tr>
			<td colspan="4" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC">
				<table cellspacing="0" cellpadding="2"  >
				<?while($tbl_Campana_Campo=mysql_fetch_assoc($result)){
					echo("<tr><td class=\"campo\">".$tbl_Campana_Campo["Nombre"]."</td>");
					$result1=mysql_query("select * from tbl_Campana_Campo_Registro where Id_Campana_Campo='".$tbl_Campana_Campo["Id"]."' and Id_Registro='".addslashes($_GET["idRegistro"])."' limit 1",$ConexionCRM->cn); 	
					$tbl_Campana_Campo_Registro=mysql_fetch_assoc($result1);
					echo("<td class=\"valor\" colspan=3>".$tbl_Campana_Campo_Registro["Valor"]."</td></tr>");
					}
				?>
				</table>
			</td>
		</tr>
		<tr><td colspan=4 class="Separador"></td></tr>
			
		<tr>
			<td class="campo">Dirección 1</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["Dir1"];?></td>
		</tr><tr>
			<td class="campo">Dirección 2</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["Dir2"];?></td>
		</tr><tr>
			<td class="campo">Dirección 3</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["Dir3"];?></td>
		</tr><tr>
			<td class="campo">Ciudad</td>
			<td>
				<table cellspacing=0 cellpadding=0>
				<tr>
					<td class="valorSimple" style="width:190px"><?echo $tbl_Registro["CIUDAD"];?></td>

					<td class="campoSimple" style="width:60px;">C.P.</td>
					<td class="valorSimple" style="width:80px"><?echo $tbl_Registro["CP"];?></td>
				</tr>
				</table>
		</tr>


		<tr><td colspan=4 class="Separador"></td></tr>
		
		<tr>
			<td class="campo">Saldo original</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDO"];?></td>
				
					<td width="76" class="campo">Descuento</td>
				
					<td width="100" class="valor" style="width:80px">$<?echo $tbl_Registro["Descuento"];?></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="campo">Saldo actual</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["Saldoact"];?></td>
				</tr>
				</table>
			</td>
		</tr>		
		</table>		
	
	</td>
	<td class="tdTablas"  valign="top" width=100 nowrap rowspan=3>
		<table cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td class="SubSubtitulo" style="background-color:<?echo $tbl_Campana_Colores["Historicos"];?>;">Historico de calificaciones</td>
		</tr>
		<tr>
			<td width=100%>
				<div style="height:240px;OVERFLOW: auto;border:1px solid #336699;">
				<table cellspacing=0 cellpadding=0 width=100%>
				<?	
				$_SESSION["query_cal"]="select * from tbl_Calificacion_Registro where tbl_Calificacion_Registro.LLAVE='".$tbl_Registro["LLAVE"]."' order by tbl_Calificacion_Registro.Id desc";		    				
			       $result=mysql_query($_SESSION["query_cal"],$ConexionCRM->cn); 				
				$auxiiii=0;
				while($tbl_calificacion_registro=mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($auxiiii%2==1){echo("#FFFFFF");}else{echo($tbl_Campana_Colores["Fondo"]);};?>;">
						<td style width=180 nowrap class="HistoricoSel">
						
							<b>Fecha:</b>&nbsp;<?echo $tbl_calificacion_registro["Fecha"]?><br>
							<b>Gestion:</b>
							<?echo $Ges[$tbl_calificacion_registro["Cve_Gestion"]];?> 
							<br><b>Nota:</b>&nbsp;
								<label style="cursor:pointer" title="Mostrar/Ocultar comentarios"><?echo $tbl_calificacion_registro["Comentario"];?></label>
							<HR>
						</td>
					</tr>
				<?$auxiiii++;}?>
					<tr><td align="center"><a href="exp_calif.php?Id_Campana=<?echo $_POST["valor"];?>&tipo=<?echo($_GET["tipo"]);?>">Exportar CSV</a></td></tr>
				</table>
				</div>
			</td>
		
		</tr>
		<tr>
			<td class="Separador"></td>
		</tr>
		<tr>
			<td class="SubSubtitulo" style="background-color:<?echo $tbl_Campana_Colores["Historicos"];?>;">Historico de pagos (0)</td>
		</tr>
		<tr>
			<td>

				<div style="height:130px;OVERFLOW: auto;border:1px solid #336699;">
				<table cellspacing=0 cellpadding=0 width=100%>
				<tr>			
					<td class="TituloSaldos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>">Fecha</td>
					<td class="TituloSaldos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>">Pago</td>
				</tr>
			    <?$result=mysql_query("select * from tbl_Pago_Registro where tbl_Pago_Registro.Id_Registro='".$tbl_Registro["Id"]."' order by tbl_Pago_Registro.Id desc",$ConexionCRM->cn);
				$auxiiii=0;
				while($tbl_Pago_registro=mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($auxiiii%2==1){echo("#FFFFFF");}else{echo($tbl_Campana_Colores["Fondo"]);}?>;">
						<td nowrap class="HistoricoSel"><?echo($tbl_Pago_registro["Fecha"]);?></td>
						<td nowrap class="HistoricoSel">$<?echo($tbl_Pago_registro["Pago"]);?></td>
					</tr>
				<?$auxiiii++;}?>
				</table>
				</div>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan=2 align="center"><br>
		<p><a href="Con_Reg.php?tipo=<?echo($_GET["tipo"]);?>">Regresar</a></p>
	</td>
</tr>
</table>
</form>
</body>
</html>
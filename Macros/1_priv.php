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
						<td style="color:#FFFFFF" align="center">Esta llamada proviene de: </td>						
					</tr><tr>
						<td valign=top align="center"><h2 style="padding:0px;margin-top:2px;margin-bottom:0px;"><?echo $tbl_Registro["CELULAR"];?></h2></td>
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
			<td width="80" class="campo">Telcel:</td>
			<td>
				<table cellspacing=0 cellpadding=0 >
				<tr>
					<td class="valorSimple" style="width:90px;"><?echo $tbl_Registro["CELULAR"];?></td>

					<td class="campoSimple"  style="width:40px;">Cuenta:</td>
					<td class="valorSimple"  style="width:110px;"><?echo $tbl_Registro["CUENTA"];?></td>
				</tr>
				</table>
			</td>
		</tr>
	
		<tr><td colspan=4 class="Separador"></td></tr>
	
		<tr>
			<td class="campo">Cliente</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["CLIENTE"];?></td>			
		</tr>
		<tr>
			<td class="campo">Estatus:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["ESTATUS"];?></td>
		</tr>
		<tr>
			<td class="campo">Tel. Con. :</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["TEL_CON"];?></td>
		</tr>
		<tr>
			<td class="campo">Extn:</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["EXTN"];?></td>
		</tr>		
		<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">Tel.Alt:</td>
					<td width="195"><?echo $tbl_Registro["TEL_ALT"];?></td>					
					<td class="campo">EST. TEL.:</td>
					<td class="valorSimple"><?echo $tbl_Registro["EST_TEL"];?></td>					
				</tr>	
				<tr>
					<td class="campo">Ciclo:</td>
					<td class="valorSimple"><?echo $tbl_Registro["CICLO"];?></td>			
					<td class="campo"></td>
					<td class="valorSimple"></td>							
				</tr>				
				</table>
			</td>
		</tr>  
		<tr>
			<td colspan="4" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC">
				<table cellspacing="0" cellpadding="2"  >
				<?while($tbl_Campana_Campo=mysql_fetch_assoc($result)){
					echo("<tr><td class=\"campo\">".$tbl_Campana_Campo["Nombre"]."</td>");
					$result1=mysql_query("select * from tbl_Campana_Campo_Registro where Id_Campana_Campo='".$tbl_Campana_Campo["Id"]."' and Id_Registro='".addslashes($_POST["valor"])."' limit 1",$ConexionCRM->cn); 	
					$tbl_Campana_Campo_Registro=mysql_fetch_assoc($result1);
					echo("<td class=\"valor\" colspan=3>".$tbl_Campana_Campo_Registro["Valor"]."</td></tr>");
					}
				?>
				</table>
			</td>
		</tr>		<tr><td colspan=4 class="Separador"></td></tr>
			
		<tr>
			<td class="campo">Dirección</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["DIRECCION"];?></td>
		</tr><tr>
			<td class="campo">Colonia</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["COLONIA"];?></td>
		</tr><tr>
			<td class="campo">Ciudad</td>
			<td class="valor" colspan=3><?echo $tbl_Registro["CIUDAD"];?></td>
		</tr><tr>
			<td class="campo">Estado</td>
			<td>
				<table cellspacing=0 cellpadding=0>
				<tr>
					<td class="valorSimple" style="width:190px"><?echo $tbl_Registro["ESTADO"];?></td>

					<td class="campoSimple" style="width:60px;">C.P.</td>
					<td class="valorSimple" style="width:80px"><?echo $tbl_Registro["CP"];?></td>
				</tr>
				</table>
		</tr>


		<tr><td colspan=4 class="Separador"></td></tr>
		
		<tr>
			<td class="campo">Saldo Total</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDO"];?></td>
				
					<td width="76" class="campo">Saldo Dia</td>
				
					<td width="100" class="valor" style="width:80px">$<?echo $tbl_Registro["SALDOD"];?></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="campo">Saldo 30</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDO30"];?></td>
				
					<td width="76" class="campo">Saldo 60</td>
				
					<td width="100" class="valor" style="width:80px">$<?echo $tbl_Registro["SALDO60"];?></td>
				</tr>
				</table>
			</td>
		</tr>	
		<tr>
			<td class="campo">Saldo 90</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDO90"];?></td>
				
					<td width="76" class="campo">Saldo 120</td>
				
					<td width="100" class="valor" style="width:80px">$<?echo $tbl_Registro["SALDO120"];?></td>
				</tr>
				</table>
			</td>
		</tr>		
		<tr>
			<td class="campo">Saldo +120</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDOMAS120"];?></td>
				
					<td width="76" class="campo">Saldo actual</td>
				
					<td width="100" class="valor" style="width:80px">$<?echo $tbl_Registro["saldoact"];?></td>
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
                            <b>MNP: </b><?echo $MNP[$tbl_calificacion_registro["MNP"]];?>
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
			    <?$result=mysql_query("select tbl_Pago_Registro.Fecha,tbl_Pago_Registro.Pago from tbl_Pago_Registro where tbl_Pago_Registro.Id_Registro=".$tbl_Registro["Id"]." order by tbl_Pago_Registro.Id desc",$ConexionCRM->cn);
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
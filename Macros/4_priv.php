<html>
<head> 
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" src="js/enviar.js"></script>
    <script src="js/jquery-1.8.3.js"></script>
    <script src="js/jquery-ui.js"></script>	
	<script type="text/javascript">
		function oculta(nombre){
			$("#"+nombre).delay(0).fadeOut("slow"); 
			$("#bo"+nombre).delay(0).fadeOut("slow"); 			
			$("#bm"+nombre).delay(620).fadeIn("slow"); 
		}		
		function muestra(nombre){
			$("#"+nombre).delay(0).fadeIn("slow"); 
			$("#bm"+nombre).delay(0).fadeOut("slow"); 
			$("#bo"+nombre).delay(620).fadeIn("slow"); 
		}		
	</script>
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
						<td valign=top align="center"><h2 style="padding:0px;margin-top:2px;margin-bottom:0px;"><?echo $tbl_Registro["CARTERA"];?></h2></td>
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
			<td colspan="4">
				<table cellspacing="0" id="P1" cellpadding="2" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC;display:none;">				 
				<tr>
					<td class="campo" colspan="2">consolidadado chrge off CHARAL lay3_TELEFONO:</td>
					<td width="195" colspan="2"><?echo $tbl_Registro["consolidadado_chrge_off_CHARAL_lay3_TELEFONO"];?></td>									
				</tr>	
				<tr>
					<td class="campo">NOMBRE REF:</td>
					<td class="valorSimple"><?echo $tbl_Registro["NOMBRE_REF"];?></td>				
				</tr>	
				<tr>
					<td class="campo">A.PATERNO REF:</td>
					<td class="valorSimple"><?echo $tbl_Registro["APATERNO_REF"];?></td>					
					<td class="campo">A.MATERNO REF:</td>
					<td class="valorSimple"><?echo $tbl_Registro["AMATERNO_REF"];?></td>				
				</tr>				
				<tr>
					<td class="campo">TELEFONO REF:</td>
					<td width="195"><?echo $tbl_Registro["TELEFONO_REF"];?></td>									
				</tr>		
				<tr>
					<td class="campo">NOMBRE REF2:</td>
					<td class="valorSimple"><?echo $tbl_Registro["NOMBRE_REF2"];?></td>				
				</tr>	
				<tr>
					<td class="campo">A.PATERNO REF2:</td>
					<td class="valorSimple"><?echo $tbl_Registro["APATERNO_REF2"];?></td>					
					<td class="campo">A.MATERNO REF2:</td>
					<td class="valorSimple"><?echo $tbl_Registro["AMATERNO_REF2"];?></td>				
				</tr>				
				<tr>
					<td class="campo">TELEFONO REF2:</td>
					<td width="195"><?echo $tbl_Registro["TELEFONO_REF2"];?></td>									
				</tr>			
				<tr>
					<td class="campo">NOMBRE REF3:</td>
					<td class="valorSimple"><?echo $tbl_Registro["NOMBRE_REF3"];?></td>				
				</tr>	
				<tr>
					<td class="campo">A.PATERNO REF3:</td>
					<td class="valorSimple"><?echo $tbl_Registro["APATERNO_REF3"];?></td>					
					<td class="campo">A.MATERNO REF3:</td>
					<td class="valorSimple"><?echo $tbl_Registro["AMATERNO_REF3"];?></td>				
				</tr>				
				<tr>
					<td class="campo">TELEFONO REF3:</td>
					<td width="195"><?echo $tbl_Registro["TELEFONO_REF3"];?></td>									
				</tr>					
				</table>
			</td>
		</tr>
 		<tr>
			<td colspan="4">
				<table cellspacing="0" id="P2" cellpadding="2" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC;display:none;">				 
				<tr>
					<td class="campo">CASTIGO:</td>
					<td width="195"><?echo $tbl_Registro["CASTIGO"];?></td>					
					<td class="campo">APERTURA:</td>
					<td class="valorSimple"><?echo $tbl_Registro["APERTURA"];?></td>					
				</tr>	
				<tr>
					<td class="campo">ULTIMA COMPRA:</td>
					<td class="valorSimple"><?echo $tbl_Registro["ULTIMA_COMPRA"];?></td>
					<td class="campo">ULTIMO RETIRO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["ULTIMO_RETIRO"];?></td>					
				</tr>	
				<tr>
					<td class="campo">LIMITE CREDITO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["LIMITE_CREDITO"];?></td>
					<td class="campo">SOBREGIRO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["SOBREGIRO"];?></td>					
				</tr>				
				<tr>
					<td class="campo">SALDO ANTERIOR:</td>
					<td width="195"><?echo $tbl_Registro["SALDO_ANTERIOR"];?></td>					
					<td class="campo">DIAS COBRANZA:</td>
					<td class="valorSimple"><?echo $tbl_Registro["DIAS_COBRANZA"];?></td>					
				</tr>	
				<tr>
					<td class="campo">OTRA CUENTA:</td>
					<td width="195" colspan="3"><?echo $tbl_Registro["TEL_OFICINA"];?></td>										
				</tr>				
				</table>
			</td>
		</tr> 			
		<tr>
		<td width="80" class="campo">CUENTA TRANSCODIFICADA:</td>
			<td>
				<table cellspacing=0 cellpadding=0 >
				<tr>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["CUENTA_TRANSCODIFICADA"];?></td>
					<td class="campoSimple"  style="width:40px;"> BUCKET:</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["BUCKET"];?></td>					
					<td class="campoSimple"  style="width:40px;">CUENTA:</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["Cuenta"];?></td>
				</tr>
				</table>
			</td>
		</tr>
	
		<tr><td colspan=4 class="Separador"></td></tr>
		<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">NOMBRE:</td>
					<td width="195"><?echo $tbl_Registro["NOMBRE"];?></td>					
					<td class="campo">RFC:</td>
					<td class="valorSimple"><?echo $tbl_Registro["RFC"];?></td>					
				</tr>	
				<tr>
					<td class="campo">TRABAJO:</td>
					<td class="valorSimple" colspan="3"><?echo $tbl_Registro["TRABAJO"];?></td>									
				</tr>			
				<tr>
					<td class="campo">N.EMPLEO:</td>
					<td class="valorSimple" colspan="3"><?echo $tbl_Registro["NOMBRE_EMPLEO"];?></td>							
				</tr>	
				<tr>
					<td class="campo">TEL OFICINA:</td>
					<td width="195"><?echo $tbl_Registro["TEL_OFICINA"];?></td>					
					<td class="campo">TEL CASA:</td>
					<td class="valorSimple"><?echo $tbl_Registro["TEL_CASA"];?></td>					
				</tr>	
				<tr>
					<td class="campo">CELULAR:</td>
					<td width="195"><?echo $tbl_Registro["TEL_OFICINA"];?></td>					
					<td class="campo">EMAIL:</td>
					<td class="valorSimple"><?echo $tbl_Registro["EMAIL"];?></td>					
				</tr>				
				</table>
			</td>
		</tr> 	
		<tr><td colspan=4 class="Separador"></td></tr>
		<tr>
		<td width="80" class="campo">TEL CASA:</td>
			<td>
				<table cellspacing=0 cellpadding=0 >
				<tr>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["TEL_CASA"];?></td>				
					<td class="campoSimple"  style="width:40px;"></td>
					<td class="valorSimple"  style="width:60px;"></td>					
					<td class="campoSimple"  style="width:40px;">CELULAR:</td>
					<td class="valorSimple"  style="width:60px;"><?echo $tbl_Registro["CELULAR"];?></td>						
				</tr>
				</table>
			</td>
		</tr>
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
		<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">CALLE:</td>
					<td width="195" colspan="3"><?echo $tbl_Registro["CALLE_Y_NUM"];?></td>									
				</tr>	
				<tr>
					<td class="campo">COLONIA:</td>
					<td class="valorSimple" colspan="3"><?echo $tbl_Registro["COLONIA"];?></td>							
				</tr>			
				<tr>
					<td class="campo">CIUDAD:</td>
					<td class="valorSimple"><?echo $tbl_Registro["CIUDAD"];?></td>			
					<td class="campo">CP:</td>
					<td class="valorSimple"><?echo $tbl_Registro["CP"];?></td>							
				</tr>						
				</table>
			</td>
		</tr> 		
				<tr><td colspan=4 class="Separador" style="border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC"></td></tr>
		<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">CALLE:</td>
					<td width="195" colspan="3"><?echo $tbl_Registro["CALLE"];?></td>									
				</tr>	
				<tr>
					<td class="campo">COLONIA2:</td>
					<td class="valorSimple" colspan="3"><?echo $tbl_Registro["COLONIA2"];?></td>							
				</tr>			
				<tr>
					<td class="campo">N.EXTERIOR:</td>
					<td class="valorSimple"><?echo $tbl_Registro["NOEXTERIOR"];?></td>					
					<td class="campo">N.INTERIOR:</td>
					<td class="valorSimple"><?echo $tbl_Registro["NOINTERIOR"];?></td>										
				</tr>
				<tr>
					<td class="campo">C.POSTAL:</td>
					<td class="valorSimple"><?echo $tbl_Registro["CPOSTAL"];?></td>													
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
		</tr>
<tr>
			<td colspan="4">
				<table cellspacing="0" cellpadding="2" >				 
				<tr>
					<td class="campo">EXTENSION:</td>
					<td class="valorSimple"><?echo $tbl_Registro["EXTENSION"];?></td>
					<td class="campo">DESCUENTO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["DESCUENTO"];?></td>					
				</tr>		
				<tr>
					<td class="campo">ULTIMO PAGO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["ULTIMO_PAGO"];?></td>
					<td class="campo">MONTO VENCIDO:</td>
					<td class="valorSimple"><?echo $tbl_Registro["MONTO_VENCIDO"];?></td>					
				</tr>				
				</table>
			 
			</td>
		</tr> 


		<tr><td colspan=4 class="Separador"></td></tr>
		
		<tr>
			<td class="campo">Saldo actual</td>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="valor" style="width:170px">$<?echo $tbl_Registro["SALDO_ACTUAL"];?></td>
				</tr>
				</table>
			</td>
		</tr>		
		</table>		
	
	</td>
	<td class="tdTablas"  valign="top" width=100 nowrap rowspan=3>
		<table cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td class="SubSubtitulo" style="background-color:<?echo $tbl_Campana_Colores["Historicos"];?>;">Datos ocultos</td>
		</tr>
		<tr>
			<td>
				<form name="oculto">
					<input type="button" id="bmP1" value="Mostrar Datos de facturaci&oacute;n" onclick="muestra('P1')">
					<input type="button" id="boP1" value="Ocultar Datos de facturaci&oacute;n" onclick="oculta('P1')" style="display:none;">
					<input type="button" id="bmP2" value="Mostrar Referencias Personales" onclick="muestra('P2')">
					<input type="button" id="boP2" value="Ocultar Referencias Personales" onclick="oculta('P2')" style="display:none;">
				</form>
			</td>
		</tr>		
		<tr>
			<td class="SubSubtitulo" style="background-color:<?echo $tbl_Campana_Colores["Historicos"];?>;">Historico de llamadas</td>
		</tr>
		<tr>
			<td width=100%>
				<div style="height:240px;OVERFLOW: auto;border:1px solid #336699;">
				<table cellspacing=0 cellpadding=0 width="100%">
				<?
			    $result=mysql_query("select * from tbl_Calificacion_Registro where tbl_Calificacion_Registro.LLAVE='".$tbl_Registro["LLAVE"]."' order by tbl_Calificacion_Registro.Id desc",$ConexionCRM->cn); 				
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
				</table>
				</div>
			</td>
		
		</tr>
		<tr>
			<td class="Separador"></td>
		</tr>
		<tr>
			<td class="SubSubtitulo" style="background-color:<?echo $tbl_Campana_Colores["Historicos"];?>;">Historico de pagos</td>
		</tr>
		<tr>
			<td>

				<div style="height:130px;OVERFLOW: auto;border:1px solid #336699;">
				<table cellspacing="2" cellpadding="10" width="100%">
				<tr>			
					<td class="TituloSaldos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>">Fecha</td>
					<td class="TituloSaldos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>">Pago</td>
				</tr>
			    <?$result=mysql_query("select * from tbl_Pago_Registro where tbl_Pago_Registro.Id_Registro='".$tbl_Registro["Id"]."' order by tbl_Pago_Registro.Id desc",$ConexionCRM->cn);
				$auxiiii=0;
				while($tbl_Pago_registro=mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($auxiiii%2==1){echo("#FFFFFF");}else{echo($tbl_Campana_Colores["Fondo"]);}?>;">
						<td nowrap class="HistoricoSel"><?echo($tbl_Pago_registro["Fecha"]);?> </td>
						<td nowrap class="HistoricoSel"> $<?echo($tbl_Pago_registro["Pago"]);?></td>
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
	<td class="Subtitulos" style="background-color:<?echo $tbl_Campana_Colores["Titulos"];?>;">Resultado de la llamada</td>	
</tr>	
<tr style="background-color:<?echo $tbl_Campana_Colores["Fondo"];?>">
	<td class="tdTablas">
		<table cellspacing=0 cellpadding=2>
		<tr valign="top">
			<td valign="top" align="right" style="background-color:<?echo $tbl_Campana_Colores["Fondo"];?> class="campoResult">Clave de gestión</td>
			<td valign="top">	
				<select name="Cve_Gestion" size=1>
								<option value="0" >&nbsp;Ninguno</option>
								<option value="1" >&nbsp;PL -  PAGO PARA LIQUIDAR</option>
								<option value="2" >&nbsp;PP -  PAGO PARCIAL</option>
								<option value="3" >&nbsp;CP -  CONVENIO DE PAGO</option>
								<option value="4" >&nbsp;CT -  CONTACTO CON TITULAR</option>
								<option value="5" >&nbsp;NP -  NEGATIVA DE PAGO</option>
								<option value="6" >&nbsp;IN -  INCUMPLIMIENTO</option>
								<option value="7" >&nbsp;FA -  FAMILIAR</option>
								<option value="8" >&nbsp;TR -  TRABAJO</option>
								<option value="9" >&nbsp;CO -  CONTACTO CON REFERENCIA</option>
								<option value="10" >&nbsp;GRAL -  LLAMADA GENERA</option>
								<option value="11" >&nbsp;LIQ -  CUENTA LIQUIDADA</option>
								<option value="12" >&nbsp;ILO -  ILOCALIZABLE</option>
								<option value="13" >&nbsp;OD -  OTRO DATO</option>
								<option value="14" >&nbsp;CC -  CONTACTO CON TERCERO</option>
								<option value="15" >&nbsp;CCT -  CONTACTO CON TITULAR SIN DEFINIR PAGO</option>
								<option value="16" >&nbsp;IRR -  IRRECUPERABLE</option>

				</select>

			</td>
		</tr><tr>
			<td  valign="top" class="campoResult" style="background-color:<?echo $tbl_Campana_Colores["Fondo"];?>">Comentario:</td>
			<td  valign="top"><textarea name="Comentario" style="width:345px;height:60px"></textarea></td>
		</tr><tr>
			<td  valign="top" class="campoResult" style="background-color:<?echo $tbl_Campana_Colores["Fondo"];?>">EXTRA:</td>
			<td  valign="top">
				<textarea name="Extra" style="width:345px;height:22px"></textarea>
			</td>
		</tr>		
		</table>	
	</td>	
</tr><tr>
	<td colspan=2 align="center"><br>
		<input type="submit" class="btnCalificar" value="Calificar llamada">
	</td>
</tr>
</table>
</form>
</body>
</html>
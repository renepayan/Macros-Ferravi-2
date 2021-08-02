<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  if($_GET["tipo"]!=null){
		  $ConexionCRM=new Conexion($_GET["tipo"]);
		  $ConexionCRM->Open();
		  $result=mysql_query("select * from tbl_Campana order by Id",$ConexionCRM->cn);
	  }
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $_SESSION["query"]="";
?>
<html>
<head> 
	<title>Exportar Registros</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	<?if($_GET["tipo"]!=null){?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Consulta y Exportacion de Registros</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" method="post" action="<?if($_POST["id_campana"]!=null){?>Con_Reg.php?tipo=<?echo($_GET["tipo"]);?>&OP=0<?}else{?>Exp_Reg.php?tipo=<?echo($_GET["tipo"]);?><?}?>" align="center">
		   Lista:
		   <?if($_POST["id_campana"]!=null){?><input type="hidden" name="id" value="<?echo $_POST["id_campana"];?>"><?}?>
			<select name="id_campana"  <?if($_POST["id_campana"]!=null){echo ("disabled");}?>>
			<?while($row = mysql_fetch_assoc($result)){?>
			   <option value="<?echo $row["Id"];?>" <?if($_POST["id_campana"]==$row["Id"]){echo ("selected");}?>><?echo $row["Nombre"];?></option>
			<?}?>
			</select>
			<BR>
			<?if($_POST["id_campana"]!=null){
				if($_GET["tipo"]==1){
					$cad=array("LLAVE","CELULAR","CUENTA","ESTATUS","CLIENTE","DIRECCION","COLONIA","CIUDAD","ESTADO","CP","TEL_CON","EXTN","TEL_ALT","TEL1","TEL2","TEL3","CAMPO1","EST_TEL","CICLO","FOLIO","SALDO","SALDOD","SALDO30","SALDO60","SALDO90","SALDO120","SALDOMAS120");
				}else{
					if($_GET["tipo"]==2){
						$cad=array("LLAVE","CLIENTE","CUENTA","CELULAR","TEL1","TEL2","TEL3","SALDO","DESCUENTO","SALDONUM","ASIG","REGION","REFERENCIA","ORD","IVR","HORA","EXTRA","RESULTADOH","RESULTADOH2","Contacto","RFC","REF_DIRECCION","DIR1","DIR2","DIR3","CP","CIUDAD","TELEF1","EXT1","TELEF2","EXT2","TELEF3","EXT3","TELEF4","EXT4","F_ADEUDO","AVAL","FIANZA","RECLAMACION","F_CARGA");
					}else{				
						if($_GET["tipo"]==3){
							$cad=array("LLAVE","TCP","COI","REFERENCIA","TEL1","TEL2","TEL3","Ges","CONTRATO","CLIENTE","SALDO","Descuento","SaldoNum","extra","resultadoh","ORD","IVR","PRODUCTO","EDICION","RAZON_SOCIAL","NOMBRE_COMERCIAL","ESTADO","Vencido","Dir1","Dir2","Dir3","CIUDAD","CP","DIVISION","AGENCIA","TEL_FACT","TEL_CONT","MA","FORMA_PAGO","IMP_MENS","VALOR_CONT","FEC_ULT_PAG");						
						}else{
							if($_GET["tipo"]==4){
								$cad=array("LLAVE","Cuenta","CUENTA_TRANSCODIFICADA","SALDO_ACTUAL","BUCKET","CORTE","CR_RATING","CASTIGO","APERTURA","ULTIMO_PAGO","ULTIMA_COMPRA","ULTIMO_RETIRO","LIMITE_CREDITO","SOBREGIRO","SALDO_ANTERIOR","MONTO_VENCIDO","DIAS_COBRANZA","OTRA_CUENTA","NOMBRE","RFC","CALLE_Y_NUM","COLONIA","CIUDAD","CP","TEL_CASA","TEL_OFICINA","CELULAR","EMAIL","TRABAJO","Agencia","Burs","NOMBRE_EMPLEO","CALLE","NOEXTERIOR","NOINTERIOR","COLONIA2","CPOSTAL","consolidadado_chrge_off_CHARAL_lay3_TELEFONO","EXTENSION","NOMBRE_REF","APATERNO_REF","AMATERNO_REF","TELEFONO_REF","NOMBRE_REF2","APATERNO_REF2","AMATERNO_REF2","TELEFONO_REF2","NOMBRE_REF3","APATERNO_REF3","AMATERNO_REF3","TELEFONO_REF3","AGENTE","NO_ASIGNACION","FECHA_ASIG","STATUS","BANCO","UDATE","TIPO","SUBTIPO","DESCUENTO","HONORARIO","Bucket_asig","CAMPO_EXTRA1","CAMPO_EXTRA2","CAMPO_EXTRA3");	
							}						
						}
					}
				}
				$kk=1;
			while($kk<=5){?>
		   Busqueda <?echo $kk;?>: <input type="text" name="query<?echo $kk;?>" size="50">
		   Buscar en:
		   <select name="Criterio<?echo $kk;?>";>
		        <?
				for($i=0;$i<count($cad);$i++){?>
				   <option value="<?echo($cad[$i]);?>"><?echo $cad[$i];?></option>
				<?}
				$result=mysql_query("select * from tbl_Campana_Campo where Id_campana='".addslashes($_POST["id_campana"])."'",$ConexionCRM->cn);
				while($row = mysql_fetch_assoc($result)){?>
				   <option value="<?echo($row["Id"]);?>"><?echo $row["Nombre"];?></option>
				<?}?>
		   </select><BR>
		   <?$kk++;}}?>
			<BR>
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Camb(formulario)" value="Siguiente">
		   <BR>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
		<?}else{?>
				<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Exp_Reg.php" align="center">
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
		</p>	
		<?}?>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  $_SESSION["query"]="";
	  if($_GET["tipo"]==1){
		$nombre="Administrativo";
	  }else{
	     if($_GET["tipo"]==2){
			$nombre="Extrajudicial";
		 }else{
			 if($_GET["tipo"]==3){
				$nombre="ADSA";
			 }else{
				 if($_GET["tipo"]==4){
					$nombre="INVEX";
				 }			 
			 }
		 }
	  }
?>
<html>
<head> 
	<title>Buscar Registros</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:640;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H3 align="center"><FONT COLOR="BLUE"><B><I>Buscar Registros <?echo($nombre);?></I></B></FONT></H2>
		<P align="center">
		<form name="formulario" method="post" action="Busca_Con_Reg.php?OP=1&tipo=<?echo($_GET["tipo"]);?>" target="Abajo" align="center">
			<?
				if($_GET["tipo"]==1){
		            $cad=array("LLAVE","CELULAR","CUENTA","ESTATUS","CLIENTE","DIRECCION","COLONIA","CIUDAD","ESTADO","CP","TEL_CON","EXTN","TEL_ALT","TEL1","TEL2","TEL3","CAMPO1","EST_TEL","CICLO","FOLIO","SALDO","SALDOD","SALDO30","SALDO60","SALDO90","SALDO120","SALDOMAS120");
				    $cad1=array(1,2,4,13,14,15);
					$cad2=array("Celular","Cuenta","Cliente","Telefono 1","Telefono 2","Telefono 3");
					$limite=2;
				}else{
					if($_GET["tipo"]==2){
						$cad=array("LLAVE","CLIENTE","CUENTA","CELULAR","TELEF1","TELEF2","TELEF3","SALDO","DESCUENTO","SALDONUM","ASIG","REGION","REFERENCIA","ORD","IVR","HORA","EXTRA","RESULTADOH","RESULTADOH2","Contacto","RFC","REF_DIRECCION","DIR1","DIR2","DIR3","CP","CIUDAD","TELEF1","EXT1","TELEF2","EXT2","TELEF3","EXT3","TELEF4","EXT4","F_ADEUDO","AVAL","FIANZA","RECLAMACION","F_CARGA");
					    $cad1=array(2,1,3,4,5,6);
						$cad2=array("Cuenta","Cliente","Celular","Telef1","Telef2","Telef3");
						$limite=2;
					}else{
						if($_GET["tipo"]==3){
							$cad=array("LLAVE","TCP","COI","REFERENCIA","TEL1","TEL2","TEL3","Ges","CONTRATO","CLIENTE","SALDO","Descuento","SaldoNum","extra","resultadoh","ORD","IVR","PRODUCTO","EDICION","RAZON_SOCIAL","NOMBRE_COMERCIAL","ESTADO","Vencido","Dir1","Dir2","Dir3","CIUDAD","CP","DIVISION","AGENCIA","TEL_FACT","TEL_CONT","MA","FORMA_PAGO","IMP_MENS","VALOR_CONT","FEC_ULT_PAG");
							$cad1=array(4,5,6,8,9,19,3);	
							$cad2=array("Telefono 1","Telefono 2","Telefono 3","Contrato","N&uacute;mero de Cliente","Nombre del Cliente","Referencia");
						    $limite=2;
						}else{
							if($_GET["tipo"]==4){
								$cad=array("LLAVE","Cuenta","CUENTA_TRANSCODIFICADA","SALDO_ACTUAL","BUCKET","CORTE","CR_RATING","CASTIGO","APERTURA","ULTIMO_PAGO","ULTIMA_COMPRA","ULTIMO_RETIRO","LIMITE_CREDITO","SOBREGIRO","SALDO_ANTERIOR","MONTO_VENCIDO","DIAS_COBRANZA","OTRA_CUENTA","NOMBRE","RFC","CALLE_Y_NUM","COLONIA","CIUDAD","CP","TEL_CASA","TEL_OFICINA","CELULAR","EMAIL","TRABAJO","Agencia","Burs","NOMBRE_EMPLEO","CALLE","NOEXTERIOR","NOINTERIOR","COLONIA2","CPOSTAL","consolidadado_chrge_off_CHARAL_lay3_TELEFONO","EXTENSION","NOMBRE_REF","APATERNO_REF","AMATERNO_REF","TELEFONO_REF","NOMBRE_REF2","APATERNO_REF2","AMATERNO_REF2","TELEFONO_REF2","NOMBRE_REF3","APATERNO_REF3","AMATERNO_REF3","TELEFONO_REF3","AGENTE","NO_ASIGNACION","FECHA_ASIG","STATUS","BANCO","UDATE","TIPO","SUBTIPO","DESCUENTO","HONORARIO","Bucket_asig","CAMPO_EXTRA1","CAMPO_EXTRA2","CAMPO_EXTRA3");
								$cad1=array(1);
								$cad2=array("Cuenta");
								$limite=2;
							}						
						}
					}
				}
				$kk=1;
			while($kk<=$limite){?>
		   Busqueda <?echo $kk;?>: <input type="text" name="query<?echo $kk;?>" size="50">
		   Buscar en:
		   <select name="Criterio<?echo $kk;?>";>
		        <?
				for($i=0;$i<count($cad1);$i++){?>
				   <option value="<?echo($cad[$cad1[$i]]);?>"><?echo $cad2[$i];?></option>
				<?}?>
		   </select><BR>
		   <?$kk++;}?>
			<BR>
		   <input type="submit" name="boton" value="Buscar">
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?
    error_reporting (E_ALL ^ E_NOTICE);  
    set_time_limit(0);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Exportacion_Registros.csv');	 
	if($_GET["tipo"]==1){
		$cad=array("Id","LLAVE","CELULAR","CUENTA","ESTATUS","CLIENTE","DIRECCION","COLONIA","CIUDAD","ESTADO","CP","TEL_CON","EXTN","TEL_ALT","TEL1","TEL2","TEL3","CAMPO1","EST_TEL","CICLO","FOLIO","SALDO","SALDOD","SALDO30","SALDO60","SALDO90","SALDO120","SALDOMAS120");
	}else{
		if($_GET["tipo"]==2){
			$cad=array("Id","LLAVE","CLIENTE","CUENTA","CELULAR","TEL1","TEL2","TEL3","SALDO","DESCUENTO","SALDONUM","ASIG","REGION","REFERENCIA","ORD","IVR","HORA","EXTRA","RESULTADOH","RESULTADOH2","Contacto","RFC","REF_DIRECCION","DIR1","DIR2","DIR3","CP","CIUDAD","TELEF1","EXT1","TELEF2","EXT2","TELEF3","EXT3","TELEF4","EXT4","F_ADEUDO","AVAL","FIANZA","RECLAMACION","F_CARGA");
		}else{
			if($_GET["tipo"]==3){
				$cad=array("Id","LLAVE","TCP","COI","REFERENCIA","TEL1","TEL2","TEL3","Ges","CONTRATO","CLIENTE","SALDO","Descuento","SaldoNum","extra","resultadoh","ORD","IVR","PRODUCTO","EDICION","RAZON_SOCIAL","NOMBRE_COMERCIAL","ESTADO","Vencido","Dir1","Dir2","Dir3","CIUDAD","CP","DIVISION","AGENCIA","TEL_FACT","TEL_CONT","MA","FORMA_PAGO","IMP_MENS","VALOR_CONT","FEC_ULT_PAG");
			}else{
				if($_GET["tipo"]==4){
					$cad=array("Id","LLAVE","Cuenta","CUENTA_TRANSCODIFICADA","SALDO_ACTUAL","BUCKET","CORTE","CR_RATING","CASTIGO","APERTURA","ULTIMO_PAGO","ULTIMA_COMPRA","ULTIMO_RETIRO","LIMITE_CREDITO","SOBREGIRO","SALDO_ANTERIOR","MONTO_VENCIDO","DIAS_COBRANZA","OTRA_CUENTA","NOMBRE","RFC","CALLE_Y_NUM","COLONIA","CIUDAD","CP","TEL_CASA","TEL_OFICINA","CELULAR","EMAIL","TRABAJO","Agencia","Burs","NOMBRE_EMPLEO","CALLE","NOEXTERIOR","NOINTERIOR","COLONIA2","CPOSTAL","consolidadado_chrge_off_CHARAL_lay3_TELEFONO","EXTENSION","NOMBRE_REF","APATERNO_REF","AMATERNO_REF","TELEFONO_REF","NOMBRE_REF2","APATERNO_REF2","AMATERNO_REF2","TELEFONO_REF2","NOMBRE_REF3","APATERNO_REF3","AMATERNO_REF3","TELEFONO_REF3","AGENTE","NO_ASIGNACION","FECHA_ASIG","STATUS","BANCO","UDATE","TIPO","SUBTIPO","DESCUENTO","HONORARIO","Bucket_asig","CAMPO_EXTRA1","CAMPO_EXTRA2","CAMPO_EXTRA3");
				}			
			}
		}
	}	
   $result=mysql_query("select * from tbl_Campana_Campo where Id_campana='".addslashes($_SESSION["idcampanaexp"])."'",$ConexionCRM->cn);
	$j=1;
	for($i=0;$i<(sizeof($cad));$i++){
	  echo("\"".$cad[$i]."\",");
	}
	echo("\"Tipo\"");
	$auxiliar=0;
	while($row = mysql_fetch_assoc($result)){
	   echo(",\"".$row["Nombre"]."\"");
	   $ids[$auxiliar]=$row["Id"];
	   $auxiliar++;
	}
	echo("\n");
	$result=mysql_query($_SESSION["query"],$ConexionCRM->cn);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			$j++;
			for($i=0;$i<(sizeof($cad));$i++){
			    echo("\"".$row[$cad[$i]]."\",");
			}
			echo("\"".$_GET["tipo"]."\"");
			for($i=0;$i<$auxiliar;$i++){
			    $result1=mysql_query("select * from tbl_Campana_Campo_Registro where Id_Campana_Campo=$ids[$i] and Id_Registro='".$row["Id"]."' limit 1",$ConexionCRM->cn);
				$arow = mysql_fetch_assoc($result1);
				echo(",\"".$arow["Valor"]."\"");
			}
			echo("\n");
		}
	}
?>
<?php	
	function dohttp($url,$npost,$post,$curl){
		curl_setopt($curl, CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_POST, $npost);
		curl_setopt($curl, CURLOPT_POSTFIELDS,$post);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);//seguimiento
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, 6);
		curl_setopt($curl, CURLOPT_COOKIEFILE, "c:/cookies/cookie.txt");
		curl_setopt($curl, CURLOPT_COOKIEJAR, "-");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		$respuesta = curl_exec ($curl);
		return $respuesta;
	}
	$texts = array('<td<td colspan="3"><input type="text" name="txtTitular" value="',
	'<td<td colspan="3"><input type="text" name="txtEmail" value="',
	'<td><input type="text" name="txtCuenta" value="',
	'<td><input type="text" name="txtContrato" value="',
	'<td><input type="text" name="txtTelCasa" value="',
	'<td><input type="text" name="txtTelCasaArea" value="',
	'<td><input type="text" name="txtTelTrabajo" value="',
	'<td><input type="text" name="txtTelTrabajoArea" value="',
	'<td><input type="text" name="txtTelTrabajoExt" value="',
	'<td><input type="text" name="txtTelOtro" value="',
	'<td><input type="text" name="txtTelOtroArea" value="',
	'<td><input type="text" name="txtTelOtroExt" value="',
	'<td colspan="3"><input type="text" name="txtTipoCliente" value="',
	'<td colspan="3"><input type="text" name="txtSubtipoCliente" value="',
	'<td colspan="3"><input type="text" name="txtTipoCuenta" value="',
	'<td><input type="text" name="txtPaquete" value="',
	'<td><input type="text" name="txtTipoPago" value="',
	'<td colspan="3"><input type="text" name="txtStatusCuenta" value="',
	'<td><input type="text" name="txtClienteDesde" value="',
	'<td><input type="text" name="txtClienteHasta" value="',
	'<td colspan="3"><input type="text" name="txtStatusLegal" value="',	
	'<td><input type="text" name="txtIRD" value="');
	set_time_limit(0);
    error_reporting (0);
    require_once("CRM_Conexion.php");
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    session_start();
    if($_SESSION["logueado"]!=true){
	   session_destroy();
	  header("Location: index.php");
    }
	$result=mysql_query("select usuario,password,date(now()) as 'fecha' from tbl_Usuario where id='".addslashes($_POST["id_usuario"])."'",$ConexionCRM->cn);
	$row = mysql_fetch_assoc($result);
	$usuario=base64_decode(base64_decode($row["usuario"]));
	$password=base64_decode(base64_decode($row["password"]));
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Informacion_Clientes_Solicitudes.csv');	
	echo('"Solicitud","Titular","Email","Cuenta","Contrato","Telefono casa","Extension","Telefono trabajo","Area","Extension","Telefono otro","Area","Extension","Tipo Cliente","Subtipo Cliente","Tipo de cuenta","Paquete","Tipo Pago","Estatus Cuenta","Cte. Desde","Cte. Hasta","Estatus Legal","IRD otorgado"');
	echo("\r\n");	
	$curl = curl_init();
	//INICIAR SESION
	dohttp("https://heat.sky.com.mx/recuperaciones/login.php",3,"txtUsuario=".$usuario."&txtContrasena=".$password."&btnAccesar=Accesar",$curl);
	$fecha = date_create();
	$file_name_xd = "archivo".date_timestamp_get($fecha).".csv";
	move_uploaded_file($_FILES["file"]["tmp_name"],$file_name_xd);
    $handle = fopen($file_name_xd, "r");
	
	$rescvs=fgetcsv($handle,5000000,',');
	$auxcont=0;
	$auxefect=0;
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
	while($rescvs=fgetcsv($handle,5000000,',')){
	    $auxcont++;     
		$solicitud=$rescvs[0];
		echo('"'.$solicitud.'",');
		$url=dohttp("https://heat.sky.com.mx/recuperaciones/solicitud_detalle.php?id=$solicitud&hs=102387438&cid=81193449",true,null,$curl);				
		//echo($url);
		for($i = 0; $i<sizeof($texts);$i++){
			echo('"');
			$index = strpos($url,$texts[$i])+strlen($texts[$i]);		
			while($url[$index]!='"'){
				echo($url[$index]);
				$index++;
			}			
			echo('"');
			if($i!=sizeof($texts)-1){
				echo(",");
			}
		}
		echo("\r\n");
	}
	curl_close ($curl);		
	$ConexionCRM->Close();
?>
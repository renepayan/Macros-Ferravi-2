<?php
    session_start();
    if($_SESSION["logueado"]!=true){
	session_destroy();
        header("Location: index.php");         
    }
        require_once("CRM_Conexion.php");
    $ConexionCRM = new Conexion(1);
    $ConexionCRM->Open();
    include 'conexion.php';
    $usuario = mysql_real_escape_string($_POST["cual"]);
    $query = "SELECT * FROM tbl_Usuario_Ferravi WHERE id = $usuario";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $contra = $row["Password"];
    $curl = curl_init();
    dohttp("https://www.sclpcj.com.mx:7071/SCLWeb/login", true, "j_username=" . $row["Usuario"] . "&j_password=" . $contra, $curl);
    $query = "SELECT * FROM tbl_Lugar_Ferravi";
    $result = mysql_query($query);
    $salida = "CLIENTE UNICO|NOMBRE DEL CLIENTE|CUADRANTE|ZONA GEO|RFC DEL CLIENTE|DIRECCION DOMICILIO CLIENTE|# EXTERIOR CLIENTE|# INTERIOR CLIENTE|CP CLIENTE|COLONIA CLIENTE|POBLACION CLIENTE|ESTADO CLIENTE|CLASIFICACION DEL CLIENTE|ATRASO MAXIMO|SALDO|MORATORIOS|SALDO TOTAL|DIA DE PAGO|FECHA ULTIMO PAGO|IMPORTE ULTIMO PAGO|DIRECCION EMPLEO CLIENTE|# EXTERIOR EMPLEO CLIENTE|# INTERIOR EMPLEO CLIENTE|COLONIA EMPLEO CLIENTE|POBLACION CLIENTE|ESTADO EMPLEO CLIENTE|NOMBRE DEL AVAL|TELEFONO DEL AVAL|DIRECCION DEL AVAL|# EXTERIOR DEL AVAL|# COLONIA DEL AVAL|CP DEL AVAL|POBLACION DEL AVAL|ESTADO DEL AVAL|D�A DE PAGO|TEL�FONO 1|TIPO TEL�FONO|TEL�FONO 2|TIPO TEL�FONO|TEL�FONO 3|TIPO TEL�FONO|TEL�FONO 4|TIPO TEL�FONO|GERENCIA|REGIONAL|RESPONSABLE" . "\r\n";
    while ($row = mysql_fetch_assoc($result)) {
        $url = "https://www.sclpcj.com.mx:7071/SCLWeb/reportes/consultaClientesPorClasificacion.do?submitter=descargarCSV&idClasificacion=16&idRegional=" . $row['id'];
        $texto = dohttp($url, false, "", $curl);
        $linea = 1;
        $algo = array();
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $texto);
        rewind($stream);
        while (($data = fgetcsv($stream, 1000, "|")) !== FALSE) {
            $num = count($data);
            if ($linea > 1) {
                for ($c = 0; $c < $num; $c++) {
                    if ($c < ($num - 1)) {
                        $salida .= ($data[$c] . "|");
                    } else {
                        $salida .= ($data[$c] . "|" . $row["Nombre"] . "|" . $row["Responsable"] . "\r\n");
                    }
                }
            }
            $linea++;
        }
        fclose($stream);
    }
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="todo.csv";');
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Expires: 0");
    ob_end_clean();
    echo $salida;
    curl_close($curl);
?>


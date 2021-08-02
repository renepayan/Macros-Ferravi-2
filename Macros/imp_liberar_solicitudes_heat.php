<?php
    require_once("CRM_Conexion.php");
    session_start();
    if($_SESSION["logueado"]!=true){
        session_destroy();
	header("Location: index.php"); 
    }
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    if(!empty($_POST["algo"])){        
        $query = "SELECT * FROM tbl_Usuario WHERE id = ".mysql_real_escape_string($_POST["usuario"]);
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $usuario = base64_decode(base64_decode($row["usuario"]));
        $password = base64_decode(base64_decode($row["password"]));
        include ('conexion.php');
        $curl = curl_init();
        dohttp("https://heat.sky.com.mx/recuperaciones/login.php", true, "txtUsuario=" . $usuario . "&txtContrasena=" . $password. "&btnAccesar=Accesar", $curl);
        //LEER ARCHIVO
        $last = null;
        $extencion = substr($_FILES["archivo"]["name"],$auxtam-3,3);
        if(strcmp(strtolower($extencion),"csv")!=0){
	     header('Location: liberar_solicitudes_heat.php?error=1');
             die();
	  }else{
            move_uploaded_file($_FILES["archivo"]["tmp_name"],"archivo_tmp.csv");
            $postParameters = "hdnAgrega=1&hdnLimpiar=0&hdnProcesar=0&btnAgregar=Agregar&txtSS=";
            $handle = fopen("archivo_tmp.csv", "r");
            $linea = 1;
            while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                $num = count($data);
                if($linea>1){
                    $postParameters = "hdnAgrega=1&hdnLimpiar=0&hdnProcesar=0&btnAgregar=Agregar&txtSS=".$data[0];
                    dohttp("https://heat.sky.com.mx/recuperaciones/captura_sistema.php", true, $postParameters, $curl);
                }
                $linea++;
            }
            $handle = fclose($handle);
        }
        $postParameters = "txtSS=&txtIRD=&hdnAgrega=0&hdnLimpiar=0&hdnProcesar=0&btnProcesar=Liberar+Registros";
        $response = dohttp("https://heat.sky.com.mx/recuperaciones/captura_sistema.php", true, $postParameters, $curl);
        curl_close($curl);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="respuesta.csv";');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Expires: 0");
        $salida = "Solicitud,IRD,Comentario";
        $toFind = '<td align"left" width="';        
        $extra = '100">';
        $pos = -1;
        $cuanto = 1;
        while (($pos = strpos($response, $toFind, $pos+1)) !== false) {
            if($cuanto==1){
                $salida.="\r\n";
            }
            $posicion = $pos+strlen($toFind)+ strlen($extra);
            for($i = $posicion;$response[$i]!="<";$i++){
                $salida.=$response[$i];
            }
            if($cuanto==3){
                $cuanto = 1;
            }else{
                $cuanto++;
                $salida.=",";
            }
        }
        $cual = 0;
        ob_end_clean();
        echo $salida;
    }

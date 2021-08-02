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
        $salida = "IRD,Mensaje"."\r\n";
        $extencion = substr($_FILES["archivo"]["name"],$auxtam-3,3);
        if(strcmp(strtolower($extencion),"csv")!=0){
	     header('Location: liberar_solicitudes_heat.php?error=1');
             die();
	  }else{
            move_uploaded_file($_FILES["archivo"]["tmp_name"],"archivo_tmp1.csv");
            $handle = fopen("archivo_tmp1.csv", "r");
            $linea = 1;
            $algo = false;
            while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                $num = count($data);
                if($linea>1){
                    $postParameters = "btnAgregar=Agregar&hdnCaptura=1&hdnAgrega=0&hdnLimpiar=0%txtIRD=".$data[0];
                    $rspId = dohttp("https://heat.sky.com.mx/recuperaciones/captura_ird.php", true, $postParameters, $curl);
                    $toFind = '<select name="selIRDNoAplica" size="12" multiple="multiple" class="input150" onChange="seleccionaNoIRD();"><option value=\''.$data[0].'\'>';
                    $pos = strpos($rspId, $toFind);
                    if($pos===false)$algo=false;
                    else $algo = true;
                    $resp2 = "";
                    if(algo){
                        $postParameters = "selIRDNoAplica=".$data[0]."&txtNoIRDSel=".$data[0]."&txtComentarios=IRD+Recuperado&selCodigo=-&txtTarjetaDiferente=&text1=&text2=&hdnTipo=3";
                        $resp2 = dohttp("https://heat.sky.com.mx/recuperaciones/captura_ird.php", true, $postParameters, $curl);
                    }else{
                        $postParameters = "txtComentarios=&selCodigo=".$data[0]."&btnRecuperado=Recuperado&txtTarjetaDiferente=&text1=&text2=&hdnTipo=1";
                        $resp2 = dohttp("https://heat.sky.com.mx/recuperaciones/captura_ird.php", true, $postParameters, $curl);        
                    }
                    //echo $resp2;
                    $tof= '<td colspan="2"><span class="Estilo4">';
                    $toPrint = "";
                    $pos1 = -1;
                    while (($pos1 = strpos($resp2, $tof, $pos1+1)) !== false) {
                        $posicion = $pos1+strlen($tof);
                        for($i = $posicion;$resp2[$i]!="<";$i++){
                            $toPrint.=$resp2[$i];
                        }
                    }
                    $salida.=$data[0].",".$toPrint."\r\n";
                }
                $linea++;
            }
            $handle = fclose($handle);
            curl_close($curl);
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="respuesta.csv";');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Expires: 0");
        ob_end_clean();
        echo $salida;
    }

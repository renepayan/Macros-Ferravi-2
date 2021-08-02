<?php
    //include 'conexion.php';
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
	curl_setopt($curl, CURLOPT_VERBOSE, false);
	$respuesta = curl_exec ($curl);
	return $respuesta;
    }
    function getUrlContent($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo curl_error($ch);
        curl_close($ch);
        return ($httpcode>=200 && $httpcode<300) ? $data : false;
    }
    function login($usuario, $password){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
        session_write_close();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.sclpcj.com.mx:7071/SCLWeb/login");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"j_username=".$usuario."&j_password=".$password."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIE, $strCookie );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
?>
<?php
    echo "TEST 01<br>";
    $curl = curl_init();
    echo dohttp("https://www.sclpcj.com.mx:7071/SCLWeb/login", true, "j_username=LT138469&j_password=AX3L**2017", $curl);
    //echo login("LT138469","AX3L**2017");
    echo "SE LOGEO<br>";
    echo dohttp("https://www.sclpcj.com.mx:7071/SCLWeb/reportes/consultaClientesPorClasificacion.do?submitter=descargarCSV&idClasificacion=16&idRegional=8234",false,"",$curl);
    curl_close($curl);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            /*if(isset($_POST["enviar"])){
                $con = getConnection();
                $usuario = $_POST["cual"];
                $usuario = mysqli_real_escape_string($con,$usuario);
                $query = "SELECT * FROM MUsuario WHERE Usuario = ".$usuario;
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $contra = $row["Password"];
                mysqli_close($con);
                $login($usuario,$contra);
                $con = getConnection();
                $query = "";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    $url = "https://www.sclpcj.com.mx:7071/SCLWeb/reportes/consultaClientesPorClasificacion.do?submitter=descargarCSV&idClasificacion=16&idRegional=".$row['id'];
                    echo getUrlContent($url);
                }
                mysqli_close($con);
            }
        ?>
        <form method="post" action ="https://www.sclpcj.com.mx:7071/SCLWeb/login">
            <input type="text" name ="j_username">
            <input type="text" name ="j_password">
            <input type="submit" value="ok">
        </form>
        <form method="POST" action="">
            <select name="cual">
                <?php
                    $con = getConnection();
                    $query  = "";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result)){
                        $id = $row['Usuario'];
                        echo "<option value = '".$id."'>".$row['Usuario']."</option>";
                    }
                    mysqli_close($con);
                */?>
            </select>
            <input type="submit" value="DESCARGAR" name="enviar">
        </form>
    </body>
</html>

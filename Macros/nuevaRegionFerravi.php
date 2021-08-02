<?php
    session_start();
    if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){  
        session_destroy();
        header("Location: index.php"); 
    }
    require_once("CRM_Conexion.php");
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    if(isset($_POST["enviar"])){
        $id = mysql_real_escape_string($_POST["id"]);
        $resp = mysql_real_escape_string($_POST["resp"]);
        $nombre = mysql_real_escape_string($_POST["name"]);
        $query = "INSERT INTO tbl_Lugar_Ferravi (id,Nombre,Responsable) VALUES ($id,'$nombre','$resp')";
        mysql_query($query);
        header('Location: lugaresFerravi.php');
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, c<!DOCTYPE html>
hoose Tools | Templates
and open the template in the editor.
-->
<html>
<head> 
	<title>Registrar Usuario</title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Registrar Region</I></B></FONT></H2>
                <form method="POST" action="">
                    <p align="center">
                        ID:<input type="number" name="id" max="99999999999" min="0" required><br>
                    </p>
                    <p align="center">
                        Nombre:<input type="text" name="name" maxlength="50" required><br>
                    </p>
                    <p align="center">
                        Responsable:<input type="text" name="resp" maxlength="50" required><br>
                    </p>
                    <p align="center">
                        <input type="submit" name="enviar" value="Aceptar">
                    </p>
                </form>
                <a href="lugaresFerravi.php"><p align="center">Regresar</p></a>
                <a href="main.php"><p align="center">Pagina Principal</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>

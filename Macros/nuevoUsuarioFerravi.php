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
        $usuario = mysql_real_escape_string($_POST["user"]);
        $pass = mysql_real_escape_string($_POST["pass"]);
        $query = "INSERT INTO tbl_Usuario_Ferravi (Usuario,Password,Activo) VALUES ('$usuario','$pass',1)";
        mysql_query($query);
        header('Location: usuarios_ferravi.php');
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
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Registrar Usuario</I></B></FONT></H2>
		<form method="POST" action="">
		<input type="hidden" name="id" value="0">
		<p align="center">
			Usuario:<input type="text" name="user" maxlength="11" required>
		</p>
		<p align="center">
			Password:<input type="Password" name="pass" maxlength="11" required><br>
		</p>
		<p align="center"><input type="submit" name="enviar" value="Aceptar"></p>
		</form>
		<a href="usuarios_ferravi.php"><p align="center">Regresar</p></a>
                <a href="main.php"><p align="center">Pagina Principal</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>


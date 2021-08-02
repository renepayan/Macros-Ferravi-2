<?php
    session_start();
    if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){  
        session_destroy();
        header("Location: index.php"); 
    }
    require_once("CRM_Conexion.php");
    if(empty($_GET["usuario"])){
        header('Location: usuarios_ferravi.php');
        die();
    }
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    $usuario = mysql_real_escape_string($_GET["usuario"]);
    $query = "SELECT * FROM tbl_Usuario_Ferravi WHERE id = $usuario";
    $result = mysql_query($query);
    if(mysql_num_rows($result)<=0){
        header('Location: usuarios_ferravi.php');
        die();
    }
    $row = mysql_fetch_assoc($result);
    if(isset($_POST["enviar"])){
        if(!empty($_POST["pass"]))$pass = mysql_real_escape_string($_POST["pass"]);
        else $pass = $row["Password"];
        if(strlen($pass)<=0)$pass=$row["Password"];
        $usu = mysql_real_escape_string($_POST["user"]);
        $query = "UPDATE tbl_Usuario_Ferravi SET Usuario = '$usu', Password = '$pass' WHERE id = $usuario";
        mysql_query($query);
        header('Location: editarUsuarioFerravi.php?usuario='.$usuario);
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head> 
	<title>Modificar Usuario</title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Modificar Usuario</I></B></FONT></H2>
                <form name="formulario" method="POST" action="">
                    <p align="center">
                        Usuario:<input type="text" name="user" value="<?php echo $row["Usuario"];?>" required>
                    </p>
                    <p align="center">
                        Password:<input type="password" name="pass">
                    </p>
                    <p align="center"><input type="submit" name="enviar" value="Aceptar"></p>
                </form>           
                <a href="usuarios_ferravi.php"><p align="center">Regresar</p></a>
                <a href="index.php"><p align="center">Menu Principal</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>


<!DOCTYPE html>
<?php
    session_start();
    if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){  
        session_destroy();
        header("Location: index.php"); 
    }
    require_once("CRM_Conexion.php");
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    if(empty($_GET["region"])){
        header('Location: lugaresFerravi.php');
        die();
    }
    $id = mysql_real_escape_string($_GET["region"]);
    $query = "SELECT * FROM tbl_Lugar_Ferravi WHERE id = $id";
    $result = mysql_query($query);
    if(mysql_num_rows($result)<=0){
        header('Location: lugaresFerravi.php');
        die();
    }
    $row = mysql_fetch_assoc($result);
    if(isset($_POST["enviar"])){
        $nombre = mysql_real_escape_string($_POST["name"]);
        $resp = mysql_real_escape_string($_POST["resp"]);
        $query = "UPDATE tbl_Lugar_Ferravi SET Nombre = '$nombre', Responsable = '$resp' WHERE id = '$id'";
        mysql_query($query);
        header('Location: editarRegionFerravi.php?region='.$id);
    }
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head> 
	<title>Modificar Region</title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Modificar Region</I></B></FONT></H2>
                <form name="formulario" method="POST" action="">
                    <p align="center">
                        Nombre:<input type="text" name="name" maxlength="50" required value="<?php echo $row["Nombre"];?>"><br>
                    </p>
                    <p align="center">
                        Responsable:<input type="text" name="resp" maxlength="50" required value="<?php echo $row["Responsable"];?>"><br>
                    </p>
                    <p align="center">
                        <input type="submit" name="enviar" value="Aceptar">
                    </p>
                </form>           
                <a href="lugaresFerravi.php"><p align="center">Regresar</p></a>
                <a href="index.php"><p align="center">Menu Principal</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>

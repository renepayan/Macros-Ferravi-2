<?php
    session_start();
    if($_SESSION["logueado"]!=true){
	session_destroy();
        header("Location: index.php");         
    }
?>
<!DOCTYPE html>
<html>
<head> 
	<title>Exportar Registros</title>
        <script src="js/jquery.min.js"></script>
	<script>
                var activo = false;
		function magia(){
                    document.getElementById("enviar").setAttribute('disabled','disabled');
                    document.getElementById("carga").style.display = "inline";
                    activo = true;
                    return true;
		}
	</script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR>
            <TD>
                <DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
                    <H2 align="center"><FONT COLOR="BLUE"><B><I>Elija un Usuario</I></B></FONT></H2>
                    <p align="center">
                        <form method="POST" action="downloadFerravi.php" name="formulario" onsubmit="return magia()" align="center">
                            Seleccione un usuario:
                            <select name="cual">
                                <?php
                                    if($_SESSION["tipo"]==0){
                                        require_once("CRM_Conexion.php");
                                        $ConexionCRM=new Conexion(1);
                                        $ConexionCRM->Open();
                                        $query  = "SELECT * FROM tbl_Usuario_Ferravi WHERE Activo = 1";
                                        $result = mysql_query($query);
                                        while($row = mysql_fetch_assoc($result)){
                                            $id = $row['id'];
                                            echo "<option value = '".$id."'>".$row['Usuario']."</option>";
                                        }
                                    }else{
                                        require_once("CRM_Conexion.php");
                                        $ConexionCRM=new Conexion(1);
                                        $ConexionCRM->Open();
                                        $query  = "SELECT * FROM tbl_Usuario_Ferravi WHERE id = ".$_SESSION["id"];
                                        $result = mysql_query($query);
                                        $row = mysql_fetch_assoc($result);
                                        $user = $row["Usuario"];
                                        echo "<option value='".$_SESSION["id"]."'>".$user."</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" value="DESCARGAR" name="enviar" id="enviar"><br>
                            <sub>LA DESCARGA PUEDE TOMAR VARIOS MINUTOS</sub>
                            <a href="main.php"><p align="center">Pagina Principal</p></a>
                            <p align="center"><img src="Cargando.gif" style="display: none;" id="carga" align="middle"/></p>
                        </form>                        
                    </p>	
                </DIV>
            </TD>
        </tr>
        </TABLE>
</body>
</html>

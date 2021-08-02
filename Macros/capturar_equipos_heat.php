<?php
    require_once("CRM_Conexion.php");
    session_start();
    if($_SESSION["logueado"]!=true){
        session_destroy();
	header("Location: index.php"); 
    }
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    if(!empty($_GET["error"])){
        if($_GET["error"]==1){
            echo "<script>alert('Tipo de extencion incorrecta');</script>";
        }
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
	<meta charset="UTF-8">
        <title>Capturar Equipos HEAT</title>
        <script>
            function magia(){
                document.getElementById("enviar").setAttribute("disabled","disabled");
                document.getElementById("carga").style.display = "inline";
                return true;
            }
        </script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
                <H2 align="center"><FONT COLOR="BLUE"><B><I>Importar Equipos a Capturar</I></B></FONT></H2>
		<P align="center">
                <form name="formulario" align="center" method="post" action="imp_capturar_equipos_heat.php" onsubmit='document.getElementById("carga").style.display = "inline";document.getElementById("enviar").disabled = true;' enctype="multipart/form-data">
                    <input type='hidden' name="algo" value="hola">
                    Usuario:
                    <select name="usuario">
                        <?php
                            $query = "";
                            if($_SESSION["tipo"]==0){
                                $query = "SELECT * FROM tbl_Usuario";
                            }else{
                                $query = "SELECT * FROM tbl_Usuario WHERE id = ".$_SESSION["id"];
                            }
                            $result = mysql_query($query);
                            while($row = mysql_fetch_assoc($result)){
                                echo "<option value='".$row["id"]."'>". base64_decode(base64_decode($row["usuario"]))."</option>";
                            }
                        ?>
                    </select>  
		   <BR>			
		   Archivo:<input type="file" name="archivo">		   
		   <BR>		   
                   <p align="center"><img src="Cargando.gif" style="display: none;" id="carga" width="40px" height="40px"></p>
		   <BR>
		   <input type="submit" name="send" id="enviar" value="Importar">
		   <BR>
                    <a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>

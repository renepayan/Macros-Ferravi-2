<?php
    session_start();
    if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){  
        session_destroy();
        header("Location: index.php"); 
    }
    require_once("CRM_Conexion.php");
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
        <title>Regiones registradas</title>
        <script>
            function confirma(cual){
                return confirm("Desea eliminar la region con el id "+cual);
            }
        </script>
    </head>
    <body>
        <DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
            <H2 align="center"><FONT COLOR="BLUE"><B><I>Regiones registradas</I></B></FONT></H2>
            <p align="center">
                <table border="1" align="center" >
                    <tr style="background-color:#295BB0;color:#FFFFFF">
                        <th><p align="center">Id</p></th>
                        <th><p align="center">Nombre</p></th>
                        <th><p align="center">Responsable</p></th>
                        <th colspan="3"><p align="center">Opciones</p></th>
                    </tr>
                    <?php
                        $query = "SELECT * FROM tbl_Lugar_Ferravi";
                        $ConexionCRM=new Conexion(1);
                        $ConexionCRM->Open();
                        $result = mysql_query($query);
                        $cont = 2;
                        while($row = mysql_fetch_assoc($result)){
                            if($cont%2==0){
                                $color = "#FFFFFF";
                            }else{
                                $color =  "#FFF6A3";
                            }
                            echo "<tr style=\"background-color:".$color.";\">";
                                echo "<td><b>".$row["id"]."</b></td>";
                                echo "<td><b>".utf8_encode($row["Nombre"])."</b></td>";
                                echo "<td><b>".$row["Responsable"]."</b></td>";
                                echo "<td><a href='editarRegionFerravi.php?region=".$row["id"]."'>Editar</a></td>";
                                echo "<td><a href='borrarRegionFerravi.php?region=".$row["id"]."' onclick='return confirma(".$row["id"].")'>Borrar</a></td>";
                            echo "</tr>";
                            $cont++;
                        }   
                    ?>
                </table>
            <a href="nuevaRegionFerravi.php"><p align="center">Agregar Region</p></a>
            <a href="main.php"><p align="center">Pagina Principal</p></a>
            </p>
        </div>
    </body>
</html>

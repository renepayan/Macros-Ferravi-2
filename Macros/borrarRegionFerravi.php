<?php
session_start();
    if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){  
        session_destroy();
        header("Location: index.php"); 
    }
    require_once("CRM_Conexion.php");
    if(empty($_GET["region"])){
        header('Location: lugaresFerravi.php');
        die();
    }
    $ConexionCRM=new Conexion(1);
    $ConexionCRM->Open();
    $id = mysql_real_escape_string($_GET["region"]);
    $query = "SELECT * FROM tbl_Lugar_Ferravi WHERE id = $id";
    $result = mysql_query($query);
    if(mysql_num_rows($result)<=0){
        header('Location: lugaresFerravi.php');
        die();
    }
    $query = "DELETE FROM tbl_Lugar_Ferravi WHERE id = $id";
    mysql_query($query);
    header('Location: lugaresFerravi.php');    
?>
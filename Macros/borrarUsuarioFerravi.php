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
    $query = "UPDATE tbl_Usuario_Ferravi SET Activo = 0 WHERE id = $usuario";
    mysql_query($query);
    header('Location: usuarios_ferravi.php');
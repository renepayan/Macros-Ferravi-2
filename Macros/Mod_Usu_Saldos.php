<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $auxid=$_POST["valor"];
	  if($auxid!="0"){
	  	  $result=mysql_query("select * from tbl_Usuario_Saldos where id='".addslashes($auxid)."'",$ConexionCRM->cn);
		  if(!($row = mysql_fetch_assoc($result))){
	         header("Location: usuarios_saldos.php");
	      }
	  }
?>
<html>
<head> 
	<title><?if($_POST["valor"]=="0"){echo("Registrar Usuario");}else{echo("Modificar Usuario");}?></title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I><?if($_POST["valor"]=="0"){echo("Registrar Usuario");}else{echo("Modificar Usuario");}?></I></B></FONT></H2>
		<form name="formulario" action="Act_Usu_Saldos.php?tipo=<?echo($_GET["tipo"]);?>" method="post">
		<input type="hidden" name="id" value="<?echo $auxid;?>">
		<p align="center">
			Usuario:<input type="text" name="usuario" value="<?if($_POST["valor"]!="0"){echo(base64_decode(base64_decode($row["usuario"])));}?>">
		</p>
		<p align="center">
			Password:<input type="password" name="password" value="<?if($_POST["valor"]!="0"){echo(base64_decode(base64_decode($row["password"])));}?>">
		</p>
		<p align="center"><input type="submit" name="boton" value="Aceptar"></p>
		</form>
		<a href="usuarios_saldos.php?tipo=<?echo($_GET["tipo"]);?>"><p align="center">Regresar</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?$ConexionCRM->Close();?>
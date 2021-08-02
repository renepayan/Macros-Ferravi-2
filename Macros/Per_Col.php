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
	  $result=mysql_query("select * from tbl_Campana_Colores where Id_Campana='".$_POST["valor_camp"]."'",$ConexionCRM->cn);
	  $row = mysql_fetch_assoc($result);
?>
<html>
 <head>
  <title>Personalizar Colores</title>
  <script src="js/jquery.min.js" type="text/javascript"></script>
  <script src="js/jquery.kolorpicker.js" type="text/javascript"></script>
  <link rel="stylesheet" href="css/kolorpicker.css" type="text/css" media="screen, tv, projection, print" />
 </head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Personalizar Colores</I></B></FONT></H2>
		<form name="formulario" method="post" action="Act_Col.php?tipo=<?echo($_GET["tipo"])?>">
		<p align="center">
		    <input type="hidden" name="id" value="<?echo $_POST["valor_camp"];?>">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Posicion</p></td>
					<th><p align="center">Color</p></td>
				</tr>
				<tr>
				<td><b>Fondo</b></td>
				<td><p><input type="text" name="Fondo" value="<?echo $row["Fondo"];?>" class="kolorPicker"></p></td>
				</tr>
				<td><b>Historicos</b></td>
				<td><p><input type="text" name="Historicos" value="<?echo $row["Historicos"];?>" class="kolorPicker"></p></td>
				</tr>
				<tr>
				<td><b>Encabezado</b></td>
				<td><p><input type="text" name="Encabezado" value="<?echo $row["Encabezado"];?>" class="kolorPicker"></p></td>
				</tr>
				<tr>
				<td><b>Titulos</b></td>
				<td><p><input type="text" name="Titulos" value="<?echo $row["Titulos"];?>" class="kolorPicker"></p></td>
				</tr>				
				
			</table>
		<p align="center"><input type="submit" name="boton" value="Aceptar"></p>
		<a href="Per_Camp.php?tipo=<?echo($_GET["tipo"])?>"><p align="center">Regresar</p></a>
		</form>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
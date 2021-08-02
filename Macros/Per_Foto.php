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
	  if($_POST["valor_camp"]==null){
	     header("Location: index.php");
	  }
	  $result=mysql_query("select * from tbl_Campana where Id=".$_POST["valor_camp"],$ConexionCRM->cn);
	  $row = mysql_fetch_assoc($result);
?>
<html>
<head> 
	<title>Personalizar Foto</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Personalizar Foto</I></B></FONT></H2>
	    <?if($row["FOTO"]!=null){?>
		   <img src="images/<?echo($row["FOTO"]);?>" width="100%" height="250px">
		<?}?>		
		<P align="center">
		<form name="formulario" align="center" method="post" action="Sub_foto.php?tipo=<?echo($_GET["tipo"]);?>" enctype="multipart/form-data">		
		   Archivo:
			<input type="file" name="file">
			<input type="hidden" name="valor_camp" value=<?echo($_POST["valor_camp"]);?>>
		   <BR>		   
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Camb(formulario)" value="Subir">
		   <BR>
		<a href="Per_camp.php?tipo=<?echo($_GET["tipo"]);?>"><p align="center">Regresar</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
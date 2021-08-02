<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }  
?>
<html>
<head> 
	<title>Mantenimiento</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	    <?if($_GET["y"]!=null){?>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se optimizaron las tablas </I></B></FONT></H2>
		<?}?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Mantenimiento</I></B></FONT></H2>
		<P align="center">
		<form name="formulario2" align="center" method="post" action="optimiza.php" enctype="multipart/form-data">	
		   <p align="center"><input type="submit" name="boton" value="Optimizar tablas"></p>
		   <a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
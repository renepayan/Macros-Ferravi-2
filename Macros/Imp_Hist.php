<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if($_GET["tipo"]!=null){
		  $ConexionCRM=new Conexion($_GET["tipo"]);
		  $ConexionCRM->Open();
?>
<html>
<head> 
	<title>Importar Historico</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	    <?if($_GET["x"]!=null){?>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se importaron correctamente <?echo($_GET["x"]);?> registros</I></B></FONT></H2>
		<?}?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Importar Historico</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" align="center" method="post" action="Ges_Imp_Hist.php?tipo=<?echo($_GET["tipo"]);?>" enctype="multipart/form-data">		
		   Archivo:
			<input type="file" name="file">		   
		   <BR>		   
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Camb(formulario)" value="Importar">
		   <BR>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?}else{?>
<html>
<head> 
	<title>Importar Historico</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
			<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Imp_Hist.php" align="center">
			<SELECT name="tipo">
			<?$file=fopen("Tipos", "r");
			$i=1;
			while (!feof($file)){
			   echo("<OPTION value=\"$i\">CRM ".preg_replace ("[\n|\r|\n\r]","",fgets($file))."</OPTION>");
			   $i++;
			}?>
			</SELECT>
			<input type="submit" value="Siguiente">
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</p>	
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?}?>
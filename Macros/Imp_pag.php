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
		 $result=mysql_query("select * from tbl_Campana order by Id",$ConexionCRM->cn);
	  if(!($row = mysql_fetch_assoc($result))){
    	 echo("<html><script type=\"text/javascript\">function func(){alert(\"Registre Campañas\");window.location=\"main.php\";}</script><body onload=\"func()\"></html>");
	  }else{
	  $result=mysql_query("select * from tbl_Campana order by Id",$ConexionCRM->cn);	  
?>
<html>
<head> 
	<title>Importar Pagos</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	    <?if($_GET["x"]!=null){?>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se procesaron correctamente <?echo($_GET["x"]);?> pagos</I></B></FONT></H2>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se encontraron correctamente <?echo($_GET["yy"]);?> telefonos</I></B></FONT></H2>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se marcaron en drop <?echo($_GET["z"]);?> telefonos</I></B></FONT></H2>
		<?}?>
	    <?if($_GET["y"]!=null){?>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I><?echo($_GET["y"]);?> </I></B></FONT></H2>
		<?}?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Importar Pagos</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" align="center" method="post" action="Ges_Imp_Pa.php?tipo=<?echo($_GET["tipo"]);?>" enctype="multipart/form-data">		
		   Archivo:
			<input type="file" name="file">		   
		   <BR>		   
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Camb(formulario)" value="Importar">
		   <BR>
		</form>
		<form name="formulario2" align="center" method="post" action="borra_pagos.php?tipo=<?echo($_GET["tipo"]);?>" enctype="multipart/form-data">	
		   <input type="submit" name="boton" value="Borrar Pagos AJU">
		</form>
		<form name="formulario3" align="center" method="GET" action="borra_pagos_mes.php" enctype="multipart/form-data">	
		   <input type="hidden" name="tipo" value="<? echo($_GET["tipo"]); ?>">
		   <select name="mes">
                       <option value="Ene">Enero</option>
		       <option value="Feb">Febrero</option>
                       <option value="Mar">Marzo</option>
		       <option value="Abr">Abril</option>
                       <option value="May">Mayo</option>
		       <option value="Jun">Junio</option>
                       <option value="Jul">Jul</option>
		       <option value="Ago">Agosto</option>
                       <option value="Sep">Septiembre</option>
		       <option value="Oct">Octubre</option>
                       <option value="Nov">Noviembre</option>
		       <option value="Dic">Diciembre</option>
		   </select>
		   <input type="submit" name="boton" value="Borrar Pagos mes">
		   <a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?}}else{?>
<html>
<head> 
	<title>Importar Pagos</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
			<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Imp_pag.php" align="center">
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
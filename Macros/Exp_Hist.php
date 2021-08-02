<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  if($_GET["tipo"]!=null){
		  $ConexionCRM=new Conexion($_GET["tipo"]);
		  $ConexionCRM->Open();
		  $result=mysql_query("select * from tbl_Campana order by Id",$ConexionCRM->cn);
	  }
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $_SESSION["query"]="";
?>
<html>
<head> 
	<title>Importar Registros</title>
	<script src="js/enviar.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-1.8.3.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();
    });
    </script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	<?if($_GET["tipo"]!=null){?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Exportacion de Historicos</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" method="post" action="exp_calif.php?tipo=<?echo($_GET["tipo"]);?>" align="center">
		   De: <input type="text" id="datepicker" name="inicial">
		   A:<input type="text" id="datepicker2" name="final"><BR>
		   <BR>		   
		   Lista:
			<select name="id_campana">
			<?while($row = mysql_fetch_assoc($result)){?>
			   <option value="<?echo $row["Nombre"];?>"><?echo $row["Nombre"];?></option>
			<?}?>
			</select>
		   <BR>		   
		   <BR>		   
		   <input type="submit" name="boton" value="Exportar">
		   <BR>
		   <a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
		<?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Exp_Hist.php" align="center">
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
		<?}?>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?php
	  error_reporting (E_ALL ^ E_NOTICE);
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
?>
<html>
<head> 
	<title>Gestionar claves de gestion</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<?if($_GET["tipo"]!=null&&$_GET["tipo"]!=4){
			$file=fopen("ges_".$_GET["tipo"], "r");
		?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Gestiones registradas</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="post" action="" align="center">
		    <input type="hidden" name="valor" value="">
			<table cellspacing="1" cellpadding="1" border=1; align="center">
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Id</p></td>
					<th><p align="center">Nombre</p></td>
					<th><p align="center">Desripcion</p></td>
					<th><p align="center">Visible</p></td>
					<th colspan="2"><p align="center">Opciones</p></td>
				</tr>
				<?$cont=0;while(!feof($file)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p><?
						$clave=preg_replace ("[\n|\r|\n\r]","",fgets($file));
						echo $clave;?></p></td>
						<td><p><?echo preg_replace ("[\n|\r|\n\r]","",fgets($file));?></p></td>
						<td><p><?echo preg_replace ("[\n|\r|\n\r]","",fgets($file))?></p></td>
						<td><p><?echo preg_replace ("[\n|\r|\n\r]","",fgets($file))?></p></td>
						<td><a href="javascript:envia(<?echo $clave;?>,10,formulario,<?echo($_GET["tipo"]);?>)"><p>Modificar</p></a></td>
						<td><a href="javascript:envia(<?echo $clave;?>,11,formulario,<?echo($_GET["tipo"]);?>)"><p>Eliminar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
		<a href="javascript:envia(-1,10,formulario,<?echo($_GET["tipo"]);?>)"><p align="center">Nueva gestion</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</p>
		<?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="gestiones.php" align="center">
			<SELECT name="tipo">
			<?$file=fopen("Tiposg", "r");
			while (!feof($file)){
			   echo("<OPTION value=\"".preg_replace ("[\n|\r|\n\r]","",fgets($file))."\">CRM ".preg_replace ("[\n|\r|\n\r]","",fgets($file))."</OPTION>");
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
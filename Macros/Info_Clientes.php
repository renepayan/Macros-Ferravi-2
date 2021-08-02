<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if(true){
		  $ConexionCRM=new Conexion(1);
		  $ConexionCRM->Open();
		  $result=mysql_query("select * from tbl_Usuario order by Id",$ConexionCRM->cn);		  
?>
<html>
<head> 
	<title>Informacion de cuentas</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
	    <?if($_GET["x"]!=null){?>
		   <H2 align="center"><FONT COLOR="BLUE"><B><I>Se cerraron correctamente <?echo($_GET["y"]);?> solicitudes de <?echo($_GET["x"]);?></I></B></FONT></H2>
		<?}?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Importar Solucitudes para consultar informacion</I></B></FONT></H2>
		<P align="center">
		<form name="formulario" align="center" method="post" action="Ges_Info_Clientes.php" enctype="multipart/form-data">
		   Usuario:
			<select name="id_usuario">
			<?while($row = mysql_fetch_assoc($result)){
				if($_SESSION["id"]==0||$row["id"]==$_SESSION["id"]) {
				?>
			   <option <?php if($row["id"]==$_SESSION["id"]) { echo("selected"); } ?> value="<?echo $row["id"];?>"><?echo base64_decode(base64_decode($row["usuario"]));?></option>
			<?} }?>
			</select>  
		   <BR>			
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
	<title>Importar Registros</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
			<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija Tipo de Solicitud</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Imp_reg_saldos.php" align="center">
			<SELECT name="tipo">
			<?
				$ConexionCRM=new Conexion(1);
			    $ConexionCRM->Open();
				if($_SESSION["id"]==0){					
					$result=mysql_query("select * from tbl_Campana order by id desc",$ConexionCRM->cn);
				}else{
					$result=mysql_query("select * from tbl_Campana where id_usuario_saldo=".$_SESSION["id"]." order by id desc",$ConexionCRM->cn);
				} ?>
			<?while($row = mysql_fetch_assoc($result)){
				?>
			   <option value="<?echo $row["id"];?>"><? echo $row["nombre"];?></option>
			<? }?>
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
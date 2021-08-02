<?php
	  error_reporting (0);
      require_once("CRM_Conexion.php");
	  session_start();
	  if($_SESSION["logueado"]!=true||$_SESSION["tipo"]!=0){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	 $ConexionCRM=new Conexion(1);
	 $ConexionCRM->Open();
	 $result=mysql_query("select * from tbl_Usuario order by id",$ConexionCRM->cn); 
?>
<html>
<head> 
	<title>Gestionar Usuarios</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Usuarios registrados</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="post" action="" align="center">
		    <input type="hidden" name="valor" value="">
			<table cellspacing="1" cellpadding="1" border=1; align="center">
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Id</p></td>
					<th><p align="center">Nombre</p></td>
					<th colspan="3"><p align="center">Opciones</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p><?echo $row["id"];?></p></td>
						<td><p><?echo base64_decode(base64_decode($row["usuario"]));?></p></td>
						<td><a href="javascript:envia(<?echo $row["id"];?>,12,formulario,1)"><p>Modificar</p></a></td>
						<td><a href="javascript:envia(<?echo $row["id"];?>,13,formulario,1)"><p>Eliminar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
		<a href="javascript:envia(0,12,formulario,1)"><p align="center">Nuevo usuario</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</p>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
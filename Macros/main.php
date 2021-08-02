<?php
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
?>
<html>
<head> 
	<title>Pagina principal</title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija alguna opci&oacute;n</I></B></FONT></H2>
		<p align="center">
			<table cellspacing="10" cellpadding="5" >
				<tr>
					<td><?php if($_SESSION["tipo"]==0){ ?><a href="usuarios.php"><p>Gestionar Usuarios Heat</p></a> <?php } ?></td>
					<td><?php if($_SESSION["tipo"]!=2 && $_SESSION["tipo"]!=3){ ?><a href="Imp_reg.php"><p>Cierre de cuentas Heat</p></a><?php } ?></td>
				</tr>
				<tr>
					<td><?php if($_SESSION["tipo"]!=1 && $_SESSION["tipo"]!=3){ ?><a href="Ges_Camp.php?tipo=1"><p>Gestionar Listas Saldos</p></a> <?php } ?></td>
					<td><?php if($_SESSION["tipo"]!=1 && $_SESSION["tipo"]!=3){ ?><a href="Imp_reg_saldos.php"><p>Consulta de saldos</p></a><?php } ?></td>
				</tr>		
				<tr>
					<td><?php if($_SESSION["tipo"]==0){ ?><a href="usuarios_saldos.php"><p>Gestionar Usuarios Saldos</p></a> <?php } ?></td>
					<td><?php if($_SESSION["tipo"]==0){ ?><a href="usuarios_ferravi.php"><p>Gestionar Usuarios SLC</p></a> <?php } ?></td>
				</tr>					
                                <tr>
					<td><?php if($_SESSION["tipo"]==0){ ?><a href="lugaresFerravi.php"><p>Gestionar Regiones SLC</p></a> <?php } ?></td>
					<td><?php if($_SESSION["tipo"]==3 || $_SESSION["tipo"]==0){ ?><a href="getAllFerravi.php"><p>Descargar Clientes SLC</p></a> <?php } ?></td>
				</tr>	
				<tr>
					<td><?php if($_SESSION["tipo"]!=2 && $_SESSION["tipo"]!=3){ ?><a href="liberar_solicitudes_heat.php"><p>Liberar Solicitudes Heat</p></a><?php } ?></td>
					<td><?php if($_SESSION["tipo"]!=2 && $_SESSION["tipo"]!=3){ ?><a href="capturar_equipos_heat.php"><p>Capturar Equipos Heat</p></a><?php } ?></td>
				</tr>
				<tr>
					<td><?php if($_SESSION["tipo"]!=2 && $_SESSION["tipo"]!=3){ ?><a href="Info_Clientes.php"><p>Descargar informacion de clientes</p></a><?php } ?></td>
				</tr>
			</table>
		</p>
		<a href="close.php"><p align="center">Salir</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
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
					<td><a href="Ges_Camp.php"><p>Gestionar Usuarios</p></a></td>
					<td><a href="Imp_reg.php"><p>Cierre de cuentas</p></a></td>
				</tr>
			</table>
		</p>
		<a href="close.php"><p align="center">Salir</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
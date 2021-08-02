<?php
      $file=fopen("CRM_Admin", "r");
	  $usuario =preg_replace ("[\n|\r|\n\r]","",fgets($file));
	  $password=preg_replace ("[\n|\r|\n\r]","",fgets($file));	
	  if($usuario==null|$password==null){
	     
	  }else{
	      session_destroy();
	      header("Location: index.php");
	  }
?>
<html>
<head> 
	<title>Asignar Usuario y Contrase&ntilde;a</title>
</head>
<body>
	<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:400;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Asignar Usuario y Contrase&ntilde;a</I></B></FONT></H2>
		<form name="formulario" action="asignar.php" method="post">
		   <table align="center">
		      <tr><td><P align="right"><B> Usuario:</B></P></td><td><input type="text" name="usuario" size="30"></td></tr>
		      <tr><td><P align="right"><B>Contrase&ntilde;a:</B></P></td><td><input type="password" name="password" size="30"></td></tr>
		   </table>
		   <p align="center"><input type="submit" value="Asignar"></p>
		</form>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
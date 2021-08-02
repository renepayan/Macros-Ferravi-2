<?php
	  error_reporting (E_ALL ^ E_NOTICE); 
	  session_start();
	  if($_SESSION["logueado"]==null){
	     session_destroy();
	  }else{
	     header("Location: main.php"); 
	  }
      $file=fopen("CRM_Admin", "r");
	  $usuario=base64_decode(base64_decode(preg_replace ("[\n|\r|\n\r]","",fgets($file))));
	  $password=base64_decode(base64_decode(preg_replace ("[\n|\r|\n\r]","",fgets($file))));	
	  if($usuario==null|$password==null){
	     header("Location: init.php");
	  }
?>
<html>
<head> 
	<title>Iniciar Sesi&oacute;n</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
	<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:400;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Ingresar al sistema</I></B></FONT></H2>
		<form name="formulario" action="login.php" method="post">
		   <table align="center">
		      <tr><td><P align="right"><B> Usuario:</B></P></td><td><input type="text" name="usuario" size="30"></td></tr>
		      <tr><td><P align="right"><B>Contrase&ntilde;a:</B></P></td><td><input type="password" name="password" size="30"></td></tr>
		   </table>
		   <?
		   if($_GET["mensaje"]!=null){
		       if($_GET["mensaje"]==0){
				  echo("<p align=\"center\"><FONT COLOR=\"RED\">Credenciales Incorrectas</FONT></p>");
			   }else{
				  if($_GET["mensaje"]==1){
					 echo("<p align=\"center\"><FONT COLOR=\"RED\">Contrase&ntilde;a Incorrecta</FONT></p>");
				  }
			   }
		   }
		   ?>
		   <p align="center"><input type="submit" value="Entrar"></p>
		</form>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
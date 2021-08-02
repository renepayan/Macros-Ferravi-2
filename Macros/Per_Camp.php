<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  if($_POST["valor"]!=null){
	     $_SESSION["valor"]=$_POST["valor"];
	  }
	  if($_SESSION["valor"]==null){
	      header("Location: Ges_Camp.php");
	  }
	  $result=mysql_query("select * from tbl_Campana_Campo where Id_Campana='".addslashes($_SESSION["valor"])."' order by Id",$ConexionCRM->cn);
?>
<html>
 <head>
  <title>Personalizar Campa&ntilde;a</title>
  <script src="js/enviar.js" type="text/javascript"></script>
 </head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Campos registrados para la Campa&ntilde;a</I></B></FONT></H2>
		<form name="formulario" method="post" action="">
		<p align="center">
		    <input type="hidden" name="valor" value="">
		    <input type="hidden" name="valor_camp" value="<?echo $_SESSION["valor"];?>">
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Id</p></td>
					<th><p align="center">Nombre</p></td>
					<th><p align="center">Visible</p></td>
					<th colspan="2"><p align="center">Opciones</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p><?echo $row["Id"];?></p></td>
						<td><p><?echo $row["Nombre"];?></p></td>
						<td><p><?if($row["Visible"]==1){echo "SI";}else{echo "NO";}?></p></td>
						<td><a href="javascript:envia(<?echo $row["Id"];?>,4,formulario,<?echo($_GET["tipo"]);?>)"><p>Modificar</p></a></td>
						<td><a href="javascript:envia(<?echo $row["Id"];?>,5,formulario,<?echo($_GET["tipo"]);?>)"><p>Eliminar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
		</p>
		<a href="javascript:envia(0,6,formulario,<?echo($_GET["tipo"]);?>)"><p align="center">Elegir Colores</p></a>
		<a href="javascript:envia(0,9,formulario,<?echo($_GET["tipo"]);?>)"><p align="center">Cambiar Imagen</p></a>
		<a href="javascript:envia(0,4,formulario,<?echo($_GET["tipo"]);?>)"><p align="center">Nuevo Campo</p></a>
		<a href="Ges_Camp.php?tipo=<?echo($_GET["tipo"]);?>"><p align="center">Regresar</p></a>
		</form>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
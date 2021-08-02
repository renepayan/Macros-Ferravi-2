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
		if($_SESSION["id"]==0){					
			$result=mysql_query("select * from tbl_Campana order by id desc",$ConexionCRM->cn);
		}else{
			$result=mysql_query("select * from tbl_Campana where id_usuario_saldo=".$_SESSION["id"]." order by id desc",$ConexionCRM->cn);
		}
	  }	  
?>
<html>
<head> 
	<title>Gestionar Listas</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<?if($_GET["tipo"]!=null){?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Listas registradas</I></B></FONT></H2>
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
						<td><p><?echo $row["nombre"];?></p></td>
						<td><a href="descarga.php?campana=<?echo $row["id"];?>"><p>Descargar</p></a></td>
						<td><a href="javascript:envia(<?echo $row["id"];?>,1,formulario,<?echo($_GET["tipo"]);?>)"><p>Modificar</p></a></td>
						<td><a href="javascript:envia(<?echo $row["id"];?>,3,formulario,<?echo($_GET["tipo"]);?>)"><p>Eliminar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
		<a href="javascript:envia(0,1,formulario,<?echo($_GET["tipo"]);?>)"><p align="center">Nueva Lista</p></a>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</p>
		<?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Elija CRM</I></B></FONT></H2>
		<p align="center">
		<form name="formulario" method="GET" action="Ges_Camp.php" align="center">
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
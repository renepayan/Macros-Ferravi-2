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
	  if($_SESSION["query"]==null){
		  $query="";
		  for($i=1;$i<=5;$i++){
			  if($_POST["query".$i]!=null){
				 if($_POST["Criterio".$i]{0}>='0'&&$_POST["Criterio".$i]{0}<='9'){
					$query=$query." and (tbl_Campana_Campo_Registro.Id_Campana_Campo='".$_POST["Criterio".$i]."' and tbl_Campana_Campo_Registro.Valor LIKE'%".$_POST["query".$i]."%')";
				 }else{
					$query=$query." and (tbl_Registro.".$_POST["Criterio".$i]." LIKE '%".$_POST["query".$i]."%')";
				 }
			  }
		  }
		  if($query!=null){
			 $query=substr($query,4);
		  }else{
		     $query="1=1";
		  }
		  $result=mysql_query("Select Id from tbl_Campana_Campo where tbl_Campana_Campo.id_Campana='".$_POST["id"]."' limit 1",$ConexionCRM->cn);
		  $auxilquery=0;
		  if($fila=mysql_fetch_assoc($result)){
		     $auxilquery=1;
		  }
		  $_SESSION["query"]="select DISTINCT tbl_Registro.* from tbl_Registro";
		  
		  if($auxilquery==1){
		     $_SESSION["query"]=$_SESSION["query"].",tbl_Campana_Campo_Registro";
		  }
		  $_SESSION["query"]=$_SESSION["query"]." where tbl_Registro.Id_campana=".$_POST["id"]." and ";
		  if($auxilquery==1){
		      $_SESSION["query"]=$_SESSION["query"]."tbl_Campana_Campo_Registro.Id_registro=tbl_Registro.Id and ";
		  }
		  $_SESSION["query"]=$_SESSION["query"]."(".$query.") order by tbl_Registro.Id";
		  $_SESSION["idcampanaexp"]=$_POST["id"];
	  }
	  $result=mysql_query($_SESSION["query"],$ConexionCRM->cn);
	  //echo($_SESSION["query"]);
?>
<html>
<head> 
	<title>Gestionar Campa&ntilde;as</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Resultado de la busqueda:</I></B></FONT></H2>
		<P align="center">	
		<form name="formulario" method="post" action="exportar.php?tipo=<?echo($_GET["tipo"]);?>" align="center">
		<p align="center">
		    <input type="hidden" name="valor" value="">		
		<?if($_GET["OP"]==0){?>
		<a href="Con_Reg.php?OP=1&tipo=<?echo($_GET["tipo"]);?>"><p align="center">Mostrar tabla de resultados</p></a>
		<?}else{?>
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
					<th><p align="center">Id</p></td>
					<th><p align="center">Llave</p></td>
					<?if($_GET["tipo"]!=4){?>
					<th><p align="center">Cliente</p></td>
					<th><p align="center">Saldo</p></td>
					<?}else{?>
					<th><p align="center">Nombre</p></td>
					<?}?>
					<th colspan="3"><p align="center">Opciones</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
						<td><p><?echo $row["Id"];?></p></td>
							<td><p><?echo $row["LLAVE"];?></p></td>
						<?if($_GET["tipo"]!=4){?>
						<td><p><?echo $row["CLIENTE"];?></p></td>
						<td><p>$<?echo $row["SALDO"];?></p></td>
						<?}else{?>
						<td><p><?echo $row["NOMBRE"];?></p></td>
						<?}?>						
						<td><a href="consulta.php?idRegistro=<?echo $row["Id"];?>&tipo=<?echo($_GET["tipo"]);?>"><p>Consulta Publica</p></a></td>
						<td><a href="javascript:envia(<?echo $row["Id"];?>,7,formulario,<?echo($_GET["tipo"]);?>)"><p>Consulta Privada</p></a></td>
						<td><a href="javascript:envia(<?echo $row["Id"];?>,8,formulario,<?echo($_GET["tipo"]);?>)"><p>Eliminar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
			<?}?>
		</p>
		   <P align="center">
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" value="Exportar CSV">
		   </P>
		 <P align="center"> <I> Nota: La exportacion puede tardar algunos minutos.</i></P>
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</form>
		</P>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
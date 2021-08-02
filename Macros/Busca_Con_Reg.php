<?php
      error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion($_GET["tipo"]);
      $ConexionCRM->Open();
	  session_start();
	  		  $query="";
		  for($i=1;$i<=2;$i++){
			  if($_POST["query".$i]!=null){
				$query=$query." and (tbl_Registro.".$_POST["Criterio".$i]." LIKE '%".$_POST["query".$i]."%')";
			  }
		  }
		  if($query!=null){
			 $query=substr($query,4);
		  }else{
		     $query="1=1";
		  }
 	  $_SESSION["query"]="select DISTINCT tbl_Registro.* from tbl_Registro";
	  $_SESSION["query"]=$_SESSION["query"]." where ";
	  $_SESSION["query"]=$_SESSION["query"]."(".$query.") order by tbl_Registro.Id";
	  $result=mysql_query($_SESSION["query"],$ConexionCRM->cn);
	  //echo($_GET["tipo"]);
	  $_SESSION["query"]=null;
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
		<?if(mysql_num_rows($result)>100000){?><H2 align="center"><FONT COLOR="BLUE"><B><I>Limite su busqueda.</I></B></FONT></H2><?}else{?>
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Resultado de la busqueda:</I></B></FONT></H2>
		<P align="center">	
		<form name="formulario" method="post" action="exportar.php" align="center">
		<p align="center">
		    <input type="hidden" name="valor" value="">		
		<?if($_GET["OP"]==0){?>
		<a href="Con_Reg.php?OP=1"><p align="center">Mostrar tabla de resultados</p></a>
		<?}else{?>
			<table cellspacing="1" cellpadding="1" border=1;>
				<tr style="background-color:#295BB0;color:#FFFFFF">
				<?if($_GET["tipo"]==1){
			$files=fopen("mnp_".$_GET["tipo"], "r");
			while(!feof($files)){
				$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$MNP[$value]=$clave;
			}
			$files=fopen("ges_".$_GET["tipo"], "r");
			while(!feof($files)){
				$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$Ges[$value]=$clave;
			}
?>
					<th><p align="center">Ciclo</p></td>
					<th><p align="center">Folio</p></td>
					<th><p align="center">Celular</p></td>
					<th><p align="center">Cuenta</p></td>
					<th><p align="center">Clave de Gestion</p></td>
					<th><p align="center">MNP</p></td>
					<th><p align="center">Nombre del cliente</p></td>
					<?}else{
						if($_GET["tipo"]==2){?>
					<th><p align="center">Id</p></td>
					<th><p align="center">Telefono</p></td>
					<th><p align="center">Lista</p></td>
					<th><p align="center">Cuenta</p></td>	
					<th><p align="center">Celular</p></td>
					<th><p align="center">Nombre del cliente</p></td>					
					<?}else{
						if($_GET["tipo"]==3){?>
					<th><p align="center">Id</p></td>
					<th><p align="center">Telefono</p></td>
					<th><p align="center">Lista</p></td>
					<th><p align="center">Numero de Cliente</p></td>	
					<th><p align="center">Contrato</p></td>	
					<th><p align="center">Nombre del Cliente</p></td>
					<th><p align="center">Telefono 2</p></td>	
					<th><p align="center">Telefono 3</p></td>	
						<?}else{
							if($_GET["tipo"]==4){?>
								<th><p align="center">Id</p></td>
								<th><p align="center">Cuenta</p></td>
							<?}						
						}						
					}
				}?>
					<th colspan="3"><p align="center">Opciones</p></td>
				</tr>
				<?$cont=0;while($row = mysql_fetch_assoc($result)){
				$resultnom=mysql_query("select Nombre from tbl_Campana where Id=".$row["Id_Campana"],$ConexionCRM->cn);
				$rownom = mysql_fetch_assoc($resultnom);
				$resultcal=mysql_query("select Cve_Gestion,MNP from tbl_Calificacion_Registro where LLAVE='".$row["LLAVE"]."' order by id desc limit 1",$ConexionCRM->cn);
                               // echo("select Cve_Gestion,MNP from tbl_Calificacion_Registro where Id_Registro=".$row["Id"]." order by id desc limit 1");
				$rowcal = mysql_fetch_assoc($resultcal);
?>
					<tr style="background-color:<?if($cont%2==0){echo "#FFFFFF;";}else{echo "#FFF6A3;";}?>">
				<?if($_GET["tipo"]==1){?>
						<td><p><?echo $row["CICLO"];?></p></td>
						<td><p><?echo $row["FOLIO"];?></p></td>
						<td><p><?echo $row["CELULAR"];?></p></td>
						<td><p><?echo $row["CUENTA"];?></p></td>
						<td><p><?echo $Ges[$rowcal["Cve_Gestion"]];?></p></td>
						<td><p><?echo $MNP[$rowcal["MNP"]];?></p></td>
						<td><p><?echo $row["CLIENTE"];?></p></td>
					<?}else{
						if($_GET["tipo"]==2){?>
						<td><p><?echo $row["Id"];?></p></td>
						<td><p><?echo $row["TELEF1"];?></p></td>
						<td><p><?echo $rownom["Nombre"];?></p></td>
						<td><p><?echo $row["CUENTA"];?></p></td>
						<td><p><?echo $row["CELULAR"];?></p></td>	
						<td><p><?echo $row["CLIENTE"];?></p></td>					
					<?}else{
						if($_GET["tipo"]==3){?>
						<td><p><?echo $row["Id"];?></p></td>
						<td><p><?echo $row["TEL1"];?></p></td>
						<td><p><?echo $rownom["Nombre"];?></p></td>
						<td><p><?echo $row["CLIENTE"];?></p></td>
						<td><p><?echo $row["CONTRATO"];?></p></td>	
						<td><p><?echo $row["RAZON_SOCIAL"];?></p></td>		
						<td><p><?echo $row["TEL2"];?></p></td>
						<td><p><?echo $row["TEL3"];?></p></td>
						<?}else{
							if($_GET["tipo"]==4){?>
							<td><p><?echo $row["Id"];?></p></td>
							<td><p><?echo $row["Cuenta"];?></p></td>
							<?}
						}
					}
				}?>					
						<td><a href="consulta.php?tipo=<?echo($_GET["tipo"]);?>&idRegistro=<?echo $row["Id"];?>"><p>Consultar</p></a></td>
					</tr>
				<?$cont++;}?>
			</table>
			<?}?>
		</p>
		   <P align="center">
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   </P>
		</form>
		</P>
	<?}?>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
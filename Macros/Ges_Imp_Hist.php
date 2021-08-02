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
	  $extencion = substr($_FILES["file"]["name"],$auxtam-3,3);
	  if(strcmp(strtolower($extencion),"csv")!=0){
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Extension incorrecta\");window.location=\"Imp_Hist.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		if($_GET["tipo"]==1){
			$cad=array("LLAVE","ESTATUS","EST_TEL","CUENTA","CELULAR","FOLIO","CICLO","Cve_Gestion","MNP","Comentario","Extra","Fecha","Campana");
		}else{
			if($_GET["tipo"]==2){
				$cad=array("LLAVE","CUENTA","CELULAR","IVR","ASIG","Cve_Gestion","Comentario","Extra","Fecha","Campana");
			}else{
				if($_GET["tipo"]==3){
					$cad=array("LLAVE","CLIENTE","CONTRATO","REFERENCIA","Cve_Gestion","Comentario","Extra","Fecha","Campana");
				}else{
					if($_GET["tipo"]==4){
						$cad=array("LLAVE","CUENTA","Cve_Gestion","Comentario","Extra","Fecha","Campana");
					}
				}		
			}
		}
	     move_uploaded_file($_FILES["file"]["tmp_name"],"archivo.csv");
?>
<html>
<head> 
	<title>Importar Historico</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Registros de Historico:</I></B></FONT></H2>
		<form name="formulario" method="post" action="Importar_Hist.php?tipo=<?echo($_GET["tipo"]);?>" align="center">
		<input type="hidden" name="id_campana" value="<?echo $_POST["id_campana"];?>">
		<table align="center">
		<?
		$auxc=0;
		$handle = fopen("archivo.csv", "r");
	    $rescvs=fgetcsv($handle,5000000,',');
		while($auxc<count($cad)){?>
		      <tr><td><P align="right"><B><?echo $cad[$auxc];?></B></P></td><td><select name="<?echo $cad[$auxc];?>"><option value="">NINGUNO</option>
		   <?
			   $auxi=0;
			   while($rescvs[$auxi]!=null){
					echo("<option value=\"$auxi\" ");
					if(strcmp(strtolower($cad[$auxc]),strtolower($rescvs[$auxi]))==0){
					   echo("selected");
					}
					echo (">".$rescvs[$auxi]."</option>");
					$auxi++;
			   }
		   ?>
		</select></td></tr>
		<?$auxc++;}	?>
		</table>
		<P align="center">
		   <img align="center" src="Cargando.gif" style="display: none;" Id="Cargando" width="40px" height="40px">
		   <BR>
		   <input type="submit" name="boton" onclick="Camb(formulario)" value="Importar">
				   <BR>		
		   Nota: La importacion puede tardar algunos minutos.		
		<a href="main.php"><p align="center">Pagina Principal</p></a>
		</P>
		</form>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?}?>
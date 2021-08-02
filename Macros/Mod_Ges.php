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
	  $auxid=$_POST["valor"];
	  $files=fopen("ges_".$_GET["tipo"], "r");
	  $maxges=-1;
	  $cuantos=-1;
	  while(!feof($files)){
		$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$cuantos++;
		if($value==$auxid){
			$auxorden=$cuantos;
		}
		$orden[$cuantos]=$value;
		$claves[$value]=$clave;
		$descripciones[$value]=$descripcion;
		$mostrars[$value]=$mostrar;
		$maxges=max($maxges,$value);
	  }
	  if($auxid==-1){
		$auxid=$maxges+1;
		$cuantos++;
		$auxorden=$cuantos;
	  }
?>
<html>
<head> 
	<title><?if($_POST["valor"]=="-1"){echo("Registrar Gesti&oacute;n");}else{echo("Modificar Gesti&oacute;n");}?></title>
</head>
<body>
		<BR><BR><BR><BR><BR><BR><BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I><?if($_POST["valor"]=="-1"){echo("Registrar Gesti&oacute;n");}else{echo("Modificar Gesti&oacute;n");}?></I></B></FONT></H2>
		<form name="formulario" action="Act_Ges.php?tipo=<?echo($_GET["tipo"]);?>" method="post">
		<input type="hidden" name="orden" value="<?php echo($auxorden);?>">
		<input type="hidden" name="maxorden" value="<?php echo($cuantos);?>">
		<input type="hidden" name="id" value="<?php echo($auxid);?>">
		<p align="center">Id:<input type="text" disabled name="idd" value="<?echo $auxid;?>"></p>
		<p align="center">
			Clave:<input type="text" name="Clave" value="<?php if($_POST["valor"]!="-1") {echo($claves[$auxid]); } ?>">
		</p>
		<p align="center">
			Descripcion:<input size="50" type="text" name="Descripcion" value="<?php if($_POST["valor"]!="-1"){ echo($descripciones[$auxid]); }?>">
		</p>
		<p align="center">
			Mostrar en pantalla: <select name="Mostrar"><option <?php if($_POST["valor"]!="-1"){ if(strcmp($mostrars[$auxid],"true")==0){ echo("selected"); } } ?> value="true">Mostrar</option><option <?php if($_POST["valor"]!="-1"){ if(strcmp($mostrars[$auxid],"false")==0){ echo("selected"); } } ?> value="false">No mostrar</option></select>
		</p>
		<p align="center"><input type="submit" name="boton" value="Aceptar"></p>
		</form>
		<a href="gestiones.php?tipo=<?echo($_GET["tipo"]);?>"><p align="center">Regresar</p></a>
	</DIV>
	</TR></TD>
	</TABLE>
</body>
</html>
<?$ConexionCRM->Close();?>
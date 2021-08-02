<?php
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $auxid=$_POST["id"];
	  $auxorden=$_POST["orden"];
	  $maxorden=$_POST["maxorden"];
	  $files=fopen("ges_".$_GET["tipo"], "r");
	  $cuantos=-1;
	  while(!feof($files)){
		$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
		$cuantos++;
		$orden[$cuantos]=$value;
		$claves[$value]=$clave;
		$descripciones[$value]=$descripcion;
		$mostrars[$value]=$mostrar;
	  }
	  $orden[$auxorden]=$auxid;
	  $claves[$auxid]=$_POST["Clave"];
	  $descripciones[$auxid]=$_POST["Descripcion"];
	  $mostrars[$auxid]=$_POST["Mostrar"];
	  $file=fopen("ges_".$_GET["tipo"], "w");
	  for($i=0;$i<$maxorden;$i++){
		fwrite($file,$orden[$i]."\n".$claves[$orden[$i]]."\n".$descripciones[$orden[$i]]."\n".$mostrars[$orden[$i]]."\n");
	  }
	  fwrite($file,$orden[$maxorden]."\n".$claves[$orden[$maxorden]]."\n".$descripciones[$orden[$maxorden]]."\n".$mostrars[$orden[$maxorden]]);
	  fclose($file);
	  header("location: gestiones.php?tipo=".$_GET["tipo"]);
?>
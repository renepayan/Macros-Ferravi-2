<?php
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $auxid=$_POST["valor"];
	  $files=fopen("ges_".$_GET["tipo"], "r");
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
	  }
	  $file=fopen("ges_".$_GET["tipo"], "w");
	  for($i=0;$i<$cuantos;$i++){
	    if($i!=$auxorden){
			fwrite($file,$orden[$i]."\n".$claves[$orden[$i]]."\n".$descripciones[$orden[$i]]."\n".$mostrars[$orden[$i]]);
			if(($i+1)==$cuantos){
				if($cuantos!=$auxorden){
					fwrite($file,"\n");
				}
			}else{
				fwrite($file,"\n");
			}
		}
	  }
	  if($cuantos!=$auxorden){
	      fwrite($file,$orden[$cuantos]."\n".$claves[$orden[$cuantos]]."\n".$descripciones[$orden[$cuantos]]."\n".$mostrars[$orden[$cuantos]]);
	  }
	  fclose($file);
	  header("Location: gestiones.php?tipo=".$_GET["tipo"]);
?>
<?php
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
      $ConexionCRM=new Conexion(1);
      $ConexionCRM->Open();
	  session_start();
	  if($_SESSION["logueado"]!=true){
	     session_destroy();
		 header("Location: index.php"); 
	  }
	  $extencion = substr($_FILES["file"]["name"],$auxtam-3,3);
	  if(strcmp(strtolower($extencion),"csv")!=0){
	     echo("<html><script type=\"text/javascript\">function func(){alert(\"Extension incorrecta\");window.location=\"Imp_reg_saldos.php?tipo=".$_GET["tipo"]."\";}</script><body onload=\"func()\"></html>");
	  }else{
		$cad=Array("Cuenta");
		$ncad=Array("cuenta");
			
	     // $result=mysql_query("select * from tbl_Campana_Campo where Id_campana='".addslashes($_POST["id_campana"])."'",$ConexionCRM->cn);
	     move_uploaded_file($_FILES["file"]["tmp_name"],"archivo".$_POST["id_usuario"].".csv");
?>
<html>
<head> 
	<title>Importar Registros</title>
	<script src="js/enviar.js" type="text/javascript"></script>
</head>
<body>
	<BR>
	<TABLE align="center">
	<TR><TD>
	<DIV style="width:900;border: 4px solid #5D5858;background-color:#E0ECF8;">
		<H2 align="center"><FONT COLOR="BLUE"><B><I>Relacion de columnas a importar:</I></B></FONT></H2>
		<form name="formulario" method="post" action="Importar_Saldos.php?tipo=<?echo($_GET["tipo"]);?>" align="center">
		<input type="hidden" name="id_usuario" value="<?echo $_POST["id_usuario"];?>">
		<table align="center">
		<?
		$auxc=0;
		$handle = fopen("archivo".$_POST["id_usuario"].".csv", "r");
	    $rescvs=fgetcsv($handle,5000000,',');
		while($auxc<count($cad)){?>
		      <tr><td><P align="right"><B><?echo $cad[$auxc];?></B></P></td><td><select name="<?echo $ncad[$auxc];?>"><option value="">NINGUNO</option>
		   <?
			   $auxi=0;
			   while($rescvs[$auxi]!=null){
					echo("<option value=\"$auxi\" ");
					if(strcmp(strtolower(preg_replace("[ |_]","",$cad[$auxc])),strtolower(preg_replace("[ |_]","",$rescvs[$auxi])))==0){
					   echo("selected");
					}
					echo (">".$rescvs[$auxi]."</option>");
					$auxi++;
			   }
		   ?>
		</select></td></tr>
		<?$auxc++;}?>
		
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
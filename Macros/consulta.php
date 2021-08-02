<?php
	  session_start();
	  error_reporting (E_ALL ^ E_NOTICE);
      require_once("CRM_Conexion.php");
	  if($_GET["idRegistro"]==null||$_GET["tipo"]==null){
	     echo("<h1>Error</h1>");
	  }else{
        $ConexionCRM=new Conexion($_GET["tipo"]);
        $ConexionCRM->Open();	  
         $result=mysql_query("select * from tbl_Registro where Id='".addslashes($_GET["idRegistro"])."' limit 1",$ConexionCRM->cn);
		 if($tbl_Registro=mysql_fetch_assoc($result)){
			 $result=mysql_query("select * from tbl_Campana_Colores where Id_Campana='".$tbl_Registro["Id_Campana"]."' limit 1",$ConexionCRM->cn);
			 $tbl_Campana_Colores=mysql_fetch_assoc($result);
			 $result=mysql_query("select * from tbl_Campana where Id='".$tbl_Registro["Id_Campana"]."' limit 1",$ConexionCRM->cn); 		 
			 $tbl_Campana=mysql_fetch_assoc($result);
			 $result=mysql_query("select * from tbl_Campana_Campo where Id_Campana='".$tbl_Registro["Id_Campana"]."' and Visible=true",$ConexionCRM->cn); 				
		     if($_GET["tipo"]==1){
				 // $Ges=array("","DGE","DPS","DCO","DXP","DAC","DCM","DFX","DNP","DCP","PTO","FSS","CS","SPP","MM","P05","AT","CNE","JU","ERR","ILO");
				$Acl=array("","LDS","I20","MED","SDS","SOC","IF1","IF2","IF3","IF4","IF5","IF6","IF7","IF8","IF9","SNS","ADS","PNE","PRO","NRC","PNA","ANA","SMC","OTR","DSH","CTX","CEL","DOM","CLV","RCO","RCI","RLM","APM","FVN");		 
                               // $MNP=array("","SEM","GPE","DES","QUI","NTD","MRD","JUB","PDS","CNR","CRN","APR","TOL","FEL","MAP","BAJ","SVC","ILO","DEF","ICA","OLV","NEP","VAC","NLR","FTP","NLP","NPD","OOO");		 

			 // }else{
				// if($_GET["tipo"]==2){
					// $Ges=array("","DGE","DPS","DCO","DXP","DAC","DCM","DIL","DFX","DNP","DCP","DIN","DSG","PTO","FSS","CS","SPP","EMAIL","LLE","CF","INC","NC","ILO");	 	 				
				// }else{
					// if($_GET["tipo"]==3){
						// $Ges=array("","DGE","DPS","DCO","DXP","DAC","DCM","DFX","DNP","DCP","PTO","FSS","CS","SPP","MM","P05","AT","CNE","JU","ERR","ILO","AEP","BZN","CC","CDB","FF","GD","NC","NAC","NRA","PP","RDG","RP","SDC","SFP","SSP","TER");	 					
					// }else{
						// if($_GET["tipo"]==4){
							// $Ges=array("","PL","PP","CP","CT","NP","IN","FA","TR","CO","GRAL","LIQ","ILO","OD","CC","CCT","IRR","CP","AC","NE","PP","ST","PB","SP","PR","CR","PT","DE","CS","RR","DC","CC","RS","NI","FA","IL","NC","EQ","LIQ","OD");	 	 									
						// }					
					// }
				// }
			$files=fopen("mnp_".$_GET["tipo"], "r");
			while(!feof($files)){
				$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$MNP[$value]=$clave;
			}				
			 }
			$files=fopen("ges_".$_GET["tipo"], "r");
			while(!feof($files)){
				$value=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$clave=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$descripcion=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$mostrar=preg_replace ("[\n|\r|\n\r]","",fgets($files));
				$Ges[$value]=$clave;
			}			
			 include ($_GET["tipo"].".php");
}else{echo("<h1>ERROR</h1>");}}?>
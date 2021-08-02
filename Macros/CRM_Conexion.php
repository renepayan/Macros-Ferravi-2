<?php	
	require_once 'mysql2pdo.php';
	error_reporting(E_ERROR);
	class Conexion{
		var $ruta;
		var $usr;
		var $paswd;
		var $dbname;
		var $cn;
		var $db;
		var $vari;		
		function Conexion($vari){
			$this->vari=$vari;
		    $file=fopen("CRM_Config", "r");
			for($i=1;$i<=intval($vari);$i++){
				$this->ruta = preg_replace ("[\n|\r|\n\r]","",fgets($file));	
				$this->usr = preg_replace ("[\n|\r|\n\r]","",fgets($file));
				$this->paswd = preg_replace ("[\n|\r|\n\r]","",fgets($file));
				$this->dbname = preg_replace ("[\n|\r|\n\r]","",fgets($file));	
			}
		}
		function Open(){
			$this->cn = mysql_connect($this->ruta,$this->usr,$this->paswd);
			if($this->cn == null){
				die("PROBLEMA CON LA CONEXION REVISAR CON EL ADMINISTRADOR DE SISTEMAS");
			}
			mysql_query("CREATE DATABASE IF NOT EXISTS $this->dbname",$this->cn);
			$this->db = mysql_select_db($this->dbname,$this->cn);
			if($this->db == null){
				die("PROBLEMA CON LA BD REVISAR CON EL ADMINISTRADOR DE SISTEMAS");
			}
			$file=fopen($this->vari, "r");
			while (!feof($file)){
				mysql_query(preg_replace ("[\n|\r|\n\r]","",fgets($file)));
			}
		}
		function Close(){
			mysql_close($this->cn);
		}
	}
?>
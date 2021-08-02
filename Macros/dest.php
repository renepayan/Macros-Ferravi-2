<?	     
   session_start();
   if($_SESSION["logueado"]!=true){
	  session_destroy();
      header("Location: index.php"); 
   }else{
      $file=fopen("CRM_Admin", "w");
      fwrite($file,PHP_EOL);
      session_destroy();
      header("Location: init.php");
   }
?>
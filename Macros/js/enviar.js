function envia(num,dest,formulario,tipo){
   switch(dest){
      case 1:
	     formulario.action="Mod_Camp.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 2:
	  	 formulario.action="Per_Camp.php?tipo="+tipo;
         formulario.valor.value=num;
	  break;
	  case 3:
	  	 formulario.action="Eli_Camp.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar la campana?")){
		    return;
		 }
	  break;
      case 4:
	     formulario.action="Mod_Campo_Camp.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 5:
	  	 formulario.action="Eli_Campo_Camp.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar el campo?")){
		    return;
		 }
	  break;	
      case 6:
	     formulario.action="Per_Col.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;	
      case 7:
	     formulario.action="consultapriv.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 8:
	  	 formulario.action="Eli_Reg.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar el registro?")){
		    return;
		 }
	  break;
      case 9:
	     formulario.action="Per_Foto.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;	
      case 10:
	     formulario.action="Mod_Ges.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 11:
	  	 formulario.action="Eli_Ges.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar el tipo de gestion?")){
		    return;
		 }
	  break;	 
      case 12:
	     formulario.action="Mod_Usu.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 13:
	  	 formulario.action="Eli_Usu.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar al usuario?")){
		    return;
		 }
	  break;	
      case 14:
	     formulario.action="Mod_Usu_Saldos.php?tipo="+tipo;
		 formulario.valor.value=num;
	  break;
	  case 15:
	  	 formulario.action="Eli_Usu_Saldos.php?tipo="+tipo;
         formulario.valor.value=num;
		 if(!confirm("¿Esta seguro de que quiere eliminar al usuario?")){
		    return;
		 }
	  break;	  
   }
   formulario.submit();
}
function Camb(formulario){
   formulario.boton.disabled=true;
   document.getElementById("Cargando").style.display = "inline";
   formulario.submit();
}
function Cambu(formulario,valor){
   formulario.boton.disabled=true;
   document.getElementById("Cargando").style.display = "inline";
   formulario.valor.value=valor;
   formulario.submit();
}
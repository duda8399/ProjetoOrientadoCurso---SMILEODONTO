<?php
	
	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['pacienteS']))
	  {
	  	unset($_SESSION['pacienteS']);
	    header('location:listPacienteS.php');
	  }
	  
	if(isset($_POST["editar"])) {
        require_once("editPagamento.php"); 
	}
	
?>
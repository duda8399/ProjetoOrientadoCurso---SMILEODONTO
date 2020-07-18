<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	if(isset($_POST["editar"])) {
        require_once("editTratamento.php"); 
	}
	
?>
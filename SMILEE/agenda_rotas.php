<?php

	if(isset($_GET["idAgendamento"])) {
        require_once("editAgenda.php"); 
	}else if(isset($_POST["editar"])) {
		require_once("editAgenda.php");
	}
	
?>
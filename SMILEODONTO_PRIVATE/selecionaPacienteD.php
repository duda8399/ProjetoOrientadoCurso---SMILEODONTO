<?php 
	
	if (!isset($_SESSION)) session_start();

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$idPaciente = $_SESSION['paciente'];

	$pegaPaciente    = "SELECT distinct p.idPessoa, p.nome, p.foto FROM pessoa p, paciente pac WHERE p.idPessoa = '$idPaciente' ";
	$pega_paciente   = mysqli_query($conecta,$pegaPaciente);

	if(!$pega_paciente) {
		header("Location: listPaciente.php?msg=5");
	}


?>
<?php 
	
	if (!isset($_SESSION)) session_start();

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$idPaciente = $_SESSION['paciente'];

	$recuperarPaciente    = "SELECT distinct p.nome, p.CPF, pac.dataCadastro, p.dataNascimento, p.logradouro, c.nomeCidade, t.telefoneCelular, t.telefoneResidencial, e.email FROM pessoa p, paciente pac, cidade c, emailPessoa e, telefonePessoa t  WHERE t.idPessoa = p.idPessoa AND e.idPessoa = p.idPessoa AND p.idCidade = c.idCidade AND p.idPessoa = pac.idPaciente AND p.idPessoa = '$idPaciente' ";
	$recuperar_pac        = mysqli_query($conecta,$recuperarPaciente);

	if(!$recuperar_pac) {
		header("Location: listPaciente.php?msg=5");
	}

	$recuperarAnamneses    = "SELECT distinct idAnamnese FROM anamnese  WHERE idPaciente = '$idPaciente' ";
	$recuperar_anamneses   = mysqli_query($conecta,$recuperarAnamneses);
	$anamneses = array();

	foreach ($recuperar_anamneses as $a) {
		array_push($anamneses, $a);
	}

	if(!$recuperar_anamneses) {
		header("Location: listPaciente.php?msg=5");
	}

	$alertas = array();

	for ($i=0; $i< count($anamneses); $i++) {

		$idAnamnese = $anamneses[$i]['idAnamnese'];

		$recuperarAlertas    = "SELECT distinct q.enunciado, a.discursiva FROM questoes q, anamneseQQ a WHERE q.idQuestoes = a.idQuestoes AND a.idAnamnese = '$idAnamnese' AND q.idAlerta = 1 ";
		$recuperar_alertas   = mysqli_query($conecta,$recuperarAlertas);

		foreach ($recuperar_alertas as $alerta) {
			array_push($alertas, $alerta);
		}

		if(!$recuperar_anamneses) {
			header("Location: listPaciente.php?msg=5");
		}
	}

?>
<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$dataAtual = date("Y-m-d");

	$consulta1 = "SELECT p.nome, a.horarioInicio FROM pessoa p, agendamento a, paciente pac WHERE a.idPaciente = pac.idPaciente AND p.idPessoa = pac.idPaciente AND a.data = '$dataAtual' ";
	$consulta_ph = mysqli_query($conecta, $consulta1);

	$consulta2 = "SELECT f.dataVencimento, f.valorParcela, p.nome FROM financeiro f, tratamento t, pessoa p WHERE f.idTratamento = t.idTratamento AND t.idPaciente = p.idPessoa AND f.dataVencimento = '$dataAtual' AND f.idStatusPagamento = '1' ";
	$consulta_pag = mysqli_query($conecta, $consulta2);

?>
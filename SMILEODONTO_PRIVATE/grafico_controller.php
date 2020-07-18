<?php
	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$i = 0;
	$qtde = array();
	$k = 0;
	$valor = array();

	$meses[$i] = array();
	$meses[1] = 'JAN';
	$meses[2] = 'FEV';
	$meses[3] = 'MAR';
	$meses[4] = 'ABR';
	$meses[5] = 'MAI';
	$meses[6] = 'JUN';
	$meses[7] = 'JUL';
	$meses[8] = 'AGO';
	$meses[9] = 'SET';
	$meses[10] = 'OUT';
	$meses[11] = 'NOV';
	$meses[12] = 'DEZ';

	for ($i=1; $i <= 12; $i++) { 

		$recuperar         = "SELECT count(idAgendamento) as qtde FROM agendamento WHERE data >= '2020-$i-01' AND data <= '2020-$i-31'";
		$recuperar_agendamento   = mysqli_query($conecta,$recuperar);
		$row = mysqli_fetch_assoc($recuperar_agendamento);

		$qtde[$i] = $row['qtde'];
	}

	for ($k=1; $k <= 12; $k++) { 

		$recuperarF         = " SELECT sum(valorPago) as valor FROM financeiro WHERE dataPagamento >= '2020-$k-01' AND dataPagamento <= '2020-$k-31' ";
		$recuperar_financeiro   = mysqli_query($conecta,$recuperarF);
		$rowF = mysqli_fetch_assoc($recuperar_financeiro);

		$valor[$k] = $rowF['valor'];
	}

?>

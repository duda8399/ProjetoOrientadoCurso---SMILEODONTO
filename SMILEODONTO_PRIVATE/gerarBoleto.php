<?php
	
	require_once '../../SMILEODONTO_PRIVATE/conexao.php';
	require_once '../../SMILEODONTO_PRIVATE/fpdf181/fpdf.php';

	$codPagamento = $_GET["id"];
	
	$result_dados  = "SELECT distinct p.nome, f.idFinanceiro, f.valorParcela, f.dataPagamento, f.valorPago FROM financeiro f, tratamento t, pessoa p WHERE f.idTratamento = t.idTratamento AND t.idPaciente = p.idPessoa AND f.idFinanceiro = '$codPagamento' ";
	$resultado_dados = mysqli_query($conecta, $result_dados);
	$row_dados = mysqli_fetch_assoc($resultado_dados);
	
	$dataPagamento = $row_dados['dataPagamento'];
	$dataP = implode("/",array_reverse(explode("-",$dataPagamento)));


 	$pdf= new FPDF("P","pt","A4");
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(0,10,'SMILE ODONTO - RECIBO',0,1,'L');
	$pdf->Cell(300);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,0,utf8_decode('Nº: '.$row_dados['idFinanceiro']),0, 2);
	$pdf->Cell(100);
	$pdf->Cell(0,0,'VALOR: '. ' R$'. $row_dados['valorPago'],0, 2);
	$pdf->Ln(80);

	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,0,'Recebi (emos) de ',0, 2);
	$pdf->Cell(120);
	$pdf->Cell(0,0,utf8_decode($row_dados['nome']),0, 2);
	$pdf->Line(130, 125, 550, 125);
	$pdf->Ln(30);
	$pdf->Cell(0,0,'a quantia de R$',0, 2);
	$pdf->Cell(100);
	$pdf->Cell(0,0,utf8_decode($row_dados['valorPago']),0, 2);
	$pdf->Line(120, 155, 550, 155);
	$pdf->Ln(30);
	$pdf->Cell(0,0,utf8_decode('Correspondente aos tratamentos odontológicos que lhe foram prestados e para clareza firmo (amos)'),0, 2);
	$pdf->Ln(18);
	$pdf->Cell(0,0,utf8_decode(' o presente.'),0, 2);
	$pdf->Ln(50);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,0,'Data: '. $dataP,0, 2);
	$pdf->Line(70, 350, 500, 350);
	$pdf->Ln(120);
	$pdf->SetFont('Arial','I',11);
	$pdf->Cell(0,0,'Assinatura',0, 0, 'C');

	$pdf->Output("Recibo.pdf","D");

  ?>
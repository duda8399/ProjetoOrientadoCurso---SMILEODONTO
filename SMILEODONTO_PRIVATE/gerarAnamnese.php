<?php
	
	require_once '../../SMILEODONTO_PRIVATE/conexao.php';
	require_once '../../SMILEODONTO_PRIVATE/fpdf181/fpdf.php';

	$codAnamnese = $_GET["id"];
	
	$result_questoes  = "SELECT q.enunciado, qq.discursiva, p.nome, quest.nomeFicha, a.data FROM anamneseqq qq, questoes q, questionario quest, anamnese a, pessoa p, paciente pac  WHERE qq.idAnamnese = '$codAnamnese' AND q.idQuestoes = qq.idQuestoes AND qq.idQuestionario = quest.idQuestionario AND a.idAnamnese = qq.idAnamnese AND a.idPaciente = pac.idPaciente AND pac.idPaciente = p.idPessoa";
	$resultado_questoes = mysqli_query($conecta, $result_questoes);
	$row_questoes = mysqli_fetch_assoc($resultado_questoes);

	$data = $row_questoes['data'];
	$dataC = implode("/",array_reverse(explode("-",$data)));

	class PDF extends FPDF {

		function Header() {
			$this->SetFont('Arial','B',15);
			$this->Cell(0,0,'Anamnese - SMILE ODONTO',0,0,'C');
			$this->Ln(20);
		}

		function Footer() {
			$this->SetY(-15);
		    $this->Line(50, 280, 160, 280);
		    $this->SetFont('Arial','I',8);
			$this->Cell(0,0,'Assinatura do paciente',0,0, "C");
		}
	}

	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,5,'Paciente: ' . utf8_decode($row_questoes['nome']),0,0);
	$pdf->Ln(10);
	$pdf->Cell(0,5,'Data: ' . $dataC,0,0);
	$pdf->Line(5, 48, 200, 48);
	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(0,5,utf8_decode($row_questoes['nomeFicha']),0,0, "C");
	$pdf->Ln(15);

	$i = 0;
	foreach ($resultado_questoes as $row_quest) {
		$i++;
		$pdf->SetFont('Arial','B',13);
		$pdf->Cell(0,5,$i . '. ' . utf8_decode($row_quest['enunciado']),0,0);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,5,'R: '. utf8_decode($row_quest['discursiva']),0,0);
		$pdf->Ln(10);
	}


	$pdf->Output("Anamnese.pdf","D");

  ?>

	<?php 

		if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}
		if(!isset ($_SESSION['tratamento'])) {
		  	unset($_SESSION['tratamento']);
		    header('location:listTratamento.php');
		}

		$idPaciente = $_SESSION['paciente'];
		$idTratamento = $_SESSION['tratamento'];

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(!empty($_POST["dente"])) {

		        $dente   	      = $_POST["dente"];
		        $procedimento     = $_POST["procedimento"];
		        $anotacao         = $_POST["anotacao"];
		        
		        $inserir    = "INSERT INTO procedimentotratamento ";
		        $inserir   .= "(idTratamento, idDente, idProcedimento, anotacoes, idStatus)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$idTratamento', '$dente', '$procedimento', '$anotacao', '2')";

		        $inserir_tratproced = mysqli_query($conecta,$inserir);

		        if(!$inserir_tratproced) {
		            header("Location: cadOrcamento.php?msg=5");
		    	}else {
		    		header("Location: cadOrcamento.php?msg=1#inserir");
		    	}
		    }
			

		}else if ($acao == 'recuperar') {

			$recuperar_Proced    		= "SELECT *FROM procedimento ORDER BY nomeProcedimento";
			$recuperar_proced   		= mysqli_query($conecta,$recuperar_Proced);

			if(!$recuperar_proced) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$recuperar_Dente  	= "SELECT *FROM dente ";
			$recuperar_dente   	= mysqli_query($conecta,$recuperar_Dente);

			if(!$recuperar_dente) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$recuperar_procedtrat  	= "SELECT p.nomeProcedimento, p.valor, d.nome, pt.idProcedimentoTratamento FROM procedimentotratamento pt, tratamento t, procedimento p, dente d WHERE pt.idProcedimento = p.idProcedimento AND pt.idDente = d.idDente AND pt.idTratamento = t.idTratamento AND t.idTratamento = '$idTratamento' ";
			$recuperar_pt   	    = mysqli_query($conecta,$recuperar_procedtrat);

			if(!$recuperar_pt) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$soma_valor  	 = "SELECT sum(p.valor) as total FROM procedimento p, procedimentotratamento pt, tratamento t WHERE pt.idProcedimento = p.idProcedimento AND pt.idTratamento = t.idTratamento AND t.idTratamento = '$idTratamento' ";
			$recuperar_soma  = mysqli_query($conecta,$soma_valor);
			$row_total       = mysqli_fetch_assoc($recuperar_soma);

			if(!$recuperar_soma) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$recuperar_pac     	= "SELECT p.nome FROM pessoa p, paciente pac WHERE pac.idPaciente = '$idPaciente' AND p.idPessoa = pac.idPaciente ";
			$recuperar_paciente = mysqli_query($conecta,$recuperar_pac);
			$row_pac            = mysqli_fetch_assoc($recuperar_paciente);

			if(!$recuperar_paciente) {
			    header("Location: listOrcamento.php?msg=5");
			}

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idProcedimentoTratamento  		 = $_GET["id"];
			    $remover    	 				 = "DELETE FROM procedimentotratamento WHERE idProcedimentoTratamento = '$idProcedimentoTratamento' ";
			    $remover_procedtrat      		 = mysqli_query($conecta,$remover);

			    if(!$remover_procedtrat) {
			        header("Location: cadOrcamento.php?msg=5");
			   	}else{
			   		header("Location: cadOrcamento.php?msg=3");
			   	}
			}

		}else if ($acao == 'enviar') {

			$atualizarE    	 		= "UPDATE tratamento SET idSituacaoTrat = '1' WHERE idTratamento = '$idTratamento' ";
			$atualizar       		= mysqli_query($conecta,$atualizarE);

			if(!$atualizar) {
			    header("Location: listOrcamento.php?msg=5");
			}else{
			   	header("Location: listOrcamento.php?msg=6");
			}

		}else if ($acao == 'inserirOrcamento') {

			if (isset($_POST['idTratamento'])) {

				$idTratamento     		= $_POST["idTratamento"];
		        $aumento          		= $_POST["aumento"];
		        $desconto         		= $_POST["desconto"];
		        $dataVencimento   		= $_POST["dataVen"];
		        $valorParcela     		= $_POST["valor"];
		        $idStatusPagamento      = 1;
		        $formaPagamento         = 2;

			    $atualizarOrcamento    	 = "UPDATE tratamento SET idSituacaoTrat = 3 WHERE idTratamento = '$idTratamento' ";
			    $atualizar_orcamento     = mysqli_query($conecta,$atualizarOrcamento);

		        for($i = 0; $i< count($valorParcela); $i++){

		        	if (!empty($aumento)) {
		        		
		        		$percentA = ($aumento*$valorParcela[$i])/100;
						$valorFinalA = $valorParcela[$i] + $percentA;

						$inserirFinanceiro    = "INSERT INTO financeiro ";
						$inserirFinanceiro   .= "(dataVencimento, valorParcela, aumento, desconto, idTratamento, idStatusPagamento, idFormaPagamento)";
						$inserirFinanceiro   .= "VALUES ";
						$inserirFinanceiro   .= "('$dataVencimento[$i]', '$valorFinalA', '$aumento', '$desconto', '$idTratamento', '$idStatusPagamento', '$formaPagamento' )";

						$inserir_financeiro = mysqli_query($conecta, $inserirFinanceiro);

						if (!$inserir_financeiro) {
						header("Location: cadOrcamento.php?msg=5");
						}else{
							header("Location: listOrcamento.php?msg=8");
						}

					}else if (!empty($desconto)) {

		        		$percentD = ($desconto*$valorParcela[$i])/100;
						$valorFinalD = $valorParcela[$i] - $percentD;

			        	$inserirFinanceiro    = "INSERT INTO financeiro ";
						$inserirFinanceiro   .= "(dataVencimento, valorParcela, aumento, desconto, idTratamento, idStatusPagamento, idFormaPagamento)";
						$inserirFinanceiro   .= "VALUES ";
						$inserirFinanceiro   .= "('$dataVencimento[$i]', '$valorFinalD', '$aumento', '$desconto', '$idTratamento', '$idStatusPagamento', '$formaPagamento' )";

						$inserir_financeiro = mysqli_query($conecta, $inserirFinanceiro);

						if (!$inserir_financeiro) {
						header("Location: cadOrcamento.php?msg=5");
						}else{
							header("Location: listOrcamento.php?msg=8");
						}

			        }else{

			        	$inserirFinanceiro    = "INSERT INTO financeiro ";
						$inserirFinanceiro   .= "(dataVencimento, valorParcela, aumento, desconto, idTratamento, idStatusPagamento, idFormaPagamento)";
						$inserirFinanceiro   .= "VALUES ";
						$inserirFinanceiro   .= "('$dataVencimento[$i]', '$valorParcela[$i]', '$aumento', '$desconto', '$idTratamento', '$idStatusPagamento', '$formaPagamento' )";

						$inserir_financeiro = mysqli_query($conecta, $inserirFinanceiro);

						if (!$inserir_financeiro) {
						header("Location: cadOrcamento.php?msg=5");
						}else{
							header("Location: listOrcamento.php?msg=8");
						}
			        }
		        }
				
			}
		}
	   
	
  ?>
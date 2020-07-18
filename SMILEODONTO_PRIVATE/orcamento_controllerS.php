	<?php 

		if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['pacienteS'])) {
		  	unset($_SESSION['pacienteS']);
		    header('location:listPacienteS.php');
		}

		$idPaciente = $_SESSION['pacienteS'];

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(!empty($_POST["dentista"])) {

		        $dentista   	      = $_POST["dentista"];
		        $dataAbertura         = $_POST["dataAbertura"];
		        $situacao             = $_POST["situacao"];
		        
		        $inserir    = "INSERT INTO tratamento ";
		        $inserir   .= "(dataAbertura, idDentista, idPaciente, idSituacaoTrat)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$dataAbertura', '$dentista', '$idPaciente', '$situacao')";

		        $inserir_tratamento = mysqli_query($conecta,$inserir);

			    if(!$inserir_tratamento) {
		           	header("Location: listOrcamento.php?msg=5");
			    }else{
			    	header("Location: listOrcamento.php?msg=1");
			    }
			}
		        
		} else if ($acao == 'recuperar') {

			$result_orcamento = "SELECT s.situacao, s.idSituacaoTrat, t.idTratamento, t.dataAbertura, p.nome FROM tratamento t, pessoa p, dentista d, situacaotratamento s WHERE t.idSituacaoTrat = s.idSituacaoTrat AND p.idPessoa = d.idDentista AND d.idDentista = t.idDentista AND t.idPaciente = '$idPaciente' AND (s.idSituacaoTrat = 1 OR s.idSituacaoTrat = 3) ";
			$resultado_orcamento =mysqli_query($conecta, $result_orcamento);

			if (isset($codigo)) {

				$recuperarTrata     = "SELECT *FROM tratamento WHERE idTratamento = '$codigo' ";
				$recuperar_trata    = mysqli_query($conecta,$recuperarTrata);

				if(!$recuperar_trata) {
				    header("Location: listOrcamento.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

			if(!empty($_POST["dentista"])) {

		    	$idTratamento         = $_POST["idTratamento"];
		        $dentista    	 	  = $_POST["dentista"];
		        $dataAbertura   	  = $_POST["dataAbertura"];
		        $dataEncerramento     = $_POST["dataEncerramento"];
		        $situacao   	      = $_POST["situacao"];
		        
		        $atualizar    = "UPDATE tratamento ";
		        $atualizar   .= "SET dataAbertura = '$dataAbertura', dataEncerramento = '$dataEncerramento', idDentista = '$dentista', idSituacaoTrat = '$situacao' ";
		        $atualizar   .= "WHERE idTratamento = '$idTratamento' ";

		        $atualizar_trat = mysqli_query($conecta,$atualizar);

		        if(!$atualizar_trat) {
		            header("Location: listOrcamento.php?msg=5");
		    	}else {
		    		header("Location: listOrcamento.php?msg=2");
		    	}
		    }

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idTratamento  	      = $_GET["id"];
			    $remover    	      = "DELETE FROM tratamento WHERE idTratamento = '$idTratamento' ";
			    $remover_tratamento   = mysqli_query($conecta,$remover);

			    if(!$remover_tratamento) {
			        header("Location: listOrcamento.php?msg=5");
			   	}else{
			   		header("Location: listOrcamento.php?msg=3");
			   	}
			}

		}
	
  ?>
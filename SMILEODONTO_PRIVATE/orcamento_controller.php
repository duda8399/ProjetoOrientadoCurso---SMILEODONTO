	<?php 

		if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}

		$idPaciente = $_SESSION['paciente'];
		$idDentista = $_SESSION['funcionarioD'];

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(!empty($_POST["dentista"])) {

		        $dentista   	      = $_POST["dentista"];
		        $dataAbertura         = $_POST["dataAbertura"];
		        $situacao             = $_POST["situacao"];

		        $dataA = implode("-",array_reverse(explode("/",$dataAbertura)));
		        
		        $inserir    = "INSERT INTO tratamento ";
		        $inserir   .= "(dataAbertura, idDentista, idPaciente, idSituacaoTrat)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$dataA', '$dentista', '$idPaciente', '$situacao')";

		        $inserir_tratamento = mysqli_query($conecta,$inserir);

			    if(!$inserir_tratamento) {
		           	header("Location: listOrcamento.php?msg=5");
			    }else{
			    	header("Location: listOrcamento.php?msg=1");
			    }
			}
		        
		} else if ($acao == 'recuperar') {

			$recuperar    			= "SELECT *FROM situacaotratamento WHERE idSituacaoTrat = 5  ORDER BY situacao";
			$recuperar_trat   		= mysqli_query($conecta,$recuperar);

			if(!$recuperar_trat) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$recuperarSitu    			= "SELECT *FROM situacaotratamento WHERE idSituacaoTrat != 3 And idSituacaoTrat != 4 And idSituacaoTrat != 1  ORDER BY situacao";
			$recuperar_situ     		= mysqli_query($conecta,$recuperarSitu);

			if(!$recuperar_situ) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$recuperarDent          = "SELECT p.nome, p.idPessoa FROM dentista d, pessoa p WHERE p.idPessoa = d.idDentista AND d.idDentista = '$idDentista' ORDER BY p.nome ";
			$recuperar_dentista     = mysqli_query($conecta,$recuperarDent);

			if(!$recuperar_dentista) {
			    header("Location: listOrcamento.php?msg=5");
			}

			$result_orcamento = "SELECT s.situacao, s.idSituacaoTrat, t.idTratamento, t.dataAbertura, p.nome FROM tratamento t, pessoa p, dentista d, situacaotratamento s WHERE t.idSituacaoTrat = s.idSituacaoTrat AND p.idPessoa = d.idDentista AND d.idDentista = t.idDentista AND t.idPaciente = '$idPaciente' AND d.idDentista = '$idDentista' ";
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
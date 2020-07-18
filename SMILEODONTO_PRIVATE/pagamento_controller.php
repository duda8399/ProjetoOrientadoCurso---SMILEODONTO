
<?php 
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['pacienteS'])) {
		  	unset($_SESSION['pacienteS']);
		    header('location:listPacienteS.php');
		}

		$idPaciente    = $_SESSION['pacienteS'];
		require_once("../../SMILEODONTO_PRIVATE/conexao.php");
		require_once '../../SMILEODONTO_PRIVATE/fpdf181/fpdf.php';

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(!empty($_POST["valor"])) {

		        $valor    	            = $_POST["valor"];
		        $descricao              = $_POST["descricao"];
		        $dataVen                = $_POST["dataVen"];
		        $tratamento             = $_POST["tratamento"];
		        $idStatusPagamento      = 1;
		        $formaPagamento         = 2;
		        
		        $inserirFinanceiro    = "INSERT INTO financeiro ";
				$inserirFinanceiro   .= "(dataVencimento, valorParcela, descricao, idTratamento, idStatusPagamento, idFormaPagamento)";
				$inserirFinanceiro   .= "VALUES ";
				$inserirFinanceiro   .= "('$dataVen', '$valor', '$descricao', '$tratamento', '$idStatusPagamento', '$formaPagamento' )";

				$inserir_financeiro = mysqli_query($conecta, $inserirFinanceiro);
		        
		        if(!$inserir_financeiro) {
		            header("Location: listPagamento.php?msg=5");
		    	}else {
		    		header("Location: listPagamento.php?msg=1");
		    	}
		    }	

		}else if ($acao == 'recuperar') {

			if (isset($codigo)) {

				$recuperarTrat    	  = "SELECT t.idTratamento FROM tratamento t, paciente p WHERE t.idPaciente = p.idPaciente AND p.idPaciente = '$idPaciente' ";
				$recuperar_trat       = mysqli_query($conecta,$recuperarTrat);

				if(!$recuperar_trat) {
					header("Location: listPagamento.php?msg=5");
				}

				$idFinanceiro  		    = $codigo;
				$recuperarFinan    	    = "SELECT * FROM financeiro WHERE idFinanceiro = '$idFinanceiro' ";
				$recuperar_financeiro   = mysqli_query($conecta,$recuperarFinan);

				if(!$recuperar_financeiro) {
					header("Location: listPagamento.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

			if(!empty($_POST["idFinanceiro"])) {

				$idFinanceiro        = $_POST["idFinanceiro"];
		        $valor               = $_POST["valor"];
		        $dataVen    	 	 = $_POST["dataVen"];
		        $tratamento     	 = $_POST["tratamento"];
		        $descricao    	     = $_POST["descricao"];
		        
		        $atualizar    = "UPDATE financeiro ";
		        $atualizar   .= "SET dataVencimento = '$dataVen', valorParcela = '$valor', descricao = '$descricao', idTratamento = '$tratamento' ";
		        $atualizar   .= "WHERE idFinanceiro = '$idFinanceiro' ";

		        $atualizar_finan = mysqli_query($conecta,$atualizar);

		        if(!$atualizar_finan) {
		            header("Location: listPagamento.php?msg=5");
		    	}else {
		    		header("Location: listPagamento.php?msg=2");
		    	}
			}
	
		}else if ($acao == 'remover') {
			if (isset($_GET['id'])) {

				$idPagamento  		 = $_GET["id"];
				$remover    	 	 = "DELETE FROM financeiro WHERE idFinanceiro = '$idPagamento' ";
				$remover_finan   	 = mysqli_query($conecta,$remover);

				if(!$remover_finan) {
				    header("Location: listPagamento.php?msg=4");
				}else{
				   	header("Location: listPagamento.php?msg=3");
				}
			}
			
		}else if ($acao == 'recuperarTudo') {

			$recuperarTrat    	  = "SELECT t.idTratamento FROM tratamento t, paciente p WHERE t.idPaciente = p.idPaciente AND p.idPaciente = '$idPaciente' ";
			$recuperar_trat       = mysqli_query($conecta,$recuperarTrat);

			if(!$recuperar_trat) {
				header("Location: listPagamento.php?msg=5");
			}

			$recuperarFormaPag    	  = "SELECT * FROM formapagamento ";
			$recuperar_formaPag       = mysqli_query($conecta,$recuperarFormaPag);

			if(!$recuperar_formaPag ) {
				header("Location: listPagamento.php?msg=5");
			}

			$result_financeiro = "SELECT distinct f.dataVencimento, f.dataPagamento, f.valorParcela, f.valorPago, f.idFinanceiro, s.status, f.aumento, f.desconto, s.idStatusPagamento FROM financeiro f, statusPagamento s, paciente p, tratamento t WHERE f.idStatusPagamento = s.idStatusPagamento AND p.idPaciente = '$idPaciente' AND t.idPaciente = p.idPaciente AND f.idTratamento = t.idTratamento ";
			$resultado_financeiro =mysqli_query($conecta, $result_financeiro);

			if(!$resultado_financeiro) {
				header("Location: listPagamento.php?msg=5");
			}

		}else if ($acao == 'pagar') {

			if(!empty($_POST["idFinanceiro"])) {

				$idFinanceiro        = $_POST["idFinanceiro"];
		        $valorPag            = $_POST["valorPag"];
		        $dataPag    	 	 = $_POST["dataPag"];
		        $multa           	 = $_POST["multa"];
		        $formaPag    	     = $_POST["formaPag"];
		        $idStatusPagamento   = 3;

		        $dataP = implode("-",array_reverse(explode("/",$dataPag)));
		        
		        $atualizarPag    = "UPDATE financeiro ";
		        $atualizarPag   .= "SET dataPagamento = '$dataP', valorPago = '$valorPag', multa = '$multa', idFormaPagamento = '$formaPag', idStatusPagamento = '$idStatusPagamento' ";
		        $atualizarPag   .= "WHERE idFinanceiro = '$idFinanceiro' ";

		        $atualizar_pag = mysqli_query($conecta,$atualizarPag);

		        if($atualizar_pag) {
					header("Location: listPagamento.php?msg=8");

				}else {
		    		header("Location: listPagamento.php?msg=5");
		    	}
			}
	
		}
		   
	
  ?>
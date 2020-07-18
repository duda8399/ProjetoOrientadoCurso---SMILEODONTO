	<?php 

		if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}

		$idPaciente = $_SESSION['paciente'];

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'recuperar') {

			$recuperar    			= "SELECT *FROM situacaotratamento WHERE idSituacaoTrat != 1 AND idSituacaoTrat != 2 AND idSituacaoTrat != 5 ORDER BY situacao";
			$recuperar_trat   		= mysqli_query($conecta,$recuperar);

			if(!$recuperar_trat) {
			    header("Location: listTratamento.php?msg=5");
			}

			$recuperarDent          = "SELECT p.nome, p.idPessoa FROM dentista d, pessoa p WHERE p.idPessoa = d.idDentista ORDER BY p.nome ";
			$recuperar_dentista     = mysqli_query($conecta,$recuperarDent);

			if(!$recuperar_dentista) {
			    header("Location: listTratamentoo.php?msg=5");
			}

			if (isset($codigo)) {

				$recuperarTrata     = "SELECT *FROM tratamento WHERE idTratamento = '$codigo' ";
				$recuperar_trata    = mysqli_query($conecta,$recuperarTrata);

				if(!$recuperar_trata) {
				    header("Location: listTratamento.php?msg=5");
				}
			}

		}else if ($acao == 'recuperarTudo') {

			if (!isset($_SESSION)) session_start();

			$idTratamento = $_SESSION['tratamento'];


				$recuperar    			= "SELECT p.nomeProcedimento, d.nome, pt.idProcedimentoTratamento FROM tratamento t, procedimentotratamento pt, procedimento p, dente d WHERE t.idTratamento = pt.idTratamento AND pt.idProcedimento = p.idProcedimento AND pt.idDente = d.idDente AND t.idTratamento = '$idTratamento' AND pt.idStatus = 2 ";
				$recuperar_trat   		= mysqli_query($conecta,$recuperar);

				if(!$recuperar_trat) {
					header("Location: listTratamento.php?msg=5");
				}

				$recuperarPT    		= "SELECT pt.data, p.nomeProcedimento, d.nome, pt.idProcedimentoTratamento FROM tratamento t, procedimentotratamento pt, procedimento p, dente d WHERE t.idTratamento = pt.idTratamento AND pt.idProcedimento = p.idProcedimento AND pt.idDente = d.idDente AND t.idTratamento = '$idTratamento' AND pt.idStatus = 1 ";
				$recuperar_pt   		= mysqli_query($conecta,$recuperarPT);

				if(!$recuperar_pt) {
					header("Location: listTratamento.php?msg=5");
				}

				$recuperar_Proced    		= "SELECT *FROM procedimento ORDER BY nomeProcedimento";
				$recuperar_proced   		= mysqli_query($conecta,$recuperar_Proced);

				if(!$recuperar_proced) {
				    header("Location: listTratamento.php?msg=5");
				}

				$recuperar_Dente  	= "SELECT *FROM dente ";
				$recuperar_dente   	= mysqli_query($conecta,$recuperar_Dente);

				if(!$recuperar_dente) {
				    header("Location: listTratamento.php?msg=5");
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
		            header("Location: listTratamento.php?msg=5");
		    	}else {
		    		header("Location: listTratamento.php?msg=2");
		    	}
		    }

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idTratamento  	      = $_GET["id"];
			    $remover    	      = "DELETE FROM tratamento WHERE idTratamento = '$idTratamento' ";
			    $remover_tratamento   = mysqli_query($conecta,$remover);

			    if(!$remover_tratamento) {
			        header("Location: listTratamento.php?msg=5");
			   	}else{
			   		header("Location: listTratamento.php?msg=3");
			   	}
			}

		}else if ($acao == 'marcarRealizada') {

			if (isset($_GET['id'])) {

				$idStatus                  = 1;
				$data                      = date('d/m/Y');
				$idProcedimentoTratamento  = $_GET['id'];

				$dataC = implode("-",array_reverse(explode("/",$data)));

		        $atualizar    = "UPDATE procedimentotratamento ";
		        $atualizar   .= "SET data = '$dataC', idStatus = '$idStatus' ";
		        $atualizar   .= "WHERE idProcedimentoTratamento = '$idProcedimentoTratamento' ";

		        $atualizar_pt = mysqli_query($conecta,$atualizar);

		        if(!$atualizar_pt) {
		            header("Location: listTratamento.php?msg=5");
		    	}else {
		    		header("Location: tratamento.php#procedimentos");
		    	}
			}
		}else if ($acao == 'reverter') {

			if (isset($_GET['id'])) {

				$idStatus                  = 2;
				$data                      = 0000-00-00;
				$idProcedimentoTratamento  = $_GET['id'];

		        $atualizar    = "UPDATE procedimentotratamento ";
		        $atualizar   .= "SET data = '$data', idStatus = '$idStatus' ";
		        $atualizar   .= "WHERE idProcedimentoTratamento = '$idProcedimentoTratamento' ";

		        $atualizar_pt = mysqli_query($conecta,$atualizar);

		        if(!$atualizar_pt) {
		            header("Location: listTratamento.php?msg=5");
		    	}else {
		    		header("Location: tratamento.php#procedimentos");
		    	}
			}
		}else if ($acao == 'inserir') {

			if(!empty($_POST["dente"])) {

				if (!isset($_SESSION)) session_start();

				$idTratamento = $_SESSION['tratamento'];

		        $dente   	            = $_POST["dente"];
		        $procedimento           = $_POST["procedimento"];
		        $anotacao               = $_POST["anotacao"];
		        $idStatusPagamento      = 1;
		        $formaPagamento         = 2;

		        $consulta       = "SELECT valor FROM procedimento WHERE idProcedimento = '$procedimento' ";
		        $consulta_valorP  = mysqli_query($conecta,$consulta);

		        foreach ($consulta_valorP as $valor) {
		        	$valorParcela = $valor['valor'];
		        }
		        
		        $inserir    = "INSERT INTO procedimentotratamento ";
		        $inserir   .= "(idTratamento, idDente, idProcedimento, anotacoes, idStatus)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$idTratamento', '$dente', '$procedimento', '$anotacao', '2')";

		        $inserir_tratproced = mysqli_query($conecta,$inserir);

		        $inserirPag    = "INSERT INTO financeiro ";
		        $inserirPag   .= "(valorParcela, idTratamento, idStatusPagamento, idFormaPagamento)";
		        $inserirPag   .= "VALUES ";
		        $inserirPag   .= "('$valorParcela', '$idTratamento', '$idStatusPagamento', '$formaPagamento')";

		        $inserir_pag = mysqli_query($conecta,$inserirPag);

		        if(!$inserir_tratproced) {
		            header("Location: tratamento.php?msg=5");
		    	}else {
		    		header("Location: tratamento.php?msg=1");
		    	}
		    }
		}
	
  ?>

	<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(!empty($_POST["data"])) {
		        $data          = $_POST["data"];
		        $horarioInicio = $_POST["horarioInicio"];
		        $horarioFim    = $_POST["horarioFim"];
		        $paciente      = $_POST["paciente"];
		        $dentista      = $_POST["dentista"];
		        $motivo    	   = $_POST["motivo"];
		        $tipo          = $_POST["tipo"];
		        $situacao      = $_POST["situacao"];

		        $dataInicio    = $data . ' ' . $horarioInicio . ':00';
		        $dataFim       = $data . ' ' . $horarioFim . ':00';

		        if (!empty($paciente)) {
		        	$selectPac        = "SELECT p.nome FROM pessoa p, paciente pac WHERE pac.idPaciente = '$paciente' AND p.idPessoa = pac.idPaciente ";
		        	$select_paciente = mysqli_query($conecta,$selectPac);

					if(!$select_paciente) {
		            	header("Location: agenda.php?msg=5");
		    		}

		    		foreach ($select_paciente as $pac) {
		    			$p = $pac['nome'];
		    			$title = $p;
		    		}

		        }

		        if ($situacao == 1) {
					$cor = "#4169E1";
				}else if ($situacao == 2) {
					$cor = "#228B22";
				}else if ($situacao == 3){
					$cor = "#C71585";
				}else if ($situacao == 4){
					$cor = "#FFD700";
				}else if ($situacao == 5) {
					$cor = "#808080";
				}else if ($situacao == 6){
					$cor = "#8B0000";
				}
		        
		        $inserir    = "INSERT INTO agendamento ";
		        $inserir   .= "(dataInicio, dataFim, idPaciente, idDentista, idTipo, idMotivo, idSituacao, cor, title, data, horarioInicio, horarioFim) ";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$dataInicio', '$dataFim', '$paciente', '$dentista', '$tipo', '$motivo', '$situacao', '$cor', '$title', '$data', '$horarioInicio', '$horarioFim' )";

		        $inserir_agendamento = mysqli_query($conecta,$inserir);
		        if(!$inserir_agendamento) {
		            header("Location: agenda.php?msg=5");
		    	}
		    }
		    
			header("Location: agenda.php?msg=1");

		}else if ($acao == 'recuperar') {

			$recuperarPac       = "SELECT p.nome, p.idPessoa FROM paciente pac, pessoa p WHERE p.idPessoa = pac.idPaciente ORDER BY p.nome ";
			$recuperar_paciente = mysqli_query($conecta,$recuperarPac);

			if(!$recuperar_paciente) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarDent          = "SELECT p.nome, p.idPessoa FROM dentista d, pessoa p WHERE p.idPessoa = d.idDentista ORDER BY p.nome ";
			$recuperar_dentista     = mysqli_query($conecta,$recuperarDent);

			if(!$recuperar_dentista) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarTipo      = "SELECT *FROM tipo ORDER BY tipo ";
			$recuperar_tipo     = mysqli_query($conecta,$recuperarTipo);

			if(!$recuperar_tipo) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarMotivo      = "SELECT *FROM motivo ORDER BY motivo ";
			$recuperar_motivo     = mysqli_query($conecta,$recuperarMotivo);

			if(!$recuperar_motivo) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarSituacao      = "SELECT *FROM situacao ORDER BY situacao ";
			$recuperar_situacao     = mysqli_query($conecta,$recuperarSituacao);

			if(!$recuperar_situacao) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarAgenda      = "SELECT *FROM agendamento ";
			$recuperar_agenda     = mysqli_query($conecta,$recuperarAgenda);

			if(!$recuperar_agenda) {
			    header("Location: agenda.php?msg=5");
			}


		}else if ($acao == 'atualizar') {

			if(!empty($_POST["idAgendamento"])) {
		    	$idAgendamento         = $_POST["idAgendamento"];
		        $paciente              = $_POST["paciente"];
		        $data            	   = $_POST["data"];
		        $horarioInicio    	   = $_POST["horarioInicio"];
		        $horarioFim   	 	   = $_POST["horarioFim"];
		        $idDentista   	 	   = $_POST["dentista"];
		        $idMotivo    	 	   = $_POST["motivo"];
		        $idTipo                = $_POST["tipo"];
		        $situacao    	 	   = $_POST["situacao"];

		        $dataInicio    = $data . ' ' . $horarioInicio . ':00';
		        $dataFim       = $data . ' ' . $horarioFim . ':00';

		        if (!empty($paciente)) {
		        	$selectPac        = "SELECT p.nome FROM pessoa p, paciente pac WHERE pac.idPaciente = '$paciente' AND p.idPessoa = pac.idPaciente ";
		        	$select_paciente = mysqli_query($conecta,$selectPac);

		        	if(!$select_paciente) {
		            	header("Location: agenda.php?msg=5");
		    		}

		    		foreach ($select_paciente as $pac) {
		    			$p = $pac['nome'];
		    			$title = $p;
		    		}

		        }

		        if ($situacao == 1) {
					$cor = "#4169E1";
				}else if ($situacao == 2) {
					$cor = "#228B22";
				}else if ($situacao == 3){
					$cor = "#C71585";
				}else if ($situacao == 4){
					$cor = "#FFD700";
				}else if ($situacao == 5) {
					$cor = "#808080";
				}else if ($situacao == 6){
					$cor = "#8B0000";
				}
		        
		        $atualizar    = "UPDATE agendamento ";
		        $atualizar   .= "SET data = '$data', horarioFim = '$horarioFim', horarioInicio = '$horarioInicio', idPaciente = '$paciente', idDentista = '$idDentista', title = '$title', cor = '$cor', idSituacao = '$situacao', idTipo = '$idTipo', idMotivo = '$idMotivo', dataInicio = '$dataInicio', dataFim = '$dataFim' ";
		        $atualizar   .= "WHERE idAgendamento = '$idAgendamento' ";

		        $atualizar_agenda = mysqli_query($conecta,$atualizar);
		        if(!$atualizar_agenda) {
		            header("Location: agenda.php?msg=5");
		    	}else {
		    		header("Location: agenda.php?msg=2");
		    	}
		    }

		}else if ($acao == 'remover') {
			if (isset($_GET['id'])) {

				$idAgendamento    = $_GET["id"];
				$removerAgenda    = "DELETE FROM agendamento WHERE idAgendamento = '$idAgendamento' ";
				$remover_agenda   = mysqli_query($conecta,$removerAgenda);

				if(!$remover_agenda) {
				    header("Location: pesquisarAgenda.php?msg=5");
				}else{
					header("Location: pesquisarAgenda.php?msg=3");
				}
			}
		}else if ($acao == 'removerModal') {
			if (isset($_GET['id'])) {

				$idAgendamento    = $_GET["id"];
				$removerAgenda    = "DELETE FROM agendamento WHERE idAgendamento = '$idAgendamento' ";
				$remover_agenda   = mysqli_query($conecta,$removerAgenda);

				if(!$remover_agenda) {
				    header("Location: agenda.php?msg=5");
				}else{
					header("Location: agenda.php?msg=3");
				}
			}
		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idAgendamento  		= $codigo;
			    $recuperar    			= "SELECT *FROM agendamento WHERE idAgendamento = '$idAgendamento'";
			    $recuperar_agendamento  = mysqli_query($conecta,$recuperar);
			    $agenda                 = mysqli_fetch_assoc($recuperar_agendamento);

			    if(!$recuperar_agendamento) {
			        header("Location: agenda.php?msg=5");
				}
			}

			$recuperarPac       = "SELECT p.nome, p.idPessoa FROM paciente pac, pessoa p WHERE p.idPessoa = pac.idPaciente ORDER BY p.nome ";
			$recuperar_paciente = mysqli_query($conecta,$recuperarPac);

			if(!$recuperar_paciente) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarDent          = "SELECT p.nome, p.idPessoa FROM dentista d, pessoa p WHERE p.idPessoa = d.idDentista ORDER BY p.nome ";
			$recuperar_dentista     = mysqli_query($conecta,$recuperarDent);

			if(!$recuperar_dentista) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarTipo      = "SELECT *FROM tipo ORDER BY tipo ";
			$recuperar_tipo     = mysqli_query($conecta,$recuperarTipo);

			if(!$recuperar_tipo) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarMotivo      = "SELECT *FROM motivo ORDER BY motivo ";
			$recuperar_motivo     = mysqli_query($conecta,$recuperarMotivo);

			if(!$recuperar_motivo) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarSituacao      = "SELECT *FROM situacao ORDER BY situacao ";
			$recuperar_situacao     = mysqli_query($conecta,$recuperarSituacao);

			if(!$recuperar_situacao) {
			    header("Location: agenda.php?msg=5");
			}

			$recuperarAgenda      = "SELECT *FROM agendamento ";
			$recuperar_agenda     = mysqli_query($conecta,$recuperarAgenda);

			if(!$recuperar_agenda) {
			    header("Location: agenda.php?msg=5");
			}


		}
		   
	
  ?>

	<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'recuperar') {

			$recuperarQuest  = "SELECT  *FROM questionario ORDER BY nomeFicha ";
			$recuperar_quest = mysqli_query($conecta,$recuperarQuest);

			if(!$recuperar_quest) {
			    header("Location: listAnamnese.php?msg=5");
			}


		}else if ($acao == 'inserir') {

		    $idPaciente       	 = $_POST["idPaciente"];
		    $data            	 = $_POST["data"];

		    $dataC = implode("-",array_reverse(explode("/",$data)));
		        
		    $inserirAnamnese     = "INSERT INTO anamnese ";
		    $inserirAnamnese    .= "(idPaciente, data) ";
		    $inserirAnamnese    .= "VALUES ('$idPaciente', '$dataC') ";

		    $inserir_anamnese    = mysqli_query($conecta,$inserirAnamnese);
		    $anamneseID          = mysqli_insert_id($conecta);

		    if (isset($_POST['ficha'])) {
		    	$idQuestionario    = $_POST['ficha'];
		    	$discursiva        = $_POST['resposta'];
		    	$idQuestoes        = $_POST['idQuestoes'];


		    	for($i = 0; $i< count($idQuestoes); $i++){
				
					$inserirQQ    = "INSERT INTO anamneseQQ ";
					$inserirQQ   .= "(idAnamnese, idQuestionario, idQuestoes, discursiva)";
					$inserirQQ   .= "VALUES ";
					$inserirQQ   .= "('$anamneseID', '$idQuestionario', '$idQuestoes[$i]', '$discursiva[$i]' )";

					$inserir_QQ = mysqli_query($conecta, $inserirQQ);

					if (!$inserir_QQ) {
						header("Location: listAnamnese.php?msg=5");
					}else{
						header("Location: listAnamnese.php?msg=1");
					}
				}
			}

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idAnamnese  		 = $_GET["id"];
			    $removerQQ   	 	 = "DELETE FROM anamneseQQ WHERE idAnamnese = '$idAnamnese' ";
			    $remover_QQ   	     = mysqli_query($conecta,$removerQQ);

			    if(!$remover_QQ) {
			        header("Location: listAnamnese.php?msg=5");
			   	}

			    $removerAnam   	 	 = "DELETE FROM anamnese WHERE idAnamnese = '$idAnamnese' ";
			    $remover_Anam   	 = mysqli_query($conecta,$removerAnam);

			    if(!$remover_Anam) {
			        header("Location: listAnamnese.php?msg=5");
			   	}else{
			   		header("Location: listAnamnese.php?msg=3");
			   	}
			}
		
		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idAnamnese  		= $codigo;
			    $recuperarQQ    	= "SELECT distinct q.idQuestoes, q.enunciado, q.idObrigatoriedade, qq.discursiva, quest.nomeFicha, quest.idQuestionario FROM anamneseqq qq, questoes q, questionario quest WHERE qq.idAnamnese = '$idAnamnese' AND q.idQuestoes = qq.idQuestoes AND qq.idQuestionario = quest.idQuestionario";
			    $recuperar_QQ   	= mysqli_query($conecta,$recuperarQQ);
			    $row_quest          = mysqli_fetch_assoc($recuperar_QQ);

			    if(!$recuperar_QQ) {
			        header("Location: listAnamnese.php?msg=5");
				}

				$recuperarQuest  = "SELECT  *FROM questionario ORDER BY nomeFicha ";
				$recuperar_quest = mysqli_query($conecta,$recuperarQuest);

				if(!$recuperar_quest) {
				    header("Location: listAnamnese.php?msg=5");
				}

				$recuperarAnamnese  = "SELECT  *FROM anamnese WHERE idAnamnese = '$idAnamnese' ";
				$recuperar_anamnese = mysqli_query($conecta,$recuperarAnamnese);
				$row_anamnese       = mysqli_fetch_assoc($recuperar_anamnese);

				$data = $row_anamnese['data'];
				$dataC = implode("/",array_reverse(explode("-",$data)));

				if(!$recuperar_anamnese) {
				    header("Location: listAnamnese.php?msg=5");
				}

			}

		}else if ($acao == 'atualizar') {

			if (isset($_POST['idAnamnese'])) {

				$idAnamnese  		 = $_POST['idAnamnese'];
				$removerQQ   	 	 = "DELETE FROM anamneseQQ WHERE idAnamnese = '$idAnamnese' ";
				$remover_QQ   	     = mysqli_query($conecta,$removerQQ);

				if(!$remover_QQ) {
				    header("Location: listAnamnese.php?msg=5");
				}

				$removerAnam   	 	 = "DELETE FROM anamnese WHERE idAnamnese = '$idAnamnese' ";
				$remover_Anam   	 = mysqli_query($conecta,$removerAnam);

				if(!$remover_Anam) {
				    header("Location: listAnamnese.php?msg=5");
				}
			}

			if (isset($_POST['idPaciente'])) {
				
				$idPaciente       	 = $_POST["idPaciente"];
			    $data            	 = $_POST["data"];

			    $dataC = implode("-",array_reverse(explode("/",$data)));
			        
			    $inserirAnamnese     = "INSERT INTO anamnese ";
			    $inserirAnamnese    .= "(idPaciente, data) ";
			    $inserirAnamnese    .= "VALUES ('$idPaciente', '$dataC') ";

			    $inserir_anamnese    = mysqli_query($conecta,$inserirAnamnese);
			    $anamneseID          = mysqli_insert_id($conecta);

			    if (isset($_POST['idQuestionario'])) {
			    	$idQuestionario    = $_POST['idQuestionario'];
			    	$discursiva        = $_POST['resposta'];
			    	$idQuestoes        = $_POST['idQuestoes'];


			    	for($i = 0; $i< count($idQuestoes); $i++){
					
						$inserirQQ    = "INSERT INTO anamneseQQ ";
						$inserirQQ   .= "(idAnamnese, idQuestionario, idQuestoes, discursiva)";
						$inserirQQ   .= "VALUES ";
						$inserirQQ   .= "('$anamneseID', '$idQuestionario', '$idQuestoes[$i]', '$discursiva[$i]' )";

						$inserir_QQ = mysqli_query($conecta, $inserirQQ);

						if (!$inserir_QQ) {
							header("Location: listAnamnese.php?msg=5");
						}else{
							header("Location: listAnamnese.php?msg=2");
						}
					}
				}
			}
			

		}
		   
	
  ?>
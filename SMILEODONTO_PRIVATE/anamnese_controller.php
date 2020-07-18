<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'recuperar') {

			$recuperarAlerta    = "SELECT *FROM alerta ";
			$recuperar_alerta   = mysqli_query($conecta,$recuperarAlerta);

			if(!$recuperar_alerta) {
			    header("Location: listCadAnamnese.php?msg=5");
			}

			$recuperarObg    = "SELECT *FROM obrigatoriedade ";
			$recuperar_obg   = mysqli_query($conecta,$recuperarObg);

			if(!$recuperar_obg) {
			    header("Location: listCadAnamnese.php?msg=5");
			}
			
		}else if ($acao == 'inserir'){

			if (!empty($_POST['anamnese'])) {
				$nomeFicha = $_POST['anamnese'];

				$inserirQuestionario    = "INSERT INTO questionario ";
				$inserirQuestionario   .= "(nomeFicha)";
				$inserirQuestionario   .= "VALUES ";
				$inserirQuestionario   .= "('$nomeFicha')";

				$inserir_questionario = mysqli_query($conecta, $inserirQuestionario);
				$questionarioID=mysqli_insert_id($conecta);

				if(!$inserir_questionario) {
				    header("Location: listCadAnamnese.php?msg=5");
				}

			}

			$pergunta      = $_POST['questao'];
			$obrigatorio   = $_POST['obrigatorio'];
			$alerta        = $_POST['alerta'];

			for($i = 0; $i< count($pergunta); $i++){
				
				$inserirQuestao    = "INSERT INTO questoes ";
				$inserirQuestao   .= "(enunciado, idAlerta, idObrigatoriedade)";
				$inserirQuestao   .= "VALUES ";
				$inserirQuestao   .= "('$pergunta[$i]', '$alerta[$i]', '$obrigatorio[$i]')";

				$inserir_questao = mysqli_query($conecta, $inserirQuestao);
				$questoesID = mysqli_insert_id($conecta);

				$inserirQQ    = "INSERT INTO questionarioQuestoes ";
				$inserirQQ   .= "(idQuestionario, idQuestoes)";
				$inserirQQ   .= "VALUES ";
				$inserirQQ   .= "('$questionarioID', '$questoesID')";

				$inserir_QQ = mysqli_query($conecta, $inserirQQ);

				if(!$inserir_questao && !$inserir_QQ) {
				    header("Location: listCadAnamnese.php?msg=5");
				}else{
					header("Location: listCadAnamnese.php?msg=1");
				}
			}
 
		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idQuestionario  = $_GET["id"];

					$select            = "SELECT idQuestoes FROM questionarioQuestoes WHERE idQuestionario = '$idQuestionario' ";
					$select_Questoes   = mysqli_query($conecta,$select);


					$removerQQ    = "DELETE FROM questionarioQuestoes WHERE idQuestionario = '$idQuestionario' ";
					$remover_QQ   = mysqli_query($conecta,$removerQQ);

					if(!$remover_QQ) {
					    header("Location: listCadAnamnese.php?msg=5");
					}

					$removerQuestionario    = "DELETE FROM questionario WHERE idQuestionario = '$idQuestionario' ";
					$remover_Questionario   = mysqli_query($conecta,$removerQuestionario);

					if(!$remover_Questionario) {
					    header("Location: listCadAnamnese.php?msg=5");
					}

					foreach ($select_Questoes as $idQuestoes) {
						
						$idQuestao = $idQuestoes['idQuestoes'];
						$removerQuestao    = "DELETE FROM questoes WHERE idQuestoes = '$idQuestao' ";
						$remover_Questao   = mysqli_query($conecta,$removerQuestao);

						if(!$remover_Questao) {
					    	header("Location: listCadAnamnese.php?msg=5");
						}
					}
					
					header("Location: listCadAnamnese.php?msg=3");
			}

		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idQuestionario  		  = $codigo;
			    $recuperarQuestionario    = "SELECT *FROM questionario WHERE idQuestionario = '$idQuestionario' ";
			    $recuperar_questionario   = mysqli_query($conecta,$recuperarQuestionario);

			    if(!$recuperar_questionario) {
			        header("Location: listCadAnamnese.php?msg=5");
				}

				$recuperarQuestao    = "SELECT q.enunciado, q.idAlerta, q.idObrigatoriedade FROM questionarioQuestoes qq, questoes q WHERE qq.idQuestionario = '$idQuestionario' AND q.idQuestoes = qq.idQuestoes ";
				$recuperar_Questao   = mysqli_query($conecta,$recuperarQuestao);

				if(!$recuperar_Questao) {
			        header("Location: listCadAnamnese.php?msg=5");
				}

				$recuperarAlerta    = "SELECT *FROM alerta ";
				$recuperar_alerta   = mysqli_query($conecta,$recuperarAlerta);

				if(!$recuperar_alerta) {
				    header("Location: listCadAnamnese.php?msg=5");
				}

				$recuperarObg    = "SELECT *FROM obrigatoriedade ";
				$recuperar_obg   = mysqli_query($conecta,$recuperarObg);

				if(!$recuperar_obg) {
				    header("Location: listCadAnamnese.php?msg=5");
				}
			}

		}else if($acao == 'atualizar'){

				$idQuestionario = $_POST['idQuestionario'];

				$condicao           = "SELECT distinct qq.idQuestionario, q.idQuestionario FROM questionarioQuestoes q, anamneseQQ qq WHERE q.idQuestionario = '$idQuestionario' AND qq.idQuestionario = q.idQuestionario ";
				$select_condicao   = mysqli_query($conecta,$condicao);
				$row_condicao      = mysqli_fetch_assoc($select_condicao);
				

				if (empty($row_condicao['idQuestionario'])) {

					$select            = "SELECT idQuestoes FROM questionarioQuestoes WHERE idQuestionario = '$idQuestionario' ";
					$select_Questoes   = mysqli_query($conecta,$select);

					$removerQQ    = "DELETE FROM questionarioQuestoes WHERE idQuestionario = '$idQuestionario' ";
					$remover_QQ   = mysqli_query($conecta,$removerQQ);

					if(!$remover_QQ) {
					    header("Location: listCadAnamnese.php?msg=5");
					}

					$removerQuestionario    = "DELETE FROM questionario WHERE idQuestionario = '$idQuestionario' ";
					$remover_Questionario   = mysqli_query($conecta,$removerQuestionario);

					if(!$remover_Questionario) {
					    header("Location: listCadAnamnese.php?msg=5");
					}

					foreach ($select_Questoes as $idQuestoes) {
						
						$idQuestao = $idQuestoes['idQuestoes'];
						$removerQuestao    = "DELETE FROM questoes WHERE idQuestoes = '$idQuestao' ";
						$remover_Questao   = mysqli_query($conecta,$removerQuestao);

						if(!$remover_Questao) {
					    	header("Location: listCadAnamnese.php?msg=5");
						}
					}

					if (!empty($_POST['anamnese'])) {
						$nomeFicha = $_POST['anamnese'];

						$inserirQuestionario    = "INSERT INTO questionario ";
						$inserirQuestionario   .= "(nomeFicha)";
						$inserirQuestionario   .= "VALUES ";
						$inserirQuestionario   .= "('$nomeFicha')";

						$inserir_questionario = mysqli_query($conecta, $inserirQuestionario);
						$questionarioID=mysqli_insert_id($conecta);

						if(!$inserir_questionario) {
						    header("Location: listCadAnamnese.php?msg=5");
						}
					}

					$pergunta      = $_POST['questao'];
					$obrigatorio   = $_POST['obrigatorio'];
					$alerta        = $_POST['alerta'];

					for($i = 0; $i< count($pergunta); $i++){
						
						$inserirQuestao    = "INSERT INTO questoes ";
						$inserirQuestao   .= "(enunciado, idAlerta, idObrigatoriedade)";
						$inserirQuestao   .= "VALUES ";
						$inserirQuestao   .= "('$pergunta[$i]', '$alerta[$i]', '$obrigatorio[$i]')";

						$inserir_questao = mysqli_query($conecta, $inserirQuestao);
						$questoesID = mysqli_insert_id($conecta);

						$inserirQQ    = "INSERT INTO questionarioQuestoes ";
						$inserirQQ   .= "(idQuestionario, idQuestoes)";
						$inserirQQ   .= "VALUES ";
						$inserirQQ   .= "('$questionarioID', '$questoesID')";

						$inserir_QQ = mysqli_query($conecta, $inserirQQ);

					}
					
					if(!$inserir_questao && !$inserir_QQ) {
						header("Location: listCadAnamnese.php?msg=5");
					}else{
						header("Location: listCadAnamnese.php?msg=2");
					}

				}else{
					header("Location: listCadAnamnese.php?msg=6");
				}
			}
?>
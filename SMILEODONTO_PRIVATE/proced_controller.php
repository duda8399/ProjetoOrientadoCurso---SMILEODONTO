
	<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

		    if(!empty($_POST["procedimento"])) {
		        $procedimento    	   = $_POST["procedimento"];
		        $valor     		       = $_POST["valor"];
		        $categoria             = $_POST["categoria"];
		        
		        $inserir    = "INSERT INTO procedimento ";
		        $inserir   .= "(nomeProcedimento, valor, idCategoria)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$procedimento', '$valor', '$categoria')";

		        $inserir_proced = mysqli_query($conecta,$inserir);
		        
		        if(!$inserir_proced) {
		            header("Location: listProcedimento.php?msg=5");
		    	}else {
		    		header("Location: listProcedimento.php?msg=1");
		    	}
		    }

		}else if ($acao == 'recuperar') {

			$recuperar    			= "SELECT *FROM categoria ORDER BY nomeCategoria ";
			$recuperar_categoria    = mysqli_query($conecta,$recuperar);

			if(!$recuperar_categoria) {
			    header("Location: listProcedimento.php?msg=5");
			}

		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idProcedimento  		= $codigo;
			    $recuperarProced        = "SELECT *FROM procedimento WHERE idProcedimento = '$idProcedimento'";
			    $recuperar_proced   	= mysqli_query($conecta,$recuperarProced);

			    if(!$recuperar_proced) {
			        header("Location: listProcedimento.php?msg=5");
				}

				$recuperar    			= "SELECT *FROM categoria ORDER BY nomeCategoria ";
				$recuperar_categoria    = mysqli_query($conecta,$recuperar);

				if(!$recuperar_categoria) {
				    header("Location: listProcedimento.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

		    if(!empty($_POST["procedimento"])) {
		    	$idProcedimento        = $_POST["idProcedimento"];
		        $nomeProcedimento      = $_POST["procedimento"];
		        $valor    	 		   = $_POST["valor"];
		        $idCategoria    	   = $_POST["categoria"];
		        
		        $atualizar    = "UPDATE procedimento ";
		        $atualizar   .= "SET nomeProcedimento = '$nomeProcedimento', valor = '$valor', idCategoria = '$idCategoria' ";
		        $atualizar   .= "WHERE idProcedimento = '$idProcedimento' ";

		        $atualizar_proced = mysqli_query($conecta,$atualizar);
		        if(!$atualizar_proced) {
		            header("Location: listProcedimento.php?msg=5");
		    	}else {
		    		header("Location: listProcedimento.php?msg=2");
		    	}
		    }

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

					$idProcedimento  		 = $_GET["id"];
				    $remover    	 		 = "DELETE FROM procedimento WHERE idProcedimento = '$idProcedimento' ";
				    $remover_proced   		 = mysqli_query($conecta,$remover);

				    if(!$remover_proced) {
				        header("Location: listProcedimento.php?msg=4");
				   	}else{
				   		header("Location: listProcedimento.php?msg=3");
				   	}
				
			}
		}
		   
	
  ?>

	<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

		    if(!empty($_POST["especialidade"])) {
		        $especialidade    	   = $_POST["especialidade"];
		        $descricao     		   = $_POST["descricao"];
		        
		        $inserir    = "INSERT INTO especialidade ";
		        $inserir   .= "(nomeEspecialidade, descricao)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$especialidade', '$descricao')";

		        $inserir_espec = mysqli_query($conecta,$inserir);
		        if(!$inserir_espec) {
		            header("Location: listEspecialidade.php?msg=5");
		    	}else {
		    		header("Location: listEspecialidade.php?msg=1");
		    	}
		    }

		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idEspecialidade  		= $codigo;
			    $recuperar    			= "SELECT *FROM especialidade WHERE idEspecialidade = '$idEspecialidade'";
			    $recuperar_espec   			= mysqli_query($conecta,$recuperar);

			    if(!$recuperar_espec) {
			        header("Location: listEspecialidade.php?msg=5");
				}
			}


		}else if ($acao == 'atualizar') {

		    if(!empty($_POST["especialidade"])) {
		    	$idEspecialidade         = $_POST["idEspecialidade"];
		        $nomeEspecialidade    	 = $_POST["especialidade"];
		        $descricao    	 		 = $_POST["descricao"];
		        
		        $atualizar    = "UPDATE especialidade ";
		        $atualizar   .= "SET nomeEspecialidade = '$nomeEspecialidade', descricao = '$descricao' ";
		        $atualizar   .= "WHERE idEspecialidade = '$idEspecialidade' ";

		        $atualizar_espec = mysqli_query($conecta,$atualizar);
		        if(!$atualizar_espec) {
		            header("Location: listEspecialidade.php?msg=5");
		    	}else {
		    		header("Location: listEspecialidade.php?msg=2");
		    	}
		    }

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idEspecialidade  		 = $_GET["id"];
			    $remover    	 		 = "DELETE FROM especialidade WHERE idEspecialidade = '$idEspecialidade' ";
			    $remover_espec   		 = mysqli_query($conecta,$remover);

			    if(!$remover_espec) {
			        header("Location: listEspecialidade.php?msg=4");
			   	}else{
			   		header("Location: listEspecialidade.php?msg=3");
			   	}
			}
		}
		   
	
  ?>
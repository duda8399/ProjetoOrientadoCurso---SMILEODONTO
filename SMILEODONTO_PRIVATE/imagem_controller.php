
	<?php 

		if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}
		$idPaciente = $_SESSION['paciente'];

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

		    if(!empty($_POST["nome"])) {
		        $nome    	   = $_POST["nome"];
		        $descricao     = $_POST["descricao"];
		        $data          = $_POST["dataCadastro"];
		        $foto          = $_FILES["foto"]['name'];

		        $dataC = implode("-",array_reverse(explode("/",$data)));
		        
		        $inserir    = "INSERT INTO imagem ";
		        $inserir   .= "(nome, descricao, data, foto, idPaciente)";
		        $inserir   .= "VALUES ";
		        $inserir   .= "('$nome', '$descricao', '$dataC', '$foto', '$idPaciente')";

		        $inserir_imagem = mysqli_query($conecta,$inserir);
		        $imagemID       = mysqli_insert_id($conecta);

		        if (!empty($foto)) {
		        	//Diretório onde o arquivo vai ser salvo
			        $diretorio = 'uploads/imagens/' . $idPaciente.'/';

			        //Criar a pasta de foto 
			        mkdir($diretorio, 0755);
			        
			        move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto);

			        if(!$inserir_imagem) {
		            	header("Location: listImagem.php?msg=5");
			    	}
		        }
		    }

		    header("Location: listImagem.php?msg=1");

		}else if ($acao == 'recuperarTudo') {

			if (isset($idPaciente)) {

			    $recuperar    	    = "SELECT *FROM imagem WHERE idPaciente = '$idPaciente'";
			    $recuperar_imagem   = mysqli_query($conecta,$recuperar);

			    if(!$recuperar_imagem) {
			        header("Location: listImagem.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

			if(!empty($_POST["idImagem"])) {

				if (!empty($_FILES["foto"]['tmp_name'])) {

			    	$idImagem         = $_POST["idImagem"];

			    	$recuperarFoto    = "SELECT idPaciente,foto FROM imagem WHERE idImagem = '$idImagem' ";
					$recuperar_foto   = mysqli_query($conecta,$recuperarFoto);

					foreach ($recuperar_foto as $row_foto) {
						$foto = $row_foto['foto'];
						$idPaciente = $row_foto['idPaciente'];
					}

					if (!empty($foto)) {

						unlink("uploads/imagens/".$idPaciente."/".$foto);
							
						$diretorio = 'uploads/imagens/'.$idPaciente.'/';
						rmdir($diretorio);	
					}

			        $nome    	 	  = $_POST["nome"];
			        $descricao    	  = $_POST["descricao"];
			        $data        	  = $_POST["dataCadastro"];
			        $foto       	  = $_FILES["foto"]['name'];
			        
			        $atualizar    = "UPDATE imagem ";
			        $atualizar   .= "SET nome = '$nome', descricao = '$descricao', data = '$data', foto = '$foto' ";
			        $atualizar   .= "WHERE idImagem = '$idImagem' ";

			        $atualizar_imagem = mysqli_query($conecta,$atualizar);

			        if (!empty($foto)) {
				        //Diretório onde o arquivo vai ser salvo
					    $diretorio = 'uploads/imagens/' . $idPaciente.'/';

					    //Criar a pasta de foto 
					    mkdir($diretorio, 0755);
					        
					    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto);

				        if(!$atualizar_imagem) {
				            header("Location: listImagem.php?msg=5");
				    	}else {
				    		header("Location: listImagem.php?msg=2");
				    	}
			    	}

			    }else if (empty($_FILES["fotoPaciente"]['tmp_name'])) {

			    	$idImagem         = $_POST["idImagem"];
			        $nome    	 	  = $_POST["nome"];
			        $descricao    	  = $_POST["descricao"];
			        $data        	  = $_POST["dataCadastro"];
			        
			        $atualizar    = "UPDATE imagem ";
			        $atualizar   .= "SET nome = '$nome', descricao = '$descricao', data = '$data' ";
			        $atualizar   .= "WHERE idImagem = '$idImagem' ";

			        $atualizar_imagem = mysqli_query($conecta,$atualizar);
			        if(!$atualizar_imagem) {
			            header("Location: listImagem.php?msg=5");
			    	}else {
			    		header("Location: listImagem.php?msg=2");
			    	}
			    }
		    }
		    

		}else if ($acao == 'recuperar') {

			if (isset($codigo)) {

				$idImagem  		    = $codigo;
			    $recuperarImagem    = "SELECT *FROM imagem WHERE idImagem = '$idImagem'";
			    $recuperar_imagem   = mysqli_query($conecta,$recuperarImagem);

			    if(!$recuperar_imagem) {
			        header("Location: listImagem.php?msg=5");
				}
			}

		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idImagem  		   = $_GET["id"];

				$recuperarFoto    = "SELECT idPaciente,foto FROM imagem WHERE idImagem = '$idImagem'  ";
				$recuperar_foto   = mysqli_query($conecta,$recuperarFoto);

				foreach ($recuperar_foto as $row_foto) {
					$foto = $row_foto['foto'];
					$idPaciente = $row_foto['idPaciente'];
				}

				if (!empty($foto)) {

					unlink("uploads/imagens/".$idPaciente."/".$foto);
							
					$diretorio = 'uploads/imagens/'.$idPaciente.'/';
					rmdir($diretorio);	
				}

			    $remover    	   = "DELETE FROM imagem WHERE idImagem = '$idImagem' ";
			    $remover_imagem    = mysqli_query($conecta,$remover);

			    if(!$remover_imagem) {
			        header("Location: listImagem.php?msg=5");
			   	}else{
			   		header("Location: listImagem.php?msg=3");
			   	}
			}
		}
		   
	
  ?>
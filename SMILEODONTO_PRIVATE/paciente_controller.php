
	<?php 

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(isset($_POST["nomePaciente"])) {
		        $nome       	 = $_POST["nomePaciente"];
		        $CPF   			 = $_POST["CPF"];
		        $RG     		 = $_POST["RG"];
		        $dataNascimento  = $_POST["dataNascimento"];
		        $sexo        	 = $_POST["sexo"];
		        $foto       	 = $_FILES["fotoPaciente"]['name'];
		        $bairro      	 = $_POST["bairro"];
		        $cep        	 = $_POST["cep"];
		        $numero      	 = $_POST["num"];
		        $complemento     = $_POST["complemento"];
		        $logradouro      = $_POST["logradouro"];
		        $idCidade        = $_POST["cidade"];
		        
		        $inserir     = "INSERT INTO pessoa ";
		        $inserir    .= "(nome,CPF,RG,dataNascimento,sexo,foto,bairro,";
		        $inserir    .= "cep,numero,complemento,logradouro,idCidade) ";
		        $inserir    .= "VALUES ";
		        $inserir    .= "('$nome','$CPF','$RG','$dataNascimento','$sexo','$foto', '$bairro','$cep','$numero','$complemento', '$logradouro','$idCidade')";

		        $operacao_inserir = mysqli_query($conecta,$inserir);
		        $pacienteID=mysqli_insert_id($conecta);

		        if (!empty($foto)) {
		        	//Diretório onde o arquivo vai ser salvo
			        $diretorio = 'uploads/' . $pacienteID.'/';

			        //Criar a pasta de foto 
			        mkdir($diretorio, 0755);
			        
			        move_uploaded_file($_FILES['fotoPaciente']['tmp_name'], $diretorio.$foto);

			        if(!$operacao_inserir) {
			            header("Location: listPacienteS.php?msg=5");
			    	}
		        }
		        
		    }

		    if(isset($_POST["dataCadastro"])) {

		        $dataCadastro    	     = $_POST["dataCadastro"];
		        $idPaciente   	 		 = $pacienteID;
		        $responsavel     		 = $_POST["responsavel"];
		        $nomeResponsavel		 = $_POST["nomeResponsavel"];
		        $telefoneResponsavel     = $_POST["telefoneResponsavel"];
		        $CPFResponsavel       	 = $_POST["CPFResponsavel"];
		        $RGResponsavel      	 = $_POST["RGResponsavel"];

		        $dataC = implode("-",array_reverse(explode("/",$dataCadastro)));
		        
		        $inserirPac    = "INSERT INTO paciente ";
		        $inserirPac    .= "(dataCadastro,idPaciente,responsavel,nomeResponsavel,";
		        $inserirPac    .= "telefoneResponsavel, CPFResponsavel, RGResponsavel)";
		        $inserirPac    .= "VALUES ";
		        $inserirPac    .= "('$dataC','$idPaciente','$responsavel','$nomeResponsavel','$telefoneResponsavel','$CPFResponsavel', '$RGResponsavel')";

		        $inserir_paciente = mysqli_query($conecta,$inserirPac);
		        if(!$inserir_paciente) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

		    if(!empty($_POST["email"])) {
		        $email    	   = $_POST["email"];
		        $idPessoa      = $pacienteID;
		        
		        $inserirEmail    = "INSERT INTO emailPessoa ";
		        $inserirEmail   .= "(idPessoa,email)";
		        $inserirEmail   .= "VALUES ";
		        $inserirEmail   .= "('$idPessoa', '$email')";

		        $inserir_email = mysqli_query($conecta,$inserirEmail);
		        if(!$inserir_email) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

		    if(isset($_POST["celular"])) {

		    	$celular    	  = $_POST["celular"];
		    	$telefoneRes      = $_POST["telefoneRes"];
		    	$telefoneRec   	  = $_POST["telefoneRec"];
		    	$idPessoa      = $pacienteID;
		        
		        $inserirTel    = "INSERT INTO telefonePessoa ";
		        $inserirTel   .= "(idPessoa, telefoneResidencial, telefoneCelular, telefoneRecado)";
		        $inserirTel   .= "VALUES ";
		        $inserirTel   .= "('$idPessoa', '$telefoneRes', '$celular', '$telefoneRec')";

		        $inserir_telefone = mysqli_query($conecta,$inserirTel);
		        if(!$inserir_telefone) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    	
			}

			header("Location: listPacienteS.php?msg=1");

		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idPessoa  		    = $codigo;
			    $recuperarPessoa    = "SELECT *FROM pessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_pessoa   = mysqli_query($conecta,$recuperarPessoa);

			    if(!$recuperar_pessoa) {
			        header("Location: listPacienteS.php?msg=5");
				}

			    $recuperarPaciente    = "SELECT *FROM paciente WHERE idPaciente = '$idPessoa' ";
			    $recuperar_paciente   = mysqli_query($conecta,$recuperarPaciente);

			    if(!$recuperar_paciente) {
			        header("Location: listPacienteS.php?msg=5");
				}

				$recuperarEmail    = "SELECT *FROM emailPessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_email   = mysqli_query($conecta,$recuperarEmail);

			    if(!$recuperar_email) {
			        header("Location: listPacienteS.php?msg=5");
				}

				$recuperarTelefone    = "SELECT *FROM telefonePessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_telefone   = mysqli_query($conecta,$recuperarTelefone);

			    if(!$recuperar_telefone) {
			        header("Location: listPacienteS.php?msg=5");
				}

				$recuperarEstados    = "SELECT *FROM uf ";
			    $recuperar_estados   = mysqli_query($conecta,$recuperarEstados);

			    if(!$recuperar_estados) {
			        header("Location: listPacienteS.php?msg=5");
				}

				$recuperarCidades    = "SELECT *FROM cidade ";
			    $recuperar_cidades   = mysqli_query($conecta,$recuperarCidades);

			    if(!$recuperar_cidades) {
			        header("Location: listPacienteS.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

			if (!empty($_FILES["fotoPaciente"]['tmp_name'])) {

					$idPessoa        = $_POST['idPessoa'];
					
					$recuperarFoto    = "SELECT foto FROM pessoa WHERE idPessoa = '$idPessoa' ";
					$recuperar_foto   = mysqli_query($conecta,$recuperarFoto);

					foreach ($recuperar_foto as $row_foto) {
						$foto = $row_foto['foto'];
					}

					if (!empty($foto)) {

						unlink("uploads/".$idPessoa."/".$foto);
							
						$diretorio = 'uploads/'.$idPessoa.'/';
						rmdir($diretorio);
					}

					$nome       	 = $_POST["nomePaciente"];
			        $CPF   			 = $_POST["CPF"];
			        $RG     		 = $_POST["RG"];
			        $dataNascimento  = $_POST["dataNascimento"];
			        $sexo        	 = $_POST["sexo"];
			        $foto       	 = $_FILES["fotoPaciente"]['name'];
			        $bairro      	 = $_POST["bairro"];
			        $cep        	 = $_POST["cep"];
			        $numero      	 = $_POST["num"];
			        $complemento     = $_POST["complemento"];
			        $logradouro      = $_POST["logradouro"];
			        $idCidade        = $_POST["cidade"];

			        $atualizarPac    = "UPDATE pessoa SET ";
			        $atualizarPac    .= "nome = '$nome', CPF = '$CPF', RG = '$RG', dataNascimento = '$dataNascimento', ";
			        $atualizarPac    .= "sexo = '$sexo', bairro = '$bairro', foto = '$foto', cep = '$cep', ";
			        $atualizarPac    .= "numero = '$numero', complemento = '$complemento', logradouro = '$logradouro', ";
			        $atualizarPac    .= "idCidade = '$idCidade' ";
			        $atualizarPac    .= "WHERE idPessoa = '$idPessoa' ";

			        $operacao_atualizar = mysqli_query($conecta,$atualizarPac);

			       if (!empty($foto)) {
			        //Diretório onde o arquivo vai ser salvo
				    $diretorio = 'uploads/' . $idPessoa.'/';

				    //Criar a pasta de foto 
				    mkdir($diretorio, 0755);
				        
				    move_uploaded_file($_FILES['fotoPaciente']['tmp_name'], $diretorio.$foto);

				    if(!$operacao_atualizar) {
				        header("Location: listPacienteS.php?msg=5");
				    }
			    }

			} else if (empty($_FILES["fotoPaciente"]['tmp_name'])) {

				$idPessoa        = $_POST['idPessoa'];
			    $nome       	 = $_POST["nomePaciente"];
			    $CPF   			 = $_POST["CPF"];
			    $RG     		 = $_POST["RG"];
			    $dataNascimento  = $_POST["dataNascimento"];
			    $sexo        	 = $_POST["sexo"];
			    $bairro      	 = $_POST["bairro"];
			    $cep        	 = $_POST["cep"];
			    $numero      	 = $_POST["num"];
			    $complemento     = $_POST["complemento"];
			    $logradouro      = $_POST["logradouro"];
			    $idCidade        = $_POST["cidade"];

			    $atualizarPac    = "UPDATE pessoa SET ";
			    $atualizarPac    .= "nome = '$nome', CPF = '$CPF', RG = '$RG', dataNascimento = '$dataNascimento', ";
			    $atualizarPac    .= "sexo = '$sexo', bairro = '$bairro', cep = '$cep', ";
			    $atualizarPac    .= "numero = '$numero', complemento = '$complemento', logradouro = '$logradouro', ";
			    $atualizarPac    .= "idCidade = '$idCidade' ";
			    $atualizarPac    .= "WHERE idPessoa = '$idPessoa' ";

			    $operacao_atualizar = mysqli_query($conecta,$atualizarPac);
			    
			    if(!$operacao_atualizar) {
			        header("Location: listPacienteS.php?msg=5");
			    }
		   	}

		   	if(isset($_POST["dataCadastro"])) {
		        $dataCadastro    	     = $_POST["dataCadastro"];
		        $responsavel     		 = $_POST["responsavel"];
		        $nomeResponsavel		 = $_POST["nomeResponsavel"];
		        $telefoneResponsavel     = $_POST["telefoneResponsavel"];
		        $CPFResponsavel       	 = $_POST["CPFResponsavel"];
		        $RGResponsavel      	 = $_POST["RGResponsavel"];

		        $dataC = implode("-",array_reverse(explode("/",$dataCadastro)));
		        
		        $atualizarPaci    = "UPDATE paciente SET ";
		        $atualizarPaci    .= "dataCadastro = '$dataC', responsavel = '$responsavel',";
		        $atualizarPaci    .= "nomeResponsavel = '$nomeResponsavel', telefoneResponsavel = '$telefoneResponsavel', CPFResponsavel = '$CPFResponsavel', RGResponsavel = '$RGResponsavel' ";
		        $atualizarPaci    .= "WHERE idPaciente = '$idPessoa' ";

		        $atualizar_pac = mysqli_query($conecta,$atualizarPaci);
		        if(!$atualizar_pac) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

		   	if(!empty($_POST["emailNovo"])) {
		        $emailNovo    	   = $_POST["emailNovo"];
		        
		        $inserirEmail    = "INSERT INTO emailPessoa ";
		        $inserirEmail   .= "(idPessoa,email)";
		        $inserirEmail   .= "VALUES ";
		        $inserirEmail   .= "('$idPessoa', '$emailNovo')";

		        $inserir_email = mysqli_query($conecta,$inserirEmail);
		        if(!$inserir_email) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

		    if(!empty($_POST["email"])) {
		        $email    	   = $_POST["email"];
		        
		        $atualizarEmail    = "UPDATE emailPessoa ";
		        $atualizarEmail   .= "SET email = '$email'";
		        $atualizarEmail   .= "WHERE idPessoa = '$idPessoa' ";

		        $atualizar_email = mysqli_query($conecta,$atualizarEmail);
		        if(!$atualizar_email) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

		    if(isset($_POST["celular"])) {
		        $celular    	  = $_POST["celular"];
		    	$telefoneRes      = $_POST["telefoneRes"];
		    	$telefoneRec   	  = $_POST["telefoneRec"];
		        
		        $atualizarTel     = "UPDATE telefonePessoa SET ";
		        $atualizarTel    .= "telefoneCelular = '$celular', telefoneResidencial = '$telefoneRes', telefoneRecado = '$telefoneRec' ";
		        $atualizarTel    .= "WHERE idPessoa = '$idPessoa' ";

		        $atualizar_tel = mysqli_query($conecta,$atualizarTel);
		        if(!$atualizar_tel) {
		            header("Location: listPacienteS.php?msg=5");
		    	}
		    }

			header("Location: listPacienteS.php?msg=2");


		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idPessoa  		 = $_GET["id"];

				    $removerEmail    = "DELETE FROM emailPessoa WHERE idPessoa = '$idPessoa' ";
				    $remover_email   = mysqli_query($conecta,$removerEmail);

				    if(!$remover_email) {
				        header("Location: listPacienteS.php?msg=5");
				   	}

				    $removerTelefone    = "DELETE FROM telefonePessoa WHERE idPessoa = '$idPessoa' ";
				    $remover_telefone   = mysqli_query($conecta,$removerTelefone);

				    if(!$remover_telefone) {
				        header("Location: listPacienteS.php?msg=5");
				   	}

				    $removerPaciente    = "DELETE FROM paciente WHERE idPaciente = '$idPessoa' ";
				    $remover_paciente   = mysqli_query($conecta,$removerPaciente);

				    if(!$remover_paciente) {
				        header("Location: listPacienteS.php?msg=5");
				   	}

				   	$recuperarFoto    = "SELECT foto FROM pessoa WHERE idPessoa = '$idPessoa' ";
				    $recuperar_foto   = mysqli_query($conecta,$recuperarFoto);

				    foreach ($recuperar_foto as $row_foto) {
						$foto = $row_foto['foto'];
					}

					if (!empty($foto)) {

						unlink("uploads/".$idPessoa."/".$foto);

						$diretorio = 'uploads/'.$idPessoa.'/';
						rmdir($diretorio);
					}
				
				    $removerPessoa      = "DELETE FROM pessoa WHERE idPessoa = '$idPessoa' ";
				    $remover_pessoa     = mysqli_query($conecta,$removerPessoa);

				    if(!$remover_pessoa) {
				        header("Location: listPacienteS.php?msg=5");
				   	}else{
				   		header("Location: listPacienteS.php?msg=3");
				   	}
				
			}
		}
		   
	
  ?>
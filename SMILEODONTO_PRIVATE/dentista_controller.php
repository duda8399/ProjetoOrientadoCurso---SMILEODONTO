
	<?php

		require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'inserir') {

			if(isset($_POST["nomeDentista"])) {
		        $nome       	 = $_POST["nomeDentista"];
		        $CPF   			 = $_POST["CPF"];
		        $RG     		 = $_POST["RG"];
		        $dataNascimento  = $_POST["dataNascimento"];
		        $sexo        	 = $_POST["sexo"];
		        $foto       	 = $_FILES["fotoDentista"]['name'];
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
		        $pessoaID=mysqli_insert_id($conecta);

		        if (!empty($foto)) {
		        	//Diretório onde o arquivo vai ser salvo
			        $diretorio = 'uploads/' .$pessoaID.'/';

			        //Criar a pasta de foto 
			        mkdir($diretorio, 0755);
			        
			        move_uploaded_file($_FILES['fotoDentista']['tmp_name'], $diretorio.$foto);

			        if(!$operacao_inserir) {
			            header("Location: listDentista.php?msg=5");
			    	}
		        }
		        
		    }

		    if(isset($_POST["login"])) {
		        $login    	         = $_POST["login"];
		        $idFuncionario   	 = $pessoaID;
		        $senha     		     = $_POST["senha"];
		        $cargo               = $_POST["cargo"];
		        $dataInicio          = $_POST["dataEntrada"];
		        $dataFim             = $_POST["dataSaida"];

		        $dataC = implode("-",array_reverse(explode("/",$dataInicio)));
   
		        $inserirFunc    = "INSERT INTO funcionario ";
		        $inserirFunc    .= "(funUsuario,funSenha,idFuncionario, idCargo, dataInicio, dataFim) ";
		        $inserirFunc    .= "VALUES ";
		        $inserirFunc    .= "('$login','$senha','$idFuncionario', '$cargo', '$dataC', '$dataFim')";

		        $inserir_func = mysqli_query($conecta,$inserirFunc);
		        if(!$inserir_func) {
		            header("Location: listDentista.php?msg=5");
		    	}
		    }

		    if(isset($_POST["CRO"])) {
		        $idDentista   	 = $pessoaID;
		        $CRO     		 = $_POST["CRO"];
		        $siglaConselho   = $_POST["sigla"];
		        $ufConselho   	 = $_POST["ufConselho"];
		        $especialidade   = $_POST["especialidade"];

		        
		        $inserirDent    = "INSERT INTO dentista ";
		        $inserirDent    .= "(idDentista, CRO, siglaConselho, ufConselho, idEspecialidade) ";
		        $inserirDent    .= "VALUES ";
		        $inserirDent    .= "('$idDentista', '$CRO', '$siglaConselho', '$ufConselho', '$especialidade')";

		        $inserir_dent = mysqli_query($conecta,$inserirDent);
		        if(!$inserir_dent) {
		            header("Location: listDentista.php?msg=5");
		    	}
		    }

			if(!empty($_POST["email"])) {
			        $email    	   = $_POST["email"];
			        $idPessoa      = $pessoaID;
			        
			        $inserirEmail    = "INSERT INTO emailPessoa ";
			        $inserirEmail   .= "(idPessoa,email)";
			        $inserirEmail   .= "VALUES ";
			        $inserirEmail   .= "('$idPessoa', '$email')";

			        $inserir_email = mysqli_query($conecta,$inserirEmail);
			        if(!$inserir_email) {
			            header("Location: listDentista.php?msg=5");
			    	}
			}

			if(isset($_POST["celular"])) {

			    	$celular    	  = $_POST["celular"];
			    	$telefoneRes      = $_POST["telefoneRes"];
			    	$telefoneRec   	  = $_POST["telefoneRec"];
			    	$idPessoa      	  = $pessoaID;
			        
			        $inserirTel    = "INSERT INTO telefonePessoa ";
			        $inserirTel   .= "(idPessoa, telefoneResidencial, telefoneCelular, telefoneRecado)";
			        $inserirTel   .= "VALUES ";
			        $inserirTel   .= "('$idPessoa', '$telefoneRes', '$celular', '$telefoneRec')";

			        $inserir_telefone = mysqli_query($conecta,$inserirTel);
			        if(!$inserir_telefone) {
			            header("Location: listDentista.php?msg=5");
			    	} 	
			}
		    
			header("Location: listDentista.php?msg=1");

		}else if ($acao == 'recuperar'){

			$recuperarEspecialidade    = "SELECT *FROM especialidade ";
			$recuperar_espec   		   = mysqli_query($conecta,$recuperarEspecialidade);

			if(!$recuperar_espec) {
			    header("Location: listDentista.php?msg=5");
			}

			$recuperarUF    = "SELECT *FROM uf ";
			$recuperar_uf   = mysqli_query($conecta,$recuperarUF);

			if(!$recuperar_uf) {
			    header("Location: listDentista.php?msg=5");
			}

			$recuperarCargo    = "SELECT *FROM cargo WHERE idCargo = 4";
			$recuperar_cargo   = mysqli_query($conecta,$recuperarCargo);

			if(!$recuperar_cargo) {
			    header("Location: listDentista.php?msg=5");
			}
	
		}else if ($acao == 'remover') {

			if (isset($_GET['id'])) {

				$idPessoa  		 = $_GET["id"];

				    $removerEmail    = "DELETE FROM emailPessoa WHERE idPessoa = '$idPessoa' ";
				    $remover_email   = mysqli_query($conecta,$removerEmail);

				    if(!$remover_email) {
				        header("Location: listDentista.php?msg=5");
				   	}

				    $removerTelefone    = "DELETE FROM telefonePessoa WHERE idPessoa = '$idPessoa' ";
				    $remover_telefone   = mysqli_query($conecta,$removerTelefone);

				    if(!$remover_telefone) {
				        header("Location: listDentista.php?msg=5");
				   	}

				   	$removerDentista    = "DELETE FROM dentista WHERE idDentista = '$idPessoa' ";
				    $remover_dentista   = mysqli_query($conecta,$removerDentista);

				    if(!$remover_dentista) {
				        header("Location: listDentista.php?msg=5");
				   	}

				   	$removerFuncionario    = "DELETE FROM funcionario WHERE idFuncionario = '$idPessoa' ";
				    $remover_funcionario   = mysqli_query($conecta,$removerFuncionario);

				    if(!$remover_funcionario) {
				        header("Location: listDentista.php?msg=5");
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
				        header("Location: listDentista.php?msg=5");
				   	}else{
				   		header("Location: listDentista.php?msg=3");
				   	}
				
			}

		}else if ($acao == 'recuperarTudo') {

			if (isset($codigo)) {

				$idPessoa  		    = $codigo;
			    $recuperarPessoa    = "SELECT *FROM pessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_pessoa   = mysqli_query($conecta,$recuperarPessoa);

			    if(!$recuperar_pessoa) {
			        header("Location: listDentista.php?msg=5");
				}

			    $recuperarDentista    = "SELECT *FROM dentista WHERE idDentista = '$idPessoa' ";
			    $recuperar_dentista   = mysqli_query($conecta,$recuperarDentista);

			    if(!$recuperar_dentista) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarFuncionario    = "SELECT *FROM funcionario WHERE idFuncionario = '$idPessoa' ";
			    $recuperar_funcionario   = mysqli_query($conecta,$recuperarFuncionario);

			    if(!$recuperar_funcionario) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarEmail    = "SELECT *FROM emailPessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_email   = mysqli_query($conecta,$recuperarEmail);

			    if(!$recuperar_email) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarTelefone    = "SELECT *FROM telefonePessoa WHERE idPessoa = '$idPessoa' ";
			    $recuperar_telefone   = mysqli_query($conecta,$recuperarTelefone);

			    if(!$recuperar_telefone) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarEstados    = "SELECT *FROM uf ";
			    $recuperar_estados   = mysqli_query($conecta,$recuperarEstados);

			    if(!$recuperar_estados) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarCidades    = "SELECT *FROM cidade ";
			    $recuperar_cidades   = mysqli_query($conecta,$recuperarCidades);

			    if(!$recuperar_cidades) {
			        header("Location: listDentista.php?msg=5");
				}

				$recuperarEspecialidade    = "SELECT *FROM especialidade ";
				$recuperar_espec   		   = mysqli_query($conecta,$recuperarEspecialidade);

				if(!$recuperar_espec) {
				    header("Location: listDentista.php?msg=5");
				}

				$recuperarCargo    = "SELECT *FROM cargo WHERE idCargo = 4";
				$recuperar_cargo   = mysqli_query($conecta,$recuperarCargo);

				if(!$recuperar_cargo) {
				    header("Location: listDentista.php?msg=5");
				}
			}

		}else if ($acao == 'atualizar') {

			if (!empty($_FILES["fotoDentista"]['tmp_name'])) {


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

		        $nome       	 = $_POST["nomeDentista"];
		        $CPF   			 = $_POST["CPF"];
		        $RG     		 = $_POST["RG"];
		        $dataNascimento  = $_POST["dataNascimento"];
		        $sexo        	 = $_POST["sexo"];
		        $foto       	 = $_FILES["fotoDentista"]['name'];
		        $bairro      	 = $_POST["bairro"];
		        $cep        	 = $_POST["cep"];
		        $numero      	 = $_POST["num"];
		        $complemento     = $_POST["complemento"];
		        $logradouro      = $_POST["logradouro"];
		        $idCidade        = $_POST["cidade"];

		        $atualizarPes    = "UPDATE pessoa SET ";
		        $atualizarPes    .= "nome = '$nome', CPF = '$CPF', RG = '$RG', dataNascimento = '$dataNascimento', ";
		        $atualizarPes    .= "sexo = '$sexo', bairro = '$bairro', foto = '$foto', cep = '$cep', ";
		        $atualizarPes    .= "numero = '$numero', complemento = '$complemento', logradouro = '$logradouro', ";
		        $atualizarPes    .= "idCidade = '$idCidade' ";
		        $atualizarPes    .= "WHERE idPessoa = '$idPessoa' ";

		        $operacao_atualizar = mysqli_query($conecta,$atualizarPes);

		        if (!empty($foto)) {
		        	//Diretório onde o arquivo vai ser salvo
			        $diretorio = 'uploads/' . $idPessoa.'/';

			        //Criar a pasta de foto 
			        mkdir($diretorio, 0755);
			        
			        move_uploaded_file($_FILES['fotoDentista']['tmp_name'], $diretorio.$foto);

			        if(!$operacao_atualizar) {
			            header("Location: listDentista.php?msg=5");
			    	}
		        }

		    } else if (empty($_FILES["fotoDentista"]['tmp_name'])) {

		    	$idPessoa        = $_POST['idPessoa'];
		    	$nome       	 = $_POST["nomeDentista"];
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

		        $atualizarPes    = "UPDATE pessoa SET ";
		        $atualizarPes    .= "nome = '$nome', CPF = '$CPF', RG = '$RG', dataNascimento = '$dataNascimento', ";
		        $atualizarPes    .= "sexo = '$sexo', bairro = '$bairro', cep = '$cep', ";
		        $atualizarPes    .= "numero = '$numero', complemento = '$complemento', logradouro = '$logradouro', ";
		        $atualizarPes    .= "idCidade = '$idCidade' ";
		        $atualizarPes    .= "WHERE idPessoa = '$idPessoa' ";

		        $operacao_atualizar = mysqli_query($conecta,$atualizarPes);
		        
		        if(!$operacao_atualizar) {
			        header("Location: listDentista.php?msg=5");
			    }
		    }

		    if(isset($_POST["login"])) {
		        $idFuncionario    	 = $_POST["idPessoa"];
		        $funUsuario    	     = $_POST["login"];
		        $funSenha   	     = $_POST["senha"];
		        $dataInicio    	     = $_POST["dataEntrada"];
		        $dataFim   	     	 = $_POST["dataSaida"];
		        $idCargo    	     = $_POST["cargo"];

		        $dataC = implode("-",array_reverse(explode("/",$dataInicio)));
		        	        
		        $atualizarFunc    = "UPDATE funcionario SET ";
		        $atualizarFunc   .= "funUsuario = '$funUsuario', funSenha = '$funSenha', dataInicio = '$dataC', dataFim = '$dataFim', idCargo = '$idCargo' ";
		        $atualizarFunc    .= "WHERE idFuncionario = '$idFuncionario' ";

		        $atualizar_func = mysqli_query($conecta,$atualizarFunc);
		        if(!$atualizar_func) {
		            header("Location: listDentista.php?msg=5");
		    	}
		    }

		    if(isset($_POST["CRO"])) {
		        $idDentista    	    = $_POST["idPessoa"];
		        $CRO                = $_POST["CRO"];
		        $siglaConselho      = $_POST["sigla"];
		        $ufConselho         = $_POST["ufConselho"];
		        $especialidade      = $_POST["especialidade"];
		        
		        $atualizarDent    = "UPDATE dentista SET ";
		        $atualizarDent    .= "CRO = '$CRO', siglaConselho = '$siglaConselho', ufConselho = '$ufConselho', idEspecialidade = '$especialidade' ";
		        $atualizarDent    .= "WHERE idDentista = '$idDentista' ";

		        $atualizar_dent = mysqli_query($conecta,$atualizarDent);
		        if(!$atualizar_dent) {
		            header("Location: listDentista.php?msg=5");
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
		            header("Location: listDentista.php?msg=5");
		    	}
		    }

		    if(!empty($_POST["email"])) {
		        $email    	   = $_POST["email"];
		        
		        $atualizarEmail    = "UPDATE emailPessoa ";
		        $atualizarEmail   .= "SET email = '$email'";
		        $atualizarEmail   .= "WHERE idPessoa = '$idPessoa' ";

		        $atualizar_email = mysqli_query($conecta,$atualizarEmail);
		        if(!$atualizar_email) {
		            header("Location: listDentista.php?msg=5");
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
		            header("Location: listDentista.php?msg=5");
		    	}
		    }

			header("Location: listDentista.php?msg=2");

		}
	
  ?>		

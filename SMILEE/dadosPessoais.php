<?php
	session_start();
	if (isset($_GET['id'])) {
		$idPaciente = $_GET['id'];
		$_SESSION['paciente'] = $idPaciente;
	}

	require 'dadosPessoais_controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <!-- Javacript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

		<title>Smile Odonto</title>

	</head>
	<body>

		<div class="page-wrap">
			<!--Início do Navbar-->
			  <?php include_once("_incluir/navbarDentista.php")  ?>
			<!--Fim do Navbar-->

			<div class="inside">
				<!--Início do Conteúdo-->
					<section>
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-3">
									<?php
										if (isset($_SESSION['paciente'])) {
											include_once("_incluir/menuDentista.php");
										}else{
									?>
									<div class="menu-lateral">
										<div class="cabecalho">
											<h3>Cadastrar Pacientes</h3>
										</div>
										<div class="corpo-menu">
											<img src="img/foto.png">
											<p>Nenhum paciente selecionado.</p>
											<hr class="hr-menu">
											<div class="botoes">
												<a href="listPaciente.php" name="localizar" class="btn btn-verde text-white">Localizar Paciente</a>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>

								<div class="col-lg-9">
									<div class="conteudo">
										<div class="cabecalho-conteudo">
											<i class="fas fa-address-book icon-conteudo"></i>
											<h3>Dados Pessoais</h3>
										</div>

										<?php foreach ($recuperar_pac as $pac) {  ?>

										<div class="row">
											<div class="col-lg-5 ml-2 mt-2">
												<label class="dado">Paciente:</label>
												<span class="ml-1"><?php echo $pac['nome']; ?></span>
											</div>

											<div class="col-lg-4 ml-2 mt-2">
												<label class="dado">CPF:</label>
												<span class="ml-1"><?php echo $pac['CPF']; ?></span>
											</div>

											<div class="col-lg-5 ml-2 mt-2">
												<label class="dado">Data do Cadastro:</label>
												<span class="ml-1">
													<?php $dataCadastro = $pac['dataCadastro'];
														$dataC = implode("/",array_reverse(explode("-",$dataCadastro))); 
														echo $dataC; ?></span>
											</div>

											<div class="col-lg-4 ml-2 mt-2">
												<label class="dado">Data de nascimento:</label>
												<span class="ml-1">
													<?php 
														$dataNasc = $pac['dataNascimento'];
														$data = implode("/",array_reverse(explode("-",$dataNasc))); 
														echo $data;
														?>
															
												</span>
											</div>

											<div class="col-lg-5 ml-2 mt-2">
												<label class="dado">Logradouro:</label>
												<span class="ml-1"><?php echo $pac['logradouro']; ?></span>
											</div>

											<div class="col-lg-4 ml-2 mt-2">
												<label class="dado">Cidade:</label>
												<span class="ml-1"><?php echo $pac['nomeCidade']; ?></span>
											</div>

											<div class="col-lg-3 ml-2 mt-2">
												<label class="dado">Contato:</label>
												<i class="fas fa-phone icon-dados"></i>
												<span class="ml-1">
													<?php echo $pac['telefoneResidencial']; ?>
												</span>
											</div>

											<div class="col-lg-3 ml-2 mt-2">
												<i class="fas fa-mobile icon-dados"></i>
												<span class="ml-1">
													<?php echo $pac['telefoneCelular']; ?>
												</span>
											</div>

											<div class="col-lg-3 ml-2 mt-2">
												<i class="fas fa-envelope icon-dados"></i>
												<span class="ml-1">
													<?php echo $pac['email']; ?>
												</span>
											</div>

										<?php } ?>
										</div>

										<div class="cabecalho-conteudo mt-2">
											<i class="fas fa-file-alt icon-conteudo"></i>
											<h3>Alertas</h3>
										</div>

										<div class="row">
											<div class="col-lg-9">
												<h2 class="text-center alert"><i class="fas fa-exclamation-triangle icon-alert"></i>ALERTAS</h2>
											</div>

											<?php for ($i=0; $i< count($alertas); $i++) { ?>

												<div class="col-lg-5 mt-2 ml-2 mb-2">
													<label class="dado"><?php echo $alertas[$i]['enunciado']; ?></label><br>
													<span><?php echo $alertas[$i]['discursiva']; ?></span>
												</div>

											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				<!--Fim do Conteúdo-->
			</div>
		</div>

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

		<div class="modal fade" data-backdrop="static" id="enviarEmail" tabindex="-1" role="dialog" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
			      	<!-- Modal Cabeçalho -->
                    <div class="modalHeader">
                        <h3><i class="fas fa-envelope icon-modal"></i>Enviar e-mail</h3>
                                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Cabeçalho -->
			    	<form method="POST" action="enviarEmail.php">
                        <div class="modal-body body"> 
                        	<div class="container-fluid">
                        		<div class="row">

                        			<div class="col-lg-3">
                        				<label for="destinatario">Para:</label>
                        			</div>
                        			<div class="col-lg-9">
                        				<input type="email" name="destinatario" class="form-control" id="destinatario" required placeholder="joao@gmail.com">
                        			</div>

                        			<div class="col-lg-3 pt-3">
                        				<label for="assunto">Assunto:</label>
                        			</div>
                        			<div class="col-lg-9 pt-3">
                        				<input type="text" name="assunto" class="form-control" id="assunto" required placeholder="Assunto do e-mail">
                        			</div>

                        			<div class="col-lg-3 pt-3">
                        				<label for="Mensagem">Mensagem:</label>
                        			</div>
                        			<div class="col-lg-9 pt-3">
                        				<textarea rows="3" cols="37" id="mensagem" name="mensagem" class="form-control"></textarea>
                        			</div>

                        		</div>
                        	</div>       
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-azul text-white">Limpar campos</button>
                            <button type="submit" name="cadastrar" class="btn btn-verde text-white">Enviar</button>
                        </div>
                    </form>
		    	</div>
		  </div>
		</div>

		<script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'paciente_controller.php?acao=remover&id='+ cod;
				if(!$('#confirm-delete').length){
					$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
				}
				$('#dataComfirmOK').attr('href', href);
		        $('#confirm-delete').modal({show: true});
				return false;
				});
		</script>
	</body>
			
</html>


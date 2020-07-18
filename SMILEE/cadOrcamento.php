<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}

	if (isset($_GET['id'])) {
		$codigo = $_GET['id'];
		$_SESSION['tratamento'] = $codigo;
	}
	
	$acao = 'recuperar';
	require 'odonto_controller.php';
	
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
		<!-- Datatable -->
		
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

		<script>
			$(document).ready(function() {
			    $('#listar-procedTrat').DataTable({
	        		"serverSide": true,
	                "ajax": {
			            "url": "list_procedTrat.php",
			            "type": "POST"
			        },
			        "language": {
						"url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
					},
			    });    
			} );
		</script>

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
								<!--Início do Menu Lateral-->
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
								<!--Fim do Menu Lateral-->

								<div class="col-lg-9">
									<div class="conteudo">
										<div class="cabecalho-conteudo">
											<i class="fas fa-file-invoice-dollar icon-conteudo"></i>
											<h3>Orçamentos</h3>
										</div>

										<div class="row">

											<div class="col-lg-12">
												<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
													<div class="alert alert-success alert-dismissible fade show" role="alert">
													  Procedimento CADASTRADO com sucesso!
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
													</div>
												<?php } ?>

												<?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
													<div class="alert alert-warning alert-dismissible fade show" role="alert">
													  Procedimento ATUALIZADO com sucesso!
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
													</div>
												<?php } ?>

												<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
													<div class="alert alert-danger alert-dismissible fade show" role="alert">
													  Procedimento EXCLUÍDO com sucesso!
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
													</div>
												<?php } ?>

												<?php if(isset ($_GET['msg']) && $_GET['msg'] == 5){ ?>
													<div class="alert bg-danger alert-dismissible fade show text-white" role="alert">
													  ERRO - Por favor, tente mais tarde!
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
													</div>
												<?php } ?>
											</div>

											<div class="col-lg-8 m-2">
												<label>Paciente: </label>
												<span><?php echo $row_pac['nome']; ?></span>
												<label class="ml-5">Orçamento: </label>
												<span><?php echo $_SESSION['tratamento']; ?></span>
											</div>
											<div class="col-lg-3 mt-2">
												<a href="odonto_controller.php?acao=enviar" class="btn btn-info ml-5">Enviar Orçamento</a>
											</div>

											<div class="col-lg-12">
												<!-- Nav tabs -->
			  									<ul class="nav nav-tabs mt-2">
													<li class="nav-item active">
														<a href="#odontograma" class="nav-link" role="tab" data-toggle="tab">Odontograma</a>
														</li>
													<li class="nav-item">
														<a href="#procedimentos" class="nav-link" role="tab" data-toggle="tab">Procedimentos</a>
													</li>
			 									</ul>

			 									<!-- Tab panes -->
			  									<div class="tab-content">

			  										<div role="tabpanel" class="tab-pane active" id="odontograma">
														<form action="odonto_controller.php?acao=inserir" method="POST">

									                       <div class="form-row form1">
									                       		<div class="col-lg-12 pb-3 pt-3">
							                                    	<div style="overflow: hidden;width: 900px;margin: auto;">

										                              	<img src="img/18.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/17.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/16.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/15.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/14.png" style="margin: 0px;padding: 0px;"> 
										                              	<img src="img/13.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/12.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/11.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/21.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/22.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/23.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/24.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/25.png" style="margin: 0px;padding: 0px;"> 
										                              	<img src="img/26.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/27.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/28.png" style="margin: 0px;padding: 0px;">       
										                            </div>
										                            
										                            <div style="overflow: hidden;width: 900px;margin: auto;padding-top: 20px;">

										                              	<img src="img/48.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/47.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/46.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/45.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/44.png" style="margin: 0px;padding: 0px;"> 
										                              	<img src="img/43.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/42.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/41.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/31.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/32.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/33.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/34.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/35.png" style="margin: 0px;padding: 0px;"> 
										                              	<img src="img/36.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/37.png" style="margin: 0px;padding: 0px;">
										                              	<img src="img/38.png" style="margin: 0px;padding: 0px;">       
										                            </div>
							                                    </div>

							                                    <div class="col-lg-12" id="inserir" style="border: 1px solid #018f85; border-radius: 8px; padding: 10px;">
							                                    	<div class="row">
							                                			<div class="col-lg-3">
								                                			<label for="dente">Dente: 
								                                				<span style="color: red;margin-left: 5px;">*</span>
								                                			</label>
									                                		<select id="dente" name="dente" class="form-control" required="">
									                                			<option>Selecione..</option>
									                                			<?php foreach ($recuperar_dente as $dente) { ?>
									                                				<option value="<?php echo $dente["idDente"]; ?>">
																						<?php echo $dente["nome"]; ?>	
																					</option>
									                                			<?php } ?>
									                                		</select>
								                                		</div>
							
								                                		<div class="col-lg-3">
								                                			<label for="procedimento">Procedimento:
									                                			<span style="color: red;margin-left: 5px;">*</span>
									                                		</label>
									                                		<select id="procedimento" name="procedimento" class="form-control" required="">
									                                			<option>Selecione..</option>
									                                			<?php foreach ($recuperar_proced as $proced) { ?>
									                                				<option value="<?php echo $proced["idProcedimento"]; ?>">
																						<?php echo $proced["nomeProcedimento"]; ?>	
																					</option>
									                                			<?php } ?>
									                                		</select>
								                                		</div>

								                                		<div class="col-lg-3">
								                                			<label for="anotacao">Anotações: </label>
								                                			<textarea rows="1" class="form-control" name="anotacao" id="anotacao"></textarea>
								                                		</div>
								                                			
								                                		<div class="col-lg-3 pt-4">
								                                			<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-success">
																			<a href="listOrcamento.php" class="btn btn-secondary ml-2">Cancelar</a>
								                                		</div>
							                                		</div>	
							                                    </div>
									                       </div>
									                    </form>
													</div>

													<div role="tabpanel" class="tab-pane" id="procedimentos">
														<div class="row">

															<div class="col-lg-12 pt-4">
																<div class="table-responsive pl-1 pr-1 pb-1">
																	<table id="listar-procedTrat" class="table table-striped" style="width:100%">
																		<thead>
																			<tr>
																                <th>Faces</th>
																                <th>Procedimento</th>
																                <th>Anotação</th>
																                <th>Ação</th>
																			</tr>
																        </thead>
																	</table>
																</div>
															</div>
															
														</div>
													</div>
			  									</div>

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<script type="text/javascript">
   		$("#dataCadastro").mask("00/00/0000");
   		$(".dataVen").mask("00/00/0000");
    </script>

    <script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'odonto_controller.php?acao=remover&id='+ cod;
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
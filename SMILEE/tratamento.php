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
	
	$acao = 'recuperarTudo';
	require 'tratamento_controller.php';
	
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

	    <script>
	    	function marcarRealizada(id) {
				location.href = 'tratamento_controller.php?acao=marcarRealizada&id='+id;
			}

			function reverter(id) {
				location.href = 'tratamento_controller.php?acao=reverter&id='+id;
			}
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
											<i class="fas fa-folder-open icon-conteudo"></i>
											<h3>Tratamento</h3>
										</div>

										<div class="row">

											<div class="col-lg-12">
												<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
													<div class="alert alert-success alert-dismissible fade show" role="alert">
													  Procedimento ADICIONADO com sucesso!
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

											<div class="col-lg-12">
												<div class="btn-anam mt-3 mb-3 ml-3">
													<button type="button" class="btn btn-cadastrar text-white" data-toggle="modal" data-target="#novoProced" >
							                            Adicionar Procedimento
							                        </button>
							                    </div>
											</div>

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
										            <img src="img/25.png" style="margin: 0px;padding: 0px;"><img src="img/26.png" style="margin: 0px;padding: 0px;">
										            <img src="img/27.png" style="margin: 0px;padding: 0px;">
										            <img src="img/28.png" style="margin: 0px;padding: 0px;">       
										        </div>
										                            
										        <div style="overflow: hidden;width: 900px;margin: auto;;padding-top: 20px;">

										            <img src="img/48.png" style="margin: 0px;padding: 0px;">
										            <img src="img/47.png" style="margin: 0px;padding: 0px;">
										            <img src="img/46.png" style="margin: 0px;padding: 0px;">
										            <img src="img/45.png" style="margin: 0px;padding: 0px;">
										            <img src="img/44.png" style="margin: 0px;padding: 0px;"><img src="img/43.png" style="margin: 0px;padding: 0px;">
										            <img src="img/42.png" style="margin: 0px;padding: 0px;">
										            <img src="img/41.png" style="margin: 0px;padding: 0px;">
										            <img src="img/31.png" style="margin: 0px;padding: 0px;">
										            <img src="img/32.png" style="margin: 0px;padding: 0px;">
										            <img src="img/33.png" style="margin: 0px;padding: 0px;">
										            <img src="img/34.png" style="margin: 0px;padding: 0px;">
										            <img src="img/35.png" style="margin: 0px;padding: 0px;"><img src="img/36.png" style="margin: 0px;padding: 0px;">
										            <img src="img/37.png" style="margin: 0px;padding: 0px;">
										            <img src="img/38.png" style="margin: 0px;padding: 0px;">       
										        </div>
							                </div>

							                <div class="col-lg-12" id="procedimentos">
							                	<div class="form-row form1">

							                		<div class="col-lg-6">
							                			<div class="pendente">
							                				<h5 class="text-center mt-3">Procedimentos Pendentes</h5>
								                			<hr>
								                			<table class="table" style="width: 100%;">
								                				<thead>
								                					<th>Procedimento</th>
								                					<th>Face</th>
								                					<th>Ação</th>
								                				</thead>
								                				<tbody>
								                					<?php foreach ($recuperar_trat as $trat){?>
									                				<tr>
												                		<td><i class="fas fa-circle mr-2 icon-pendente"></i><?php echo $trat['nomeProcedimento']; ?></td>
												                		<td><?php echo $trat['nome']; ?></td>
												                		<td>
												                			<i class="fas fa-check-square fa-lg text-success ml-3" style="cursor: pointer;" onclick="marcarRealizada(<?php echo $trat['idProcedimentoTratamento']; ?>)" ></i>
												                		</td>
											                		</tr>
											                	<?php } ?>
								                				</tbody>
									                		</table>
							                			</div>
							                		</div>

							                		<div class="col-lg-6">
							                			<div class="feito ml-3">
							                				<h5 class="text-center mt-3">Procedimentos Realizados</h5>
								                			<hr>
								                			<table class="table" style="width: 100%;">
								                				<thead>
								                					<th>Procedimento</th>
								                					<th>Finalizado</th>
								                					<th>Ação</th>
								                				</thead>
								                				<tbody>
								                					<?php foreach ($recuperar_pt as $pt) {
								                						$data = $pt['data'];
																		$dataC = implode("/",array_reverse(explode("-",$data)));?>
									                				<tr>
												                		<td><i class="fas fa-circle mr-2 icon-feito"></i><?php echo $pt['nomeProcedimento']; ?></td>
												                		<td><?php echo $dataC; ?></td>
												                		<td>
												                			<i class="fas fa-undo fa-lg text-info ml-3" style="cursor: pointer;" onclick="reverter(<?php echo $pt['idProcedimentoTratamento']; ?>)"></i>
												                		</td>
											                		</tr>
											                	<?php } ?>
											                	</tbody>
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
					</section>
				<!--Fim do Conteúdo-->
			</div>
		</div>

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

		<!--Modal Adicionar Procedimento-->
		<div class="modal fade" data-backdrop="static" id="novoProced" tabindex="-1" role="dialog" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
			      	<!-- Modal Cabeçalho -->
                    <div class="modalHeader">
                        <h3><i class="fas fa-tooth icon-modal"></i>Novo Procedimento</h3>
                                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Cabeçalho -->
			    	<form method="POST" action="tratamento_controller.php?acao=inserir">
                        <div class="modal-body"> 
                        	<div class="container-fluid">
                        		<div class="row">

                        			<div class="col-lg-12 p-0">
                                        <div class="alert alert-info" role="alert">
                                            Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são obrigatórios.
                                        </div>
                                    </div>

                        			<div class="col-lg-6">
								        <label for="dente">Dente: 
								            <span style="color: red;margin-left: 5px;">*</span>
								        </label>
									    <select id="dente" name="dente" class="form-control" required="">
									        <option>Selecione..</option>
									        <?php foreach ($recuperar_dente as $dente) { ?>
									            <option value="<?php echo $dente["idDente"]; ?>">
												<?php echo $dente["nome"]; ?></option>
									        <?php } ?>
									    </select>
								    </div>

                        			<div class="col-lg-6">
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

								    <div class="col-lg-12 mt-3">
								        <label for="anotacao">Anotações: </label>
								        <textarea rows="3" class="form-control" name="anotacao" id="anotacao"></textarea>
								    </div>

                        		</div>
                        	</div>       
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-azul text-white">Limpar campos</button>
                            <button type="submit" name="cadastrar" class="btn btn-verde text-white">Salvar</button>
                        </div>

                    </form>
		    	</div>
		  </div>
		</div>
		<!--Fim Modal Adicionar Procedimento-->

	</body>
</html>
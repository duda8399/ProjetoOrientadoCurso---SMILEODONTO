<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['pacienteS'])) {
		  	unset($_SESSION['pacienteS']);
		    header('location:listPacienteS.php');
		}

	if (isset($_GET['id'])) {
		$codigo = $_GET['id'];
		$_SESSION['tratamento'] = $codigo;
	}
	
	$acao = 'recuperar';
	require 'odonto_controllerS.php';
	
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
			            "url": "list_procedTratS.php",
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
			  <?php include_once("_incluir/navbarSecret.php")  ?>
			<!--Fim do Navbar-->

			<div class="inside">
				<!--Início do Conteúdo-->
					<section>
						<div class="container-fluid">
							<div class="row">
								<!--Início do Menu Lateral-->
								<div class="col-lg-3">
									<?php
										if (isset($_SESSION['pacienteS'])) {
											include_once("_incluir/menu.php");
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
												<a href="cadPaciente.php" name="cadastrar" class="btn btn-azul text-white">Novo Paciente</a><br>
												<a href="listPacienteS.php" name="localizar" class="btn btn-verde text-white">Localizar Paciente</a>
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

											<div class="col-lg-12 m-2">
												<label>Paciente: </label>
												<span><?php echo $row_pac['nome']; ?></span>
												<label class="ml-5">Orçamento: </label>
												<span><?php echo $_SESSION['tratamento']; ?></span>
											</div>

											<div class="col-lg-12">
												<!-- Nav tabs -->
			  									<ul class="nav nav-tabs mt-2">
													<li class="nav-item active">
														<a href="#procedimentos" class="nav-link" role="tab" data-toggle="tab">Procedimentos</a>
													</li>
													<li class="nav-item">
														<a href="#orcamento" class="nav-link" role="tab" data-toggle="tab">Orçamento</a>
													</li>
			 									</ul>

			 									<!-- Tab panes -->
			  									<div class="tab-content">

													<div role="tabpanel" class="tab-pane active" id="procedimentos">
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

													<div role="tabpanel" class="tab-pane" id="orcamento">
														<form action="odonto_controllerS.php?acao=inserirOrcamento" method="POST">
															<div class="row">
																<form>
																	<div class="col-lg-7">
																		<table id="listar-orcamento" class="table table-striped">
																			<thead>
																				<th>Face</th>
																				<th>Procedimento</th>
																				<th>Valor</th>
																			</thead>

																			<tbody>
																				<?php foreach ($recuperar_pt as $pt) { ?>
																				<tr>
																					<td><?php echo $pt['nome']; ?></td>
																					<td><?php echo $pt['nomeProcedimento']; ?></td>
																					<td>R$ <?php echo $pt['valor']; ?></td>
																				</tr>
																				<?php } ?>
																			</tbody>
																			<tfoot><td id="valorTotal" style="font-weight: bold;">Valor Total: <span style="font-weight: normal;">R$ <?php echo ceil($row_total['total']); ?>,00</span></td></tfoot>
																		</table>
																	</div>
																</form>

																<div class="col-lg-5">
																	<input type="hidden" id ="idTratamento" name="idTratamento" value="<?php echo $_SESSION['tratamento']; ?>">
																	<label for="metodo" class="pt-4">Método de Pagamento: 
																		<span style="color: red;margin-left: 5px;">*</span>
																	</label>
																	<select id="metodo" name="metodo" class="form-control" required="">
																		<option>Selecione</option>
																		<option value="1">À vista</option>
																		<option value="2">Por procedimento</option>
																		<option value="3">Parcelado</option>
																	</select>

																	<div id="parcelas" class="pt-3">
																		
																	</div>

																	<table id="listar-parcelas" class="table table-striped">
																		<thead>
																			<th>Data de vencimento</th>
																			<th>Valor</th>
																		</thead>
																		<tbody id="tabela-parcela">
																			
																		</tbody>
																	</table>

																	<input type="submit" name="cadastrar" value="Aprovar Orçamento" class="btn btn-verde text-white mb-2">
																</div>
																
															</div>
														</form>
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

	<script>
		$('#metodo').change(function(e){
                var idMetodo = $(this).val();
                var idTratamento = $('#idTratamento').val();
                var valorTotal = $('#valorTotal').val();

                if (idMetodo == 2) {
                	$('#parcelas').empty();
                	$.ajax({
	                    type:"GET",
	                    data:"idTratamento=" + idTratamento,
	                    url:"http://localhost/SMILEE/retornarFinanceiro.php",
	                    async:false
	                }).done(function(data){
	                    var tratamentos = "";
	                    $.each($.parseJSON(data), function(chave,valor){

	                    	tratamentos+= '<tr><td><input type="date" class="form-control dataVen" name="dataVen[]" placeholder="dd/mm/aaaa"></td><td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="background: #CCC;">R$</span></div><input type="number" name="valor[]" id="valor[]" class="form-control" value="'+Math.ceil(valor.valor)+'"></div></td></tr>';
	                    	
	                    });

	                    $('#tabela-parcela').html(tratamentos);
	            	})

                }else if (idMetodo == 1){
                	$('#parcelas').empty();

                	var desconto = '<label class="pt-3">Percentual de desconto:(%)</label><input type="number" name="desconto" class="form-control">';
                	$('#parcelas').html(desconto);

                	$.ajax({
	                    type:"GET",
	                    data:"idTratamento=" + idTratamento,
	                    url:"http://localhost/SMILE/retornarFinanceiroTotal.php",
	                    async:false
	                }).done(function(data){
	                    var tratamentos = "";
	                    $.each($.parseJSON(data), function(chave,valor){

	                    	tratamentos = '<tr><td><input type="date" class="form-control dataVen" name="dataVen[]" placeholder="dd/mm/aaaa"></td><td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="background: #CCC;">R$</span></div><input type="number" name="valor[]" id="valor[]" class="form-control" value="'+Math.ceil(valor.valorTotal)+'"></div></td></tr>';
	                    	
	                    });

	                    $('#tabela-parcela').html(tratamentos);
	            	})
                }else if (idMetodo == 3){

                	$('#tabela-parcela').empty();

                	var parcelas = '<label>Nº de parcelas:</label><select id="selecione" name="parcela" class="form-control" required=""><option>Selecione</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><label class="pt-3">Percentual de aumento: (%)</label><input type="number" name="aumento" class="form-control">';
                	$('#parcelas').html(parcelas);

                	$('#selecione').change(function(e){

                		var numParcelas = $(this).val();
                		var tratamentos = "";
                		var valorTotal = "";

                		$.ajax({
		                    type:"GET",
		                    data:"idTratamento=" + idTratamento,
		                    url:"http://localhost/SMILEE/retornarFinanceiroTotal.php",
		                    async:false
		                }).done(function(data){
		                    $.each($.parseJSON(data), function(chave,valor){
		                    	valorTotal = valor.valorTotal;
		                    });
		                })

		                var varParcela = Math.ceil(valorTotal/numParcelas);

                		for (var i = 0; i < numParcelas; i++) {

                			tratamentos+= '<tr id="'+i+'"><td><input type="date" class="form-control dataVen" name="dataVen[]" placeholder="dd/mm/aaaa"></td><td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="background: #CCC;">R$</span></div><input type="text" name="valor[]" id="valor[]" class="form-control" value="'+varParcela+'"></div></td></tr>';
                		}

		                $('#tabela-parcela').html(tratamentos);
		            	
                	})
                }
                
        });
	</script>

	<script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'odonto_controllerS.php?acao=remover&id='+ cod;
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
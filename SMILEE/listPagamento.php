<?php
	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['pacienteS']))
	  {
	  	unset($_SESSION['pacienteS']);
	    header('location:listPacienteS.php');
	  }

	$acao = 'recuperarTudo';
	require 'pagamento_controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
										<i class="fas fa-money-check-alt icon-conteudo"></i>
										<h3>Pagamentos</h3>
									</div>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
											  Parcela CADASTRADA com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
											  Parcela ATUALIZADA com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
											  Parcela EXCLUÍDA com sucesso!
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

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 8){ ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
											  Pagamento realizado com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<form method="POST" action="pagamento_rotas.php">
											<div class="btn-anam mt-3 mb-3 ml-3">
												<button type="button" class="btn btn-cadastrar text-white" data-toggle="modal" data-target="#novoPagamento" >
						                            Adicionar Parcela
						                        </button>
											</div>
											
											<div class="table-responsive">
												<table id="listar-pagamento" class="table table-striped" style="width:100%">
													<thead>
														<tr>
															<th>Vencimento</th>
															<th>Pagamento</th>
															<th>Status</th>
															<th>Valor da Parcela</th>
															<th>Valor Pago</th>
											                <th>Ações</th>
														</tr>
											        </thead>
											        <tbody>
											        	<?php foreach ($resultado_financeiro as $row_financeiro) { 
											        		$dataVencimento = $row_financeiro['dataVencimento'];
															 $dataV = implode("/",array_reverse(explode("-",$dataVencimento)));
															 $dataPagamento = $row_financeiro['dataPagamento'];
															 $dataP = implode("/",array_reverse(explode("-",$dataPagamento))); ?>
											        	<tr>
											        		<td><?php echo $dataV; ?></td>
											        		<td><?php echo $dataP; ?></td>
											        		<td><?php echo $row_financeiro['status']; ?></td>
											        		<td><?php echo 'R$'.$row_financeiro['valorParcela']; ?></td>
											        		<td><?php echo 'R$'.$row_financeiro['valorPago']; ?></td>
											        		<?php if ($row_financeiro['idStatusPagamento'] == 1) { ?>
											        			<td>
											        				<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="<?php echo $row_financeiro['idFinanceiro']; ?>">Editar</button>
											        				<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="<?php echo $row_financeiro['idFinanceiro']; ?>">Excluir</button>
											        				<button type="button" name="pagar" id="pagar" data-toggle="modal" data-target="#pagarParcela" class="btn btn-verde text-white ml-2" value="<?php echo $row_financeiro['idFinanceiro']; ?>" >Pagar</button>
											        			</td>
											        		<?php }else{ ?>
											        			<td>
											        				<?php
											        				echo 
											        				'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_financeiro["idFinanceiro"].'">Excluir</button>'.
											        				'<a name="imprimir" href="gerarBoleto.php?id='.$row_financeiro["idFinanceiro"].'" class="btn btn-secondary text-white ml-2">Imprimir<i class="fas fa-print text-white ml-2"></i> </a>';
											        				?>
											        			</td>
											        	</tr>
											        <?php }} ?>
											        </tbody>
												</table>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</section>
				<!--Fim do Conteúdo-->
			</div>
		</div>

		<!--Modal Adicionar Parcela-->
		<div class="modal fade" data-backdrop="static" id="novoPagamento" tabindex="-1" role="dialog" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
			      	<!-- Modal Cabeçalho -->
                    <div class="modalHeader">
                        <h3><i class="fas fa-coins icon-modal"></i>Nova Parcela</h3>
                                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Cabeçalho -->
			    	<form method="POST" action="pagamento_controller.php?acao=inserir">
                        <div class="modal-body"> 
                        	<div class="container-fluid">
                        		<div class="row">

                        			<div class="col-lg-12 p-0">
                                        <div class="alert alert-info" role="alert">
                                            Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são obrigatórios.
                                        </div>
                                    </div>

                        			<div class="col-lg-6">
                        				<label for="valor">Valor da Parcela:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" style="background: #CCC;">R$</span>
											</div>
                        					<input type="text" name="valor" class="form-control" id="valor" required>
                        				</div>
                        			</div>

                        			<div class="col-lg-6">
                        				<label for="dataVen">Data de Vencimento:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<input type="date" name="dataVen" class="form-control" id="dataVen" required placeholder="dd/mm/aaaa">
                        			</div>

                        			<div class="col-lg-6 pt-3 pb-3">
                        				<label for="tratamento">Orçamento:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<select id="tratamento" name="tratamento" class="form-control" required>
                        					<option>Selecione..</option>
                        					<?php foreach ($recuperar_trat as $trat) { ?>
                        						<option value="<?php echo $trat['idTratamento']; ?>">
                        							<?php echo $trat['idTratamento']; ?>
                        						</option>
                        					<?php } ?>
                        				</select>
                        			</div>

                        			<div class="col-lg-6 pt-3 pb-3">
                        				<label for="descricao">Descrição:</label>
                        				<textarea class="form-control" name="descricao" id="descricao"></textarea>
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
		<!--Fim Modal Adicionar Parcela-->

		<!--Modal Pagar Parcela-->
		<div class="modal fade" data-backdrop="static" id="pagarParcela" tabindex="-1" role="dialog" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
			      	<!-- Modal Cabeçalho -->
                    <div class="modalHeader">
                        <h3><i class="fas fa-coins icon-modal"></i>Pagar Parcela</h3>
                                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Cabeçalho -->
			    	<form method="POST" action="pagamento_controller.php?acao=pagar">
                        <div class="modal-body"> 
                        	<div class="container-fluid">
                        		<div class="row">

                        			<div class="col-lg-12 p-0">
                                        <div class="alert alert-info" role="alert">
                                            Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são obrigatórios.
                                        </div>
                                    </div>

                                    <input type="hidden" name="idFinanceiro" id="idFinanceiro">

                                    <div class="col-lg-6">
                        				<label for="dataPag">Data de Pagamento:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<input type="text" name="dataPag" class="form-control" id="dataPag" required value="<?php echo date('d/m/Y');?>" placeholder="dd/mm/aaaa">
                        			</div>

                        			<div class="col-lg-6">
                        				<label for="valorParcela">Valor da Parcela:</label>
                        				<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" style="background: #CCC;">R$</span>
											</div>
                        					<input type="text" name="valorParcela" class="form-control" id="valorParcela" readonly="">
                        				</div>
                        			</div>

                        			<div class="col-lg-6 pt-3">
                        				<label for="valorPag">Valor Pago:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<div id="novoValor">
                        					<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text" style="background: #CCC;">R$</span>
												</div>
												<input type="text" name="valorPag" class="form-control" id="valorPag" required>
                        					</div>
                        				</div>
                        			</div>

                        			<div class="col-lg-6 pt-3 pb-3">
                        				<label for="multa">Multa/Juros: </label>
                        				<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" style="background: #CCC;">R$</span>
											</div>
                        					<input type="text" name="multa" class="form-control" id="multa">
                        				</div>
                        			</div>

                        			<div class="col-lg-12 pt-3 pb-3">
                        				<label for="formaPag">Forma de Pagamento
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<select id="formaPag" name="formaPag" class="form-control" required>
                        					<option>Selecione..</option>
                        					<?php foreach ($recuperar_formaPag as $forma) { ?>
                        						<option value="<?php echo $forma['idFormaPagamento']; ?>">
                        							<?php echo $forma['formaPagamento']; ?>
                        						</option>
                        					<?php } ?>
                        				</select>
                        			</div>

                        		</div>
                        	</div>       
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="cadastrar" class="btn btn-verde text-white align-middle" style="margin: auto;">Pagar</button>
                        </div>

                    </form>
		    	</div>
		  </div>
		</div>
		<!--Fim Modal Pagar Parcela-->

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->
		
		<script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'pagamento_controller.php?acao=remover&id='+ cod;
				if(!$('#confirm-delete').length){
					$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
				}
				$('#dataComfirmOK').attr('href', href);
		        $('#confirm-delete').modal({show: true});
				return false;
				});
		</script>

		<script>
			$(document).on('blur', '#multa', function() {
				var valorMulta = $(this).val();
				var valorParcela = $('#valorPag').val();
				var somaMulta = parseFloat(valorMulta) + parseFloat(valorParcela);

				var novoElemento = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="background: #CCC;">R$</span></div><input type="text" name="valorPag" class="form-control" id="valorPag" required value="'+somaMulta+'" ></div>';
				
				$('#novoValor').html(novoElemento);
			});
		</script>

		<script>
			$(document).on('click', '#pagar', function(e) {
	                var idFinanceiro = $(this).val();

	                $.ajax({
	                    type:"GET",
	                    data:"idFinanceiro=" + idFinanceiro,
	                    url:"http://localhost/SMILEE/retornarValorParcela.php",
	                    async:false
	                }).done(function(data){

	                    $.each($.parseJSON(data), function(chave,valor){
	                    	$('#idFinanceiro').val(valor.idFinanceiro);
	                    	$('#valorParcela').val(valor.valorParcela);
							
	                    });

	                    $('#pagarParcela').modal('show');
	            })
	        });
		</script>
	</body>
</html>
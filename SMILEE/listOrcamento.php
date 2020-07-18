<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	$acao = 'recuperar';
	require 'orcamento_controller.php';
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

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
											  Orçamento CADASTRADO com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
											  Orçamento ATUALIZADO com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
											  Orçamento EXCLUÍDO com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
											<div class="alert alert-info alert-dismissible fade show" role="alert">
											  Orçamento ENVIADO com sucesso!
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
											<div class="alert bg-success alert-dismissible fade show text-white" role="alert">
												Orçamento APROVADO com sucesso!
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php } ?>

										<form method="POST" action="orcamento_rotas.php">
											<div class="btn-anam mt-3 mb-3 ml-3">
												<button type="button" class="btn btn-cadastrar text-white" data-target="#novoTratamento" data-toggle="modal">Novo Orçamento</button>
											</div>
											
											<div class="table-responsive pl-2 pr-2 pb-2 pt-4">
												<table id="listar-orcamento" class="table table-striped" style="width:100%">
													<thead>
														<tr>
															<th>Orçamento</th>
															<th>Aberto em</th>
															<th>Dentista Responsável</th>
															<th>Situação</th>
											                <th>Ações</th>
														</tr>
											        </thead>
											        <tbody>
											        	<?php foreach ($resultado_orcamento as $row_orcamento) { $dataAbertura = $row_orcamento['dataAbertura'];
															 $data = implode("/",array_reverse(explode("-",$dataAbertura))); ?>
											        	<tr>											    
											        		<td><?php echo $row_orcamento["idTratamento"]; ?></td>
											        		<td><?php echo $data; ?></td>
											        		<td><?php echo $row_orcamento["nome"]; ?></td>   <td><?php echo $row_orcamento["situacao"]; ?></td>
											        		<?php if ($row_orcamento['idSituacaoTrat'] == 3){?>
											        			<td>
											        				<?php echo'<a href="orcamentoAprovado.php?id='.$row_orcamento["idTratamento"].'" class="btn btn-verde text-white ml-2 mr-2">Odontograma</a>'; ?>
											        			</td>
											        		<?php }else{ ?>
											        			<td>
											        				<?php echo '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_orcamento["idTratamento"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_orcamento["idTratamento"].'" >Excluir</button>'.'<a href="cadOrcamento.php?id='.$row_orcamento["idTratamento"].'" class="btn btn-verde text-white ml-2 mr-2">Odontograma</a>'; ?>
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

		<!--Modal Cadastro-->
		<div class="modal fade" data-backdrop="static" id="novoTratamento" tabindex="-1" role="dialog" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
			      	<!-- Modal Cabeçalho -->
                    <div class="modalHeader">
                        <h3><i class="fas fa-file-invoice-dollar icon-modal"></i>Novo Orçamento</h3>
                                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Cabeçalho -->
			    	<form method="POST" action="orcamento_controller.php?acao=inserir">
                        <div class="modal-body"> 
                        	<div class="container-fluid">
                        		<div class="row">

                        			<div class="col-lg-12 p-0">
                                        <div class="alert alert-info" role="alert">
                                            Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são obrigatórios.
                                        </div>
                                    </div>

                        			<div class="col-lg-6">
                        				<label for="dentista">Dentista responsável:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<select id="dentista" name="dentista" class="form-control" required>
                        					<?php foreach ($recuperar_dentista as $dent) { ?>
                        						<option value="<?php echo $dent['idPessoa']; ?>">
                        							<?php echo $dent['nome']; ?>
                        						</option>
                        					<?php } ?>
                        				</select>
                        			</div>

                        			<div class="col-lg-6">
                        				<label for="dataA">Aberto em:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<input type="text" name="dataAbertura" class="form-control" id="dataA" value="<?php echo date('d/m/Y');?>" required >
                        			</div>

                        			<div class="col-lg-12 pt-3 pb-3">
                        				<label for="situacao">Situação:
                        					<span style="color: red;margin-left: 5px;">*</span>
                        				</label>
                        				<select id="situacao" name="situacao" class="form-control" required>
                        					<?php foreach ($recuperar_trat as $trat) { ?>
                        						<option value="<?php echo $trat['idSituacaoTrat']; ?>">
                        							<?php echo $trat['situacao']; ?>
                        						</option>
                        					<?php } ?>
                        				</select>
                        			</div>

                        		</div>
                        	</div>       
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="cadastrar" class="btn btn-verde text-white">Salvar</button>
                        </div>

                    </form>
		    	</div>
		  </div>
		</div>
		<!--Fim Modal Cadastro-->

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

		<script src="js/funcoes.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

		<script type="text/javascript">
	   		$("#dataA").mask("00/00/0000");
	    </script>

    	<script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'orcamento_controller.php?acao=remover&id='+ cod;
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
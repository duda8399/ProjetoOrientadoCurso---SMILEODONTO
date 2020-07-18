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
		<!-- Datatable -->
		
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

		<script>
			$(document).ready(function() {
			    $('#listar-func').DataTable({
	        		"serverSide": true,
	                "ajax": {
			            "url": "list_func.php",
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
			  <?php include_once("_incluir/navbarAdm.php")  ?>
			<!--Fim do Navbar-->

			<div class="inside">
				<!--Início do Conteúdo-->
				<section>
					<div class="container-fluid">
						<div class="row">
							<!--Início do Menu Lateral-->
							<div class="col-lg-3">
								<div class="menu-lateral2">
									<div class="cabecalho">
										<h3>Cadastrar Funcionários</h3>
									</div>
									<div class="corpo-menu">
										<div class="botao-cadastrar">
											<a href="cadFuncionario.php" name="cadastrar" class="btn btn-cadastrar text-white">Adicionar Funcionário</a><br>
										</div>
										<hr>
										<?php include_once("_incluir/menuCadastro.php") ?>
									</div>
								</div>
							</div>
							<!--Fim do Menu Lateral-->

							<div class="col-lg-9">
								<div class="conteudo">
									<div class="cabecalho-conteudo">
										<i class="fas fa-users icon-conteudo"></i>
										<h3>Funcionários</h3>
									</div>

									<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
											  Funcionário CADASTRADO com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
											  Funcionário ATUALIZADO com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
											  Funcionário EXCLUÍDO com sucesso!
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

										<form method="POST" action="funcionario_rotas.php">
											<div class="table-responsive pt-3 pl-2 pr-2 pb-2">
												<table id="listar-func" class="table table-striped" style="width:100%">
													<thead>
														<tr>
											                <th>Nome</th>
											                <th>Cargo</th>
											                <th>Logradouro</th>
											                <th>Telefone</th>
											                <th>Ações</th>
														</tr>
											        </thead>
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

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

		<script>
			$(document).on('click', '#excluir', function() {
				var cod = $(this).val();
				var href = 'funcionario_controller.php?acao=remover&id='+ cod;
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


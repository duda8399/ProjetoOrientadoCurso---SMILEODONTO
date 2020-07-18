<?php
	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	$acao = 'recuperarTudo';
	require 'imagem_controller.php';
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
									<div class="conteudo pb-3">
										<div class="cabecalho-conteudo">
											<i class="fas fa-camera icon-conteudo"></i>
											<h3>Imagens</h3>
										</div>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
											  Imagem CADASTRADA com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
											  Imagem ATUALIZADA com sucesso!
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											    <span aria-hidden="true">&times;</span>
											  </button>
											</div>
										<?php } ?>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
											  Imagem EXCLUÍDA com sucesso!
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

										<div class="form-group col-lg-9 p-4">
											<a class="btn btn-azul text-white" href="cadImagem.php">Adicionar Imagem</a>
										</div>
										<hr>
										<form method="POST" action="imagem_rotas.php">
											<div class="row p-2">
												<?php foreach ($recuperar_imagem as $imagem) { 
													$id = $imagem['idPaciente'];
													$foto = $imagem['foto'];
												?>
													<div class="col-lg-4 pb-3">
														<div class="card">
															<img class="card-img-top" src="<?php echo "uploads/imagens/$id/$foto"; ?>">

															<div class="card-body">
																<span class="cardText"><?php echo $imagem['nome'] ?></span>
																<button type="submit" name="editar" class="btn btn-editar text-white img-btn" value="<?php echo $imagem['idImagem']; ?>">Editar </button>
																<button type="button" name="" class="btn btn-excluir text-white img-btn" id="excluir" value="<?php echo $imagem['idImagem']; ?>">Excluir </button>
															</div>
														</div>
													</div>
												<?php } ?>
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
				var href = 'imagem_controller.php?acao=remover&id='+ cod;
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

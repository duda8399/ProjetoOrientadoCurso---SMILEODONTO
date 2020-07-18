<?php 

	if (isset($_POST['editar'])) {
		$codigo = $_POST['editar'];
	}

	$acao = "recuperarTudo";
	require 'proced_controller.php';
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
	    <!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

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
											<h3>Cadastrar Procedimentos</h3>
										</div>
										<div class="corpo-menu">
											<div class="botao-cadastrar">
												<a href="cadProcedimento.php" name="cadastrar" class="btn btn-proc text-white">Adicionar Procedimento</a><br>
											</div>
											<hr>
											<?php include_once("_incluir/menuCadastro.php") ?>
										</div>
									</div>
								</div>
								<!--Fim do Menu Lateral-->

								<div class="col-lg-9">
									<div class="conteudo pb-3">
										<div class="cabecalho-conteudo">
											<i class="fas fa-tooth icon-conteudo"></i>
											<h3>Procedimentos</h3>
										</div>

										<form id="add-proced" method="POST" action="proced_controller.php?acao=atualizar">

										<div class="form-row">
											<?php foreach ($recuperar_proced as $proced) { 
												$minhacat = $proced['idCategoria']; ?>

											<input type="hidden" name="idProcedimento" value="<?php echo $proced["idProcedimento"]; ?>">

											<div class="col-lg-12 pb-0 pt-3 pl-3 pr-3">
												<div class="alert alert-info" role="alert">
												  Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são de preenchimento obrigatório.
												</div>
											</div>

											<div class="col-lg-6 pl-5">
												<label for="procedimento">Nome do procedimento:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="procedimento" id="procedimento" placeholder="Digite o nome do procedimento" class="form-control" required="" value="<?php echo $proced["nomeProcedimento"]; ?>">

												<label for="valor" class="pt-2">Valor:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<div class="input-group">
												    <div class="input-group-prepend">
												        <span class="input-group-text" style="background: #CCC;">R$</span>
												    </div>
												    <input type="text" class="form-control" name="valor" id="valor" required="" value="<?php echo $proced["valor"]; ?>">
												</div>

												<label for="categoria" class="pt-2">Categoria:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<select class="form-control" name="categoria" id="categoria" required="">

													<?php foreach ($recuperar_categoria as $cat) { ?>
														

														<?php foreach ($recuperar_categoria as $cat) {
															$catprincipal = $cat['idCategoria'];

															if ($minhacat == $catprincipal) { ?>

															<option value="<?php echo $cat["idCategoria"]; ?>" selected>
															<?php echo $cat["nomeCategoria"]; ?>	
															</option>

														<?php } else { ?>
															<option value="<?php echo $cat["idCategoria"]; ?>">
															<?php echo $cat["nomeCategoria"]; ?>	
															</option>
														<?php }} ?>
													<?php } ?>
												</select>

											<?php } ?>

												<div class="pt-5">
													<input type="submit" name="atualizar" id="cadastrar" value="Atualizar" class="btn btn-success">
													<a href="listProcedimento.php" class="btn btn-secondary ml-2">Cancelar</a>
												</div>
											</div>

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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>
	</body>
</html>

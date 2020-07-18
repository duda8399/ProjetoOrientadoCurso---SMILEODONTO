<?php

	if (isset($_POST['editar'])) {
		$codigo = $_POST['editar'];
	}

	$acao = 'recuperar';
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
											<i class="fas fa-camera icon-conteudo"></i>
											<h3>Imagens</h3>
										</div>

										<form id="add-imagem" method="POST" action="imagem_controller.php?acao=atualizar" enctype="multipart/form-data">
											<?php foreach ($recuperar_imagem as $imagem) { 
												$foto = $imagem['foto'];
												$idPaciente = $imagem['idPaciente']; ?>

											<div class="form-row form1">
												<div class="col-lg-12">
													<div class="alert alert-info" role="alert">
														Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são de preenchimento obrigatório.
													</div>
												</div>

												<div class="col-lg-3">
													<img src="<?php echo "uploads/imagens/$idPaciente/$foto"; ?>" id="img-file" width="130" height="129" class="img-file" style="margin-left: 10px;"><br>

													<div class="fileUp btn btn-outline-success">
					    								<span><i class="fas fa-upload text-black mr-3"></i>Enviar Foto</span>
					    									<input type="file" id="foto-upload" class="upload" name="foto">
													</div>
												</div>
												
												<input type="hidden" name="idImagem" value="<?php echo $imagem['idImagem']; ?>">

												<div class="col-lg-9">
													<label for="nome">Nome:
														<span style="color: red;margin-left: 5px;">*</span>
													</label>
													<input type="text" name="nome" id="nome" placeholder="Digite o nome da imagem" class="form-control" required="" value="<?php echo $imagem['nome']; ?>">

													<label for="dataCadastro" class="pt-3">Data do Cadastro:
														<span style="color: red;margin-left: 5px;">*</span>
													</label>
													<input type="date" name="dataCadastro" id="dataCadastro" class="form-control" value="<?php echo $imagem['data']; ?>" required >

													<label for="descricao" class="pt-3">Descrição:</label>
													<textarea class="form-control" name="descricao" id="descricao" rows="3"><?php echo $imagem['descricao']; ?></textarea>

													<div class="col-lg-9 pt-5">
														<input type="submit" name="atualizar" id="atualizar" value="Atualizar" class="btn btn-success">
														<a href="listImagem.php" class="btn btn-secondary ml-2">Cancelar</a>
													</div>
									
												</div>
											</div>
											<?php } ?>
										</form>
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

 	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funcoes.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	</body>
</html>

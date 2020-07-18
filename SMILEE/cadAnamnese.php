<?php

	$acao = 'recuperar';
	require 'anamnese_controller.php';
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
										<h3>Cadastrar Anamneses</h3>
									</div>
									<div class="corpo-menu">
										<div class="botao-cadastrar">
											<a href="cadAnamnese.php" name="cadastrar" class="btn btn-cadastrar text-white">Adicionar Anamnese</a><br>
										</div>
										<hr>
									<?php include_once("_incluir/menuCadastro.php") ?>
									</div>
								</div>
							</div>
							<!--Fim do Menu Lateral-->

							<div class="col-lg-9">
								<div class="conteudo-form">
									<div class="cabecalho-conteudo">
										<i class="fas fa-cogs text-black icon-conteudo mr-1"></i>
										<h3>Anamneses</h3>
									</div>

									<form id="add-anamnese" method="POST" action="anamnese_controller.php?acao=inserir" enctype="multipart/form-data">
										<div class="form-row form1" id="formulario">

											<div class="col-lg-8">
												<label for="anamnese">Nome da Ficha de Anamnese:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="anamnese" id="anamnese" placeholder="Digite um nome" class="form-control" required="">
											</div>

											<div class="col-lg-12 mt-4">
												<span><i class="fas fa-question mr-2"></i>Perguntas</span>
												<hr>
											</div>

											<div class="col-lg-12 mt-2" id="adicionar">

											</div>

											<div class="col-lg-12 mt-3">
												<span class="btn btn-outline-success" id="add-campo">
													Adicionar Pergunta
												</span>
											</div>

											<div class="col-lg-12 mt-4">
												<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-success">
												<a href="listCadAnamnese.php" class="btn btn-secondary ml-2">Cancelar</a>
												<button class="btn btn-info ml-2" type="reset">Limpar campos</button>
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

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funcoes.js"></script>
	<script>
		var cont = 1;
        //https://api.jquery.com/click/
        $("#add-campo").click(function () {
        	cont++;
				//https://api.jquery.com/append/
                $("#adicionar").append('<div class="row mt-2" id="campo' + cont + '"><i class="fas fa-trash btn-apagar" style="margin-top: 40px;margin-left: 5px;cursor: pointer;" id="' + cont + '"></i><div class="col-lg-6"><label for="pergunta">Pergunta:</label><input type="text" id="pergunta" name="questao[]" class="form-control" placeholder="Digite a pergunta"></div><div class="col-lg-2"><label for="obrigatorio">Obrigatoriedade:</label><select class="form-control" name="obrigatorio[]" id="obrigatorio"><?php foreach ($recuperar_obg as $obg) { ?><option value="<?php echo $obg["idObrigatoriedade"]; ?>"><?php echo $obg["obrigatorio"]; ?>	</option><?php } ?></select></div><div class="col-lg-3"><label for="alerta">Alerta:</label><select class="form-control" name="alerta[]" id="alerta"><?php foreach ($recuperar_alerta as $alerta) { ?><option value="<?php echo $alerta["idAlerta"]; ?>"><?php echo $alerta["alerta"]; ?></option><?php } ?></select></div></div>');
            });

        	$('form').on('click', '.btn-apagar', function () {
	            var button_id = $(this).attr("id");
	            $('#campo' + button_id + '').remove();
	        });

        </script>

	</body>
</html>
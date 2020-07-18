<?php
	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	if (isset($_POST['editar'])) {
		$codigo = $_POST['editar'];
	}
	  
	$acao = 'recuperarTudo';
	require 'preencherAnam_controller.php';
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
								<div class="conteudo-form">
									<div class="cabecalho-conteudo">
										<i class="fas fa-file-alt icon-conteudo"></i>
										<h3>Anamneses</h3>
									</div>

									<form id="add-anamnese" method="POST" action="preencherAnam_controller.php?acao=atualizar" enctype="multipart/form-data">
										<div class="form-row form1" id="formulario">

											<input type="hidden" name="idPaciente" value="<?php echo $_SESSION['paciente']; ?>">

											<input type="hidden" name="idAnamnese" value="<?php echo $codigo; ?>">


											<div class="col-lg-6">
												<label for="ficha">Ficha de Anamnese
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												
												<input type="text" name="nomeFicha" id="ficha" class="form-control" value="<?php echo $row_quest['nomeFicha']; ?>" readonly>
												<input type="hidden" name="idQuestionario" value="<?php echo $row_quest['idQuestionario']; ?>">
												
											</div>

											<div class="col-lg-6">
												<label for="data">Data:</label>
												<input type="text" name="data" id="data" class="form-control" value="<?php echo $dataC ?>">
											</div>

											<div class="col-lg-12 mt-5" style="margin-bottom: -15px;">
												<span>Ficha de Anamnese</span>
												<hr>
											</div>

											<?php 
												foreach ($recuperar_QQ as $QQ) {

												if ($QQ['idObrigatoriedade'] == 1) { ?>

											<div class="col-lg-12 mt-3">
												<label for="enunciado"><?php echo $QQ['enunciado']; ?>
													<span style="color: red;margin-left: 5px;">*</span>
												</label>

												<input type="text" name="resposta[]" id="enunciado" value="<?php echo $QQ['discursiva'] ?>" class="form-control mt-1">
												<input type="hidden" name="idQuestoes[]" value="<?php echo $QQ['idQuestoes']; ?>">
											</div>

											<?php }else if ($QQ['idObrigatoriedade'] == 2) {?>
												<div class="col-lg-12 mt-3">
													<label for="enunciado"><?php echo $QQ['enunciado']; ?>
													</label>
													<input type="text" name="resposta[]" id="enunciado" value="<?php echo $QQ['discursiva'] ?>" class="form-control mt-1" >
													<input type="hidden" name="idQuestoes[]" value="<?php echo $QQ['idQuestoes']; ?>">
												</div>
											<?php }} ?>


											<div class="col-lg-12 pt-5">
												<input type="submit" name="atualizar" id="atualizar" value="Atualizar" class="btn btn-success">
												<a href="listAnamnese.php" class="btn btn-secondary ml-2">Cancelar</a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<script type="text/javascript">
   		$("#data").mask("00/00/0000");
    </script>

	</body>
</html>
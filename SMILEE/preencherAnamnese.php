<?php
	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }
	  
	$acao = 'recuperar';
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

									<form id="add-anamnese" method="POST" action="preencherAnam_controller.php?acao=inserir" enctype="multipart/form-data">
										<div class="form-row form1" id="formulario">

											<input type="hidden" name="idPaciente" value="<?php echo $_SESSION['paciente']; ?>">

											<div class="col-lg-6">
												<label for="ficha">Escolha uma Ficha de Anamnese
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<select class="form-control" id="ficha" name="ficha">
													<option>Selecione..</option>
													<?php foreach ($recuperar_quest as $quest) { ?>

														<option value="<?php echo $quest["idQuestionario"]; ?>">	<?php echo $quest["nomeFicha"]; ?>
														</option>

													<?php } ?>
												</select>
											</div>

											<div class="col-lg-6">
												<label for="data">Data:</label>
												<input type="text" name="data" id="data" class="form-control" value="<?php echo date('d/m/Y');?>">
											</div>

											<div class="col-lg-12 mt-5" style="margin-bottom: -15px;">
												<span>Ficha de Anamnese</span>
												<hr>
											</div>

											<div class="col-lg-12" id="questao">
												
											</div>

											<div class="col-lg-12 pt-5">
												<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-success">
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

	<script>
		$('#ficha').change(function(e){
                var idQuestionario = $(this).val();

                $.ajax({
                    type:"GET",
                    data:"idQuestionario=" + idQuestionario,
                    url:"http://localhost/SMILEE/retornarAnamnese.php",
                    async:false
                }).done(function(data){
                    var anamneses = "";
                    $.each($.parseJSON(data), function(chave,valor){

                    	
                    	if (valor.idObrigatoriedade == 1) {
                    		anamneses+= '<label for="enunciado" class="mt-4">' + valor.enunciado +'<span style="color: red;margin-left: 5px;">*</span></label><input type="text" name="resposta[]" class="form-control mt-1" placeholder="Digite a resposta" required=""><input type="hidden" name="idQuestoes[]" value="' +valor.idQuestoes +'">';

                    	}else if (valor.idObrigatoriedade == 2) {
                    		anamneses+= '<label for="enunciado" class="mt-4">' + valor.enunciado +'</label><input type="text" name="resposta[]" class="form-control mt-1" placeholder="Digite a resposta"><input type="hidden" name="idQuestoes[]" value="'+ valor.idQuestoes +'">';
                    	}	
                    	
                    });

                    $('#questao').html(anamneses);
            })
        });
	</script>

	</body>
</html>
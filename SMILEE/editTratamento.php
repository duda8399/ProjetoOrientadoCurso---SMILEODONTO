<?php

	if (isset($_POST['editar'])) {
		$codigo = $_POST['editar'];
	}

	$acao = 'recuperar';
	require 'tratamento_controller.php';
	
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
								<div class="conteudo">
									<div class="cabecalho-conteudo">
										<i class="fas fa-folder-open icon-conteudo"></i>
										<h3>Tratamentos</h3>
									</div>

									<form method="POST" action="tratamento_controller.php?acao=atualizar">
										
										<div class="container-fluid">
				                        	<div class="form-row form1">

				                        		<?php foreach ($recuperar_trata as $trat) { 
				                        			$meudentista = $trat['idDentista'];
				                        			$minhasit = $trat['idSituacaoTrat']; ?>

				                        		<div class="col-lg-12 p-0">
				                                    <div class="alert alert-info" role="alert">
				                                        Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são obrigatórios.
				                                    </div>
				                               	</div>

				                               	<input type="hidden" name="idTratamento" value="<?php echo $trat['idTratamento']; ?>">

				                        		<div class="col-lg-6">
				                        			<label for="dentista">Dentista responsável:
				                        				<span style="color: red;margin-left: 5px;">*</span>
				                        			</label>
				                        			<select id="dentista" name="dentista" class="form-control" required>
				                        				<option>Selecione..</option>
				                        				<?php foreach ($recuperar_dentista as $dent) { 
				                        					$dentistaprincipal = $dent['idPessoa'];

				                        					if ($meudentista == $dentistaprincipal) { ?>

					                        					<option value="<?php echo $dent['idPessoa']; ?>" selected>
					                        						<?php echo $dent['nome']; ?>
					                        					</option>
				                        					<?php }else { ?>

				                        						<option value="<?php echo $dent['idPessoa']; ?>">
				                        							<?php echo $dent['nome']; ?>
				                        						</option>
				                        				<?php }} ?>
				                        			</select>
				                        		</div>

				                        		<div class="col-lg-6">
				                        			<label for="dataA">Aberto em:
				                        				<span style="color: red;margin-left: 5px;">*</span>
				                        			</label>
				                        			<input type="date" name="dataAbertura" class="form-control" id="dataA" value="<?php echo $trat['dataAbertura']; ?>" required >
				                        		</div>

				                        		<div class="col-lg-6 pt-3">
				                        			<label for="dataE">Encerrado em:</label>
				                        			<input type="date" name="dataEncerramento" class="form-control" id="dataE" value="<?php echo $trat['dataEncerramento']; ?>">
				                        		</div>

				                        		<div class="col-lg-6 pt-3">
				                        			<label for="situacao">Situação:
				                        				<span style="color: red;margin-left: 5px;">*</span>
				                        			</label>
				                        			<select id="situacao" name="situacao" class="form-control" required>
				                        				<option>Selecione..</option>
				                        				<?php foreach ($recuperar_trat as $trat) { 
				                        					$sitprincipal = $trat['idSituacaoTrat'];
				                        					if ($sitprincipal == $minhasit) { ?>

					                        					<option value="<?php echo $trat['idSituacaoTrat']; ?>" selected>
					                        						<?php echo $trat['situacao']; ?>
					                        					</option>
				                        					<?php }else { ?>
				                        						<option value="<?php echo $trat['idSituacaoTrat']; ?>">
					                        						<?php echo $trat['situacao']; ?>
					                        					</option>
					                        				<?php }} ?>
				                        			</select>
				                        		</div>

				                        		<?php } ?>

				                        		<div class="pt-5">
													<input type="submit" name="atualizar" id="atualizar" value="Atualizar" class="btn btn-success">
													<a href="listTratamento.php" class="btn btn-secondary ml-2">Cancelar</a>
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

		<script src="js/funcoes.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	</body>
</html>
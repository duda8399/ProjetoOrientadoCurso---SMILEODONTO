<?php

	if (isset($_POST['editar'])) {
		$codigo = $_POST['editar'];
	}

	$acao = 'recuperar';
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

										<form id="add-pagamento" method="POST" action="pagamento_controller.php?acao=atualizar">
											<?php foreach ($recuperar_financeiro as $finan) { 
												$meuorcamento = $finan['idTratamento']; ?>

											<div class="form-row form1">
												<div class="col-lg-12">
													<div class="alert alert-info" role="alert">
														Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são de preenchimento obrigatório.
													</div>
												</div>
												
												<input type="hidden" name="idFinanceiro" value="<?php echo $finan['idFinanceiro']; ?>">

												<div class="col-lg-6">
			                        				<label for="valor">Valor da Parcela:
			                        					<span style="color: red;margin-left: 5px;">*</span>
			                        				</label>
			                        				<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text" style="background: #CCC;">R$</span>
														</div>
			                        					<input type="text" name="valor" class="form-control" id="valor" required value="<?php echo $finan['valorParcela']; ?>">
			                        				</div>
			                        			</div>

			                        			<div class="col-lg-6">
			                        				<label for="dataVen">Data de Vencimento:
			                        					<span style="color: red;margin-left: 5px;">*</span>
			                        				</label>
			                        				<input type="date" name="dataVen" class="form-control" id="dataVen" required value="<?php echo $finan['dataVencimento']; ?>" >
			                        			</div>

			                        			<div class="col-lg-6 pt-3 pb-3">
			                        				<label for="tratamento">Orçamento:
			                        					<span style="color: red;margin-left: 5px;">*</span>
			                        				</label>
			                        				<select id="tratamento" name="tratamento" class="form-control" required>
			                        					<option>Selecione..</option>
			                        					<?php foreach ($recuperar_trat as $trat) {
			                        						$orcamentoprincipal = $trat['idTratamento'];

			                        						if ($meuorcamento == $orcamentoprincipal) { ?>

			                        						<option value="<?php echo $trat['idTratamento']; ?>" selected>
			                        							<?php echo $trat['idTratamento']; ?>
			                        						</option>
			                        					<?php }else { ?>
			                        						<option value="<?php echo $trat['idTratamento']; ?>">
			                        							<?php echo $trat['idTratamento']; ?>
			                        						</option>
			                        					<?php }} ?>
			                        				</select>
			                        			</div>

			                        			<div class="col-lg-6 pt-3 pb-3">
			                        				<label for="descricao">Descrição:</label>
			                        				<textarea class="form-control" name="descricao" id="descricao"><?php echo $finan['descricao']; ?></textarea>
			                        			</div>

			                        			<div class="col-lg-9 pt-3">
													<input type="submit" name="atualizar" id="atualizar" value="Atualizar" class="btn btn-success">
													<a href="listPagamento.php" class="btn btn-secondary ml-2">Cancelar</a>
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

	</body>
</html>

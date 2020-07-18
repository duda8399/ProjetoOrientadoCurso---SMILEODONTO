<?php
	
	if (isset($_POST['dataI']) && isset($_POST['dataF'])) {

		$dataI = $_POST['dataI'];
		$dataF = $_POST['dataF'];

		require 'list_relatorio_pac.php';
	}

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
			  <?php include_once("_incluir/navbarSecret.php")  ?>
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
											<h3>Relatório de Pacientes</h3>
										</div>
										<div class="corpo-menu">
											<div class="m-3">
												<span>
													Resumo dos pacientes cadastrados por período.
												</span>
											</div>
											<hr>
											<?php include_once("_incluir/menuRelatorio.php") ?>
										</div>
									</div>
								</div>
								<!--Fim do Menu Lateral-->

								<div class="col-lg-9">
									<div class="conteudo">
										<div class="cabecalho-conteudo">
											<i class="fas fa-user icon-conteudo"></i>
											<h3>Pacientes</h3>
										</div>

										<form method="POST" method="relatorioPaciente.php">
											<div class="form-row form">

												<div class="col-lg-6">
													<label>Período de Cadastro</label>
													<div class="input-group mt-3">
														<div class="input-group-prepend">
														    <span class="input-group-text" style="background: #CCC;">De</span>
														</div>
														<input type="date" name="dataI" class="form-control">

														<div class="input-group-prepend">
														    <span class="input-group-text" style="background: #CCC;">à</span>
														</div>
														<input type="date" name="dataF" class="form-control">
													</div>
												</div>

												<div class="col-lg-6">
													<button type="submit" class="btn btn-verde text-white" style="margin-top: 48px;margin-left: 100px;">Gerar relatório</button>
												</div>
													
											</div>
										</form>
										<div class="row">

											<div class="col-lg-12">
												<a href="gerarPDFRP.php" class="btn btn-danger text-white mt-2 ml-2"><i class="fas fa-file-pdf text-white mr-2"></i>PDF</a>

												<a href="gerarPDFRP.php" class="btn btn-danger text-white mt-2 ml-2"><i class="fas fa-file-pdf text-white mr-2"></i>PDF</a>
											</div>

											<div class="col-lg-12" style="margin-top: -15px;">
												<div class="table-responsive">
													<table id="listar-paciente" class="table table-striped" style="width:100%">
														<thead>
															<tr>
																<th>Registro</th>
																<th>Nome</th>
																<th>Data Cadastro</th>
												                <th>Celular</th>
												                <th>CEP</th>
												                <th>E-mail</th>
															</tr>
												        </thead>
												        <tbody>
												        	<?php
												        		if (isset($resultado_paciente)) {
												        			foreach ($resultado_paciente as $pac) {  
												        	?>
												        	<tr>
												        		<td><?php echo $pac['idPessoa']; ?></td>
												        		<td><?php echo $pac['nome']; ?></td>
												        		<td><?php echo $pac['dataCadastro']; ?></td>
												        		<td><?php echo $pac['telefoneCelular']; ?></td>
												        		<td><?php echo $pac['cep']; ?></td>
												        		<td><?php echo $pac['email']; ?></td>
												        	</tr>
												        	<?php }} ?>
												        </tbody>
													</table>
												</div>
											</div>
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
	</body>
</html>

<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$result_paciente = "SELECT t.telefoneCelular, p.nome, p.cep, p.idPessoa , e.email, pac.dataCadastro FROM telefonePessoa t, pessoa p, paciente pac, emailpessoa e WHERE p.idPessoa = t.idPessoa and pac.idPaciente = p.idPessoa AND e.idPessoa = pac.idPaciente and pac.dataCadastro>= '$dataI' and pac.dataCadastro<= '$dataF' ";
	$resultado_paciente =mysqli_query($conecta, $result_paciente);

	if (!$resultado_paciente) {
		header("Location: index.php");
	}

?>
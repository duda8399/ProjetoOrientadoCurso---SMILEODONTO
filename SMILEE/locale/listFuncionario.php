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

		<!--Início do Navbar-->
		  <?php include_once("_incluir/navbar.php")  ?>
		<!--Fim do Navbar-->

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
								<div class="botao-func">
									<a href="cadFuncionario.php" name="cadastrar" class="btn btn-cadastrar text-white">Adicionar Funcionário</a><br>
								</div>
								<hr>
								<div class="menu-inteiro">
									<ul>
										<li>
											<a href="listFuncionario.php"><i class="fas fa-users text-black"></i>Cadastrar Funcionários</a>
										</li>
										<li>
											<a href="listDentista.php"><i class="fas fa-user-md text-black"></i>Cadastrar Dentistas</a>
										</li>
										<li>
											<a href="listConvenio.php"><i class="fas fa-address-card text-black"></i>Cadastrar Convênios</a>
										</li>
										<li>
											<a href="listProcedimento.php"><i class="fas fa-tooth text-black"></i>Cadastrar Procedimentos</a>
										</li>
										<li>
											<a href=""><i class="fas fa-cogs text-black"></i>Configurar Anamnese</a>
										</li>
									</ul>
								</div>
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

							<div class="form-group col-md-6 busca">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Buscar..." name="buscaPaciente">
										<div class="input-group-append">
										    <button class="btn btn-verde" type="button">
										    	<i class="fas fa-search text-white"></i>
											</button>
										</div>
									</div>
							</div>

							<form action="listPaciente.php" method="GET">
								<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<td>Nome</td>
													<td>Telefone</td>
													<td>Grupo</td>
													<td>Ações</td>
												</tr>
											</thead>
											<tbody>
												<tr class="conteudo-listagem">
													<td>Ana Silva</td>
													<td>(37) 9 9958-1386</td>
													<td>Secretária</td>
													<td>
														<a name="visualizar" href="visuFuncionario.php" class="btn btn-verde text-white">Visualizar</a>
														<a name="editar" href="editFuncionario.php" class="btn btn-editar text-white">Editar</a>
														<a href="apagarFuncionario.php" name="excluir" class="btn btn-excluir text-white">Excluir</a>
													</td>
												</tr>
											</tbody>
											<tbody>
												<tr class="conteudo-listagem2">
													<td>André Silva</td>
													<td>(37) 9 9958-1386</td>
													<td>Gerente</td>
													<td>
														<a name="visualizar" href="visuFuncionario.php" class="btn btn-verde text-white">Visualizar</a>
														<a name="editar" href="editFuncionario.php" class="btn btn-editar text-white">Editar</a>
														<a href="apagarFuncionario.php" name="excluir" class="btn btn-excluir text-white">Excluir</a>
													</td>
												</tr>
											</tbody>
											<tbody>
												<tr class="conteudo-listagem">
													<td>Natália Silva</td>
													<td>(37) 9 9958-1386</td>
													<td>Assistente</td>
													<td>
														<a name="visualizar" href="visuFuncionario.php" class="btn btn-verde text-white">Visualizar</a>
														<a name="editar" href="editFuncionario.php" class="btn btn-editar text-white">Editar</a>
														<a href="apagarFuncionario.php" name="excluir" class="btn btn-excluir text-white">Excluir</a>
													</td>
												</tr>
											</tbody>
										</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Fim do Conteúdo-->

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
</html>
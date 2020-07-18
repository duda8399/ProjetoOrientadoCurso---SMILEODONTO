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
		<div class="geral">
			<!--Início do Navbar-->
		  <?php include_once("_incluir/navbar.php")  ?>
		<!--Fim do Navbar-->

		<!--Início do Conteúdo-->
		<section>
			<div class="container-fluid">
				<div class="row">
					<!--Início do Menu Lateral-->
					<div class="col-lg-3">
						<?php
							if (isset($_GET['codigo'])) {
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
								<img src="img/pac.png">
								<h3>Pacientes</h3>
							</div>

							<form>
								<div class="form-row form">

									<div class="col-lg-6">
										<div class="upload">
											<img src="img/add-foto.png" id="img-file" width="130" height="129" class="rounded-circle img-file">
										</div>
										
										<div class="fileUpload btn btn-outline-success">
    										<span><i class="fas fa-upload text-black mr-3"></i>Enviar Foto</span>
    										<input type="file" id="foto-upload" class="upload" name="fotoPaciente" />
										</div>
									</div>

									<div class="col-lg-6">
										<label for="nomePaciente">Nome do Paciente:</label>
										<input type="text" name="nomePaciente" id="nomePaciente" placeholder="Digite o nome completo" class="form-control">

										<label for="dataCadastro" class="pt-3">Data do Cadastro:</label>
										<input type="date" name="dataCadastro" id="dataCadastro" class="form-control">
									</div>

									<div class="col-lg-6">
										<label for="CPF" class="pt-3">CPF:</label>
										<input type="text" name="CPF" id="CPF" placeholder="___.___.___-__" class="form-control">
									</div>

									<div class="col-lg-6">
										<label for="RG" class="pt-3">RG:</label>
										<input type="text" name="RG" id="RG" placeholder="__.___.___-__" class="form-control">
									</div>

									<div class="col-lg-6">
										<label for="dataNascimento" class="pt-3">Data de Nascimento:</label>
										<input type="date" name="dataNascimento" id="dataNascimento" class="form-control">
									</div>

									<div class="col-lg-6">
										<label for="sexo" class="pt-4">Sexo:</label><br>

										<input class="radio-inline" type="radio" name="sexo" id ="masc" value="masculino" checked="yes"> <label for="masc" class="radio">Masculino</label>

                						<input class="radio-inline" type="radio" name="sexo" id="fem" value="feminino"> <label for="fem" class="radio">Feminino</label>
									</div>
								</div>

								<div class="form-row form">
									<div class="col-lg-9">
										<img src="img/map.png">
										<span class="titulo">Endereço</span>
									</div>

									<div class="col-lg-4">
										<label for="cep" class="pt-3">CEP:</label>
										<input type="text" name="cep" id="cep" class="form-control">
									</div>

									<div class="col-lg-4">
										<label for="estado" class="pt-3">Estado:</label>
										<input type="text" name="estado" id="estado" class="form-control" placeholder="Exemplo: São Paulo">
									</div>

									<div class="col-lg-4">
										<label for="cidade" class="pt-3">Cidade:</label>
										<input type="text" name="cidade" id="cidade" class="form-control" placeholder="Exemplo: São Paulo">
									</div>

									<div class="col-lg-8">
										<label for="endereco" class="pt-3">Endereço:</label>
										<input type="text" name="endereco" id="endereco" class="form-control" placeholder="Exemplo: Av. Paulista">
									</div>

									<div class="col-lg-2">
										<label for="num" class="pt-3">Número:</label>
										<input type="number" name="num" id="num" class="form-control">
									</div>

									<div class="col-lg-2">
										<label for="complemento" class="pt-3">Complemento:</label>
										<input type="text" name="complemento" id="complemento" class="form-control">
									</div>

									<div class="col-lg-9 alerta">
										<p id="mensagem"></p>
									</div>
								</div>

								<div class="form-row form">
									<div class="col-lg-9">
										<img src="img/contact.png">
										<span class="titulo">Contato</span>
									</div>

									<div class="col-lg-5">
										<label for="tipo" class="pt-3">Tipo:</label>
										<select class="form-control" name="tipo" id="tipo">
											<option>Selecione:</option>
											<option>Celular</option>
											<option>Telefone residencial</option>
										</select>
									</div>

									<div class="col-lg-5">
										<label for="telefone" class="pt-3">Telefone:</label>
										<div class="input-group">
											<input type="tel" class="form-control" id="telefone" name="telefone">
  											<div class="input-group-append">
    											<span class="input-group-text"><i class="fas fa-phone text-white"></i></span>
  											</div>
										</div>
									</div>

									<div class="col-lg-1 pt-5 ml-5">
										<button type="button" id="add-campo" class="btn btn-primary btn-custom"><i class="fas fa-plus text-white"></i></button>
									</div>

									<div class="col-lg-5" id="add-tipo">
										
									</div>

									<div class="col-lg-5" id="add-telefone">
										
									</div>

									<div class="col-lg-1 ml-5" id="tira-campo">
										
									</div>

									<div class="col-lg-6">
										<label for="email" class="pt-3">E-mail:</label>
										<div class="input-group">
											<input type="email" class="form-control" id="email" name="email">
  											<div class="input-group-append">
    											<span class="input-group-text"><i class="fas fa-envelope text-white"></i></span>
  											</div>
										</div>
									</div>
								</div>

								<div class="form-row form1">
									<div class="col-lg-9">
										<img src="img/user-respon.png">
										<span class="titulo">Responsável</span>
									</div>

									<div class="col-lg-4">
										<label for="responsavel" class="pt-3">Tem responsável?</label><br>

										<input type="radio" name="responsavel" id="sim" value="sim" class="radio-inline"><label for="sim" class="radio ml-1">Sim</label>
										<input type="radio" name="responsavel" id="nao" value="nao" class="radio-inline ml-3"><label for="nao" class="radio ml-1">Não</label>
									</div>

									<div class="col-lg-8">
										<label class="pt-3" for="responsavel">Responsável:</label>
										<select name="responsavel" id="responsavel" class="form-control">
											<option>Selecione:</option>
										</select>
									</div>
								</div>

								<div class="form-row form1">
									<div class="col-lg-9 pt-5">
										<input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success right">
										<a href="listPaciente.php" class="right2">Voltar à listagem</a>
									</div>
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
		</div>
		

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funcoes.js"></script>

	</body>
</html>
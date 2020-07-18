<?php
	if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
								<div class="conteudo-form">
									<div class="cabecalho-conteudo">
										<img src="img/pac.png">
										<h3>Pacientes</h3>
									</div>

									<form id="add-paciente" method="POST" action="paciente_controller.php?acao=inserir" enctype="multipart/form-data">
										<div class="form-row form">

											<div class="col-lg-12 p-0">
												<div class="alert alert-info" role="alert">
												  Os campos marcados com <span style="color: red;margin-left: 5px;">*</span> são de preenchimento obrigatório.
												</div>
											</div>

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
												<label for="nomePaciente">Nome do Paciente:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="nomePaciente" id="nomePaciente" placeholder="Digite o nome completo" class="form-control" required="">

												<label for="dataCadastro" class="pt-3">Data do Cadastro:</label>
												<input type="text" name="dataCadastro" id="dataCadastro" class="form-control" value="<?php echo date('d/m/Y');?>">
											</div>

											<div class="col-lg-6">
												<label for="CPF" class="pt-3">CPF:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="CPF" id="CPF" placeholder="Ex.: 000.000.000-00" class="form-control CPF" required="">
											</div>

											<div class="col-lg-6">
												<label for="RG" class="pt-3">RG:</label>
												<input type="text" name="RG" id="RG" placeholder="Ex.: AA-00.000.000" class="form-control RG">
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
												<input type="text" name="cep" id="cep" class="form-control"
												placeholder="Ex.: 00000-000">
											</div>

											<div class="col-lg-4">
												<label for="estado" class="pt-3">Estado:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<select name="estado" id="estado" class="form-control" required="">
													<option>Selecione..</option>
												</select>
											</div>

											<div class="col-lg-4">
												<label for="cidade" class="pt-3">Cidade:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<select name="cidade" id="cidade" class="form-control" required="">
												</select>
							
											</div>

											<div class="col-lg-4">
												<label for="bairro" class="pt-3">Bairro:
												</label>
												<input type="text" name="bairro" id="bairro" class="form-control" placeholder="Ex.: Bairro">
											</div>

											<div class="col-lg-4">
												<label for="logradouro" class="pt-3">Endereço:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Ex.: Rua A" required="">
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

											<div class="col-lg-6">
												<label for="celular" class="pt-3">Celular:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" class="form-control tel" id="celular" name="celular" placeholder="Ex.: (00) 0 0000-0000" required="">
											</div>

											<div class="col-lg-6">
												<label for="telefoneRes" class="pt-3">Telefone Residencial:
												</label>
												<div class="input-group">
													<input type="text" class="form-control" id="telefoneRes" name="telefoneRes" placeholder="Ex.: (00) 0000-0000">
												<div class="input-group-append">
		    											<span class="input-group-text"><i class="fas fa-phone text-white"></i></span>
		  											</div>
												</div>
											</div>

											<div class="col-lg-6">
												<label for="telefoneRec" class="pt-3">Telefone para Recado:
												</label>
												<input type="text" class="form-control tel" id="telefoneRec" name="telefoneRec" placeholder="Ex.: (00) 0 0000-0000">
											</div>

											<div class="col-lg-6">
												<label for="email" class="pt-3">E-mail:</label>
												<div class="input-group">
													<input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
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

											<div class="col-lg-12">
												<label for="responsavel" class="mr-3 mt-3">Tem responsável? </label>

												<input type="radio" class="radio-inline" name="responsavel" id="sim" value="Sim"><label class="ml-1 radio" for="sim">Sim</label>

												<input type="radio" class="radio-inline ml-2" name="responsavel" id="nao" value="Não" checked="yes"><label class="ml-1 radio" for="nao">Não</label>
											</div>

											<div class="col-lg-6 mt-3">
												<label for="nomeResponsavel">Nome do Responsável:</label>
												<input type="text" name="nomeResponsavel" id="nomeResponsavel" placeholder="Digite o nome completo" class="form-control">
											</div>

											<div class="col-lg-6 mt-3">
												<label for="telefone">Telefone do Responsável:</label>
												<input type="text" name="telefoneResponsavel" id="telefone" placeholder="Ex.: (00) 00000-0000" class="form-control tel">
											</div>

											<div class="col-lg-6 mt-2">
												<label for="CPF" class="pt-3">CPF do Responsável:</label>
												<input type="text" name="CPFResponsavel" id="CPF" placeholder="Ex.: 000.000.000-00" class="form-control CPF">
											</div>

											<div class="col-lg-6 mt-2">
												<label for="RG" class="pt-3">RG do Responsável:</label>
												<input type="text" name="RGResponsavel" id="RG" placeholder="Ex.: AA.000.000-00" class="form-control RG">
											</div>

										</div>

										<div class="form-row form1">
											<div class="col-lg-9 pt-5">
												<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-success">
												<a href="listPacienteS.php" class="btn btn-secondary ml-2">Cancelar</a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<script type="text/javascript">
   		$(".tel").mask("(00) 0 0000-0000");
   		$("#telefoneRes").mask("(00) 0000-0000");
   		$(".CPF").mask("000.000.000-00");
   		$("#cep").mask("00000-000");
   		$(".RG").mask("AA-00.000-000");
   		$("#dataCadastro").mask("00/00/0000");
    </script>

    	<script>
            function retornarEstados(data) {
                var estados = "";
                $.each(data, function(chave, valor){
                    estados += '<option value="' + valor.idUF + '">' + valor.nomeUF + '</option>';
                });
                $('#estado').html(estados);
            }

            $('#estado').change(function(e){
                var idUF = $(this).val();

                $.ajax({
                    type:"GET",
                    data:"idUF=" + idUF,
                    url:"http://localhost/SMILEE/retornarCidades.php",
                    async:false
                }).done(function(data){
                    var cidades = "";
                    $.each($.parseJSON(data), function(chave,valor){
                        cidades+= '<option value="' + valor.idCidade + '">' + valor.nomeCidade + '</option>';                    });
                    $('#cidade').html(cidades);
                })
            });
            
        </script>
        
        <script src="http://localhost/SMILEE/retornarEstados.php?callback=retornarEstados"></script>
    
	</body>
</html>
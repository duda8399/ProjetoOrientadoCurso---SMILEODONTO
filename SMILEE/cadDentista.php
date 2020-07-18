<?php
	  
	$acao = 'recuperar';
	require 'dentista_controller.php';
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
										<h3>Cadastrar Dentistas</h3>
									</div>
									<div class="corpo-menu">
										<div class="botao-cadastrar">
											<a href="cadDentista.php" name="cadastrar" class="btn btn-cadastrar text-white">Adicionar Dentista</a><br>
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
										<i class="fas fa-user-md icon-conteudo"></i>
										<h3>Dentistas</h3>
									</div>

									<form id="add-dentista" method="POST" action="dentista_controller.php?acao=inserir" enctype="multipart/form-data">
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
		    										<input type="file" id="foto-upload" class="upload" name="fotoDentista" />
												</div>
											</div>

											<div class="col-lg-6">
												<label for="nomeDentista">Nome do Dentista:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="nomeDentista" id="nomeDentista" placeholder="Digite o nome completo" class="form-control">

												<label for="dataEntrada" class="pt-3">Data de Entrada:</label>
												<input type="text" name="dataEntrada" id="dataEntrada" class="form-control" value="<?php echo date('d/m/Y');?>">
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
											<div class="col-lg-12">
												<img src="img/tooth.png">
												<span class="titulo">Identificação</span>
											</div>

											<div class="col-lg-3">
												<label for="CRO" class="pt-3">Número do conselho:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="CRO" id="CRO" class="form-control" required="" placeholder="Digite o CRO">
											</div>

											<div class="col-lg-3">
												<label for="siglaConselho" class="pt-3">Sigla do conselho:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="sigla" id="siglaConselho" class="form-control" placeholder="Digite a sigla">
											</div>

											<div class="col-lg-3">
												<label for="ufConselho" class="pt-3">UF do conselho:</label>
												<select name="ufConselho" id="ufConselho" class="form-control">

												<?php foreach ($recuperar_uf as $uf) { ?>
													<option value="<?php echo $uf["idUF"]; ?>">
														<?php echo $uf["sigla"]; ?>	
													</option>
												<?php } ?>
												</select>
											</div>

											<div class="col-lg-3">
												<label for="especialidade" class="pt-3">Especialidade:
													<span style="color: red;margin-left: 5px;">*</span>
												</label><br>

												<select name="especialidade" id="especialidade" class="form-control" required="">
													<?php foreach ($recuperar_espec as $espec) { ?>

													<option value="<?php echo $espec["idEspecialidade"]; ?>">	<?php echo $espec["nomeEspecialidade"]; ?>
													</option>

													<?php } ?>
												</select>
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
												<input type="text" name="bairro" id="bairro" class="form-control" placeholder="Ex.: Novo Horizonte">
											</div>

											<div class="col-lg-4">
												<label for="logradouro" class="pt-3">Endereço:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Ex.: Abílio Machado" required="">
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
												<span class="titulo">Acesso ao sistema</span>
											</div>

											<div class="col-lg-6">
												<label for="InputLogin" class="pt-3">Usuário:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<input type="text" name="login" id="InputLogin" class="form-control" placeholder="Digite um e-mail ou nome de usuário" required="">
											</div>

											<div class="col-lg-6">
												<label for="senha" class="pt-3">Senha:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>

												<div class="input-group mb-3">
												  	<input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a senha" required="">

												  	<div class="input-group-append">
												    	<button class="btn btn-secondary" type="button" id="btnSenha">
												    		<i class="fas fa-eye text-white"></i>
												    	</button>
												  	</div>
												</div>
											</div>

											<div class="col-lg-6">
												<label for="cargo" class="pt-3">Cargo:
													<span style="color: red;margin-left: 5px;">*</span>
												</label>
												<select class="form-control" name="cargo" id="cargo" required="">

													<?php foreach ($recuperar_cargo as $cargo) { ?>
														<option value="<?php echo $cargo["idCargo"]; ?>">	<?php echo $cargo["nomeCargo"]; ?>
														</option>
													<?php } ?>

												</select>
											</div>

											<div class="col-lg-6">
												<label for="dataSaida" class="pt-3">Data de Saída:</label>
												<input type="date" name="dataSaida" id="dataSaida" class="form-control">
											</div>

										</div>

										<div class="form-row form1">
											<div class="col-lg-9 pt-5">
												<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-success">
												<a href="listDentista.php" class="btn btn-secondary ml-2">Cancelar</a>
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
	   		$("#dataEntrada").mask("00/00/0000");
	    </script>

    	<script>
    		$(document).ready(function(){
 
			 	$('#btnSenha').on('click', function(){
			    
			    var passwordField = $('#senha');
			    var passwordFieldType = passwordField.attr('type');
			 
			    if(passwordFieldType == 'password') {

			        passwordField.attr('type', 'text');
			        $(this).val('Hide');

			    } else {
			        
			        passwordField.attr('type', 'password');
			 
			        $(this).val('Show');
			    }

				});
			});
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

        <script>
			var cont = 1;
	        
	        $("#add-campo").click(function () {
	        	cont++;
					
	                $("#adicionar").append('<div class="row mt-2" id="campo' + cont + '"><i class="fas fa-trash btn-apagar" style="margin-top: 40px;margin-left: 5px;cursor: pointer;" id="' + cont + '"></i><div class="col-lg-6"><label for="pergunta">Pergunta:</label><input type="text" id="pergunta" name="questao[]" class="form-control" placeholder="Digite a pergunta"></div><div class="col-lg-2"><label for="obrigatorio">Obrigatoriedade:</label><select class="form-control" name="obrigatorio[]" id="obrigatorio"><?php foreach ($recuperar_obg as $obg) { ?><option value="<?php echo $obg["idObrigatoriedade"]; ?>"><?php echo $obg["obrigatorio"]; ?>	</option><?php } ?></select></div><div class="col-lg-3"><label for="alerta">Alerta:</label><select class="form-control" name="alerta[]" id="alerta"><?php foreach ($recuperar_alerta as $alerta) { ?><option value="<?php echo $alerta["idAlerta"]; ?>"><?php echo $alerta["alerta"]; ?></option><?php } ?></select></div></div>');
	            });

	        	$('form').on('click', '.btn-apagar', function () {
		            var button_id = $(this).attr("id");
		            $('#campo' + button_id + '').remove();
		        });

        </script>

	</body>
</html>
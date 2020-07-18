<?php
	session_start();
	if (isset($_GET['id'])) {
		$idPaciente = $_GET['id'];
		$_SESSION['paciente'] = $idPaciente;
	}
	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <!-- Javacript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- Datatable -->
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

		<script>
			$(document).ready(function() {
			    $('#listar-paciente').DataTable({
	        		"serverSide": true,
	                "ajax": {
			            "url": "list_paciente.php",
			            "type": "POST"
			        },
			        "language": {
						"url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
					},
			    });    
			} );
		</script>

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

								<div class="col-lg-9">
									<div class="conteudo">
										<div class="cabecalho-conteudo">
											<img src="img/pac.png">
											<h3>Pacientes</h3>
										</div>

										<form method="POST" action="paciente_rotas.php">
											<div class="table-responsive pt-3 pl-2 pr-2 pb-2">
												<table id="listar-paciente" class="table table-striped" style="width:100%">
													<thead>
														<tr>
															<th></th>
											                <th>Nome</th>
											                <th>Logradouro</th>
											                <th>Telefone</th>
														</tr>
											        </thead>
												</table>
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
	</body>
			
</html>


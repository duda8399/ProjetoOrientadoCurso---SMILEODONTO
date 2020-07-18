<?php
	
	if (isset($_POST['dataAI']) && isset($_POST['dataAF'])) {

		session_start();

		$_SESSION['dataAI'] = $_POST['dataAI'];
		$_SESSION['dataAF'] = $_POST['dataAF'];

	}else{
		session_start();

		$_SESSION['dataAI'] = '2019-01-01';
		$_SESSION['dataAF'] = '2019-12-31';
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
		<!-- Datatable -->
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
		<!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

		<script>
			$(document).ready(function() {
				var printCounter = 0;
			 
			    $('#listar-agenda').DataTable({
	        		"serverSide": true,
	                "ajax": {
			            "url": "list_relatorio_agenda.php",
			            "type": "POST"
			        },
			        "language": {
						"url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
					},
					dom: 'Bfrtip',
			        buttons: [
			            {
			                extend: 'excel'
			            },
			            {
			                extend: 'pdf',
			                messageBottom: null
			            },
			        ]
			    });    
			} );
		</script>

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
											<h3>Relatório de Agendamentos</h3>
										</div>
										<div class="corpo-menu">
											<div class="m-3">
												<span>
													Resumo dos agendamentos cadastrados por período.
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
											<i class="far fa-calendar-alt icon-conteudo"></i>
											<h3>Agendamentos</h3>
										</div>

										<form method="POST" method="relatorioAgenda.php">
											<div class="form-row form">

												<div class="col-lg-6">
													<label>Período de Cadastro</label>
													<div class="input-group mt-3">
														<div class="input-group-prepend">
														    <span class="input-group-text" style="background: #CCC;">De</span>
														</div>
														<input type="date" name="dataAI" class="form-control" value="<?php echo $_SESSION['dataAI']; ?>">

														<div class="input-group-prepend">
														    <span class="input-group-text" style="background: #CCC;">à</span>
														</div>
														<input type="date" name="dataAF" class="form-control" value="<?php echo $_SESSION['dataAF']; ?>">
													</div>
												</div>

												<div class="col-lg-6">
													<button type="submit" class="btn btn-verde text-white" style="margin-top: 48px;margin-left: 100px;">Gerar relatório</button>
												</div>
													
											</div>
										</form>
										<div class="row">
											<div class="col-lg-12">
												<div class="table-responsive pt-3 pl-2 pr-2 pb-2">
													<table id="listar-agenda" class="table table-striped" style="width:100%">
														<thead>
															<tr>
																<th>Paciente</th>
																<th>Dentista</th>
																<th>Data</th>
												                <th>Tipo</th>
												                <th>Motivo</th>
												                <th>Situação</th>
															</tr>
												        </thead>
													</table>
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
	</body>
</html>
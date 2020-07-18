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
			    $('#listar-parcelas').DataTable({
	        		"serverSide": true,
	                "ajax": {
			            "url": "list_parcelaPend.php",
			            "type": "POST"
			        },
			        "language": {
						"url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
					},
			    });    
			} );
		</script>
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
									<div class="menu-lateral-financeiro">
										<div class="cabecalho">
											<h3>Fluxo de Caixa</h3>
										</div>
										<ul class="list-group">
											<li class="list-group-item"><a href="financeiro.php">Todas as parcelas</a></li>
											<li class="list-group-item"><a href="financeiroPago.php">Parcelas pagas</a></li>
											<li class="list-group-item active"><a href="financeiroPendente.php">Parcelas pendentes</a></li>
										</ul>
									</div>
								</div>
								<!--Fim do Menu Lateral-->

								<div class="col-lg-9">
									<div class="conteudo">
										<div class="cabecalho-conteudo">
											<i class="fas fa-money-check-alt icon-conteudo"></i>
											<h3 class="pl-1">Parcelas pendentes</h3>
										</div>

										<div class="table-responsive pt-3 pl-2 pr-2 pb-2">
											<table id="listar-parcelas" class="table table-striped" style="width:100%">
												<thead>
													<tr>
														<th>Paciente</th>
											            <th>Telefone</th>
											            <th>Valor Parcela</th>
											            <th>Vencimento</th>
											            <th>Tratamento</th>
											            <th>Status</th>
													</tr>
											    </thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
			</div>
		</div>
	</body>
</html>
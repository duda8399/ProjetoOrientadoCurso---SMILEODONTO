<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['paciente'])) {
		  	unset($_SESSION['paciente']);
		    header('location:listPaciente.php');
		}

	if (isset($_GET['id'])) {
		$codigo = $_GET['id'];
		$_SESSION['tratamento'] = $codigo;
	}
	
	$acao = 'recuperar';
	require 'odonto_controller.php';
	
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
											<i class="fas fa-file-invoice-dollar icon-conteudo"></i>
											<h3>Orçamentos</h3>
										</div>

										<div class="row">

											<div class="col-lg-12 mt-2 ml-2">
												<label>Paciente: </label>
												<span><?php echo $row_pac['nome']; ?></span>
												<label class="ml-5">Orçamento: </label>
												<span><?php echo $_SESSION['tratamento']; ?></span>
											</div>

											<div class="col-lg-12 pb-3 pt-3">
							                    <div style="overflow: hidden;width: 900px;margin: auto;">

										            <img src="img/18.png" style="margin: 0px;padding: 0px;">
										            <img src="img/17.png" style="margin: 0px;padding: 0px;">
										            <img src="img/16.png" style="margin: 0px;padding: 0px;">
										            <img src="img/15.png" style="margin: 0px;padding: 0px;">
										            <img src="img/14.png" style="margin: 0px;padding: 0px;">
										            <img src="img/13.png" style="margin: 0px;padding: 0px;">
										            <img src="img/12.png" style="margin: 0px;padding: 0px;">
										            <img src="img/11.png" style="margin: 0px;padding: 0px;">
										            <img src="img/21.png" style="margin: 0px;padding: 0px;">
										            <img src="img/22.png" style="margin: 0px;padding: 0px;">
										            <img src="img/23.png" style="margin: 0px;padding: 0px;">
										            <img src="img/24.png" style="margin: 0px;padding: 0px;">
										            <img src="img/25.png" style="margin: 0px;padding: 0px;"><img src="img/26.png" style="margin: 0px;padding: 0px;">
										            <img src="img/27.png" style="margin: 0px;padding: 0px;">
										            <img src="img/28.png" style="margin: 0px;padding: 0px;">       
										        </div>
										                            
										        <div style="overflow: hidden;width: 900px;margin: auto;padding-top: 20px;">

										            <img src="img/48.png" style="margin: 0px;padding: 0px;">
										            <img src="img/47.png" style="margin: 0px;padding: 0px;">
										            <img src="img/46.png" style="margin: 0px;padding: 0px;">
										            <img src="img/45.png" style="margin: 0px;padding: 0px;">
										            <img src="img/44.png" style="margin: 0px;padding: 0px;"><img src="img/43.png" style="margin: 0px;padding: 0px;">
										            <img src="img/42.png" style="margin: 0px;padding: 0px;">
										            <img src="img/41.png" style="margin: 0px;padding: 0px;">
										            <img src="img/31.png" style="margin: 0px;padding: 0px;">
										            <img src="img/32.png" style="margin: 0px;padding: 0px;">
										            <img src="img/33.png" style="margin: 0px;padding: 0px;">
										            <img src="img/34.png" style="margin: 0px;padding: 0px;">
										            <img src="img/35.png" style="margin: 0px;padding: 0px;"><img src="img/36.png" style="margin: 0px;padding: 0px;">
										            <img src="img/37.png" style="margin: 0px;padding: 0px;">
										            <img src="img/38.png" style="margin: 0px;padding: 0px;">       
										        </div>
							                </div>

							                <div class="col-lg-12">
												<table id="listar-orcamento" class="table table-striped">
													<thead>
														<th>Face</th>
														<th>Procedimento</th>
														<th>Valor</th>
														</thead>
														<tbody>
															<?php foreach ($recuperar_pt as $pt) { ?>
															<tr>
																<td><?php echo $pt['nome']; ?></td>
																<td><?php echo $pt['nomeProcedimento']; ?></td>
																<td>R$ <?php echo $pt['valor']; ?></td>
															</tr>
															<?php } ?>
														</tbody>
														<tfoot>
															<td id="valorTotal" style="font-weight: bold;">Valor Total: <span style="font-weight: normal;">R$ <?php echo ceil($row_total['total']); ?>,00</span></td>
														</tfoot>
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
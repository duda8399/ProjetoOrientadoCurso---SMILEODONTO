<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['pacienteS']))
	  {
	  	unset($_SESSION['pacienteS']);
	    header('location:listPacienteS.php');
	  }

	$acao = 'recuperar';
	require 'orcamento_controllerS.php';
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
										<i class="fas fa-file-invoice-dollar icon-conteudo"></i>
										<h3>Orçamentos</h3>
									</div>

										<?php if(isset ($_GET['msg']) && $_GET['msg'] == 8){ ?>
											<div class="alert bg-success alert-dismissible fade show text-white" role="alert">
												Orçamento APROVADO com sucesso!
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php } ?>

										<form method="POST" action="orcamento_rotas.php">
											
											<div class="table-responsive pb-2 pt-4">
												<table id="listar-orcamento" class="table table-striped" style="width:100%">
													<thead>
														<tr>
															<th>Orçamento</th>
															<th>Aberto em</th>
															<th>Dentista Responsável</th>
															<th>Situação</th>
											                <th>Ações</th>
														</tr>
											        </thead>
											        <tbody>
											        	<?php foreach ($resultado_orcamento as $row_orcamento) { $dataAbertura = $row_orcamento['dataAbertura'];
															 $data = implode("/",array_reverse(explode("-",$dataAbertura)));?>
											        	<tr>											    
											        		<td><?php echo $row_orcamento["idTratamento"]; ?></td>
											        		<td><?php echo $data; ?></td>
											        		<td><?php echo $row_orcamento["nome"]; ?></td>   <td><?php echo $row_orcamento["situacao"]; ?></td>
											        		<?php if ($row_orcamento['idSituacaoTrat'] == 3){?>
											        			<td>
											        				<?php echo'<a href="orcamentoAprovadoS.php?id='.$row_orcamento["idTratamento"].'" class="btn btn-verde text-white ml-2 mr-2">Odontograma</a>'; ?>
											        			</td>
											        		<?php }else{ ?>
											        			<td>
											        				<?php echo '<a href="cadOrcamentoS.php?id='.$row_orcamento["idTratamento"].'" class="btn btn-info text-white ml-2 mr-2">Realizar Aprovação</a>'; ?>
											        			</td>
											        	</tr>
											        	<?php }} ?>
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
			</div>
		</div>

		<!--Início do Rodapé-->
		<?php include_once("_incluir/footer.php") ?>
		<!--Fim do Rodapé-->

		<script src="js/funcoes.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	</body>
</html>
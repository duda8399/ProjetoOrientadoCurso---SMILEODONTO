<?php

	require 'tabelasIndex.php';
	require 'grafico_controller.php';
 ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
		<!-- https://www.cloudia.com.br/odontograma/ -->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <!-- Estilo customizado -->
	    <link rel="stylesheet" type="text/css" href="_css/estilo.css">
	    <!-- Gráfico -->
	    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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

							<div class="col-lg-8">
								<div class="conteudo-graficoS">
									<div class="cabecalho-conteudo">
										<i class="fas fa-chart-pie icon-conteudo"></i>
										<h3 style="margin-top: -25px;margin-left: 30px;">Gráfico Agendamentos</h3>
									</div>

									<div class="col-lg-12" style="margin-left: -45px;">
										<div id="myColumnChart" style="margin-top: 30px; margin-left: 55px;"></div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 espaco">
								<table class="table-index table">
									<thead>
										<th>Pacientes do dia (<?php echo date('d/m');?>)</th>
										<th></th>
									</thead>
									<thead class="thead-index">
										<th class="th-index">Paciente</th>
										<th class="th-index">Horário</th>
									</thead>
									<tbody class="tbody-index">
										<?php foreach ($consulta_ph as $ph) { ?>
										<tr>
											<td class="td-index"><?php echo $ph['nome']; ?></td>
											<td class="td-index"><?php echo $ph['horarioInicio']; ?></td>
										</tr>
										<?php } ?>
									</tbody>
									
								</table>
							</div>

							<div class="col-lg-8 mb-5">
								<div class="conteudo-grafico1 mt-5">
									<div class="cabecalho-conteudo">
										<i class="fas fa-chart-pie icon-conteudo"></i>
										<h3 style="margin-top: -25px;margin-left: 45px;">Gráfico Financeiro</h3>
									</div>

									<div class="col-lg-12" style="margin-left: -45px;">
										<div id="myPieChart" style="margin-top: 30px; margin-left: 55px;"></div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 mt-2">
										
								<table class="table-index table">
									<thead>
										<th>Parcelas a receber (<?php echo date('d/m');?>)</th>
										<th></th>
										<th></th>
									</thead>
									<thead class="thead-index">
										<th class="th-index">Data vencimento</th>
										<th class="th-index">Paciente</th>
										<th class="th-index">Valor</th>
									</thead>
									<tbody class="tbody-index">
										<?php foreach ($consulta_pag as $pag) { 
											$dataV = $pag['dataVencimento'];
											$data = implode("/",array_reverse(explode("-",$dataV)));?>
										<tr>
											<td class="td-index"><?php echo $data; ?></td>
											<td class="td-index"><?php echo $pag['nome']; ?></td>
											<td class="td-index"><?php echo 'R$' . $pag['valorParcela']; ?></td>
										</tr>
										<?php } ?>
									</tbody>
									
								</table>
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

		<script type="text/javascript">
		    google.charts.load('current', {packages: ['corechart']});
		    google.charts.setOnLoadCallback(drawChart);

		    function drawChart() {
		      // Define the chart to be drawn.
		      var data = new google.visualization.DataTable();
		      data.addColumn('string', 'Mês');
		      data.addColumn('number', 'Nº');

		      data.addRows(<?php echo $i ?>);

		      <?php 
		      		$a = $i;

		      		for ($i=1; $i < $a; $i++) { ?>

		      			data.setValue(<?php echo $i ?>, 0, '<?php echo $meses[$i] ?>');
		      			data.setValue(<?php echo $i ?>, 1, <?php echo $qtde[$i] ?>);

		      <?php } ?>



		      var options = {
		      	title: 'Agendamentos por mês',
		      	width: 800, height: 300,
		      	colors: ['#335070'],
		      	legend: {position: 'bottom'}
		      }
		      ////////////////////////////////////////////////////////////////////////
		      var data2 = new google.visualization.DataTable();
		      data2.addColumn('string', 'Mês');
		      data2.addColumn('number', 'Ganhos em R$');

		      data2.addRows(<?php echo $k ?>);

		      <?php 
		      		$p = $k;

		      		for ($k=1; $k < $p; $k++) { ?>

		      			data2.setValue(<?php echo $k ?>, 0, '<?php echo $meses[$k] ?>');
		      			data2.setValue(<?php echo $k ?>, 1, <?php echo $valor[$k] ?>);

		      <?php } ?>

		      var options2 = {
		      	title: 'Ganhos por mês',
		      	width: 800, height: 300,
		      	colors: ['#335070'],
		      	legend: {position: 'bottom'}
		      }

		      var chart = new google.visualization.ColumnChart(document.getElementById('myColumnChart'));
		      chart.draw(data, options);

		      var chart2 = new google.visualization.AreaChart(document.getElementById('myPieChart'));
		      chart2.draw(data2, options2);

		    }
		  </script>

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funcoes.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    
	</body>
</html>
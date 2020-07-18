<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['pacienteS']))
	  {
	      header('location:listPacienteS.php');
	  }

	require "selecionaPaciente.php";
?>

<div class="menu-lateral2">
	<div class="cabecalho">
		<h3>Paciente</h3>
	</div>
	<div class="corpo-menu">
		<?php foreach ($pega_paciente as $pac){ 
			$foto = $pac['foto']; 
			$id   = $pac['idPessoa']; ?>
			
			<?php if ($foto != ""){ ?>
				<img src="<?php echo "uploads/$id/$foto"; ?>" height="80" width="80" alt="imagem" class="rounded-circle ml-3">
			<?php }else{ ?>
				<img src="img/add-foto.png" height="80" width="80" alt="imagem" class="rounded-circle ml-3">
			<?php } ?>

			<p class="nome-user"><?php echo $pac['nome']; ?></p>
			<!-- <button class="btn-email" data-toggle="modal" data-target="#enviarEmail"><i class="fas fa-envelope" ></i></button>
			<span class="email">Enviar e-mail</span> -->


		<?php } ?>
		<hr class="hr-menu">
		<div class="botoes">
			<a href="cadPaciente.php" name="cadastrar" class="btn btn-azul text-white">Novo Paciente</a><br>
			<a href="listPacienteS.php" name="localizar" class="btn btn-verde text-white">Localizar Paciente</a>
		</div>
		<hr>
		<div class="menu-inteiro">
			<ul>
				<li>
					<a href="listOrcamentoS.php"><i class="fas fa-file-invoice-dollar text-black"></i>Orçamento</a>
				</li>
				<li>
					<a href="listPagamento.php"><i class="fas fa-money-check-alt text-black"></i>Pagamentos</a>
				</li>
			</ul>
		</div>
	</div>
</div>


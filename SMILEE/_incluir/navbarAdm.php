<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['adm']))
	  {
	  	unset($_SESSION['adm']);
	    unset($_SESSION['funcionarioAdm']);
	    unset($_SESSION['usuarioAdm']);
	  	unset($_SESSION['senhaAdm']);
	    header('location:login.php');
	  }

	$login = 'recuperarA';
	require "selecionaFuncionario.php";
?>

<header>
	<nav class="navbar navbar-expand-lg navbar-dark navbar-color fixed-top">
		<div class="container">

			<a href="indexAdm.php" class="navbar-brand">
			    <span style="padding-top: 20px;font-weight: bold;font-size: 15pt;">SMILE ODONTO</span>
			</a>

			<button class="navbar-toggler"
			        data-toggle="collapse"
			        data-target="#nav-principal">
				<i class="fas fa-bars text-white"></i>
			</button>
					
			<div class="collapse navbar-collapse" id="nav-principal">

			<ul class="navbar-nav">

				<li class="nav-item">
					<a href="indexAdm.php" class="nav-link">
						<span>Início</span> 
					</a>
				</li>

				<li class="nav-item">
					<a href="listDentista.php" class="nav-link">
						<span>Dentista</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="listFuncionario.php" class="nav-link">
						<span>Funcionário</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="listProcedimento.php" class="nav-link">
						<span>Procedimento</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="listCadAnamnese.php" class="nav-link">
						<span>Anamnese</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="listEspecialidade.php" class="nav-link">
						<span>Especialidade</span>
					</a>
				</li>

				<li class="nav-item user-menu d-none d-lg-block mb-0">
					<a href="" class="nav-link">
						<span><?php echo $rowPegaA['nome']; ?></span>
					</a>
				</li>

				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<?php 

							$foto = $rowPegaA['foto'];
							$id = $rowPegaA['idPessoa'];

						 if ($foto == '') { ?>
							<img src="img/add-foto.png" height="45" width="45" alt="imagem" class="rounded-circle nav-link dropdown-toggle menu-img" href="" data-toggle="dropdown">
						<?php }else{ ?>
							<img src="<?php echo "uploads/$id/$foto"; ?>" height="45" width="45" alt="imagem" class="rounded-circle nav-link dropdown-toggle menu-img" href="" data-toggle="dropdown">
						<?php } ?>

						<div class="dropdown-menu">
                        	<a href="login_controller.php?sair=1" class="dropdown-item linkDrop" id="sair">Sair</a>
					    </div>
					</li>
				</ul>
			</ul>			
		</div>
		</div>
	</nav>
</header>

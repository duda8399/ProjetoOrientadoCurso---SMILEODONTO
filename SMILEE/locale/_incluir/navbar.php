<header>
	<nav class="navbar navbar-expand-lg navbar-dark navbar-color fixed-top">
		<div class="container">

			<a href="index.html" class="navbar-brand">
			     <img src="img/logo.png" width="150" height="45">
			</a>

			<button class="navbar-toggler"
			        data-toggle="collapse"
			        data-target="#nav-principal">
				<i class="fas fa-bars text-white"></i>
			</button>
					
			<div class="collapse navbar-collapse" id="nav-principal">

			<ul class="navbar-nav">

				<li class="nav-item">
					<a href="" class="nav-link">
						<span>Início</span> 
					</a>
				</li>
				<li class="nav-item">
					<a href="listPaciente.php" class="nav-link">
						<span>Pacientes</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="agenda.php" class="nav-link">
						<span>Agenda</span>
					</a>
				</li>

				<li class="nav-item mostrar-nav">
					<a href="listDentista.php" class="nav-link">
						<span>Cadastrar</span>
					</a>
				</li>

				<ul class="navbar-nav icon">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="listDentista.php" data-toggle="dropdown" id="navDrop">
							<span>Cadastrar</span>
						</a>

						<div class="dropdown-menu">
						    <a class="dropdown-item linkDrop" href="listDentista.php">Dentista</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item linkDrop" href="listFuncionario.php">Funcionário</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item linkDrop" href="listConvenio.php">Convênio</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item linkDrop" href="listProcedimento.php">Procedimento</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item linkDrop" href="">Anamnese</a>
						</div>
					</li>
				</ul>

				<li class="nav-item">
					<a href="" class="nav-link">
						<span>Financeiro</span>
					</a>
				</li>
				<li class="nav-item user-menu d-none d-lg-block mb-0">
					<a href="" class="nav-link">
						<span>Usuário</span>
					</a>
				</li>

				<ul class="navbar-nav icon-user">
					<li class="nav-item dropdown">
						<img src="img/girl.png" height="45" width="45" alt="imagem" class="rounded-circle nav-link dropdown-toggle menu-img" href="" data-toggle="dropdown">

						<div class="dropdown-menu">
                        	<a href="" class="dropdown-item linkDrop">Ajuda</a>
                        	<a href="" class="dropdown-item linkDrop">Sobre</a>
					        <div class="dropdown-divider"></div>
                        	<a href="" class="dropdown-item linkDrop">Sair</a>
					    </div>
					</li>
				</ul>
			</ul>			
		</div>
		</div>
	</nav>
</header>

<?php

	$acao = 'listar';
	require 'login_controller.php';
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Smile Odonto</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
					<span class="login100-form-title-1">
						SMILE ODONTO
					</span>
				</div>

				<form class="login100-form validate-form" action="login_controller.php?acao=conferir" method="POST">

					<div class="row">
						
						<div class="col-lg-12">
							<?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										Erro - Usuário e/ou senha incorretos!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php } ?>

							<?php if(isset ($_GET['msg']) && $_GET['msg'] == 5){ ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										Erro - por favor, tente novamente mais tarde!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php } ?>
							</div>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Acesso:</span>
						<select name="acesso" class="form-control ">
							<option>Selecione</option>
							<?php foreach ($recuperar_login as $login) { ?>
					    		<option value="<?php echo $login['idCargo']; ?>"><?php echo $login['nomeCargo']; ?></option>
					    	<?php } ?>
						</select>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Usuário obrigatório">
						<span class="label-input100">Usuário:</span>
						<input class="input100" type="text" name="usuario" placeholder="Digite seu usuário">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Senha obrigatória">
						<span class="label-input100">Senha:</span>
						<input class="input100" type="password" name="senha" placeholder="Digite a sua senha">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn" style="padding-top: 30px; padding-left: 80px;">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
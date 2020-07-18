<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "smileodonto";
	$conecta = mysqli_connect($servidor, $usuario, $senha, $banco);
	mysqli_set_charset($conecta,'utf8');

	if (mysqli_connect_errno()) {
		die("Conexão falhou: " . mysqli_connect_errno());
	}

  ?>
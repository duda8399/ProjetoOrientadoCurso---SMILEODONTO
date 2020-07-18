<?php 
	
	if (!isset($_SESSION)) session_start();

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	$login = isset($_GET['login']) ? $_GET['login'] : $login;

	if ($login == 'recuperarS') {

		$idFuncionarioS = $_SESSION['funcionarioS'];

		$pegaFuncionarioS   = "SELECT distinct p.idPessoa, p.nome, p.foto FROM pessoa p, funcionario func WHERE p.idPessoa = '$idFuncionarioS' AND p.idPessoa = func.idFuncionario ";
		$pega_funcionarioS   = mysqli_query($conecta,$pegaFuncionarioS);
		$rowPegaS = mysqli_fetch_assoc($pega_funcionarioS);

	}else if ($login == 'recuperarD') {

		$idFuncionarioD = $_SESSION['funcionarioD'];

		$pegaFuncionarioD   = "SELECT distinct p.idPessoa, p.nome, p.foto FROM pessoa p, funcionario func WHERE p.idPessoa = '$idFuncionarioD' AND p.idPessoa = func.idFuncionario ";
		$pega_funcionarioD   = mysqli_query($conecta,$pegaFuncionarioD);
		$rowPegaD = mysqli_fetch_assoc($pega_funcionarioD);

	}else if ($login == 'recuperarA') {

		$idFuncionarioA = $_SESSION['funcionarioAdm'];

		$pegaFuncionarioA   = "SELECT distinct p.idPessoa, p.nome, p.foto FROM pessoa p, funcionario func WHERE p.idPessoa = '$idFuncionarioA' AND p.idPessoa = func.idFuncionario ";
		$pega_funcionarioA   = mysqli_query($conecta,$pegaFuncionarioA);
		$rowPegaA = mysqli_fetch_assoc($pega_funcionarioA);
	}


?>
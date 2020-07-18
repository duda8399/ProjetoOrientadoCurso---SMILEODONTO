<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['dataI'])) {
		  	unset($_SESSION['dataI']);
		    header('location:index.php');
		}

		if(!isset ($_SESSION['dataF'])) {
		  	unset($_SESSION['dataF']);
		    header('location:index.php');
		}

		$dataI = $_SESSION['dataI'];
		$dataF = $_SESSION['dataF'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'idPessoa',
	    1 => 'nome',
	    2 => 'dataCadastro',
	    3 => 'telefoneCelular',
	    4 => 'cep',
	    5 => 'email'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_paciente = "SELECT t.telefoneCelular, p.nome, p.cep, p.idPessoa , e.email, pac.dataCadastro FROM telefonePessoa t, pessoa p, paciente pac, emailpessoa e WHERE p.idPessoa = t.idPessoa and pac.idPaciente = p.idPessoa AND e.idPessoa = pac.idPaciente and pac.dataCadastro>= '$dataI' and pac.dataCadastro<='$dataF' ";
	$resultado_paciente =mysqli_query($conecta, $result_paciente);
	$qnt_linhas = mysqli_num_rows($resultado_paciente);


	//Obter os dados a serem apresentados
	$result_pacientes = "SELECT t.telefoneCelular, p.nome, p.cep, p.idPessoa , e.email, pac.dataCadastro FROM telefonePessoa t, pessoa p, paciente pac, emailpessoa e WHERE p.idPessoa = t.idPessoa and pac.idPaciente = p.idPessoa AND e.idPessoa = pac.idPaciente and pac.dataCadastro>= '$dataI' and pac.dataCadastro<='$dataF' ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_pacientes.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_pacientes.=" OR p.cep LIKE '".$requestData['search']['value']."%' ";
		$result_pacientes.=" OR t.telefoneCelular LIKE '".$requestData['search']['value']."%' ";
		$result_pacientes.=" OR p.idPessoa LIKE '".$requestData['search']['value']."%' ";
		$result_pacientes.=" OR e.email LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_pacientes=mysqli_query($conecta, $result_pacientes);
	$totalFiltered = mysqli_num_rows($resultado_pacientes);
		//Ordenar o resultado
	$result_pacientes.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_pacientes=mysqli_query($conecta, $result_pacientes);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_pacientes =mysqli_fetch_array($resultado_pacientes) ) { 

		$dataCadastro = $row_pacientes['dataCadastro'];
		$dataC = implode("/",array_reverse(explode("-",$dataCadastro)));

		$dado = array(); 
		$dado[] = $row_pacientes["idPessoa"];
		$dado[] = $row_pacientes["nome"];
		$dado[] = $dataC;
		$dado[] = $row_pacientes["telefoneCelular"];
		$dado[] = $row_pacientes["cep"];
		$dado[] = $row_pacientes["email"];
		$dados[] = $dado;
	}

	//Cria o array de informações a serem retornadas para o Javascript
	$json_data = array(
		"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
		"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
		"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
		"data" => $dados
	    //Array de dados completo dos dados retornados da tabela 
	);

	echo json_encode($json_data);  //enviar dados como formato json

?>
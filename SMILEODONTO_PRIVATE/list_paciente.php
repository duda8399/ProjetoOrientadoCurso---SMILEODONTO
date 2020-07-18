<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nome',
	    1 => 'idPessoa',
	    2 => 'logradouro',
	    3 => 'telefoneCelular'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_paciente = "SELECT t.telefoneCelular, p.nome, p.logradouro, p.idPessoa FROM telefonePessoa t, pessoa p, paciente pac WHERE p.idPessoa = t.idPessoa and pac.idPaciente = p.idPessoa ";
	$resultado_paciente =mysqli_query($conecta, $result_paciente);
	$qnt_linhas = mysqli_num_rows($resultado_paciente);


	//Obter os dados a serem apresentados
	$result_pacientes = "SELECT t.telefoneCelular, p.nome, p.logradouro, p.idPessoa FROM telefonePessoa t, pessoa p, paciente pac WHERE p.idPessoa = t.idPessoa and pac.idPaciente = p.idPessoa ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_pacientes.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_pacientes.=" OR t.telefoneCelular LIKE '".$requestData['search']['value']."%' ";
		$result_pacientes.=" OR p.logradouro LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_pacientes=mysqli_query($conecta, $result_pacientes);
	$totalFiltered = mysqli_num_rows($resultado_pacientes);
		//Ordenar o resultado
	$result_pacientes.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_pacientes=mysqli_query($conecta, $result_pacientes);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_pacientes =mysqli_fetch_array($resultado_pacientes) ) {  
		$dado = array(); 
		$dado[] = '<a class="btn btn-outline-light btn-custom" href="dadosPessoais.php?id='.$row_pacientes["idPessoa"].'"><span><i class="fas fa-check"></i></span></a>';
		$dado[] = $row_pacientes["nome"];
		$dado[] = $row_pacientes["logradouro"];
		$dado[] = $row_pacientes["telefoneCelular"];
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
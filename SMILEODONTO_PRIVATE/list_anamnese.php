<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nomeFicha',
	    1 => 'idQuestionario'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_anamnese = "SELECT * FROM questionario WHERE 1=1 ";
	$resultado_anamnese =mysqli_query($conecta, $result_anamnese);
	$qnt_linhas = mysqli_num_rows($resultado_anamnese);


	//Obter os dados a serem apresentados
	$result_anamneses = "SELECT * FROM questionario WHERE 1=1 ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_anamneses.=" AND ( nomeFicha LIKE '".$requestData['search']['value']."%' ";    
		$result_anamneses.=" OR idQuestionario LIKE '".$requestData['search']['value']."%' ";
	}
	
	$resultado_anamneses=mysqli_query($conecta, $result_anamneses);
	$totalFiltered = mysqli_num_rows($resultado_anamneses);
		//Ordenar o resultado
	$result_anamneses.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_anamneses=mysqli_query($conecta, $result_anamneses);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_anamnese =mysqli_fetch_array($resultado_anamneses) ) {  
		$dado = array(); 
		$dado[] = $row_anamnese["nomeFicha"];	
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_anamnese["idQuestionario"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_anamnese["idQuestionario"].'" >Excluir</button>';
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
<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'idEspecialidade',
	    1 => 'nomeEspecialidade',
	    2 => 'descricao',
	    3 => 'idEspecialidade'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_espec = "SELECT *FROM especialidade";
	$resultado_espec =mysqli_query($conecta, $result_espec);
	$qnt_linhas = mysqli_num_rows($resultado_espec);


	//Obter os dados a serem apresentados
	$result_especs = "SELECT *FROM especialidade WHERE 1 = 1 ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_especs.=" AND ( nomeEspecialidade LIKE '".$requestData['search']['value']."%' ";    
		$result_especs.=" OR idEspecialidade LIKE '".$requestData['search']['value']."%' ";
		$result_especs.=" OR descricao LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_especs=mysqli_query($conecta, $result_especs);
	$totalFiltered = mysqli_num_rows($resultado_especs);
		//Ordenar o resultado
	$result_especs.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_especs=mysqli_query($conecta, $result_especs);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_espec =mysqli_fetch_array($resultado_especs) ) {  
		$dado = array(); 
		$dado[] = $row_espec["idEspecialidade"];
		$dado[] = $row_espec["nomeEspecialidade"];
		$dado[] = $row_espec["descricao"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_espec["idEspecialidade"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_espec["idEspecialidade"].'" >Excluir</button>';	
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
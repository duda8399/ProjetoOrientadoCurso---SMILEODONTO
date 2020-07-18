<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nome',
	    1 => 'idCargo',
	    2 => 'logradouro',
	    3 => 'telefoneCelular',
	    4 => 'idPessoa'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_func = "SELECT p.nome, c.nomeCargo, p.logradouro, t.telefoneCelular, p.idPessoa  FROM telefonePessoa t, pessoa p, funcionario f, cargo c WHERE p.idPessoa = t.idPessoa and f.idFuncionario = p.idPessoa and f.idCargo = c.idCargo and c.idCargo != 4 ";
	$resultado_func =mysqli_query($conecta, $result_func);
	$qnt_linhas = mysqli_num_rows($resultado_func);


	//Obter os dados a serem apresentados
	$result_funcs = "SELECT p.nome, c.nomeCargo, p.logradouro, t.telefoneCelular, p.idPessoa  FROM telefonePessoa t, pessoa p, funcionario f, cargo c WHERE p.idPessoa = t.idPessoa and f.idFuncionario = p.idPessoa and f.idCargo = c.idCargo and c.idCargo != 4 ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_funcs.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_funcs.=" OR t.telefoneCelular LIKE '".$requestData['search']['value']."%' ";
		$result_funcs.=" OR c.nomeCargo LIKE '".$requestData['search']['value']."%' ";
		$result_funcs.=" OR p.logradouro LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_funcs=mysqli_query($conecta, $result_funcs);
	$totalFiltered = mysqli_num_rows($resultado_funcs);
		//Ordenar o resultado
	$result_funcs.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_funcs=mysqli_query($conecta, $result_funcs);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_func =mysqli_fetch_array($resultado_funcs) ) {  
		$dado = array(); 
		$dado[] = $row_func["nome"];
		$dado[] = $row_func["nomeCargo"];
		$dado[] = $row_func["logradouro"];
		$dado[] = $row_func["telefoneCelular"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_func["idPessoa"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_func["idPessoa"].'" >Excluir</button>';	
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
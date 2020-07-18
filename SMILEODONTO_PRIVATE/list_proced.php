<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nomeProcedimento',
	    1 => 'valor',
	    2 => 'idCategoria',
	    3 => 'idProcedimento'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_proced = "SELECT c.nomeCategoria, p.nomeProcedimento, p.valor, p.idProcedimento FROM categoria c, procedimento p WHERE c.idCategoria = p.idCategoria ";
	$resultado_proced =mysqli_query($conecta, $result_proced);
	$qnt_linhas = mysqli_num_rows($resultado_proced);


	//Obter os dados a serem apresentados
	$result_proceds = "SELECT c.nomeCategoria, p.nomeProcedimento, p.valor, p.idProcedimento FROM categoria c, procedimento p WHERE c.idCategoria = p.idCategoria ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_proceds.=" AND ( c.nomeCategoria LIKE '".$requestData['search']['value']."%' ";    
		$result_proceds.=" OR p.nomeProcedimento LIKE '".$requestData['search']['value']."%' ";
		$result_proceds.=" OR p.valor LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_proceds=mysqli_query($conecta, $result_proceds);
	$totalFiltered = mysqli_num_rows($resultado_proceds);
		//Ordenar o resultado
	$result_proceds.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_proceds=mysqli_query($conecta, $result_proceds);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_proced =mysqli_fetch_array($resultado_proceds) ) {  
		$dado = array(); 
		$dado[] = $row_proced["nomeProcedimento"];
		$dado[] = 'R$ '.$row_proced["valor"];
		$dado[] = $row_proced["nomeCategoria"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_proced["idProcedimento"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_proced["idProcedimento"].'" >Excluir</button>';	
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
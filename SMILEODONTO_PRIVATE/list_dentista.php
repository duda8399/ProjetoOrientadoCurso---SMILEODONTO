<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nome',
	    1 => 'CRO',
	    2 => 'especialidade',
	    3 => 'telefoneCelular',
	    4 => 'idPessoa'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_dentista = "SELECT d.CRO, p.nome, t.telefoneCelular, e.nomeEspecialidade, p.idPessoa FROM telefonePessoa t, pessoa p, dentista d, especialidade e WHERE p.idPessoa = t.idPessoa and d.idDentista = p.idPessoa and d.idEspecialidade = e.idEspecialidade ";
	$resultado_dentista =mysqli_query($conecta, $result_dentista);
	$qnt_linhas = mysqli_num_rows($resultado_dentista);


	//Obter os dados a serem apresentados
	$result_dentistas = "SELECT d.CRO, p.nome, t.telefoneCelular, e.nomeEspecialidade, p.idPessoa FROM telefonePessoa t, pessoa p, dentista d, especialidade e WHERE p.idPessoa = t.idPessoa and d.idDentista = p.idPessoa and d.idEspecialidade = e.idEspecialidade ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_dentistas.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_dentistas.=" OR t.telefoneCelular LIKE '".$requestData['search']['value']."%' ";
		$result_dentistas.=" OR d.CRO LIKE '".$requestData['search']['value']."%' ";
		$result_dentistas.=" OR e.nomeEspecialidade LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_dentistas=mysqli_query($conecta, $result_dentistas);
	$totalFiltered = mysqli_num_rows($resultado_dentistas);
		//Ordenar o resultado
	$result_dentistas.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_dentistas=mysqli_query($conecta, $result_dentistas);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_dentista =mysqli_fetch_array($resultado_dentistas) ) {  
		$dado = array(); 
		$dado[] = $row_dentista["nome"];
		$dado[] = $row_dentista["CRO"];
		$dado[] = $row_dentista["nomeEspecialidade"];
		$dado[] = $row_dentista["telefoneCelular"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_dentista["idPessoa"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_dentista["idPessoa"].'" >Excluir</button>';	
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
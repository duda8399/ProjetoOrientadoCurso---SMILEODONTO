<?php

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nome',
	    1 => 'telefoneCelular',
	    2 => 'valorParcela',
	    3 => 'dataVencimento',
	    4 => 'status'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_parcela = "SELECT p.nome, t.telefoneCelular, f.valorParcela, f.dataVencimento, s.status FROM pessoa p, telefonepessoa t, financeiro f, statuspagamento s, tratamento trat WHERE f.idTratamento = trat.idTratamento AND trat.idPaciente = p.idPessoa AND t.idPessoa = p.idPessoa AND f.idStatusPagamento = s.idStatusPagamento ";
	$resultado_parcela =mysqli_query($conecta, $result_parcela);
	$qnt_linhas = mysqli_num_rows($resultado_parcela);


	//Obter os dados a serem apresentados
	$result_parcelas = "SELECT p.nome, t.telefoneCelular, f.valorParcela, f.dataVencimento, s.status FROM pessoa p, telefonepessoa t, financeiro f, statuspagamento s, tratamento trat WHERE f.idTratamento = trat.idTratamento AND trat.idPaciente = p.idPessoa AND t.idPessoa = p.idPessoa AND f.idStatusPagamento = s.idStatusPagamento ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_parcelas.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";
		$result_parcelas.=" OR t.telefoneCelular LIKE '".$requestData['search']['value']."%' ";
		$result_parcelas.=" OR f.valorParcela LIKE '".$requestData['search']['value']."%' "; 
		$result_parcelas.=" OR f.dataVencimento LIKE '".$requestData['search']['value']."%' ";
		$result_parcelas.=" OR s.status LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_parcelas=mysqli_query($conecta, $result_parcelas);
	$totalFiltered = mysqli_num_rows($resultado_parcelas);
		//Ordenar o resultado
	$result_parcelas.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_parcelas=mysqli_query($conecta, $result_parcelas);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_parcelas =mysqli_fetch_array($resultado_parcelas) ) {  

		$dataVencimento = $row_parcelas['dataVencimento'];
		$data = implode("/",array_reverse(explode("-",$dataVencimento)));

		$dado = array(); 
		$dado[] = $row_parcelas["nome"];
		$dado[] = $row_parcelas["telefoneCelular"];
		$dado[] = 'R$ '. $row_parcelas["valorParcela"];
		$dado[] = $data;
		$dado[] = $row_parcelas["status"];
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
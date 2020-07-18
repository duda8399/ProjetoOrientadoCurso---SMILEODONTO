<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['dataFI'])) {
		  	unset($_SESSION['dataFI']);
		    header('location:index.php');
		}

		if(!isset ($_SESSION['dataFF'])) {
		  	unset($_SESSION['dataFF']);
		    header('location:index.php');
		}

		$dataFI = $_SESSION['dataFI'];
		$dataFF = $_SESSION['dataFF'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'valorParcela',
	    1 => 'valorPago',
	    2 => 'dataVencimento',
	    3 => 'dataPagamento',
	    4 => 'idTratamento',
	    5 => 'formaPagamento'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_financeiro = "SELECT f.idTratamento, f.dataPagamento, f.dataVencimento, f.valorPago, f.valorParcela, fp.formaPagamento FROM financeiro f, formapagamento fp WHERE fp.idFormaPagamento = f.idFormaPagamento AND  f.dataVencimento>= '$dataFI' AND f.dataVencimento<='$dataFF' ";
	$resultado_financeiro =mysqli_query($conecta, $result_financeiro);
	$qnt_linhas = mysqli_num_rows($resultado_financeiro);


	//Obter os dados a serem apresentados
	$result_financeiros = "SELECT f.idTratamento, f.dataPagamento, f.dataVencimento, f.valorPago, f.valorParcela, fp.formaPagamento FROM financeiro f, formapagamento fp WHERE fp.idFormaPagamento = f.idFormaPagamento AND  f.dataVencimento>= '$dataFI' AND f.dataVencimento<='$dataFF' ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_financeiros.=" AND ( f.idTratamento LIKE '".$requestData['search']['value']."%' ";    
		$result_financeiros.=" OR f.valorPago LIKE '".$requestData['search']['value']."%' ";
		$result_financeiros.=" OR f.valorParcela LIKE '".$requestData['search']['value']."%' ";
		$result_financeiros.=" OR fp.formaPagamento LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_financeiros=mysqli_query($conecta, $result_financeiros);
	$totalFiltered = mysqli_num_rows($resultado_financeiros);
		//Ordenar o resultado
	$result_financeiros.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_financeiros=mysqli_query($conecta, $result_financeiros);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_financeiro =mysqli_fetch_array($resultado_financeiros) ) { 

		$dataVencimento = $row_financeiro['dataVencimento'];
		$dataV = implode("/",array_reverse(explode("-",$dataVencimento)));

		$dataPagamento = $row_financeiro['dataPagamento'];
		$dataP = implode("/",array_reverse(explode("-",$dataPagamento)));

		$dado = array(); 
		$dado[] = 'R$'.$row_financeiro["valorParcela"];
		$dado[] = 'R$'.$row_financeiro["valorPago"];
		$dado[] = $dataV;
		$dado[] = $dataP;
		$dado[] = $row_financeiro["idTratamento"];
		$dado[] = $row_financeiro["formaPagamento"];
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
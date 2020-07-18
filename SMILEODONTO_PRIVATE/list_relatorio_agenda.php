<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['dataAI'])) {
		  	unset($_SESSION['dataAI']);
		    header('location:index.php');
		}

		if(!isset ($_SESSION['dataAF'])) {
		  	unset($_SESSION['dataAF']);
		    header('location:index.php');
		}

		$dataAI = $_SESSION['dataAI'];
		$dataAF = $_SESSION['dataAF'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'title',
	    1 => 'nome',
	    2 => 'data',
	    3 => 'idTipo',
	    4 => 'idMotivo',
	    5 => 'idSituacao'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_agenda = "SELECT m.motivo, t.tipo, s.situacao, a.title, p.nome, a.data FROM agendamento a, pessoa p, situacao s, tipo t, motivo m WHERE s.idSituacao = a.idSituacao AND m.idMotivo = a.idMotivo AND p.idPessoa = a.idDentista AND a.idTipo = t.idTipo and a.data>= '$dataAI' and a.data<='$dataAF' ";
	$resultado_agenda =mysqli_query($conecta, $result_agenda);
	$qnt_linhas = mysqli_num_rows($resultado_agenda);


	//Obter os dados a serem apresentados
	$result_agendas = "SELECT m.motivo, t.tipo, s.situacao, a.title, p.nome, a.data FROM agendamento a, pessoa p, situacao s, tipo t, motivo m WHERE s.idSituacao = a.idSituacao AND m.idMotivo = a.idMotivo AND p.idPessoa = a.idDentista AND a.idTipo = t.idTipo and a.data>= '$dataAI' and a.data<='$dataAF' ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_agendas.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_agendas.=" OR a.title LIKE '".$requestData['search']['value']."%' ";
		$result_agendas.=" OR m.motivo LIKE '".$requestData['search']['value']."%' ";
		$result_agendas.=" OR t.tipo LIKE '".$requestData['search']['value']."%' ";
		$result_agendas.=" OR s.situacao LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_agendas=mysqli_query($conecta, $result_agendas);
	$totalFiltered = mysqli_num_rows($resultado_agendas);
		//Ordenar o resultado
	$result_agendas.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_agendas=mysqli_query($conecta, $result_agendas);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_agenda =mysqli_fetch_array($resultado_agendas) ) { 

		$dataCadastro = $row_agenda['data'];
		$dataC = implode("/",array_reverse(explode("-",$dataCadastro)));

		$dado = array(); 
		$dado[] = $row_agenda["title"];
		$dado[] = $row_agenda["nome"];
		$dado[] = $dataC;
		$dado[] = $row_agenda["tipo"];
		$dado[] = $row_agenda["motivo"];
		$dado[] = $row_agenda["situacao"];
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
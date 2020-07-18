<?php

	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['pacienteS'])) {
		  	unset($_SESSION['pacienteS']);
		    header('location:listPacienteS.php');
		}

		if(!isset ($_SESSION['tratamento'])) {
		  	unset($_SESSION['tratamento']);
		    header('location:listTratamento.php');
		}

		$idPaciente = $_SESSION['pacienteS'];
		$codigo     = $_SESSION['tratamento'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'nome',
	    1 => 'nomeProcedimento',
	    2 => 'anotacoes',
	    3 => 'idProcedimentoTratamento'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_procedOdonto = "SELECT d.nome, pt.anotacoes, p.nomeProcedimento, pt.idProcedimentoTratamento, d.idDente FROM dente d, procedimentotratamento pt, procedimento p, tratamento t WHERE d.idDente = pt.idDente AND p.idProcedimento = pt.idProcedimento AND pt.idTratamento = t.idTratamento AND pt.idTratamento = '$codigo' ";
	$resultado_procedOdonto =mysqli_query($conecta, $result_procedOdonto);
	$qnt_linhas = mysqli_num_rows($resultado_procedOdonto);


	//Obter os dados a serem apresentados
	$result_procedOdontos = "SELECT d.nome, pt.anotacoes, p.nomeProcedimento, pt.idProcedimentoTratamento, d.idDente FROM dente d, procedimentotratamento pt, procedimento p, tratamento t WHERE d.idDente = pt.idDente AND p.idProcedimento = pt.idProcedimento AND pt.idTratamento = t.idTratamento AND pt.idTratamento = '$codigo' ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_procedOdontos.=" AND ( d.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_procedOdontos.=" OR pt.anotacoes LIKE '".$requestData['search']['value']."%' ";
		$result_procedOdontos.=" OR p.nomeProcedimento LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_procedOdontos=mysqli_query($conecta, $result_procedOdontos);
	$totalFiltered = mysqli_num_rows($resultado_procedOdontos);
		//Ordenar o resultado
	$result_procedOdontos.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_procedOdontos=mysqli_query($conecta, $result_procedOdontos);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_trat =mysqli_fetch_array($resultado_procedOdontos) ) {  

		$dado = array(); 
		$dado[] = $row_trat["nome"];
		$dado[] = $row_trat["nomeProcedimento"];
		$dado[] = $row_trat["anotacoes"];
		$dado[] = '<button type="button" name="excluir" id="excluir" class="btn btn-ex btn-danger text-white" value="'. $row_trat["idProcedimentoTratamento"].'" ><i class="fas fa-trash text-white"></i></button>';	
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
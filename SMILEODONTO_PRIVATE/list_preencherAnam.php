<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	  $idPaciente = $_SESSION['paciente'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'idAnamnese',
	    1 => 'idPaciente',
	    2 => 'idAnamnese'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_anamnese = "SELECT distinct a.idAnamnese, q.nomeFicha FROM anamneseqq a, questionario q, anamnese an WHERE a.idQuestionario = q.idQuestionario AND a.idAnamnese = an.idAnamnese AND an.idPaciente = '$idPaciente' ";
	$resultado_anamnese =mysqli_query($conecta, $result_anamnese);
	$qnt_linhas = mysqli_num_rows($resultado_anamnese);


	//Obter os dados a serem apresentados
	$result_anamneses = "SELECT distinct a.idAnamnese, q.nomeFicha FROM anamneseqq a, questionario q, anamnese an WHERE a.idQuestionario = q.idQuestionario AND a.idAnamnese = an.idAnamnese AND an.idPaciente = '$idPaciente' ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_anamneses.=" AND ( a.idAnamnese LIKE '".$requestData['search']['value']."%' ";    
		$result_anamneses.=" OR q.nomeFicha LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_anamneses=mysqli_query($conecta, $result_anamneses);
	$totalFiltered = mysqli_num_rows($resultado_anamneses);
		//Ordenar o resultado
	$result_anamneses.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_anamneses=mysqli_query($conecta, $result_anamneses);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_anamneses =mysqli_fetch_array($resultado_anamneses) ) {  
		$dado = array(); 
		$dado[] = $row_anamneses["idAnamnese"];
		$dado[] = $row_anamneses["nomeFicha"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_anamneses["idAnamnese"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_anamneses["idAnamnese"].'" >Excluir</button>' . '<a name="imprimir" href="gerarAnamnese.php?id='.$row_anamneses["idAnamnese"].'" class="btn btn-secondary text-white ml-2">Imprimir<i class="fas fa-print text-white ml-2"></i> </a>';	
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
<?php

	if (!isset($_SESSION)) session_start();

	  if(!isset ($_SESSION['paciente']))
	  {
	  	unset($_SESSION['paciente']);
	    header('location:listPaciente.php');
	  }

	  if(!isset ($_SESSION['funcionarioD']))
	  {
	  	unset($_SESSION['funcionarioD']);
	    header('location:login.php');
	  }

	  $idPaciente = $_SESSION['paciente'];
	  $idDentista = $_SESSION['funcionarioD'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'idTratamento',
	    1 => 'nome',
	    2 => 'situacao',
	    3 => 'idTratamento'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_tratamento = "SELECT distinct t.idTratamento, p.nome, s.situacao FROM tratamento t, pessoa p, situacaotratamento s WHERE t.idDentista = p.idPessoa AND t.idSituacaoTrat = s.idSituacaoTrat AND t.idSituacaoTrat != 1 AND t.idSituacaoTrat != 2 AND t.idSituacaoTrat != 5  AND t.idPaciente = '$idPaciente' AND t.idDentista = '$idDentista' ";
	$resultado_tratamento =mysqli_query($conecta, $result_tratamento);
	$qnt_linhas = mysqli_num_rows($resultado_tratamento);


	//Obter os dados a serem apresentados
	$result_tratamentos = "SELECT distinct t.idTratamento, p.nome, s.situacao FROM tratamento t, pessoa p, situacaotratamento s WHERE t.idDentista = p.idPessoa AND t.idSituacaoTrat = s.idSituacaoTrat AND t.idSituacaoTrat != 1 AND t.idSituacaoTrat != 2 AND t.idSituacaoTrat != 5 AND t.idPaciente = '$idPaciente' AND t.idDentista = '$idDentista'";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_tratamentos.=" AND ( t.idTratamento LIKE '".$requestData['search']['value']."%' ";
		$result_tratamentos.=" AND ( p.nome LIKE '".$requestData['search']['value']."%' ";    
		$result_tratamentos.=" OR s.situacao LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_tratamentos=mysqli_query($conecta, $result_tratamentos);
	$totalFiltered = mysqli_num_rows($resultado_tratamentos);
		//Ordenar o resultado
	$result_tratamentos.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_tratamentos=mysqli_query($conecta, $result_tratamentos);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_tratamentos =mysqli_fetch_array($resultado_tratamentos) ) { 
		$dado = array(); 
		$dado[] = $row_tratamentos["idTratamento"];
		$dado[] = $row_tratamentos["nome"];
		$dado[] = $row_tratamentos["situacao"];
		$dado[] = '<button type="submit" name="editar" class="btn btn-editar text-white mr-2" value="'.$row_tratamentos["idTratamento"].'">Editar</button>'.'<button type="button" name="excluir" id="excluir" class="btn btn-excluir text-white" value="'.$row_tratamentos["idTratamento"].'" >Excluir</button>'.'<a href="tratamento.php?id='.$row_tratamentos["idTratamento"].'" class="btn btn-verde text-white ml-2 mr-2">Tratamento</a>';	
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
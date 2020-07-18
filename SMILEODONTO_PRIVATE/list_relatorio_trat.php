<?php
	
	if (!isset($_SESSION)) session_start();

		if(!isset ($_SESSION['dataTI'])) {
		  	unset($_SESSION['dataTI']);
		    header('location:index.php');
		}

		if(!isset ($_SESSION['dataTF'])) {
		  	unset($_SESSION['dataTF']);
		    header('location:index.php');
		}

		$dataTI = $_SESSION['dataTI'];
		$dataTF = $_SESSION['dataTF'];

	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

	//Receber a requisão da pesquisa 
	$requestData= $_REQUEST;

	//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
	$columns = array(
	    0 => 'idTratamento',
	    1 => 'nome',
	    2 => 'dataAbertura',
	    3 => 'situacao'
	);

	//Obtendo registros de número total sem qualquer pesquisa
	$result_tratamento = "SELECT t.idTratamento, p.nome, t.dataAbertura, st.situacao FROM pessoa p, paciente pac, tratamento t, situacaoTratamento st where p.idPessoa = pac.idPaciente and t.idPaciente = pac.idPaciente AND st.idSituacaoTrat = t.idSituacaoTrat and t.dataAbertura>= '$dataTI' and t.dataAbertura<='$dataTF'  ";
	$resultado_tratamento =mysqli_query($conecta, $result_tratamento);
	$qnt_linhas = mysqli_num_rows($resultado_tratamento);


	//Obter os dados a serem apresentados
	$result_tratamentos = "SELECT t.idTratamento, p.nome, t.dataAbertura, st.situacao FROM pessoa p, paciente pac, tratamento t, situacaoTratamento st where p.idPessoa = pac.idPaciente and t.idPaciente = pac.idPaciente AND st.idSituacaoTrat = t.idSituacaoTrat and t.dataAbertura>= '$dataTI' and t.dataAbertura<='$dataTF'  ";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_tratamentos.=" AND ( t.idTratamento LIKE '".$requestData['search']['value']."%' ";    
		$result_tratamentos.=" OR p.nome LIKE '".$requestData['search']['value']."%' ";
		$result_tratamentos.=" OR t.dataAbertura LIKE '".$requestData['search']['value']."%' ";
		$result_tratamentos.=" OR st.situacao LIKE '".$requestData['search']['value']."%' ) ";
	}
	
	$resultado_tratamentos=mysqli_query($conecta, $result_tratamentos);
	$totalFiltered = mysqli_num_rows($resultado_tratamentos);
		//Ordenar o resultado
	$result_tratamentos.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$resultado_tratamentos=mysqli_query($conecta, $result_tratamentos);


	// Ler e criar o array de dados
	$dados = array();
	while( $row_trat =mysqli_fetch_array($resultado_tratamentos) ) { 

		$dataAbertura = $row_trat['dataAbertura'];
		$dataA = implode("/",array_reverse(explode("-",$dataAbertura)));

		$dado = array(); 
		$dado[] = $row_trat['idTratamento'];
		$dado[] = $row_trat['nome'];
		$dado[] = $dataA;
		$dado[] = $row_trat['situacao'];
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
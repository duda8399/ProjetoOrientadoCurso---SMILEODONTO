<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    require_once("../../SMILEODONTO_PRIVATE/conexao.php");

    if(isset($_GET['idTratamento'])) {
        $IDTratamento = $_GET['idTratamento'];
    } else {
        $IDTratamento = 1;
    }

    $selecao  = "SELECT sum(p.valor) as valorTotal FROM procedimentotratamento pt, tratamento t, procedimento p WHERE p.idProcedimento = pt.idProcedimento AND pt.idTratamento = t.idTratamento AND t.idTratamento = '$IDTratamento' ";

    $tratamento = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($tratamento)) {
        $retorno[] = $linha;
    }

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>
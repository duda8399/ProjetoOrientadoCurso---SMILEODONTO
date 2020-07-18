<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    require_once("../../SMILEODONTO_PRIVATE/conexao.php");

    if(isset($_GET['idFinanceiro'])) {
        $IDFinanceiro = $_GET['idFinanceiro'];
    } else {
        $IDFinanceiro = 1;
    }

    $selecao  = "SELECT idFinanceiro, valorParcela FROM financeiro WHERE idFinanceiro = '$IDFinanceiro' ";

    $financeiro = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($financeiro)) {
        $retorno[] = $linha;
    }

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>
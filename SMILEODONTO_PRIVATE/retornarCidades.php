<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    require_once("../../SMILEODONTO_PRIVATE/conexao.php");

    if(isset($_GET['idUF'])) {
        $cidID = $_GET['idUF'];
    } else {
        $cidID = 1;
    }

    $selecao  = "SELECT idCidade, nomeCidade FROM cidade ";
    $selecao .= "WHERE idUF = {$cidID}";
    $cidades = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($cidades)) {
        $retorno[] = $linha;
    } 	

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>
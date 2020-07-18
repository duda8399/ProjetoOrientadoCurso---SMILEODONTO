<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    require_once("../../SMILEODONTO_PRIVATE/conexao.php");

    $query = "SELECT idUF,nomeUF FROM UF";
    $estados = mysqli_query($conecta,$query);

    $retorno = array();
    while($linha = mysqli_fetch_object($estados)) {
        $retorno[] = $linha;
    }

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>
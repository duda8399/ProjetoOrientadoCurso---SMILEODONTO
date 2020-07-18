<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    require_once("../../SMILEODONTO_PRIVATE/conexao.php");

    if(isset($_GET['idQuestionario'])) {
        $IDQuestionario = $_GET['idQuestionario'];
    } else {
        $IDQuestionario = 1;
    }

    $selecao  = "SELECT q.idQuestoes, q.enunciado, q.idAlerta, q.idObrigatoriedade FROM questoes q, questionario quest, questionarioquestoes qq WHERE quest.idQuestionario = '$IDQuestionario' AND quest.idQuestionario = qq.idQuestionario AND q.idQuestoes = qq.idQuestoes ";

    $anamnese = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($anamnese)) {
        $retorno[] = $linha;
    }

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>
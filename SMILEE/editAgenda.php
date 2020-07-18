<?php

    if (isset($_GET['idAgendamento'])) {
        $codigo = $_GET['idAgendamento'];
    }else if (isset($_POST['editar'])) {
        $codigo = $_POST['editar'];
    }

      $acao = 'recuperarTudo';
      require 'agenda_controller.php';

  ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!-- Javacript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Estilo customizado -->
      <link rel="stylesheet" type="text/css" href="_css/estilo.css">
    </head>

    <body>
      <div class="page-wrap">
        <!--Início do Navbar-->
          <?php include_once("_incluir/navbarSecret.php")  ?>
        <!--Fim do Navbar-->

        <div class="inside">

          <!--Início do Conteúdo-->
          <section>
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="conteudo">
                        <div class="cabecalho-conteudo">
                          <i class="far fa-calendar-alt icon-conteudo"></i>
                          <h3>Atualizar Agendamento</h3>
                        </div>

                        <form action="agenda_controller.php?acao=atualizar" method="POST">
                            <div class="form-row form1">

                            <div class="col-lg-12">
                                <div class="alert alert-info" role="alert">
                                  Todos os campos são de preenchimento obrigatório.
                                </div>
                            </div>

                            <?php $minhapac       = $agenda['idPaciente'];
                                  $meudentista    = $agenda['idDentista'];
                                  $meutipo        = $agenda['idTipo'];
                                  $minhasituacao  = $agenda['idSituacao'];
                                  $meumotivo      = $agenda['idMotivo']; ?>

                              <input type="hidden" name="idAgendamento" value="<?php echo $agenda['idAgendamento']; ?>">
                              <div class="col-lg-6">
                                  <i class="fas fa-user icon-agenda"></i>
                                  <label for="paciente" class="pt-3">Paciente:</label><br>
                                  <select class="form-control" name="paciente" id="paciente" required="">
                                    <?php foreach ($recuperar_paciente as $paciente) { 
                                      $pacienteprincipal = $paciente['idPessoa'];

                                      if($minhapac == $pacienteprincipal) {
                                    ?>
                                      <option value="<?php echo $paciente['idPessoa']; ?>" selected ><?php echo $paciente['nome']; ?></option>

                                    <?php } else { ?>

                                      <option value="<?php echo $paciente["idPessoa"]; ?>"><?php echo $paciente["nome"]; ?></option>

                                    <?php }} ?>
                                  </select>
                              </div>

                              <div class="col-lg-6">
                                  <i class="fas fa-user-md icon-agenda"></i>
                                  <label for="dentista" class="pt-3">Dentista:</label><br>
                                  <select class="form-control" name="dentista" id="dentista" required="">
                                      <?php foreach ($recuperar_dentista as $dentista) { 
                                        $dentistaprincipal = $dentista['idPessoa']; 

                                        if ($meudentista == $dentistaprincipal) { ?>

                                        <option value="<?php echo $dentista["idPessoa"]; ?>" selected><?php echo $dentista["nome"]; ?></option>
                                      <?php } else { ?>
                                        <option value="<?php echo $dentista["idPessoa"]; ?>"><?php echo $dentista["nome"]; ?></option>
                                      <?php }} ?>
                                    </select>
                              </div>

                              <div class="col-lg-4 mt-3">
                                  <i class="far fa-calendar-alt icon-agenda"></i>
                                  <label for="data" class="pt-3">Data:</label><br>
                                  <input type="date" name="data" id="data" class="form-control" required="" value="<?php echo $agenda['data'] ?>">
                              </div>

                              <div class="col-lg-4 mt-3">
                                <i class="fas fa-clock icon-agenda"></i>
                                <label for="horarioinicio" class="pt-3">Horário início:</label><br>
                                <input type="text" name="horarioInicio" id="horarioinicio" class="form-control time" placeholder="Ex.: 00:00" required="" value="<?php echo $agenda["horarioInicio"] ?>">
                              </div>

                              <div class="col-lg-4 mt-3">
                                <i class="fas fa-clock icon-agenda"></i>
                                <label for="horariofim" class="pt-3">Horário término:</label><br>
                                <input type="text" name="horarioFim" id="horariofim" class="form-control time" placeholder="Ex.: 00:00" required="" value="<?php echo $agenda["horarioFim"] ?>">
                              </div>

                              <div class="col-lg-4 mt-3">
                                <i class="fas fa-file-alt icon-agenda"></i>
                                <label for="motivo" class="pt-3">Motivo:</label><br>
                                <select class="form-control" name="motivo" id="motivo" required="">
                                    <?php foreach ($recuperar_motivo as $motivo) { 
                                      $motivoprincipal = $motivo['idMotivo']; 

                                      if ($meumotivo == $motivoprincipal) { ?>
                                        <option value="<?php echo $motivo["idMotivo"]; ?>" selected><?php echo $motivo["motivo"]; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $motivo["idMotivo"]; ?>"><?php echo $motivo["motivo"]; ?></option>
                                    <?php }} ?>
                                </select>
                              </div>

                              <div class="col-lg-4 mt-3">
                                <i class="fas fa-tooth icon-agenda"></i>
                                <label for="tipo" class="pt-3">Tipo:</label><br>
                                <select class="form-control" name="tipo" id="tipo" required="">
                                  <?php foreach ($recuperar_tipo as $tipo) { 
                                    $tipoprincipal = $tipo['idTipo']; 

                                    if ($tipoprincipal == $meutipo) { ?>
                                    <option value="<?php echo $tipo["idTipo"]; ?>" selected><?php echo $tipo["tipo"]; ?></option>
                                  <?php }else{ ?>
                                    <option value="<?php echo $tipo["idTipo"]; ?>"><?php echo $tipo["tipo"]; ?></option>
                                  <?php }} ?>
                                </select>
                              </div>

                              <div class="col-lg-4 mt-3">
                                <i class="fas fa-user-check icon-agenda"></i>
                                <label for="situacao" class="pt-3">Situação:</label><br>
                                <select class="form-control" name="situacao" id="situacao" required="">
                                  <?php foreach ($recuperar_situacao as $situacao) { 
                                    $situacaoprincipal = $situacao['idSituacao'];

                                    if ($situacaoprincipal == $minhasituacao) { ?>
                                      <option value="<?php echo $situacao["idSituacao"]; ?>" selected><?php echo $situacao["situacao"]; ?></option>
                                  <?php }else { ?>
                                    <option value="<?php echo $situacao["idSituacao"]; ?>"><?php echo $situacao["situacao"]; ?></option>
                                  <?php }} ?>
                                </select>
                              </div>

                            <div class="col-lg-9 pt-5">
                              <input type="submit" name="atualizar" id="atualizar" value="Atualizar" class="btn btn-success">
                              <a href="agenda.php" class="btn btn-secondary ml-2">Cancelar</a>
                            </div>

                          </div>

                        </form>
                      </div>
                  </div>
              </div>
            </div>
          </section>
          <!--Fim do Conteúdo-->
        </div>
      </div>

      <!--Início do Rodapé-->
      <?php include_once("_incluir/footer.php") ?>
      <!--Fim do Rodapé-->

      <script src="js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

      <script type="text/javascript">
          $("#telefone").mask("(00) 00000-0000");
          $(".time").mask("00:00");
      </script>

  </body>
</html>
<?php

  $acao = 'recuperar';
  require_once 'agenda_controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <!-- Meta tags Obrigatórias -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!-- FullCalendar -->
      <link href='_css/fullcalendar.min.css' rel='stylesheet' />
      <link href='_css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
      <script src='js/js_calendar/moment.min.js'></script>
      <script src='js/js_calendar/jquery.min.js'></script>
      <script src='js/js_calendar/fullcalendar.min.js'></script>
      <script src='locale/pt-br.js'></script>
      <!-- Estilo customizado -->
      <link rel="stylesheet" type="text/css" href="_css/estilo-agenda.css">

        <title>Smile Odonto</title>

    </head>

    <body>
      <div class="page-wrap">
        <!--Início do Navbar-->
          <?php include_once("_incluir/navbarSecret.php")  ?>
        <!--Fim do Navbar-->

        <div class="inside">

          <!--Início do Conteúdo-->
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="conteudo-agenda">
                        <div class="cabecalho-conteudo">
                          <i class="far fa-calendar-alt text-white"></i>
                          <h3>Agenda</h3>
                        </div>

                    <?php if(isset ($_GET['msg']) && $_GET['msg'] == 1){ ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Agendamento REALIZADO com sucesso!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php } ?>

                    <?php if(isset ($_GET['msg']) && $_GET['msg'] == 3){ ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Agendamento EXCLUÍDO com sucesso!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php } ?>

                    <?php if(isset ($_GET['msg']) && $_GET['msg'] == 5){ ?>
                      <div class="alert bg-danger alert-dismissible fade show text-white" role="alert">
                        ERRO - Por favor, tente mais tarde!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php } ?>

                        <div class="form-row">
                          <div class="col-lg-6">
                            <button name="" class="btn btn-verde text-white" data-toggle="modal" data-target="#novoAgendamento" >
                            Novo Agendamento
                          </button>

                            <a href="pesquisarAgenda.php" class="btn btn-azul text-white">Pesquisar Agendamento</a>
                          </div>

                          <div class="col-lg-6 pt-2">
                            <i class="fas fa-circle atendido"></i> <span class="mr-2">Atendido</span>
                            <i class="fas fa-circle confirmado"></i> <span class="mr-2">Confirmado</span>
                            <i class="fas fa-circle confirmar"></i> <span class="mr-2">Confirmar</span>
                            <i class="fas fa-circle desmarcou"></i> <span class="mr-2">Desmarcou</span>
                            <i class="fas fa-circle ematendimento"></i> <span class="mr-2">Em atendimento</span>
                            <i class="fas fa-circle faltou"></i> <span>Faltou</span>
                          </div>
                        </div>

                        <!-- Início Modal -->
                        <section>
                          <div class="modal fade" data-backdrop="static" id="novoAgendamento" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                              <!-- Modal Cabeçalho -->
                              <div class="modalHeader">
                                <div class="cabecalho">
                                  <h3><i class="far fa-calendar-alt icon-modal"></i>Novo Agendamento</h3>
                                </div>
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <!-- Modal Cabeçalho -->

                              <!-- Modal Corpo -->
                              <form method="POST" action="agenda_controller.php?acao=inserir" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="container-fluid">
                                      <div class="form-row">

                                        <div class="col-lg-12 p-0">
                                          <div class="alert alert-info" role="alert">
                                            Todos os campos são de preenchimento obrigatório.
                                          </div>
                                        </div>

                                          <div class="col-lg-12">
                                            <i class="fas fa-user"></i>
                                            <label for="paciente" class="pt-3">Paciente:</label><br>
                                            <select class="form-control" name="paciente" id="paciente" required="">
                                            <?php foreach ($recuperar_paciente as $paciente) { ?>
                                              <option value="<?php echo $paciente["idPessoa"]; ?>"><?php echo $paciente["nome"]; ?></option>
                                            <?php } ?>
                                            </select>
                                          </div>

                                        <div class="col-lg-12 pt-2">
                                          <i class="far fa-calendar-alt"></i>
                                          <label for="data" class="pt-3">Data:</label><br>
                                          <input type="date" name="data" id="data" class="form-control" required="">
                                        </div>

                                        <div class="col-lg-6 pt-2">
                                          <i class="fas fa-clock"></i>
                                          <label for="horarioinicio" class="pt-3">Horário de início:</label><br>
                                          <input type="text" name="horarioInicio" id="horarioinicio" class="form-control time" placeholder="Ex.: 00:00" required="">
                                        </div>

                                        <div class="col-lg-6 pt-2">
                                          <i class="fas fa-clock"></i>
                                          <label for="horariofim" class="pt-3">Horário de término:</label><br>
                                          <input type="text" name="horarioFim" id="horariofim" class="form-control time" placeholder="Ex.: 00:00" required="">
                                        </div>

                                        <div class="col-lg-12 pt-2">
                                          <i class="fas fa-user-md"></i>
                                          <label for="dentista" class="pt-3">Dentista:</label><br>
                                          <select class="form-control" name="dentista" id="dentista" required="">
                                            <?php foreach ($recuperar_dentista as $dentista) { ?>
                                            <option value="<?php echo $dentista["idPessoa"]; ?>"><?php echo $dentista["nome"]; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>

                                        <div class="col-lg-12 pt-2">
                                          <i class="fas fa-file-alt"></i>
                                          <label for="motivo" class="pt-3">Motivo:</label><br>
                                          <select class="form-control" name="motivo" id="motivo" required="">
                                            <?php foreach ($recuperar_motivo as $motivo) { ?>
                                              <option value="<?php echo $motivo["idMotivo"]; ?>"><?php echo $motivo["motivo"]; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>

                                        <div class="col-lg-6 pt-2">
                                          <i class="fas fa-tooth"></i>
                                          <label for="tipo" class="pt-3">Tipo:</label><br>
                                          <select class="form-control" name="tipo" id="tipo" required="">
                                            <?php foreach ($recuperar_tipo as $tipo) { ?>
                                              <option value="<?php echo $tipo["idTipo"]; ?>"><?php echo $tipo["tipo"]; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>

                                        <div class="col-lg-6 pt-2">
                                            <i class="fas fa-user-check"></i>
                                            <label for="situacao" class="pt-3">Situação:</label><br>
                                            <select class="form-control" name="situacao" id="situacao" required="">
                                            <?php foreach ($recuperar_situacao as $situacao) { ?>
                                              <option value="<?php echo $situacao["idSituacao"]; ?>"><?php echo $situacao["situacao"]; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Corpo -->

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                  <button type="submit" name="cadastrar" class="btn btn-verde text-white">Salvar</button>
                                  <button type="reset" class="btn btn-azul text-white">Limpar campos</button>
                                  <button type="button" class="btn btn-excluir text-white" data-dismiss="modal">Fechar</button>
                                </div>
                                </form>
                                <!-- Modal Footer -->
                              </div>
                            </div>
                          </div>
                        </section>
                        <!-- Fim Modal -->

                        <div id="calendar"></div>

                        <!-- Início Modal -->
                        <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                              <div class="modalHeader">
                                <div class="cabecalho">
                                  <h3><i class="far fa-calendar-alt icon-modal"></i>Agendamento</h3>
                                </div>
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <form method="GET" action="agenda_rotas.php">
                                <div class="modal-body">

                                    <div id="adicionar">
                                      
                                    </div>

                                    <input type="hidden" class="form-control" name="idAgendamento" id="ID">

                                    <label><i class="fas fa-user"></i> Paciente:</label>
                                    <span class="ml-2" id="title"></span><br>

                                    <label class="pt-2"><i class="far fa-calendar-alt"></i>Início da Consulta:</label>
                                    <span class="ml-2" id="start"></span><br>

                                    <label class="pt-2"><i class="far fa-calendar-check"></i>Fim da Consulta:</label>
                                    <span class="ml-2" id="end"></span>
                                  
                                </div>

                                <div class="modal-footer">
                                  <button type="submit" name="editar" class="btn btn-editar text-white">Editar</button>
                                  <button type="button" class="btn btn-excluir text-white" id="excluir" data-toggle="modal" data-target="#confirm-delete">Excluir</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>

                        <?php ?>

                      </div>
                  </div>
              </div>
          </div>
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

      <script>
          $(document).ready(function() {
            $('#calendar').fullCalendar({
              height: 650,
              contentHeight: 650,
              aspectRatio: 2,
              header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
              },
              defaultDate: Date(),
              navLinks: true,
              editable: true,
              eventLimit: true,
              eventTextColor: "#fff",

              eventClick: function(event) {
            
                $('#visualizar #id').text(event.id);
                $('#visualizar #ID').val(event.id);
                $('#visualizar #excluir').val(event.id);
                $('#visualizar #title').text(event.title);
                $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
                $('#visualizar').modal('show');

                return false;
              },

              events: [
                <?php
                  foreach ($recuperar_agenda as $agenda) {
                    ?>
                    {
                    id: '<?php echo $agenda['idAgendamento']; ?>',
                    title: '<?php echo $agenda['title']; ?>',
                    start: '<?php echo $agenda['dataInicio']; ?>',
                    end: '<?php echo $agenda['dataFim']; ?>',
                    color: '<?php echo $agenda['cor']; ?>',
                    },
                <?php } ?>
              ]
            });
          });
      </script>


      <script>
        //https://api.jquery.com/click/
        $("#excluir").click(function () {
          var cod = $(this).val();
          var href = 'agenda_controller.php?acao=removerModal&id='+ cod;
        //https://api.jquery.com/append/
                $("#adicionar").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">Tem certeza que deseja excluir esse item?<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><a type="button" id="dataComfirmOK" class="btn btn-verde text-white mt-2">Confirmar</button><a href="agenda.php" class="btn btn-secondary mt-2">Cancelar</a></div>');
                $('#dataComfirmOK').attr('href', href);
            });

        </script>

  </body>
</html>
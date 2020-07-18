<?php

  $acao = 'recuperar';
  require_once("agenda_controller.php");
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
    <!-- Datatable -->
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- Estilo customizado -->
      <link rel="stylesheet" type="text/css" href="_css/estilo.css">

    <script>
      $(document).ready(function() {
          $('#listar-agenda').DataTable({
              "serverSide": true,
                  "ajax": {
                  "url": "list_agenda.php",
                  "type": "POST"
              },
              "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
          },
          });    
      } );
    </script>

      
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
                          <h3>Agenda</h3>
                        </div>

                    <?php if(isset ($_GET['msg']) && $_GET['msg'] == 2){ ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Agendamento ATUALIZADO com sucesso!
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

                        <form method="POST" action="agenda_rotas.php">
                          <div class="table-responsive pt-3 pl-2 pr-2 pb-2">
                              <table id="listar-agenda" class="table table-striped" style="width:100%">
                                <thead>
                                  <tr>
                                    <th>Paciente</th>
                                    <th>Dentista</th>
                                    <th>Situação</th>
                                    <th>Data</th>
                                    <th>Horário</th>
                                    <th>Ações</th>
                                  </tr>
                                </thead>
                              </table>
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

      <script>
      $(document).on('click', '#excluir', function() {
        var cod = $(this).val();
        var href = 'agenda_controller.php?acao=remover&id='+ cod;
        if(!$('#confirm-delete').length){
          $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
        }
        $('#dataComfirmOK').attr('href', href);
            $('#confirm-delete').modal({show: true});
        return false;
        });
    </script>
  </body>
</html>
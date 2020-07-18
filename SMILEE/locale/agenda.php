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
      <!-- Estilo customizado -->
      <link rel="stylesheet" type="text/css" href="_css/estilo-agenda.css">
      <!-- FullCalendar -->
        <link href='_css/fullcalendar.min.css' rel='stylesheet' />
        <link href='_css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <script src='js/js_calendar/moment.min.js'></script>
        <script src='js/js_calendar/jquery.min.js'></script>
        <script src='js/js_calendar/fullcalendar.min.js'></script>
        <script src='locale/pt-br.js'></script>
        <title>Smile Odonto</title>

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
              defaultDate: '2019-01-12',
              navLinks: true,
              editable: true,
              eventLimit: true,

              events: [
                  {
                    title: 'All Day Event',
                    start: '2019-01-01',
                  },
                  {
                    title: 'Meeting',
                    start: '2019-01-12T10:30:00',
                    end: '2019-01-12T12:30:00'
                  },
                  {
                    title: 'Lunch',
                    start: '2019-01-12T12:00:00'
                  },
                  {
                    title: 'Meeting',
                    start: '2019-01-12T14:30:00'
                  },
                  {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2019-01-28'
                  }
              ]
            });
          });
      </script>
    </head>

    <body>
      <!--Início do Navbar-->
      <?php include_once("_incluir/navbar.php")  ?>
      <!--Fim do Navbar-->

      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <div class="conteudo-agenda">
                    <div class="cabecalho-conteudo">
                      <i class="far fa-calendar-alt text-white"></i>
                      <h3>Agenda</h3>
                    </div>

                    <input type="submit" name="" class="btn btn-verde text-white" value="Novo Agendamento">
                    <input type="submit" name="" class="btn btn-azul text-white" value="Pesquisar Agendamento">

                    <div id="calendar">
                      
                    </div>

                  </div>
              </div>
          </div>
      </div>

      <!--Início do Rodapé-->
      <?php include_once("_incluir/footer.php") ?>
      <!--Fim do Rodapé-->

      <script src="js/bootstrap.min.js"></script>
  </body>
</html>
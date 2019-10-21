<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='{{asset("plugins/fullcalendar/packages/core/main.min.css")}}' rel='stylesheet' />
<link href='{{asset("plugins/fullcalendar/packages/daygrid/main.min.css")}}' rel='stylesheet' />
<link href='{{asset("plugins/fullcalendar/packages/list/main.min.css")}}' rel='stylesheet' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src='{{asset("plugins/fullcalendar/packages/core/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/interaction/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/daygrid/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/list/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/google-calendar/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/core/locales/pt-br.js")}}'></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      locale: 'pt-br',

      plugins: [ 'interaction', 'dayGrid', 'list', 'googleCalendar' ],

      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listYear'
      },

      displayEventTime: false, // don't show the time column in list view
      editable: true,
      navLinks: true,

      // THIS KEY WON'T WORK IN PRODUCTION!!!
      // To make your own Google API key, follow the directions here:
      // http://fullcalendar.io/docs/google_calendar/
      googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

      // US Holidays
      // events: 'en.usa#holiday@group.v.calendar.google.com' ,
      events: [

          @for($i=0;$i<count($eventos);$i++)
          {
              title: "{{$eventos[$i]['title']}}",
              color: "{{$eventos[$i]['color']}}",
              start: "{{$eventos[$i]['start']}}",
              end: "{{$eventos[$i]['end']}}",
          },
          @endfor

      ] ,

      eventClick: function(info) {
        // console.log(info.event);
        $('#modalExemplo #titulo').text(info.event.title)
        $('#modalExemplo #inicio').text(info.event.start.toLocaleString())
        $('#modalExemplo #fim').text(info.event.end.toLocaleString())
        $('#modalExemplo').modal('show');
        // window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

        // arg.jsEvent.preventDefault() // don't navigate in main tab
      },

      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      }

    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>

  <div id='loading'>loading...</div>

  <div id='calendar'></div>

  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <dl class="row">

          <dt class="col-md-3">Título:</dt>
          <dd class="col-md-9" id="titulo"></dd>

          <dt class="col-md-3">Data de início:</dt>
          <dd class="col-md-9" id="inicio"></dd>

          <dt class="col-md-3">Data Final:</dt>
          <dd class="col-md-9" id="fim"></dd>
          
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        {{-- <button type="button" class="btn btn-primary">Salvar mudanças</button> --}}
      </div>
    </div>
  </div>
</div>
</body>
</html>

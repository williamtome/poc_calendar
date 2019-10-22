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
      selectable: true,

      // THIS KEY WON'T WORK IN PRODUCTION!!!
      // To make your own Google API key, follow the directions here:
      // http://fullcalendar.io/docs/google_calendar/
      // googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
      googleCalendarApiKey: 'AIzaSyCNj0123VbvSFq9LEXV6AJmz6DJGe67qso',

      // US Holidays
      // events: 'en.usa#holiday@group.v.calendar.google.com' ,
      events: [

        @for($i=0;$i<count($eventos);$i++)
        {
            title: "{{$eventos[$i]['title']}}",
            color: "{{$eventos[$i]['color']}}",
            start: "{{$eventos[$i]['start']}}",
            end: "{{$eventos[$i]['end']}}",
            textColor: 'white',
        },
        @endfor

      ],
      

      select: function (info) {
        // alert("Selected: " + info.startStr + " to " + info.endStr)

        $('#cadastrar #start').val(info.start.toLocaleString());
        $('#cadastrar #start').on('keypress', function() {
          DataHora(event, this);
        })

        $('#cadastrar #end').val(info.end.toLocaleString());
        $('#cadastrar #end').on('keypress', function() {
          DataHora(event, this);
        })

        $('#cadastrar').modal('show');
      },

      eventClick: function(info) {
        // console.log(info.event);
        info.jsEvent.preventDefault() // don't navigate in main tab
        $('#visualizar #titulo').text(info.event.title)
        $('#visualizar #inicio').text(info.event.start.toLocaleString())
        $('#visualizar #fim').text(info.event.end.toLocaleString())
        $('#visualizar').modal('show');
        // window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

      },

      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      }

    });

    calendar.render();
  });

//Mascara para o campo data e hora
function DataHora(evento, objeto) {
  var keypress = (window.event) ? event.keyCode : evento.which;
  campo = eval(objeto);
  if (campo.value == '00/00/0000 00:00:00') {
      campo.value = "";
  }

  caracteres = '0123456789';
  separacao1 = '/';
  separacao2 = ' ';
  separacao3 = ':';
  conjunto1 = 2;
  conjunto2 = 5;
  conjunto3 = 10;
  conjunto4 = 13;
  conjunto5 = 16;
  if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
      if (campo.value.length == conjunto1)
          campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto2)
          campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto3)
          campo.value = campo.value + separacao2;
      else if (campo.value.length == conjunto4)
          campo.value = campo.value + separacao3;
      else if (campo.value.length == conjunto5)
          campo.value = campo.value + separacao3;
  } else {
      event.returnValue = false;
  }
}

// $(document).ready(function() {
//   $('#addEvent').on('submit', function (event) {
//     event.preventDefault();
//     $.ajax({
//       type: 'post',
//       url: "{{route('calendar.store')}}",
//       // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//       data: $('#addEvent').serialize(),
//       contentType: false,
//       processData: false,
//       success: function (response) {
//         console.log(response);
//       },
//       error: function (error) {
//         console.log(error);
//       }
//     });
//   })
// });

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
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  <div id='loading'>loading...</div>

  <div id='calendar'></div>

  <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Visualizar Plantão</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl class="row">

            <dt class="col-md-3">Título:</dt>
            <dd class="col-md-9" id="titulo"></dd>

            <dt class="col-md-3">início:</dt>
            <dd class="col-md-9" id="inicio"></dd>

            <dt class="col-md-3">Final:</dt>
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

  <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar Plantão</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{route('calendar.store')}}">
            @csrf
            <div class="form-group row">
              <label for="title" class="col-md-2 col-form-label">Título</label>
              <div class="col-md-10">
                <input type="text" name="title" id="title" class="form-control" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="start" class="col-md-2 col-form-label">Início</label>
              <div class="col-md-10">
                <input type="text" name="start" id="start" class="form-control" required>
                <small>Informe a data e hora. Ex: dd/mm/aaaa hh:mm:ss</small>
              </div>
            </div>
            <div class="form-group row">
              <label for="end" class="col-md-2 col-form-label">Final</label>
              <div class="col-md-10">
                <input type="text" name="end" id="end" class="form-control" required>
                <small>Informe a data e hora. Ex: dd/mm/aaaa hh:mm:ss</small>
              </div>              
            </div>
            <div class="form-group row">
              <label for="color" class="col-md-2 col-form-label">Cor</label>
              <div class="col-md-10">
                <input type="color" name="color" id="color" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</html>

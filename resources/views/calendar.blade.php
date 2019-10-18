<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='{{asset("plugins/fullcalendar/packages/core/main.min.css")}}' rel='stylesheet' />
<link href='{{asset("plugins/fullcalendar/packages/daygrid/main.min.css")}}' rel='stylesheet' />
<link href='{{asset("plugins/fullcalendar/packages/list/main.min.css")}}' rel='stylesheet' />

<script src='{{asset("plugins/fullcalendar/packages/core/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/interaction/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/daygrid/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/list/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/google-calendar/main.min.js")}}'></script>
<script src='{{asset("plugins/fullcalendar/packages/core/locales/pt-br.js")}}'></script>

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

      eventClick: function(arg) {
        // opens events in a popup window
        alert("Olá "+arg);
        window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

        arg.jsEvent.preventDefault() // don't navigate in main tab
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

</body>
</html>

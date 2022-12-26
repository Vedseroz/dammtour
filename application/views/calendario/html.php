<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href='../assets/fullcalendar/lib/main.css' rel='stylesheet' />
<script src='../assets/fullcalendar/lib/main.js'></script>
<script> peticionHTTP = new XMLHRequest();</script>
<style>

  body {
   
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
    display:flex;
    min-height:100vh;
    flex-direction: column;
  }

  #calendar {
    width: 90%;
    height: 60%;
    margin: 0 auto;
    flex: 1;
  }

</style>
</head>
<body>

  <div id='calendar'></div>
  

  <!--Modal para llamar al formulario de ingreso-->
      <div id="calendarModal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h4 id="modalTitle" class="modal-title">Informacion del Evento</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">close</span></button>
              </div>
              <div id="modalBody" class="modal-body"> </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Volver</button>
              </div>
          </div>
      </div>
      </div>
  
<script>

      document.addEventListener('DOMContentLoaded', function() {
  
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    locale: 'es',
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    selectable: true,
    selectMirror: true,
    events:"<?php echo base_url();?>index.php/Transfer/getDatosVoucherCalendario",
    // aqui van las funciones asociadas al select

    eventClick: function(info) {
      // AJAX request
      $.ajax({
        url: '<?php echo base_url();?>index.php/Transfer/getDatosVoucherById/'+info.event.id,
        type: 'post',
        success: function(response){ 
           // Add response in Modal body
           var data = JSON.parse(response);
           var text = '';
           console.log(data[0]);

           text += '<ul>';
           text += '<li><label for="nombre">Nombre Pasajero:</label>'+' '+data[0]['nombre']+'</li>';
           text += '<li><label for="apellido">Apellido Pasajero:</label>'+' '+data[0]['apellido']+'</li>';
           text += '<li><label for="telefono">Telefono Pasajero:</label>'+' '+data[0]['telefono']+'</li>';
           text += '<li><label for="email">Correo Pasajero:</label>'+' '+data[0]['email']+'</li>';
           text += '<li><label for="acompa">Cantidad de Pasajeros:</label>'+' '+data[0]['acompa']+'</li>';
           text += '<br><hr>'
           text += '<h5>Informacion Transfer</h5>'+' ';
           text += '<li><label for="fecha">FECHA:</label>'+' '+data[0]['fecha']+'</li>';
           text += '<li><label for="origen">ORIGEN:</label>'+' '+data[0]['origen']+'</li>';
           text += '<li><label for="hora_inicio">HORA INICIO:</label>'+' '+data[0]['hora_inicio']+'</li>';
           text += '<li><label for="destino">DESTINO:</label>'+' '+data[0]['destino']+'</li>';
           text += '<li><label for="hora_finalizacion">HORA FINALIZACION:</label>'+' '+data[0]['hora_finalizacion']+'</li>';


           text += '</ul>'

           $('.modal-body').html(text);

           // Display Modal
           $('#calendarModal').modal('show'); 
        }
     });
      

    },
    dayMaxEvents: true, // allow "more" link when too many events
  });

  calendar.render();
});

</script>


</body>

<!--Bootstrap-->

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>


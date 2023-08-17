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
    events:"<?php echo base_url();?>index.php/Pasajero/getDatosPasajeroCalendario",
    // aqui van las funciones asociadas al select

    eventClick: function(info) {   //se carga la informacion de cada una de las instancias clickeadas.
      // AJAX request
      console.log(info.event.id+' '+info.event.title);
      $.ajax({
        url: '<?php echo base_url();?>index.php/Pasajero/getDatosPasajerosCalendarioById/'+info.event.id+' '+info.event.title,
        type: 'post',
        success: function(response){ 
           // Add response in Modal body
           var string = response;
           var new_string = string.slice(13,(string.length-2));

           var data = JSON.parse(new_string);
           var text = '';

           if(data.id_pasajero_transfer!=undefined){ // caso de que sea un transfer

            data.fechallegada =  data.fechallegada.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
            data.fechasalida = data.fechasalida.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

              text += '<ul>';
           text += '<li><label for="nombre">Nombre del Pasajero:</label>'+' '+data.nombre+'</li>';
           text += '<li><label for="nombre">Cantidad de Adultos:</label>'+' '+data.cant_adultos+'</li>';
           text += '<li><label for="apellido">Cantidad de Niños:</label>'+' '+data.cant_ninos+'</li>';
           text += '<li><label for="telefono">Cantidad de Maletas:</label>'+' '+data.cant_maletas+'</li>';
           text += '<br><hr>'
           text += '<h5>Informacion Transfer</h5>'+' ';
           text += '<li><label for="fecha">FECHA DE LLEGADA:</label>'+' '+data.fechallegada+'</li>';
           text += '<li><label for="fecha">HORA DE LLEGADA:</label>'+' '+data.horallegada+'</li>';
           text += '<li><label for="fecha">FECHA DE SALIDA:</label>'+' '+data.fechasalida+'</li>';
           text += '<li><label for="fecha">HORA DE SALIDA:</label>'+' '+data.horasalida+'</li>';
           text += '<li><label for="fecha">VEHICULO:</label>'+' '+data.marca+' '+data.modelo+'</li>';
           text += '<li><label for="fecha">PATENTE VEHICULO:</label>'+' '+data.patente+'</li>';
           text += '<li><label for="fecha">CHOFER DESIGNADO:</label>'+' '+data.nombre_chofer.split(' ')[0]+' '+data.apellido_chofer.split(' ')[0]+'</li>';
           text += '</ul>'
           }

           if(data.hospedaje_id != undefined){
            
            data.fechallegada =  data.fechallegada.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
            data.fechasalida = data.fechasalida.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
            
            text += '<ul>';
           text += '<li><label for="nombre">Nombre del Pasajero:</label>'+' '+data.nombre+'</li>';
           text += '<li><label for="nombre">Pais:</label>'+' '+data.pais+'</li>';
           text += '<li><label for="apellido">Ciudad:</label>'+' '+data.ciudad+'</li>';
           text += '<li><label for="telefono">Posada:</label>'+' '+data.nombre_hospedaje+'</li>';
           text += '<li><label for="telefono">Información Recepción</label>'+' '+data.recepcionista+'</li>';
           text += '<br><hr>'
           text += '<h5>Informacion Hospedaje</h5>'+' ';
           text += '<li><label for="fecha">FECHA DE LLEGADA:</label>'+' '+data.fechallegada+'</li>';
           text += '<li><label for="fecha">HORA DE LLEGADA:</label>'+' '+data.horallegada+'</li>';
           text += '<li><label for="fecha">FECHA DE SALIDA:</label>'+' '+data.fechasalida+'</li>';
           text += '<li><label for="fecha">HORA DE SALIDA:</label>'+' '+data.horasalida+'</li>';
           text += '</ul>'
           }

           if(data.tour_id!=undefined){

            data.fechallegada =  data.fechallegada.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
            data.fechasalida = data.fechasalida.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

            text += '<ul>';
           text += '<li><label for="nombre">Nombre del Pasajero:</label>'+' '+data.nombre+'</li>';
           text += '<li><label for="nombre">Pais:</label>'+' '+data.pais+'</li>';
           text += '<li><label for="apellido">Ciudad:</label>'+' '+data.ciudad+'</li>';
           text += '<li><label for="telefono">Tour:</label>'+' '+data.nombre_tour+'</li>';
           text += '<br><hr>'
           text += '<h5>Informacion Tour</h5>'+' ';
           text += '<li><label for="fecha">FECHA DE LLEGADA:</label>'+' '+data.fechallegada+'</li>';
           text += '<li><label for="fecha">HORA DE LLEGADA:</label>'+' '+data.horallegada+'</li>';
           text += '<li><label for="fecha">FECHA DE SALIDA:</label>'+' '+data.fechasalida+'</li>';
           text += '<li><label for="fecha">HORA DE SALIDA:</label>'+' '+data.horasalida+'</li>';
           text += '</ul>'
           
           }

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


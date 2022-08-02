<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href='../assets/fullcalendar/lib/main.css' rel='stylesheet' />
<script src='../assets/fullcalendar/lib/main.js'></script>



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
      events:"<?php echo base_url();?>index.php/pasajero/getDatosPasajeros",
      // aqui van las funciones asociadas al select

      eventClick: function(arg) {
        if (confirm('Are you sure you want to delete this event?')) {
          arg.event.remove()
        }
      },
      dayMaxEvents: true, // allow "more" link when too many events
    });

    calendar.render();
  });

  
  $('#myInput').trigger('focus')
  
 
</script>
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
  <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese los datos del transfer:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--CONENIDO DEL MODAL, AQUI VA EL FORMULARIO-->  
      <?= form_open_multipart(site_url('calendario/Ingresar'), 'class="form-horizontal" role="form"') ?>
      <div class="nombre">
        <label for="nombre">Nombre:</label>
        <input type="text" name="name" id="nombre">
      </div>

      <div class="apellido">
        <label for="apellido">Apellidos:</label>
        <input type="text" name="apellido" id="apellido">
      </div>

      <div class="telefono">
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono">
      </div>

      <div class="email">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
      </div>

      <div class="pais">
        <label for="pais">Pais:</label>
        
        <select type="" name="pais" id="pais" >
          <?php for($i = 0 ; $i < count($paises); $i++) :?>
            <option value="<?php echo $paises[$i]['pais']; ?>"><?php echo $paises[$i]['pais'];?></option>
            <?php endfor;?>
        </select>
        
      </div>

      <div class="ciudad">
        <label for="ciudad">Ciudad:</label>
        <select type="" name="ciudad" id="ciudad" >
            <?php for($i = 0 ; $i < count($localidad); $i++) :?>
            <?php if($this->input->post('pais') == $localidad[$i]['pais']):?>
            <option value="<?php echo $localidad[$i]['ciudad']; ?>"><?php echo $localidad[$i]['ciudad'];?></option>
            <?php endif;?>
            <?php endfor;?>
        </select>
      </div>

      <div class="posada">
        <label for="posada">Posada:</label>
        <input type="text" name="posada" id="posada">
      </div>

      <div class="fecha-llegada">
        <label for="fechallegada">Fecha llegada:</label>
        <input type="date" name="fechallegada" id="fechallegada">
      </div>

      <div class="hora-llegada clockpicker" data-autoclose="true">
        <label for="horallegada">Hora llegada:</label>
        <input type="text" name="horallegada" id="horallegada">
      </div>

      <div class="fecha-salida">
        <label for="fechasalida">Fecha salida:</label>
        <input type="date" name="fechasalida" id="fechasalida">
      </div>

      <div class="hora-salida clockpicker" data-autoclose="true">
        <label for="horasalida">Hora salida:</label>
        <input type="text" name="horasalida" id="horasalida">
      </div>

      <div class="observacion">
        <label for="observacion">Observación:</label>
        <textarea name="observacion" id="observacion" rows="10"></textarea>
      </div>

      <div class="servicios">
        <label><b>Servicios:</b></label>
        
        <div class="servicio">
          <div>
            <input type="checkbox" name="transfer" id="servicio">
            <label for="servicio">Transfer</label>
          </div>
          <div>
            <input type="checkbox" name="hospedaje" id="servicio">
            <label for="servicio">Hospedaje</label>
          </div>
          <div>
            <input type="checkbox" name="tour" id="servicio">
            <label for="servicio">Tour</label>
          </div>
        </div>
        
        <!--fin del formulario-->
      </form>
      </div>

      <!--Este es el pie del modal aqui puedes agregar mas botones-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> 
  
  




</body>

<!--Bootstrap-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>


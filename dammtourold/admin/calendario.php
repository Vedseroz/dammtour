<?php
require '../includes/funciones.php';

$auth = estaAutenticado();

if (!$auth) { # Si el usuario no se autenticó correctamente...
  header('Location: /dammtour');
}

incluirTemplate('header', $inicio = true);  # Incluyendo header al sitio
?>

<!-- Incluyendo Calendario y su menu -->
<?php incluirTemplate('menu_calendario', $inicio = true); ?>




<!--
  Ventana Modal
-->

<!-- Incluyendo header de Ventana Modal  -->
<?php incluirTemplate('modal_header', $inicio = true); ?>

<div class="modal-body">
  <input type="hidden" name="ID" id="ID">

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
    <input type="text" name="pais" id="pais">
  </div>

  <div class="ciudad">
    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad">
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
  </div>

</div> 


  <!-- Incluyendo footer de Ventana Modal  -->
  <?php incluirTemplate('modal_footer', $inicio = true); ?>



  <!-- Incluyendo footer al sitio -->
  <?php incluirTemplate('footer', $inicio = true); ?>
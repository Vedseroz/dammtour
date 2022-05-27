   <!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inicio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('pasajero')?>"><?php echo $before?></a></li>
              <li class="breadcrumb-item active"><?php echo $actual?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!--                           ETIQUETAS PRICIPALES DE LA PAGINA, AQUI SE HACEN LAS MODIFICACIONES.                                  -->


    <!-- CONTENIDO PRINCIPAL DE LA PAGINA  -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Ingresar Pasajero</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('Pasajero/IngresarPasajeroForm'), 'class="form-horizontal" role="form"') ?>
                  <div class="nombre">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre">
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

                  <div class="acompa">
                    <label for="acompa">Acompañantes:</label>
                    <input type="number" name="acompa" id="acompa" min = "0" max = "6" >
                  </div>

                  
                  <div class="fecha-llegada">
                    <label for="fechallegada">Fecha llegada:</label>
                    <input type="date" name="fechallegada" id="fechallegada">
                  </div>

                  <div class="hora-llegada clockpicker" data-autoclose="true">
                    <label for="horallegada">Hora llegada:</label>
                    <input type="time" name="horallegada" id="horallegada">
                  </div>

                  <div class="fecha-salida">
                    <label for="fechasalida">Fecha salida:</label>
                    <input type="date" name="fechasalida" id="fechasalida">
                  </div>

                  <div class="hora-salida clockpicker" data-autoclose="true">
                    <label for="horasalida">Hora salida:</label>
                    <input type="time" name="horasalida" id="horasalida">
                  </div>

                  <div class="observacion">
                    <label for="observacion">Observación:</label>
                    <textarea name="observacion" id="observacion" rows="10"></textarea>
                  </div>

                  <div class="servicios">
                    <label><b>Servicios:</b></label>
                    
                    <div class="servicio">
                      <div>
                        <input type="checkbox" name="transfer" id="servicio" value="transfer">
                        <label for="servicio">Transfer</label>
                      </div>
                      <div>
                        <input type="checkbox" name="hospedaje" id="servicio" value="hospedaje">
                        <label for="servicio">Hospedaje</label>
                      </div>
                      <div>
                        <input type="checkbox" name="tour" id="servicio" value="tour">
                        <label for="servicio">Tour</label>
                      </div>
                    </div>

                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <a href="<?php echo site_url('pasajero')?>" class="btn btn-danger" type="reset">
                        <i class="ace-icon fa fa-times bigger-110"></i>
                        Cancelar
                     </a>
                    </div>
                    
                    <!--fin del formulario-->
                  </form>
                  </div>
                
                            
            

              
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
 

  
</div>

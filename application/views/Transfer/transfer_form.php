 <!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agregar Evento</h1>
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
                <h3 class="card-title">Ingresar Evento</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('Transfer/AgregarEventoForm/'.$this->uri->segment(3)), 'class="form-horizontal" role="form"') ?>                

                  <div class="fecha">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" value = "<?= set_value('fecha')?>">
                  </div>

                  <div class="origen">
                    <label for="origen">Origen:</label>
                    <input type="text" name="origen" id="origen" value = "<?= set_value('origen')?>">
                  </div>

                  <div class="hora_inicio">
                    <label for="hora_inicio">Hora de Inicio:</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" value = "<?= set_value('hora_inicio')?>">
                  </div>

                  <div class="destino">
                    <label for="destino">Destino:</label>
                    <input type="text" name="destino" id="destino" value = "<?= set_value('destino')?>">
                  </div>

                  <div class="hora_finalizacion">
                    <label for="hora_finalizacion">Hora de Finalizacion:</label>
                    <input type="time" name="hora_finalizacion" id="hora_finalizacion" value = "<?= set_value('hora_finalizacion')?>" >
                  </div>

                  <!-- 
                  <div class="fecha-llegada">
                    <label for="fechallegada">Fecha llegada:</label>
                    <input type="date" name="fechallegada" id="fechallegada" value = "<?= set_value('fechallegada')?>">
                  </div>

                  <div class="hora-llegada clockpicker" data-autoclose="true">
                    <label for="horallegada">Hora llegada:</label>
                    <input type="time" name="horallegada" id="horallegada" value = "<?= set_value('horallegada')?>">
                  </div>

                  <div class="fecha-salida">
                    <label for="fechasalida">Fecha salida:</label>
                    <input type="date" name="fechasalida" id="fechasalida" value = "<?= set_value('fechasalida')?>">
                  </div>

                  <div class="hora-salida clockpicker" data-autoclose="true">
                    <label for="horasalida">Hora salida:</label>
                    <input type="time" name="horasalida" id="horasalida" value = "<?= set_value('horasalida')?>">
                  </div> -->

                  <div class="detalles">
                    <label for="detalles">Detalles Adicionales:</label>
                    <textarea name="detalles" id="detalles" rows="10" value = "<?= set_value('detalles')?>"></textarea>
                  </div>

                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Agregar
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
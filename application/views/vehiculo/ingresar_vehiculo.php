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
                <h3 class="card-title">Ingresar Transfer</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('Vehiculo/IngresarVehiculoForm'), 'class="form-horizontal" role="form"') ?>
                  

                  <div class="marca">
                    <label for="marca">Marca del Vehiculo:</label>
                    <input type="text" name="marca" id="marca" value="<?= set_value('marca')?>">
                  </div>

                  <div class="modelo">
                    <label for="modelo">Modelo del Vehiculo:</label>
                    <input type="text" name="modelo" id="modelo" value="<?= set_value('modelo')?>">
                  </div>

                  <div class="patente">
                    <label for="patente">Patente del Vehiculo:</label>
                    <input type="text" name="patente" id="marca" value="<?= set_value('patente')?>">
                  </div>

                 <div class="tipovehiculo">
                    <label for="tipovehiculo">Tipo de Vehiculo:</label>
                    <select name="tipo" id="tipo" value="<?= set_value('tipo')?>">
                        <option value=""></option>
                        <option value="Sedan">Sedan</option>
                        <option value="Van">Van</option>
                        <option value="Hatch Back">Hatch Back</option>
                        <option value="SUV">SUV</option>
                    </select>
                  </div>


                  <div class="cant_maletas">
                    <label for="acompa">Cantidad de Pasajeros Disponibles:</label>
                    <input type="number" name="cant_pasajeros" id="cant_pasajeros" min = "0" max = "6" value="<?= set_value('cant_pasajeros')?>">
                  </div>


                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <a href="<?php echo site_url('transfer')?>" class="btn btn-danger" type="reset">
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
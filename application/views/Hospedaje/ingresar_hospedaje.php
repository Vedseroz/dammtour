<!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Hospedaje</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('Hospedaje')?>"><?php echo $before?></a></li>
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
                <h3 class="card-title">Ingresar Hospedaje</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('Hospedaje/IngresarHospedajeForm'), 'class="form-horizontal" role="form"') ?>
                  

                  <div class="marca">
                    <label for="marca">Nombre del Hospedaje:</label>
                    <input type="text" name="nombre_hospedaje" id="nombre_hospedaje" value="<?= set_value('nombre_hospedaje')?>">
                  </div>

                  <div class="modelo">
                    <label for="modelo">Direccion del Hospedaje:</label>
                    <input type="text" name="direccion_hospedaje" id="direccion_hospedaje" value="<?= set_value('direccion_hospedaje')?>">
                  </div>
                  
                  <div class="ciudad">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?= set_value('ciudad')?>">
                  </div>

                  <div class="comuna">
                    <label for="comuna">Comuna:</label>
                    <input type="text" name="comuna" id="comuna" value="<?= set_value('comuna')?>">
                  </div>

                  <div class="pais">
                    <label for="patente">Pais:</label>
                    <input type="text" name="pais" id="pais" value="<?= set_value('pais')?>">
                  </div>

                  <div class="telefono">
                    <label for="patente">Telefono del Hospedaje:</label>
                    <input type="text" name="telefono_hospedaje" id="telefono_hospedaje" value="<?= set_value('telefono_hospedaje')?>">
                  </div>



                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <a href="<?php echo site_url('hospedaje')?>" class="btn btn-danger" type="reset">
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
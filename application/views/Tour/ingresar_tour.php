<!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <!--<a class="btn btn-dark"href="<?php echo site_url('Tour')?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>-->
            <h1 class="m-0">Tour</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('Tour')?>"><?php echo $before?></a></li>
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
                <h3 class="card-title">Ingresar Tour</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('Tour/IngresarTourForm'), 'class="form-horizontal" role="form"') ?>
                  
                <div class="row">
                    <div class="col-3">
                        <div class="nombre">
                        <label for="nombre">Nombre del Tour:</label>
                        <input type="text" name="nombre_tour" id="nombre_tour" value="<?= set_value('nombre_tour')?>" size="35" onkeyup="mayus(this);">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="ciudad">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" name="ciudad" id="ciudad" value="<?= set_value('ciudad')?>" size="35" onkeyup="mayus(this);">
                        </div>
                    </div>

                    <div class="col-3">
                        <div div class="pais">
                        <label for="patente">Pais:</label>
                        <input type="text" name="pais" id="pais" value="<?= set_value('pais')?>" onkeyup="mayus(this);">
                        </div>
                    </div>    
                </div>
                <br>
                <div class="row">
                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <a href="<?php echo site_url('Tour')?>" class="btn btn-danger" type="reset">
                        <i class="ace-icon fa fa-times bigger-110"></i>
                        Cancelar
                     </a>
                    </div>
                </div>    
                    <!--fin del formulario-->
                    <br>

                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <?php $this->load->view('Tour/tabla_tour');?>
                    </div>
                </div>

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

<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>
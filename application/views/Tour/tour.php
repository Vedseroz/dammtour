    <!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tours</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $before?></a></li>
              <li class="breadcrumb-item active"><?php echo $actual?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!--                           ETIQUETAS PRICIPALES DE LA PAGINA, AQUI SE HACEN LAS MODIFICACIONES.                                  -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                

              
                <div class="row">
                      <div class = 'col'>
                        <label for="">Agregar Nuevo Tour</label>
                      <a href="<?php echo site_url('Tour/IngresarTour')?>" class="btn btn-dark rounded-circle"><i class="fa fa-plus" aria-hidden="true"></i></a>
                      </div>
                    </div>
                    <hr>
                    <br>
                    <h3>Tours Agendados por Pasajeros:</h3>
                    <div class = "row">
                      <div class = "col d-flex justify-content-center">
                      <?php
                      // en este sector se carga la tabla con todos los pasajeros. 
                      $this->load->view('Tour/tabla_datosTour');
                        ?>
                      </div>
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
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
</div>
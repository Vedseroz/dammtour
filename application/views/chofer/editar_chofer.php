<!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chofer</h1>
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
                <h3 class="card-title">Editar Chofer</h3>
                        
                <br><hr>
                
                <?= form_open_multipart(site_url('chofer/EditarChoferForm/').$this->uri->segment(3), 'class="form-horizontal" role="form"') ?>
                  <div class="nombre">
                    <label for="nombre">Nombre del Chofer:</label>
                    <input type="text" name="nombre_chofer" id="nombre" value="<?= $chofer[0]['nombre_chofer']?>" required placeholder="Nombre">
                  </div>

                  <div class="apellido">
                    <label for="apellido">Apellido del Chofer:</label>
                    <input type="text" name="apellido_chofer" id="apellido" value="<?= $chofer[0]['apellido_chofer']?>" required placeholder="Apellido">
                  </div>

                  <div class="RUT">
                    <label for="RUT">RUT:</label>
                    <input type="text" name="rut_chofer" id="rut_chofer" value="<?= $chofer[0]['rut_chofer']?>" required placeholder="ej. 12345678-9">
                  </div>

                  <div class="apellido">
                    <label for="apellido">Telefono del Chofer:</label>
                    <input type="text" name="telefono_chofer" id="telefono" value="<?= $chofer[0]['telefono_chofer'] ?>" required placeholder="ej. 932457681">
                  </div>

                  <div class="Direccion">
                    <label for="Direccion">Direccion de Domicilio:</label>
                    <input type="text" name="direccion_chofer" id="direccion_chofer" value="<?= $chofer[0]['direccion_chofer']?>" required placeholder="ej. Errazuriz #2756">
                  </div>


                    <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <a href="<?php echo site_url('chofer')?>" class="btn btn-danger" type="reset">
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
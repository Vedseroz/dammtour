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
                  

                  <div class="nombre">
                    <label for="nombre">Nombre del Hospedaje:</label>
                    <input type="text" name="nombre_hospedaje" id="nombre_hospedaje" value="<?= set_value('nombre_hospedaje')?>">
                  </div>

                  <div class="pais1">
                  <label for="pais1">Pais: </label>
                  <select name="pais1" id="pais1" required>
                  <option>Seleccione un pais</option>
                  <!--CARGAMOS LOS PAISES EN EL SELECT-->
                    <?php $this->load->model('Localidad_model');
                    $paises = $this->Localidad_model->getPaises();
                    var_dump($paises);
                    for ($i = 0; $i < count($paises); $i++) {
                    echo '<option value="' . $paises[$i]['pais'] . '">' . $paises[$i]['pais'] . '</option>';
                    }
                  ?>
                  </select>
                  </div>

                  <div class="ciudad">
                    <label for="ciudad">Ciudad:</label>
                    <select name="ciudad1" id="ciudad1" required>
                    <option>Seleccione una Ciudad</option>
                </select>
                </div>
                
                <!--SCRIPT PARA LA SELECCION DINAMICA DE LA CIUDAD-->
                  <script>
                $(document).ready(function() {
                  $("#pais1").change(function() {
                    var pais_seleccionado = $(this).val();
                    console.log(pais_seleccionado);

                    $.ajax({
                      url: '<?php echo base_url(); ?>index.php/Localidad/getCiudadPorPais/' + pais_seleccionado,
                      type: 'post',
                      success: function(response) {
                        // Add response in Modal body
                        var data = JSON.parse(response);
                        var text = '';

                        for (let i = 0; i < data.length; i++) {
                          text += '<option value="' + data[i]['ciudad'] + '">' + data[i]['ciudad'] + '</option>';
                        }

                        $('#ciudad1').html(text);

                      }
                    });



                  })
                })
              </script>

                  
                  



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
                    
                    <br>
                    <hr>
                    <h4>Hospedajes disponibles</h4>
                    <div class="row">
                    <div class="col d-flex justify-content-center">
                        <?php $this->load->view('Hospedaje/tabla_hospedaje');?>
                    </div>
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
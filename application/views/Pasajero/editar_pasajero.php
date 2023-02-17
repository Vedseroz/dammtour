 <!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pasajero</h1>
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
                <h3 class="card-title">Editar Datos del Pasajero</h3>
                      
                <br><hr>

                <!--INFORMACION DEL PASAJERO-->
                <div class="row">
                  <div class="col-3"><label for="nombre">NOMBRE DEL PASAJERO:</label><?= '   '.$pasajero[0]['nombre']?></div>
                  <div class="col-3"><label for="telefono">TELEFONO DEL PASAJERO:</label><?= '  '.$pasajero[0]['telefono']?></div>
                  <div class="col-3"><label for="telefono">CORREO DEL PASAJERO:</label><?= '  '.$pasajero[0]['email']?></div>
                </div>
                <div class="row">
                  <div class="col-3"><label for="telefono">FECHA DE INICIO:</label><?= '  '.$pasajero[0]['fecha_inicio']?></div>
                  <div class="col-3"><label for="telefono">HORA DE INICIO:</label><?= '  '.$pasajero[0]['hora_inicio']?></div>
                  <div class="col-3"><label for="telefono">DESTINO:</label><?= '  '.$pasajero[0]['destino']?></div>
                </div>
                <div class="row">
                  <div class="col-3"><label for="telefono">CANTIDAD DE ADULTOS:</label><?= '  '.$pasajero[0]['cant_adultos']?></div>
                  <div class="col-3"><label for="telefono">CANTIDAD DE NIÑOS:</label><?= '  '.$pasajero[0]['cant_ninos']?></div>
                  <div class="col-3"><label for="telefono">SERVICIOS SOLICITADOS:</label><?= '  '.$pasajero[0]['servicios']?></div>
                </div>

                <hr>
                <h3 class="card-title">TRANSFER</h3>
                <!--informacion del transfer---------------------------------------------------------------------------------------------------------------->
                <?= form_open_multipart(site_url('Transfer/agregarTransfer/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>

                <br>

                <div class="row">
                  <div class="col-3">
                    <label for="fechallegada">Fecha llegada: &nbsp;</label>
                    <input type="date" name="fechallegada" id="fechallegada" ></div>
                  <div class="col-2">
                    <label for="horallegada">Hora llegada: &nbsp;</label>
                    <input type="time" name="horallegada" id="horallegada" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="fechasalida">Fecha salida: &nbsp;</label>
                    <input type="date" name="fechasalida" id="fechasalida"></div>
                  <div class="col-2">
                  <label for="horasalida">Hora salida: &nbsp;</label>
                    <input type="time" name="horasalida" id="horasalida" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="adultos">Cantidad de adultos: &nbsp;</label>
                    <input type="number" name="cant_adultos" id="cant_adultos" min="1" max="20"></div>
                  <div class="col-3">
                  <label for="ninos">Cantidad de niños: &nbsp;</label>
                    <input type="number" name="cant_ninos" id="cant_ninos" min="0" max="20"></div>
                  <div class="col-3">
                  <label for="horasalida">Cantidad de maletas: &nbsp;</label>
                    <input type="number" name="cant_maletas" id="cant_maletas" min="0" max="20"></div>
                </div>

                <div class = "col-3"></div>
                <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseTransfer" aria-expanded="false" aria-controls="collapseExample">
                        Mostrar Transfers del Pasajero
                      </button>
                      
                      <div class="collapse" id="collapseTransfer">
                        <div class="card card-body">
                         <?php $this->load->view('Pasajero/tablapasajero_transfer')?>
                        </div>
                      </div>

                  </div>  
                </div>
                </form>

                <!--Hospedaje-------------------------------------------------------------------------------------------------------------------->
                <hr>
                <h3 class="card-title">HOSPEDAJE</h3>
                <!--informacion del transfer-->
                <?= form_open_multipart(site_url('Hospedaje/IngresarHospedajeForm/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>

                <br>

                <div class="row">
                  <div class="col-3">
                    <label for="fechallegada">Fecha llegada: &nbsp;</label>
                    <input type="date" name="fechallegada2" id="fechallegada" ></div>
                  <div class="col-2">
                    <label for="horallegada">Hora llegada: &nbsp;</label>
                    <input type="time" name="horallegada2" id="horallegada" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="fechasalida">Fecha salida: &nbsp;</label>
                    <input type="date" name="fechasalida2" id="fechasalida"></div>
                  <div class="col-2">
                  <label for="horasalida">Hora salida: &nbsp;</label>
                    <input type="time" name="horasalida2" id="horasalida" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="pais">Pais: &nbsp;</label>
                  <select name="pais1" id="pais1">
                  <option>Seleccione un pais</option>
                  <!--CARGAMOS LOS PAISES EN EL SELECT-->
                  <?php $this->load->model('Localidad_model');
                        $paises = $this->Localidad_model->getPaises();
                        var_dump($paises);
                        for($i=0;$i<count($paises);$i++){
                          echo '<option value="'.$paises[$i]['pais'].'">'.$paises[$i]['pais'].'</option>';
                        }      
                  ?>
                  </select>
                 </div>
                  <div class="col-3">
                  <label for="ciudad">Ciudad: &nbsp;</label>
                  <select name="ciudad1" id="ciudad1">
                    <option>Seleccione una Ciudad</option>
                  </select>
                  </div>
                      

                  <!--SELECT DINAMICO CIUDAD--------------------------------------------------------------------->
                  <script>
                    $(document).ready(function(){
                      $("#pais1").change(function(){
                        var pais_seleccionado = $(this).val();
                        console.log(pais_seleccionado);

                        $.ajax({
                              url: '<?php echo base_url();?>index.php/Localidad/getCiudadPorPais/'+pais_seleccionado,
                              type: 'post',
                              success: function(response){ 
                                // Add response in Modal body
                                var data = JSON.parse(response);
                                var text = '';

                                for (let i = 0; i<data.length;i++){
                                text += '<option value="'+data[i]['ciudad']+'">'+data[i]['ciudad']+'</option>';
                                }

                                $('#ciudad1').html(text);
                               
                              }
                          });



                      })
                    })
                  </script>
                  <!-------------------------------------------------------------------------------------->

                  <div class="col-3">
                  <label for="posada">Posada: &nbsp;</label>
                    <select  name="posada" ID="posada">
                    <option>Seleccione una posada</option>

                     <!--SELECT DINAMICO POSADA--------------------------------------------------------------------->
                  <script>
                    $(document).ready(function(){
                      $("#ciudad1").change(function(){
                        var ciudad_seleccionada = $(this).val();
                        console.log(ciudad_seleccionada);

                        $.ajax({
                              url: '<?php echo base_url();?>index.php/Hospedaje/getHospedajePorCiudad/'+ ciudad_seleccionada,
                              type: 'post',
                              success: function(response){ 
                                // Add response in Modal body
                                var text = '';
                                var data = JSON.parse(response);
                                console.log(data);

                                for (let i = 0; i<data.length;i++){
                                text += '<option value="'+data[i]['nombre_hospedaje']+'">'+data[i]['nombre_hospedaje']+'</option>';
                                }

                                $('#posada').html(text);
                               
                              }
                          });

                      })
                    })
                  </script>
                  <!-------------------------------------------------------------------------------------->


                  </select>
                  </div>

                <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseHospedaje" aria-expanded="false" aria-controls="collapseExample">
                        Mostrar Hospedajes del Pasajero
                      </button>
                      
                      <div class="collapse" id="collapseHospedaje">
                        <div class="card card-body">
                        <?php $this->load->view('Pasajero/tablapasajero_hospedaje')?>
                        </div>
                      </div>
                    
                </div>
                </div>
                  </div>
                  </form>

                  <br>


                <!--DATOS DE LOS TOURS----------------------------------------------------------------------------------------------------------->
                <hr>
                <h3 class="card-title">TOURS</h3>
                <!--informacion del transfer-->
                <?= form_open_multipart(site_url('Tour/IngresarTourForm/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>

                <br>

                <div class="row">
                  <div class="col-3">
                    <label for="fechallegada">Fecha llegada: &nbsp;</label>
                    <input type="date" name="fechallegada3" id="fechallegada" ></div>
                  <div class="col-2">
                    <label for="horallegada">Hora llegada: &nbsp;</label>
                    <input type="time" name="horallegada3" id="horallegada" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="fechasalida">Fecha salida: &nbsp;</label>
                    <input type="date" name="fechasalida3" id="fechasalida"></div>
                  <div class="col-2">
                  <label for="horasalida">Hora salida: &nbsp;</label>
                    <input type="time" name="horasalida3" id="horasalida" ></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="pais">Pais: &nbsp;</label>
                  <select name="pais2" id="pais2">
                    <option>Seleccione un Pais</option>
                    <!-- SCRIPT------------------------------------------------------------------------------------------------------>
                    <?php $this->load->model('Localidad_model');
                        $paises = $this->Localidad_model->getPaises();
                        for($i=0;$i<count($paises);$i++){
                          echo '<option value="'.$paises[$i]['pais'].'">'.$paises[$i]['pais'].'</option>';
                        }      
                    ?>
                    <!--------------------------------------------------------------------------------------------------------------->
                  </select>
                 </div>
                  <div class="col-3">
                  <label for="ciudad">Ciudad: &nbsp;</label>
                  <select name="ciudad2" id="ciudad2">
                    <option>Seleccione una Ciudad</option>
                      <!--SCRIPT------------------------------------------------------------------------------------------------------> 
                      <script>
                    $(document).ready(function(){
                      $("#pais2").change(function(){
                        var pais_seleccionado = $(this).val();
                        console.log(pais_seleccionado);

                        $.ajax({
                              url: '<?php echo base_url();?>index.php/Localidad/getCiudadPorPais/'+pais_seleccionado,
                              type: 'post',
                              success: function(response){ 
                                // Add response in Modal body
                                var data = JSON.parse(response);
                                var text = '';

                                for (let i = 0; i<data.length;i++){
                                text += '<option value="'+data[i]['ciudad']+'">'+data[i]['ciudad']+'</option>';
                                }

                                $('#ciudad2').html(text);
                               
                              }
                          });
                      })
                    })
                  </script>

                      <!--------------------------------------------------------------------------------------------------------------> 


                  </select>
                  </div>
                  <div class="col-3">
                  <label for="posada">Tour: &nbsp;</label>
                  <select name="tour" ID="tour">
                    <option >Seleccione un Tour</option>

                     <!--SCRIPT------------------------------------------------------------------------------------------------------> 
                     <script>
                    $(document).ready(function(){
                      $("#ciudad2").change(function(){
                        var ciudad_seleccionada = $(this).val();
                        console.log(ciudad_seleccionada);

                        $.ajax({
                              url: '<?php echo base_url();?>index.php/Tour/getTourPorCiudad/'+ciudad_seleccionada,
                              type: 'post',
                              success: function(response){ 
                                // Add response in Modal body
                                var data = JSON.parse(response);
                                console.log(data);
                                var text = '';

                                for (let i = 0; i<data.length;i++){
                                text += '<option value="'+data[i]['nombre_tour']+'">'+data[i]['nombre_tour']+'</option>';
                                }

                                $('#tour').html(text);
                               
                              }
                          });
                      })
                    })
                  </script>

                      <!-------------------------------------------------------------------------------------------------------------->

                  </select>
                  </div>
        

                <div class="clearfix form-actions center">
                      <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>

                      <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseTour" aria-expanded="false" aria-controls="collapseExample">
                        Mostrar Tours del Pasajero
                      </button>
                      
                      <div class="collapse" id="collapseTour">
                        <div class="card card-body">
                        <?php $this->load->view('Pasajero/tablapasajero_tour')?>
                        </div>
                      </div>
                    
                </div>
                </div>
                
                <br>
                </form>
                  </div>

                <!--COSTOS----------------------------------------------------------------------------------------------------------------------------------------->
               
                <hr>
                <h3 class="card-title">COSTOS</h3>
                <?= form_open_multipart(site_url('Costo/IngresarCosto/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>
                <br>
                <div class="row">
                  <div class="col-3">
                  <label for="pais">COSTO TOTAL: &nbsp;</label>
                  <input type="text" name="currency-field" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$1,000,000.00"><label>(BRL)</label>
                  
                  <!--script-->
                  <script>
                  $("input[data-type='currency']").on({
                      keyup: function() {
                        formatCurrency($(this));
                      },
                      blur: function() { 
                        formatCurrency($(this), "blur");
                      }
                  });

                  function formatNumber(n) {
                    // format number 1000000 to 1,234,567
                    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                  }


                  function formatCurrency(input, blur) {
                    // appends $ to value, validates decimal side
                    // and puts cursor back in right position.
                    
                    // get input value
                    var input_val = input.val();
                    
                    // don't validate empty input
                    if (input_val === "") { return; }
                    
                    // original length
                    var original_len = input_val.length;

                    // initial caret position 
                    var caret_pos = input.prop("selectionStart");
                      
                    // check for decimal
                    if (input_val.indexOf(".") >= 0) {

                      // get position of first decimal
                      // this prevents multiple decimals from
                      // being entered
                      var decimal_pos = input_val.indexOf(".");

                      // split number by decimal point
                      var left_side = input_val.substring(0, decimal_pos);
                      var right_side = input_val.substring(decimal_pos);

                      // add commas to left side of number
                      left_side = formatNumber(left_side);

                      // validate right side
                      right_side = formatNumber(right_side);
                      
                      // On blur make sure 2 numbers after decimal
                      if (blur === "blur") {
                        right_side += "00";
                      }
                      
                      // Limit decimal to only 2 digits
                      right_side = right_side.substring(0, 2);

                      // join number by .
                      input_val = "$" + left_side + "." + right_side ;

                    } else {
                      // no decimal entered
                      // add commas to number
                      // remove all non-digits
                      input_val = formatNumber(input_val);
                      input_val = "$" + input_val;
                      
                      // final formatting
                      if (blur === "blur") {
                        input_val += ".00";
                      }
                    }
                    
                    // send updated string to input
                    input.val(input_val);

                    // put caret back in the right position
                    var updated_len = input_val.length;
                    caret_pos = updated_len - original_len + caret_pos;
                    input[0].setSelectionRange(caret_pos, caret_pos);
                  }

                  </script>

                 </div>

                <div class="clearfix form-actions center">
                      <button class="btn btn-danger" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        FINALIZAR
                      </button>

                      <a class="btn btn-success pull-right" href="">ENVIAR VOUCHER POR CORREO</a>
                
                </div>

                </div>
                </form>

                
                <!--<?= form_open_multipart(site_url('Pasajero/editarPasajeroForm/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>
                <div class="nombre">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value = "<?= $pasajero[0]['nombre']?>">
                  </div>

                  <div class="apellido">
                    <label for="apellido">Apellidos:</label>
                    <input type="text" name="apellido" id="apellido" value= "<?= $pasajero[0]['apellido']?>">
                  </div>

                  <div class="telefono">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" name="telefono" id="telefono" value = "<?= $pasajero[0]['telefono']?>">
                  </div>

                  <div class="email">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value = "<?= $pasajero[0]['email']?>">
                  </div>

                  <div class="acompa">
                    <label for="acompa">Acompañantes:</label>
                    <input type="number" name="acompa" id="acompa" min = "0" max = "6" value = "<?= $pasajero[0]['acompa']?>" >
                  </div>

                  
                  <div class="fecha-llegada">
                    <label for="fechallegada">Fecha llegada:</label>
                    <input type="date" name="fechallegada" id="fechallegada" value = "<?= $fecha[0]['fechallegada']?>">
                  </div>

                  <div class="hora-llegada clockpicker" data-autoclose="true">
                    <label for="horallegada">Hora llegada:</label>
                    <input type="time" name="horallegada" id="horallegada" value = "<?= $fecha[0]['horasalida']?>">
                  </div>

                  <div class="fecha-salida">
                    <label for="fechasalida">Fecha salida:</label>
                    <input type="date" name="fechasalida" id="fechasalida" value = "<?= $fecha[0]['fechasalida']?>">
                  </div>

                  <div class="hora-salida clockpicker" data-autoclose="true">
                    <label for="horasalida">Hora salida:</label>
                    <input type="time" name="horasalida" id="horasalida" value = "<?= $fecha[0]['horasalida']?>">
                  </div>

                  <div class="observacion">
                    <label for="observacion">Observación:</label>
                    <textarea name="observacion" id="observacion" rows="10" value = "<?= $pasajero[0]['observacion']?>"></textarea>
                  </div> 

                  <div class="servicios">
                    <label><b>Servicios:</b></label>
                    
                    <div class="servicio">
                      <div>
                        <input type="checkbox" name="transfer" id="servicio" value="Transfer">
                        <label for="servicio">Transfer</label>
                      </div>
                      <div>
                        <input type="checkbox" name="hospedaje" id="servicio" value="Hospedaje">
                        <label for="servicio">Hospedaje</label>
                      </div>
                      <div>
                        <input type="checkbox" name="tour" id="servicio" value="Tour">
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

                    fin del formulario-->
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
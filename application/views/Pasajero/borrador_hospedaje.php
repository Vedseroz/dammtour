<hr>
                <h3 class="card-title">HOSPEDAJE</h3>
                <!--informacion del transfer---------------------------------------------------------------------------------------------------------------->
                <?= form_open_multipart(site_url('Hospedaje/IngresarHospedajeForm/'.$this->uri->segment(3)), 'class="form-horizontal" role="form" method="POST" ') ?>

                <br>

                <div class="row">
                  <div class="col-3">
                    <label for="fechallegada">Fecha llegada: &nbsp;</label>
                    <input type="date" name="fechallegada2" id="fechallegada" required></div>
                  <div class="col-2">
                    <label for="horallegada">Hora llegada: &nbsp;</label>
                    <input type="time" name="horallegada2" id="horallegada" required></div>
                </div>

                <div class="row">
                  <div class="col-3">
                  <label for="fechasalida">Fecha salida: &nbsp;</label>
                    <input type="date" name="fechasalida2" id="fechasalida" required></div>
                  <div class="col-2">
                  <label for="horasalida">Hora salida: &nbsp;</label>
                    <input type="time" name="horasalida2" id="horasalida" required></div>
                </div>

            <div class="row">
                  <div class="col-3">
                  <label for="pais">Pais: &nbsp;</label>
                  <select name="pais1" id="pais1" required>
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
                  <select name="ciudad1" id="ciudad1" required>
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
                  <label for="ciudad">Posada: &nbsp;</label>
                  <select name="posada" id="posada" required>
                    <option>Seleccione una Posada</option>
                  </select>
                </div>

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
                  
            </div>
                 

                

                <div class ="row" >
                  
                  <button class="btn btn-info" type="submit" style="margin:10px">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Ingresar
                      </button>
                  

                  
                  <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseTransfer" aria-expanded="false" aria-controls="collapseExample">
                        Mostrar Transfers del Pasajero
                      </button>
                      </div>
                 
                
                  <div class="collapse" id="collapseTransfer">
                        <div class="card card-body">
                         <?php $this->load->view('Pasajero/tablapasajero_hospedaje')?>
                  </div>
                 
                  </div>
                
                </form>
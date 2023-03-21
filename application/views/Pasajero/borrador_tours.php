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
                  </div
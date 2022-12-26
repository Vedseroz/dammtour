<!-- HEADER DE LA PAGINA , CAMBIAR SOLO PARAMETROS DEL BREADCRUMB. -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transfer</h1>
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
                <h3 class="card-title">Asignar Transfer</h3>   
                  <br>
                  <hr>
                  <!--Informacion del pasajero-->
                  <div class="container">
                    <div class="row">
                     <div class="col-lg-3">
                        <label abel for="nombre">Nombre del Pasajero: </label>
                        <?php echo $pasajero[0]['nombre']; ?>
                      </div>
                      <div class="col-lg-4">
                        <label for="apellido">Apellido del Pasajero: </label>
                        <?php echo $pasajero[0]['apellido']; ?>
                      </div>
                      <div class="col-lg-3">
                        <label for="telefono">Telefono del Pasajero: </label>
                        <?php echo $pasajero[0]['telefono']; ?>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="correo">Correo del Pasajero: </label>
                        <?php echo $pasajero[0]['email']; ?>
                      </div>
                      <div class="col-lg">
                        <label for="correo">Cantidad de Pasajeros: </label>
                        <?php echo $pasajero[0]['acompa']; ?>
                      </div>
                      <div class="col-lg">
                        <label for="servicios">Servicios solicitados: </label>
                        <?php echo $pasajero[0]['servicios']; ?>
                      </div>
                  </div>

                  <div class ='row'>
                    <div class = 'col'>
                       <a href="<?php echo site_url('Transfer/AgregarEvento/'.$this->uri->segment(3))?>" class="btn btn-dark">Agregar Eventos</a>
                    </div>
                    <div class = 'col'>
                    <a type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm" >Enviar Voucher</a>
                    </div>
                  </div>
                
                <br>
                <?php $this->load->view('Transfer/tabla_voucher');?>
                
              <br>

              
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
 
  <script>
   jQuery('#confirm').modal('show',{backdrop : 'static'});
</script>
<!--Modal-->
<div class="modal fade" id="confirm"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alerta:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--CONENIDO DEL MODAL, AQUI VA EL FORMULARIO-->  
        <h4>¿Desea enviar el voucher al cliente por el correo: <?= $pasajero[0]['email']?>?</h4>
      </div>

      <!--Este es el pie del modal aqui puedes agregar mas botones-->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <a id="url-delete" name="url-delete" href="#" class="btn btn-success btn-sm"><i class="fa fa-check">&nbsp;</i>Enviar Voucher</a>
      </div>
    </div>
  </div>
  


</div>


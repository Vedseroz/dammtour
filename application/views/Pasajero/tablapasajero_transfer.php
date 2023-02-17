<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>

<style><?php include 'tablapasajeros.css'?></style>



<script>
    $(document).ready(function(){
        var myTable = $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable({
            "bAutoWidth":false,
            "processing":true,
            "ajax":{
                "url": "<?= site_url('Transfer/getDatosTransferById/'.$this->uri->segment(3)); ?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "data":'pasajero_id',
                    "targets":0,
                    "searchable":true,
                    "render": function (data,type,row,meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "title": 'Adultos',
                    "data": 'cant_adultos',
                    "targets": 1,
                    "searchable": false,
                    "visible": true
                },
                {
                    "title": 'Niños',
                    "data": 'cant_ninos',
                    "targets": 2,
                    "searchable": true,
                    "visible":true               
                },
                {
                    "title": 'Maletas',
                    "data": 'cant_maletas',
                    "targets": 3,
                    "visible":true

                },
                {
                    "title": 'Fecha de Llegada',
                    "data": 'fechallegada',
                    "targets": 4,
                    "visible":true

                },
                {
                    "title": 'Hora de Llegada',
                    "data": 'horallegada',
                    "targets": 5,
                    "visible":true

                },
                {
                    "title": 'Fecha de Salida',
                    "data": 'fechasalida',
                    "targets": 6,
                    "visible":true

                },
                {
                    "title": 'Hora de Salida',
                    "data": 'horasalida',
                    "targets": 7,
                    "visible":true

                },
                {
                "title": 'Opciones',
                "data": null,
                "targets": 8,
                "searchable": false,
                "orderable": false,
                "render": function(data,type,row){
                    
                    var link = '<?php echo site_url('Pasajero/editarPasajero'); ?>/' + row.pasajero_id;
                    
                    return '<a onclick="return confirm_modal('+row.id_pasajero+');" type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#exampleModal" id = "'+row.id+'"><i class="fa fa-times" aria-hidden="true"></i></a>'

                    }
                },

            ],
            "order":[[0,"asc"]],
            "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
            }
        })
    });

    function confirm_modal(id){
        console.log(id);
        var url='<?php echo site_url('Pasajero/eliminarPasajero/')?>';
        var new_url = url+id;
        //$("url-delete").attr("href",new_url);
        jQuery('#exampleModal').modal('show',{backdrop : 'static'});
        var link = document.getElementById('url-delete');
        link.href = new_url;
    }

    
</script>


<!-- ====================================================================HTML============================================================================================-->
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover"></table>
        </div>
    
    </div>
</div> 

<!--Modal-->
<div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog">
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
        <h4>¿Está seguro que quiere eliminar a este pasajero?</h4>
      </div>

      <!--Este es el pie del modal aqui puedes agregar mas botones-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="url-delete" name="url-delete" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times">&nbsp;</i>Eliminar</a>
      </div>
    </div>
  </div>
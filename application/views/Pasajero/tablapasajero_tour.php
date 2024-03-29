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
        var myTable = $('#dynamic-table3')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable({
            "bAutoWidth":false,
            "processing":true,
            "ajax":{
                "url": "<?= site_url('Tour/getDatosTourByIdPasajero/'.$this->uri->segment(3)); ?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "targets":0,
                    "searchable":true,
                    "render": function (data,type,row,meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "title": 'Tour',
                    "data": 'detalles_tour',
                    "targets": 1,
                    "searchable": false,
                    "visible": true
                },
                {
                    "title": 'Ciudad',
                    "data": 'ciudad',
                    "targets": 2,
                    "searchable": true,
                    "visible":true               
                },
                {
                    "title": 'Pais',
                    "data": 'pais',
                    "targets": 3,
                    "visible":true

                },
                {
                "title": 'Opciones',
                "data": null,
                "targets": 4,
                "searchable": false,
                "orderable": false,
                "render": function(data,type,row){
                    
                    return '<a onclick="return confirm_modal2('+row.id_tour+');" type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#tourmodal" id = "'+row.id+'"><i class="fa fa-times" aria-hidden="true"></i></a>'

                    }
                },

            ],
            "order":[[0,"asc"]],
            "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
            }
        })
    });

    function confirm_modal2(id){
        console.log(id);
        var url='<?php echo site_url('Tour/eliminarEventoTour/')?>';
        var new_url = url+id;
        //$("url-delete").attr("href",new_url);
        jQuery('#tourmodal').modal('show',{backdrop : 'static'});
        var link = document.getElementById('url-delete2');
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
            <table id="dynamic-table3" class="table table-striped table-bordered table-hover"></table>
        </div>
    
    </div>
</div> 

<!--Modal-->
<div class="modal fade" id="tourmodal"  tabindex="-1" role="dialog">
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
        <h4>¿Está seguro que quiere eliminar este evento?</h4>
      </div>

      <!--Este es el pie del modal aqui puedes agregar mas botones-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="url-delete2" name="url-delete2" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times">&nbsp;</i>Eliminar</a>
      </div>
    </div>
  </div>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>

<style>
    <?php include 'tablapasajeros.css' ?>
</style>



<script>
    $(document).ready(function() {
        var myTable = $('#dynamic-tableServicio')
            //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
            .DataTable({
                "bAutoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Pasajero/getDatosServicioPasajero/' . $this->uri->segment(3)); ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                        "title": '#',
                        "data": 'id_servicio',
                        "targets": 0,
                        "searchable": true,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "title": 'N° Vuelo',
                        "data": 'n_vuelo',
                        "targets": 1,
                        "searchable": false,
                        "visible": true
                    },
                    {
                        "title": 'Avión',
                        "data": 'avion',
                        "targets": 2,
                        "searchable": true,
                        "visible": true
                    },
                    {
                        "title": 'Embarque',
                        "data": 'embarque',
                        "targets": 3,
                        "visible": true

                    },
                    {
                        "title": 'Desembarque',
                        "data": 'desembarque',
                        "targets": 4,
                        "visible": true

                    },
                    {
                        "title": 'Opciones',
                        "data": null,
                        "targets": 5,
                        "searchable": false,
                        "orderable": false,
                        "render": function(data, type, row) {

                            return '<a onclick="return confirm_modalServicio(' + row.id_servicio + ');" type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#serviciomodal" id = "' + row.id_servicio + '"><i class="fa fa-times" aria-hidden="true"></i></a>'

                        }
                    },

                ],
                "order": [
                    [0, "asc"]
                ],
                "language": {
                    "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
                }
            })
    });

    function confirm_modalServicio(id_servicio) {
        var url = '<?php echo site_url('Pasajero/EliminarServicioPasajero/' . $this->uri->segment(3)) ?>' + '/' + id_servicio;
        jQuery('#serviciomodal').modal('show', {
            backdrop: 'static'
        });
        var link = document.getElementById('url-deleteServicio');
        link.href = url;
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
            <table id="dynamic-tableServicio" class="table table-striped table-bordered table-hover"></table>
        </div>

    </div>
</div>

<!--Modal-->
<div class="modal fade" id="serviciomodal" tabindex="-1" role="dialog">
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
                <h4>¿Está seguro que quiere eliminar este servicio?</h4>
            </div>

            <!--Este es el pie del modal aqui puedes agregar mas botones-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="url-deleteServicio" name="url-deleteServicio" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times">&nbsp;</i>Eliminar</a>
            </div>
        </div>
    </div>
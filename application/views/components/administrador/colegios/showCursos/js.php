<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.gritter.min.js') ?>"></script>

<script>
$(document).ready(function() {
    //initiate dataTables plugin
    var myTable = $('#dynamic-table')
    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
    .DataTable( {
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?= site_url('Administrador/ajaxGetEstudiantesCursos/') . $id_curso ?>",
            "type": "GET"
        },
        "columnDefs": [
           {
                "title": 'id',
                "data": 'id',
                "targets": 0,
                "visible": false
            },
            {
                "title": 'RUT',
                "data": 'rut',
                "targets": 1
            },
            {
                "title": 'Nombres',
                "data": 'nombres',
                "targets": 2
            },
            {
                "title": 'Apellido Paterno',
                "data": 'apellido_p',
                "targets": 3
            },
            {
                "title": 'Apellido Materno',
                "data": 'apellido_m',
                "targets": 4,
            },
            {
                "title": 'Nacimiento',
                "data": 'nacimiento',
                "targets": 5,
            },
            {
                "title": 'Opciones',
                "data": null,
                "targets": 6,
                "searchable": false,
                "orderable": false,
                "render": function ( data, type, row ) {
                    //Declaracion y creacion de link para botones segun la etapa del proceso

                    var link_edit = '<?= site_url('Administrador/edit_estudiante') ?>' + '/' + row.id;
                    var link_detalles = '<?= site_url('Administrador/show_estudiante') ?>' + '/' + row.id;

                    var remove_normal = '<a class="red" title="Eliminar" href="#" data-toggle="modal" data-target="#deleteModal" data-id="' + row.id + '" data-codigo="' + row.rut + '"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                    var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';
                    var show_details_normal = '<a class="grey" href="' + link_detalles + '" title="detalles y cursos"><i class="ace-icon fa fa-search-plus bigger-130"></i></a>';
                    var edit_normal = '<a class="blue" href="' + link_edit + '" title="editar"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';

                    options_normal += show_details_normal + edit_normal + remove_normal;
                    options_normal += '</div>';

                    var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
                    var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="detalles y cursos"><span class="grey"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span></a></li>';
                    var show_details_responsive = '<li><a href="' + link_detalles + '" class="tooltip-success" data-rel="tooltip" title="editar"><span class="blue"><i class="ace-icon fa fa-search-plus bigger-120"></i></span></a></li>';
                    var remove_responsive = '<li><a href="#" data-toggle="modal" data-target="#deleteModal" data-id="' + row.id + '" data-codigo="' + row.rut + '" class="tooltip-error" data-rel="tooltip" title="Eliminar"><span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></li>';
                    
                    options_responsive += show_details_responsive + edit_responsive + remove_responsive;
                    options_responsive += '</ul></div></div>';

                    return options_normal;
                }
            }
        ],
        "order": [[ 0, "desc" ]],
        "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
        }
    } );

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        
        var id = button.data('id');
        var codigo = button.data('codigo');
        
        var modal = $(this);    
        
        modal.find('.delete-modal-codigo').text(codigo);
        modal.find('#deleteButton').attr('onclick', "btnRemove(" + id + ")");
    });
    
    $('.loading-delete-btn').on(ace.click_event, function () {
        var btn = $(this);
        btn.button('loading');
    });

});

function btnRemove(id) {
    $.ajax({
        url: "<?= site_url('/Administrador/ajaxRemoverEstudianteDeCurso') ?>/" + id,
        type: 'get',                
        dataType: 'json',
        success:function(response) {
             $.gritter.add({
                        title: 'Eliminación exitosa',
                        text: 'Se ha eliminado con éxito el colegio, código ',
                        class_name: 'gritter-success'
                    });
            if(response.type === 'Successful') {
                if(response.name == 'Remove') {
                    $.gritter.add({
                        title: 'Eliminación exitosa',
                        text: 'Se ha eliminado con éxito el colegio, código ',
                        class_name: 'gritter-success'
                    });
                }
            } else if(response.type === 'Warning') {
                $.gritter.add({
                    title: 'Advertencia eliminación',
                    text: 'No existe el colegio, es posible que ya se haya eliminado.',
                    class_name: 'gritter-warning'
                });
            } else if(response.type === 'Error') {
                $.gritter.add({
                    title: 'Error eliminación',
                    text: 'No se ha podido eliminar el colegio.',
                    class_name: 'gritter-error'
                });
            }

            $('#deleteModal').modal('hide');
            setTimeout(function () {
                $('.loading-delete-btn').button('reset')
            }, 500);
            
            $('#dynamic-table').DataTable().ajax.reload(null, false);
        }, // /succes
        error: function (jqXHR, textStatus, errorThrown)
        {
            $.gritter.add({
                title: 'Error eliminación',
                text: 'No se ha podido eliminar el colegio.',
                class_name: 'gritter-error'
            });
            $('#deleteModal').modal('hide');
            setTimeout(function () {
                $('.loading-delete-btn').button('reset')
            }, 500);
            console.log(errorThrown);
        } // /error
    });
}
</script>
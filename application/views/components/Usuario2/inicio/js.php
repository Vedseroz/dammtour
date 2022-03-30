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
            "url": "<?= site_url('Inicio/getProcedimientos') ?>",
            "type": "POST"
        },
        "columnDefs": [
            {
                "title": 'ID de Procedimiento',
                "data": 'id',
                "targets": 0,
                "searchable": false,
                "visible": true
            },
            {
                "title": 'RUC',
                "data": 'RUC',
                "targets": 1,
                "searchable": false,
                "visible": true
            },            
            {
                "title": 'Asignado',
                "data": 'asignado',
                "targets": 2,
                "searchable": true,
                "visible": false
            },
            {
                "title": 'Nombre',
                "data": null,
                "targets": 3,
                "render": function ( data, type, row ) {
                    return row.apellido_p +' '+ row.apellido_m;
                }
            },
            {
                "title": 'Apellido Paterno',
                "data": 'apellido_p',
                "targets": 4,
                "visible": false
            },
            {
                "title": 'Apellido Materno',
                "data": 'apellido_m',
                "targets": 5,
                "visible": false
            },
            {
                "title": 'Fecha',
                "data": 'fecha',
                "searchable": false,
                "targets": 6,
                "visible": true,
                "render": function ( data, type, row ) {
                    if(data == null) {
                        return 'Sin información'
                    }
                    return data.split("-").reverse().join("-");
                }
            },
            {
                "title": 'Titulo',
                "data": 'titulo',
                "targets": 7,
                "visible": true
            },
            {
                "title": 'Etapa',
                "data": 'etapa',
                "searchable": false,
                "targets": 8,
                "render": function ( data, type, row ) {
                    if(row.etapa == 2) return 'Denuncia Realizada -> Apertura';
                    if(row.etapa == 3) return 'Apertura -> Formulación de Cargo';
                    if(row.etapa == 4) return 'Formulación de Cargo -> Dictamen';
                    if(row.etapa == 5) return 'Dictamen -> Impugnación';
                    if(row.etapa == 6) return 'Impugnación -> Resolución';
                    if(row.etapa == 7) return 'Resolución Finalizada';
                },
                "visible": true
            },
            {
                "title": 'Conitnuar',
                "data": null,
                "targets": 9,
                "searchable": false,
                "orderable": false,
                "render": function ( data, type, row ) {
                    //Declaracion y creacion de link para botones segun la etapa del proceso

                    var link_edit = '*';
                    if(row.etapa == '2') link_edit = '<?= site_url('EducacionSegundo/estudianteIng') ?>/' + row.id + '/' + row.id_ctrz;
                    if(row.etapa == '3') link_edit = '<?= site_url('EducacionTercero/pieIng') ?>/' + row.id + '/' + row.id_ctrz;
                    if(row.etapa == '4') link_edit = '<?= site_url('EducacionCuarta/profeJefesp') ?>/' + row.id + '/' + row.id_ctrz;
                    if(row.etapa == '5') link_edit = '<?= site_url('EducacionQuinto/apoderadoIng') ?>/' + row.id + '/' + row.id_ctrz;
                    
                    var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';

                    var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';

                    options_normal += edit_normal;
                    options_normal += '</div>';

                    var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
                    var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="Continuar"><span class="blue"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span></a></li>';
                    
                    options_responsive += edit_responsive;
                    options_responsive += '</ul></div></div>';

                    return options_normal + options_responsive
                }
            }
        ],
        "order": [[ 5, "desc" ]],
        "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
        }
    } );
    
    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    
    new $.fn.dataTable.Buttons( myTable, {
        buttons: [
          {
            "extend": "colvis",
            "text": "<i class='fa fa-table bigger-110 blue'></i> <span class='hidden'>Mostrar/Esconder columnas</span>",
            "className": "btn btn-white btn-primary btn-bold",
            "columns": ':not(:first):not(:last)'
          },
          {
            "extend": "copy",
            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copiar al portapapeles</span>",
            "className": "btn btn-white btn-primary btn-bold",
            "exportOptions": {
                "columns": ':visible:not(:last)'
            }
          },
          {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
            "className": "btn btn-white btn-primary btn-bold",
            "autoPrint": true,
            "message": '<h2>Centros de costo</h2>',
            "exportOptions": {
                "columns": ':visible:not(:last)'
            }
          }
        ]
    } );
    
    myTable.buttons().container().appendTo( $('.tableTools-container') );
    
    
    //style the message box
    var defaultCopyAction = myTable.button(1).action();
    myTable.button(1).action(function (e, dt, button, config) {
        defaultCopyAction(e, dt, button, config);
        $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
    });
    
    var defaultColvisAction = myTable.button(0).action();
    myTable.button(0).action(function (e, dt, button, config) {
        
        defaultColvisAction(e, dt, button, config);
                
        if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
            .find('a').attr('href', '#').wrap("<li />")
        }
        $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
    });

    ////
    setTimeout(function() {
        $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
        });
    }, 500);
    
    myTable.on( 'select', function ( e, dt, type, index ) {
        if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
        }
    } );
    myTable.on( 'deselect', function ( e, dt, type, index ) {
        if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
        }
    } );

    /////////////////////////////////
    //table checkboxes

    /********************************/
    //add tooltip for small view action buttons in dropdown menu
    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    
    //tooltip placement on right or left
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }
    
    /***************/
    $('.show-details-btn').on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });
});
</script>

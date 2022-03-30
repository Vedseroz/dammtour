<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable();
    $('#example2').DataTable();
} );

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
                "searchable": true                
            },
            {
                "title": 'Apellido Paterno',
                "data": 'apellido_p',
                "targets": 3,
                "visible": false
            },
            {
                "title": 'Apellido Materno',
                "data": 'apellido_m',
                "targets": 4,
                "visible": false
            },
            {
                "title": 'Fecha',
                "data": 'fecha',
                "searchable": false,
                "targets": 5,
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
                "targets": 6,
                "visible": true
            },
            {
                "title": 'Etapa',
                "data": 'etapa',
                "searchable": false,
                "targets": 7,
                "render": function ( data, type, row ) {
                    if(row.etapa == 2) return 'Denuncia Realizada -> Apertura';
                    if(row.etapa == 3) return 'Apertura -> Formulación de Cargo';
                    if(row.etapa == 4) return 'Formulación de Cargo -> Dictamen';
                    if(row.etapa == 5) return 'Dictamen -> Impugnación';
                    if(row.etapa == 6) return 'Impugnación -> Resolución';
                    if(row.etapa == 7) return 'Resolución Finalizada';
                }
            },
            {
                "title": 'Tipo',
                "data": 'tipo',
                "searchable": false,
                "targets": 8,
                "visible": true,
                "render": function ( data, type, row ) {
                    if(data == 1) {
                        return 'Interna';
                    }else{
                        return 'Externa';
                    }
                }
            },
            {
                "title": 'Opciones',
                "data": null,
                "targets": 9,
                "searchable": false,
                "orderable": false,
                "render": function ( data, type, row ) {
                    var link_edit = '*';
                    if(row.etapa == 2) link_edit = '<?= site_url('Proc_Educacion/EducacionPrimero/mostrar') ?>/' + row.id;
                    if(row.etapa == 3) link_edit = '<?= site_url('EduciacionTercero/Usuario1sp') ?>/' + row.id + '/' + row.id_ctrz;
                    if(row.etapa == 4) link_edit = '<?= site_url('EduciacionCuarta/Usuario1sp') ?>/' + row.id + '/' + row.id_ctrz;
                    if(row.etapa == 5) link_edit = '<?= site_url('EduciacionQuinto/Usuario1sp') ?>/' + row.id + '/' + row.id_ctrz;
                    
                    var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';
                    var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';

                    //options_normal += show_details_normal + edit_normal + remove_normal;
                    options_normal += edit_normal;
                    options_normal += '</div>';
                    
                    var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
                    var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="Editar"><span class="green"><i class="ace-icon fa fa-search-square-o bigger-120"></i></span></a></li>';
                    //options_responsive += show_details_responsive + edit_responsive + remove_responsive;
                    options_responsive += edit_responsive;
                    options_responsive += '</ul></div></div>';
                     
                    return options_normal + options_responsive;
                }
            }
        ],
        "order": [[ 5, "asc" ]],
        "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
        }
    } );

/*  var myTable2 = $('#dynamic-table2');

    function inicializarDT(){

        $('#dynamic-table2').DataTable( {
            "bAutoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('ajax/getEstudiantesDrvz') ?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "title": 'ID',
                    "data": 'id',
                    "targets": 0,
                    "searchable": false,
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
                    "title": 'Apellido P.',
                    "data": 'apellido_p',
                    "targets": 3
                },
                {
                    "title": 'Apellido M.',
                    "data": 'apellido_m',
                    "targets": 4,
                },
                {
                    "title": 'Fecha',
                    "data": 'fecha',
                    "searchable": false,
                    "targets": 5,
                    "render": function ( data, type, row ) {
                        if(data == null) {
                            return 'Sin información'
                        }
                        return data.split("-").reverse().join("-");
                    }
                },
                {
                    "title": 'Tipo',
                    "data": 'tipo',
                    "searchable": false,
                    "targets": 6,
                    "render": function ( data, type, row ) {
                                if(row.tipo == 1) return 'Habilidades/talentos';
                                if(row.tipo == 2) return 'Conductual->En espera';
                                if(row.tipo == 3) return 'Conductual->Mediación escolar';
                                if(row.tipo == 4) return 'Conductual->Red interna';
                                if(row.tipo == 5) return 'Conductual->Red externa';
                            },
                },
                {
                    "title": 'Etapa',
                    "data": 'etapa',
                    "searchable": false,
                    "targets": 7,
                    "render": function ( data, type, row ) {
                                if(row.tipo == 1){
                                    return data + ' de 2 ';
                                } else{
                                    if(row.tipo == 2){
                                        return data + ' de 3+ ';
                                    }else{
                                        if(row.tipo == 3){
                                            return data + ' de 4 ';
                                        }else{
                                            if(row.tipo == 4 || row.tipo == 5){
                                                return data + ' de 3 ';
                                            }
                                        }
                                    }
                                }
                            },
                },
                {
                    "title": 'Opciones',
                    "data": null,
                    "targets": 8,
                    "searchable": false,
                    "orderable": false,
                    "render": function ( data, type, row ) {
                        var link_edit ='*';
                        if(row.tipo == 1){
                            link_edit ='<?= site_url('derivacionA11/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
                        }
                        if(row.tipo == 2){
                            link_edit ='<?= site_url('derivacionA21/UsuarioEspera') ?>/' + row.id + '/' + row.id_drvz;
                        }
                        if(row.tipo == 3){
                            if(row.etapa == 3) link_edit ='<?= site_url('derivacionA22/Usuario1Espera') ?>/' + row.id + '/' + row. id_drvz;
                            if(row.etapa == 4) link_edit ='<?= site_url('derivacionA23/Usuario1Ing') ?>/' + row.id + '/' + row.id_drvz ;
                        }
                        if(row.tipo == 4){
                            link_edit ='<?= site_url('derivacionA31/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
                        } 
                        if(row.tipo == 5){
                            link_edit ='<?= site_url('derivacionA32/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
                        }
                        
                        var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';
                        var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-pencil   bigger-130"></i></a>';
                        
                        //options_normal += show_details_normal + edit_normal + remove_normal;
                        options_normal += edit_normal;
                        options_normal += '</div>';
                        
                        var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn   btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa  fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon     dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
                        var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip"   title="Editar"><span class="green"><i class="ace-icon fa fa-search-square-o   bigger-120"></i></span></a></li>';
                        //options_responsive += show_details_responsive + edit_responsive + remove_responsive;
                        options_responsive += edit_responsive;
                        options_responsive += '</ul></div></div>';
                         
                        return options_normal + options_responsive;
                    }
                }
            ],
            "order": [[ 5, "asc" ]],
            "language": {
                "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
            }
        } );
    };
    
  */
    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    
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
    $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
    
    //select/deselect all rows according to table header checkbox
    $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;//checkbox inside "TH" table header
        
        $('#dynamic-table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) myTable.row(row).select();
            else  myTable.row(row).deselect();
        });
    });
    
    //select/deselect a row when the checkbox is checked/unchecked
    $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
        var row = $(this).closest('tr').get(0);
        if(this.checked) myTable.row(row).deselect();
        else myTable.row(row).select();
    });

    $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
        e.stopImmediatePropagation();
        e.stopPropagation();
        e.preventDefault();
    });
    
    //And for the first simple table, which doesn't have TableTools or dataTables
    //select/deselect all rows according to table header checkbox
    var active_class = 'active';
    $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;//checkbox inside "TH" table header
        
        $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
        });
    });
    
    //select/deselect a row when the checkbox is checked/unchecked
    $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
        var $row = $(this).closest('tr');
        if($row.is('.detail-row ')) return;
        if(this.checked) $row.addClass(active_class);
        else $row.removeClass(active_class);
    });

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

    window.setTimeout(inicializarDT, 1000);
        
});

</script>

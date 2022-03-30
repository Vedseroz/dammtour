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
    //initiate dataTables plugin
    var myTable = $('#dynamic-table')
    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
    .DataTable( {
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?= site_url('Reportes_comite/procedimientos') ?>",
            "type": "POST",
            "data": { $id: '<?php echo $this->uri->segment(3);?>' }
        },
        "columnDefs": [
            {
                "title": 'ID de Procedimiento',
                "data": 'id',
                "targets": 0,
                "searchable": false,
                "visible": true,
                "render": function ( data, type, row ) {
                    return 'ID de Procedimiento: ' + data;
                }
            },
            {
                "title": 'Fecha',
                "data": 'fecha',
                "searchable": false,
                "targets": 1,
                "visible": true,
                "render": function ( data, type, row ) {
                    if(data == null) {
                        return 'Sin información'
                    }
                    return data.split("-").reverse().join("-");
                }
            },
            {
                "title": 'Reporte',
                "data": null,
                "targets": 2,
                "searchable": false,
                render: function ( data, type, row ) {
                    return  '<a href="<?= site_url('Reportes_comite/downloadcarac/')?>'+ row.id +'" type="button" class="btn btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>'
                }
            }
        ],
        "order": [[ 1, "desc" ]],
        "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
        } 
    } );

    var myTable2 = $('#dynamic-table2');

        $('#dynamic-table2')
        .DataTable( {
            "bAutoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Reportes_comite/Derivacion') ?>",
                "type": "POST",
                "data": { $id: '<?php echo $this->uri->segment(3);?>' }
            },
            "columnDefs": [
            {
                "title": 'ID',
                "data": 'id',
                "targets": 0,
                "searchable": false,
                "visible": true,
                "render": function ( data, type, row ) {
                    return 'Derivación N°: ' + data;
                }
            },
            {
                "title": 'Fecha',
                "data": 'fecha',
                "searchable": false,
                "targets": 1,
                "visible": true,
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
                "targets": 2,
                "render": function ( data, type, row ) {
                    if(row.tipo == 1) return 'Habilidades/talentos';
                    if(row.tipo == 2) return 'Conductual->En espera';
                    if(row.tipo == 3) return 'Conductual->Mediación escolar';
                    if(row.tipo == 4) return 'Conductual->Red interna';
                    if(row.tipo == 5) return 'Conductual->Red externa';
                },
            },
            {
                "title": 'Reporte',
                "data": null,
                "targets": 3,
                "searchable": false,
                render: function ( data, type, row ) {
                    return  '<a href="<?= site_url('Reportes_comite/downloadderiv/')?>'+ row.id +'" type="button" class="btn btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>'
                }
            }
        ],
        "order": [[ 1, "desc" ]],
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


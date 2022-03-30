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
	var myTable2 = $('#dynamic-table2')
	//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
	.DataTable( {
		"bAutoWidth": false,
		"processing": true,
        "serverSide": true,
		"ajax": {
            "url": "<?= site_url('Inicio/getEstudiantesDrvzOrientador') ?>",
            "type": "POST"
        },
        "columnDefs": [
            {
            	"title": 'ID',
            	"data": 'id',
            	"searchable": false,
                "targets": 0,
                "visible": false
            },
            {
            	"title": 'ID_DRVZ',
            	"data": 'id_drvz',
            	"searchable": false,
                "targets": 0,
                "visible": false
            },
            {
            	"title": 'RUT',
            	"data": 'rut',
                "targets": 1,
                "visible": true
            },
            {
            	"title": 'Nombres',
            	"data": 'nombres',
                "targets": 2,
                "visible": true
            },
            {
            	"title": 'Apellido P.',
            	"data": 'apellido_p',
                "targets": 3,
                "visible": true
            },
            {
            	"title": 'Apellido M.',
            	"data": 'apellido_m',
                "targets": 4,
                "visible": true
            },
            {
            	"title": 'Colegio',
            	"data": 'nombreColegio',
            	"searchable": false,
                "targets": 5,
                "visible": false
            },
            {
            	"title": 'Curso',
            	"data": 'codigo',
            	"searchable": false,
                "targets": 6,
                "visible": false
            },
            {
            	"title": 'Fecha',
            	"data": 'fecha',
            	"searchable": false,
                "targets": 7,
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
                "targets": 8,
                "render": function ( data, type, row ) {
                			if(row.tipo == 1){
            					if(row.estado_act == 0) return 'Habilidades/talentos';
                                if(row.estado_act == 1) return 'Habilidades/talentos (Iniciada)';
                			} else{
                				if(row.tipo == 2){
                					return 'Conductual->En espera';
                				}else {
                					if (row.tipo == 3){
                                        if(row.estado_act == 0) return 'Conductual->Mediación escolar';
                                        if(row.estado_act == 1) return 'Conductual->Mediación escolar (Iniciada)';
                					}else {
	                					if (row.tipo == 4){
	                						return 'Conductual->Red interna';
	                					} else{ 
	                						if (row.tipo == 5){
	                							return 'Conductual->Red externa';
	                						}

	                					}
	                				}
                				}
                			}
          				},
                "visible": true
            },
            {
            	"title": 'Etapa',
            	"data": 'etapa',
            	"searchable": false,
                "targets": 9,
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
                "visible": true
            },
            {
            	"title": 'Opciones',
            	"data": null,
	            "targets": 10,
	            "searchable": false,
	            "orderable": false,
	            "render": function ( data, type, row ) {
	            	//Declaracion y creacion de link para botones segun la etapa del proceso
	            	var link_edit ='*';
	            	if(row.tipo == 1){
                        if(row.estado_act == 0)	link_edit ='<?= site_url('derivacionA11/orientadorIng') ?>/' + row.id + '/' + row.id_drvz;
                        if(row.estado_act == 1) link_edit ='<?= site_url('derivacionA11/orientadorContinuar') ?>/' + row.id + '/' + row.id_drvz;
	            	}
	            	if(row.tipo == 2){
	            		link_edit ='<?= site_url('derivacionA21/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
	            	}
	            	if(row.tipo == 3){
	            		if(row.etapa == 3) {
                            if(row.estado_act == 0) link_edit ='<?= site_url('derivacionA22/orientadorIng') ?>/' + row.id + '/' + row.id_drvz;
                            if(row.estado_act == 1) link_edit ='<?= site_url('derivacionA22/orientadorContinuar') ?>/' + row.id + '/' + row.id_drvz;
                        }
	            		if(row.etapa == 4) link_edit ='<?= site_url('derivacionA23/Usuario1Ing') ?>/' + row.id + '/' + row.id_drvz;
	            	}
	            	if(row.tipo == 4){
	            		link_edit ='<?= site_url('derivacionA31/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
	            	} 
	            	if(row.tipo == 5){
	            		link_edit ='<?= site_url('derivacionA32/Usuario1Espera') ?>/' + row.id + '/' + row.id_drvz;
	            	}

 	
	            	var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';

	            	var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';

	            	options_normal += edit_normal;
	            	options_normal += '</div>';

	            	var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
					var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="Continuar"><span class="blue"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span></a></li>';
					
					options_responsive += edit_responsive;
					options_responsive += '</ul></div></div>';

					return options_normal;              		              		
                }
        	}
        ],
        "order": [[ 7, "desc" ]],
		"language": {
        	"url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
    	}
    } );

	$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
		
	new $.fn.dataTable.Buttons( myTable2, {
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

	myTable2.buttons().container().appendTo( $('.tableTools-container') );

	var defaultCopyAction = myTable2.button(1).action();
	myTable2.button(1).action(function (e, dt, button, config) {
		defaultCopyAction(e, dt, button, config);
		$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
	});

	var defaultColvisAction = myTable2.button(0).action();
	myTable2.button(0).action(function (e, dt, button, config) {
    	defaultColvisAction(e, dt, button, config);
    	if($('.dt-button-collection > .dropdown-menu').length == 0) {
        	$('.dt-button-collection')
        	.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
        	.find('a').attr('href', '#').wrap("<li />")
        }
    	$ ('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')	
	});

	setTimeout(function() {
		$($('.tableTools-container')).find('a.dt-button').each(function() {
			    var div = $(this).find(' > div').first();
				if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
				else $(this).tooltip({container: 'body', title: $(this).text()});
			});
	}, 500);

	myTable2.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTable2.row( index ).node() ).find('input:checkbox').prop('checked', true);
			}
	} );
	myTable2.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTable2.row( index ).node() ).find('input:checkbox').prop('checked', false);
		}
	} );
		
    $(document).on('click', '#dynamic-table2 .dropdown-toggle', function(e) {
        e.stopImmediatePropagation();
        e.stopPropagation();
        e.preventDefault();
    });

    var active_class = 'active';
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
    $('.show-details-btn').on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });
});
</script>

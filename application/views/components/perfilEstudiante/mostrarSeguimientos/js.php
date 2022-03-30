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
            "url": "<?= site_url('/perfilEstudiante/getprocedimientos') ?>/" + <?= $estudiante[0]->id?>,
            "type": "POST",
        },
        "columnDefs": [
            {
            	"title": 'ID',
            	"data": 'id',
                "targets": 0,
                "visible": false
            },
            {
            	"title": 'Fecha',
            	"data": 'fecha',
                "targets": 1,
                "visible": true
            },
            {
            	"title": 'Estado',
            	"data": 'estado',
                "targets": 2,
                "visible": true
            },
            {
            	"title": 'Opciones',
            	"data": null,
	            "targets": 3,
	            "searchable": false,
	            "orderable": false,
	            "render": function ( data, type, row ) {
	            	//Declaracion y creacion de link para botones segun la etapa del proceso

	            	var link_edit = '<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id) ?>/' + row.id + '/' + 1;

	            	var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';

	            	var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-search bigger-130"></i></a>';

	            	options_normal += edit_normal;
	            	options_normal += '</div>';

	            	var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
					var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="Continuar"><span class="blue"><i class="ace-icon fa fa-search-square-o bigger-120"></i></span></a></li>';
					
					options_responsive += edit_responsive;
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
	
	$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

	////
	setTimeout(function() {
		$($('.tableTools-container')).find('a.dt-button').each(function() {
			var div = $(this).find(' > div').first();
			if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
			else $(this).tooltip({container: 'body', title: $(this).text()});
		});
	}, 500);
	



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
	



//initiate dataTables plugin
	var myTable = $('#dynamic-table2')
	//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
	.DataTable( {
		"bAutoWidth": false,
		"processing": true,
        "serverSide": true,
		"ajax": {
            "url": "<?= site_url('perfilEstudiante/getDerivaciones/') ?>" + <?= $estudiante[0]->id?>,
            "type": "POST"
        },
        "columnDefs": [
            {
            	"title": 'ID',
            	"data": 'id',
                "targets": 0,
                "visible": false
            },
            {
            	"title": 'Fecha',
            	"data": 'fecha',
                "targets": 1,
                "visible": true
            },
            {
            	"title": 'Tipo',
            	"data": 'tipo',
                "targets": 2,
                "visible": true,
                "render": function ( data, type, row ) {
                			if(row.tipo == 1){
            					return 'Habilidades/talentos';
                			} else{
                				if(row.tipo == 2){
                					return 'Conductual->En espera';
                				}else {
                					if (row.tipo == 3){
                						return 'Conductual->Mediación escolar';
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
            },
            {
            	"title": 'Estado',
            	"data": 'estado',
                "targets": 3,
                "visible": true
            },
            {
            	"title": 'Opciones',
            	"data": null,
	            "targets": 4,
	            "searchable": false,
	            "orderable": false,
	            "render": function ( data, type, row ) {
	            	//Declaracion y creacion de link para botones segun la etapa del proceso

	            	var link_edit = '*';
	            	if(row.tipo == 1){
	            		link_edit ='<?= site_url('PerfilEstudiante/mostrarDerivacion/'. $estudiante[0]->id ) ?>/' + row.id + '/' + row.tipo;
	            	}
	            	if(row.tipo == 2){
	            		link_edit ='<?= site_url('PerfilEstudiante/mostrarDerivacion/'. $estudiante[0]->id ) ?>/' + row.id+'/' + row.tipo;
	            	}
	            	if(row.tipo == 3){
	            		link_edit ='<?= site_url('PerfilEstudiante/mostrarDerivacion/'. $estudiante[0]->id ) ?>/'+ row.id+'/' + row.tipo;
	            	}
	            	if(row.tipo == 4){
	            		link_edit ='<?= site_url('PerfilEstudiante/mostrarDerivacion/'. $estudiante[0]->id ) ?>/'+ row.id+'/' + row.tipo;
	            	} 
	            	if(row.tipo == 5){
	            		link_edit ='<?= site_url('PerfilEstudiante/mostrarDerivacion/'. $estudiante[0]->id ) ?>/'+ row.id+'/' + row.tipo;
	            	}

	            	var options_normal = '<div class="hidden-sm hidden-xs action-buttons">';

	            	var edit_normal = '<a class="blue" href="' + link_edit + '" title="Continuar"><i class="ace-icon fa fa-search bigger-130"></i></a>';

	            	options_normal += edit_normal;
	            	options_normal += '</div>';

	            	var options_responsive = '<div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
					var edit_responsive = '<li><a href="' + link_edit + '" class="tooltip-success" data-rel="tooltip" title="Continuar"><span class="blue"><i class="ace-icon fa fa-search-square-o bigger-120"></i></span></a></li>';
					
					options_responsive += edit_responsive;
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

	
});

</script>
<script>
	$(document).ready(function() {
		
		$('[data-rel=popover]').popover({container:'body'});

		$('#id-input-file').ace_file_input({
			no_file: 'Sin archivos ...',
			btn_choose: 'Seleccionar',
			btn_change: 'Cambiar',
			uploadMultiple: true,
			parallelUploads: 10,
			droppable: true,
			//whitelist:'xlxs'
			//blacklist:'exe|php'
			//onchange:''
			//
		})
		
	});


</script>

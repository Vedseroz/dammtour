<script src="<?= base_url('assets/js/jquery.maskedinput.min.js') ?>"></script>
<script src="<?= base_url('assets/js/chosen.jquery.min.js') ?>"></script>
<script type="text/javascript">

$(document).ready(function() { 

	var cSelect = '<?php echo $cursosSelect; ?>';
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});
	$('.input-mask-phone').mask('(+56) 9 9999-9999');


	$('#colegiosselect').chosen({});

	if(!ace.vars['touch']) {
		$('.chosen-select')
		.chosen({allow_single_deselect:true})
		.change((event) => {
			var name = event.currentTarget.name;
			var value = event.currentTarget.value;
			if(name == 'colegiosselect') {
				$('#cursosselect').children('option:not(:first)').remove();
				if(value == '') {
					$('#cursosselect').trigger("chosen:updated");
				} else {
				    $.ajax({
						url: '<?= site_url('administrador/ajaxGetCursos') ?>/' + encodeURI(value),
						type: 'get',				
						dataType: 'json',
						success: function(respuesta) {
							if(respuesta.type == 'Successful' && respuesta.data) {
								$.each(respuesta.data, function(key, value) {

											$('#cursosselect')
							         		.append($("<option></option>")
							         		.attr("value", value.id)
							         		.text(value.nombre +" - "+ value.fecha));

								});
							} else {
								$('#cursosselect').children('option:not(:first)').remove();
							}
							$('#cursosselect').trigger("chosen:updated");
						}, // /succes
						error: function (jqXHR, textStatus, errorThrown)
				    	{
							console.log('Error');
					    } // /error
					}); // /ajax
				}
			}
		}); 
		//resize the chosen on window resize

		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if(event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		});
	}
	
});

</script>
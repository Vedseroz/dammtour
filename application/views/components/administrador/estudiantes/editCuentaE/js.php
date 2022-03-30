<script src="<?= base_url('assets/js/jquery.maskedinput.min.js') ?>"></script>
<script src="<?= base_url('assets/js/chosen.jquery.min.js') ?>"></script>
<script type="text/javascript">

$(document).ready(function() { 

	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});
	$('.input-mask-phone').mask('(+56) 9 9999-9999');


	$('#colegiosselect').chosen({});
	
});

</script>
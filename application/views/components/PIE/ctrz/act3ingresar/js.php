<script>
$('[data-rel=popover]').popover({container:'body'});
$('#agregar').click(function() {
		$("#baseclone").clone(true).appendTo("#contenedor").find("input").val('');
	});

$('#eliminar').click(function() {
		$(this).parent('div').remove();
	});
</script>

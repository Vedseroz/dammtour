<script>
$('[data-rel=popover]').popover({container:'body'});
$('#input-file').ace_file_input({
			no_file: 'Sin archivo seleccionado ...',
			btn_choose: 'Seleccionar',
			btn_change: 'Cambiar',
			droppable: true, //arrastrar y soltar
			onchange: null,
			thumbnail: false, //| true | large
			//whitelist:'xlxs'
			//blacklist:'exe|php'
			//onchange:''
			//
		});

$('#input-file2').ace_file_input({
			no_file: 'Sin archivo seleccionado ...',
			btn_choose: 'Seleccionar',
			btn_change: 'Cambiar',
			droppable: true,
			onchange: null,
			thumbnail: false, //| true | large
			//whitelist:'xlxs'
			//blacklist:'exe|php'
			//onchange:''
			//
		});

$("tr").on("mousedown", ":radio", function(){
  var $self = $(this);
  if( $self.is(':checked') ){
    var uncheck = function(){
      setTimeout(function(){$self.removeAttr('checked');},0);
    };
    var unbind = function(){
      $self.unbind('mouseup',up);
    };
    var up = function(){
      uncheck();
      unbind();
    };
    $self.bind('mouseup',up);
    $self.one('mouseout', unbind);
  }
});

</script>
<script src="<?= base_url('assets/js/ace-elements.min.js') ?>"></script>
<script src="<?= base_url('assets/js/ace.min.js') ?>"></script>
<script src="<?= base_url('assets/js/spinbox.min.js') ?>"></script>

<script src="<?= base_url('assets/js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/js/utils.js') ?>"></script>
<script src="<?= base_url('assets/js/bootbox.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.gritter.min.js') ?>"></script>

<script>

var variablePHP = '<?php echo $estudiante[0]->id; ?>';
var sizeLabel = '<?php echo $labelSize; ?>';


$("#bootbox-confirm").on(ace.click_event, function() {
	var materiaId = document.getElementById('form-field-select-1').value;
	var nota = document.getElementById('spinner3').value;
	var materiaNombre = '';
	var variablePHP = '<?php echo $estudiante[0]->id; ?>';
	switch (materiaId) {
		case '1':
			materiaNombre = 'Historia';
			break;
		case '2':
			materiaNombre = 'Ciencias';
			break;
		case '3':
			materiaNombre = 'Ingles';
			break;
		case '4':
			materiaNombre = 'Lenguaje';
			break;
		case '5':
			materiaNombre = 'Matematicas';
			break;
		default:
			materiaNombre = '0';
			break;
	}
	if( 0 == parseInt(materiaId)){
		$.gritter.add({
			title: 'Asignación de materia',
			text: 'Se requiere la selección de una materia para ingresar la nota',
			class_name: 'gritter-error',
			time: 2000,
		});

	}	else{
			//TO-DO: Controlar cuando se trate de insertar un 0
			bootbox.confirm('<div="row"><h3 class="header smaller lighter green">Confirmar calificación</h3></div><div="row"><h4>'+materiaNombre+': '+nota+'</h4></div>', function(result) {
				if(result) {

					$.post("<?= site_url('PerfilEstudiante/ajaxIngresarNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : materiaId, 'nota' : nota}, function (data){
						//TO-DO: controlar errores.
					});
					$.gritter.add({
								title: 'Nota ingresada',
								text: 'Su nota fue ingresada',
								class_name: 'gritter-success',
								time: 2000,
							});
					var month = MONTHS[config.data.labels.length % MONTHS.length];
					config.data.datasets.forEach(function(dataset) {
						if(dataset.label == materiaNombre){
							dataset.data.push(nota);
							if(dataset.data.length >= config.data.labels.length) config.data.labels.push(month);
						} 
							
					});
					window.myLine.update();

				}
			});
		}
});

$('#spinner3').ace_spinner({value:0,min:0,max:70,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});

var defaultNotas = JSON.parse('<?php echo $notas; ?>');
var defaultLenght = 0;
for (var index = 0; index < defaultNotas.length; ++index) {
	if(defaultNotas[index].length > defaultLenght ) defaultLenght = defaultNotas[index].length;
}	

var MONTHS = ['1° Prueba', '2° Prueba', '3° Prueba', '4° Prueba', '5° Prueba', '6° Prueba', '7° Prueba', '8° Prueba', '9° Prueba', '10° Prueba', '11° Prueba', '12° Prueba', '13° Prueba', '14° Prueba', '15° Prueba', '16° Prueba', '17° Prueba', '18° Prueba'];
var config = {
	type: 'line',
	data: {
		labels: MONTHS.slice(0, defaultLenght + 1),
		datasets: [{
			label: 'Lenguaje',
			backgroundColor: window.chartColors.green,
			borderColor: window.chartColors.green,
			data: defaultNotas[0],
			fill: false,
		}, {
			label: 'Matematicas',
			fill: false,
			backgroundColor: window.chartColors.blue,
			borderColor: window.chartColors.blue,
			data: defaultNotas[1],
		}]
	},
	options: {
		responsive: true,
		title: {
			display: true,
			text: 'Notas anuales'
		},
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: false,
					labelString: 'Month'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Nota'
				},
				ticks: {
					min : 0,
					max : 70
				}
			}]
		}
	}
};

window.onload = function() {
	var ctx = document.getElementById('myChart').getContext('2d');
	window.myLine = new Chart(ctx, config);
};


var colorNames = Object.keys(window.chartColors);

document.getElementById('1').addEventListener('click', function() {
	var button = document.getElementById('1');
	var mate = 1;
    var std = button.getAttribute('data-std');
	button.classList.remove('btn-default');
	button.classList.add('btn-info');

	if(std == 0) {
		$.post("<?= site_url('PerfilEstudiante/ajaxNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : mate, 'std' : std},
			function (data){
				columnsAdd = 0;
				valoresData = JSON.parse(data);
				var colorName = window.chartColors.red;
				var newColor = window.chartColors.red;
				var newDataset = {
					label: 'Historia',
					backgroundColor: newColor,
					borderColor: newColor,
					data: valoresData,
					fill: false
				};
				config.data.datasets.push(newDataset);
				button.setAttribute('data-std', '1');
				if(config.data.labels.length < valoresData.length )
					columnsAdd = valoresData.length - config.data.labels.length + 1;
				
				for (var index = 0; index < columnsAdd; ++index){
					var month = MONTHS[config.data.labels.length];
					config.data.labels.push(month);
				}

				window.myLine.update();
		    }
		);
	} 	else{
			button.classList.remove('btn-info');
			button.classList.add('btn-default');
			button.setAttribute('data-std', '0');
			for (var index = 0; index < config.data.datasets.length; ++index) {
				if(config.data.datasets[index].label == 'Historia' ) config.data.datasets.splice(index, 1);
			}			
			window.myLine.update();
		}	
});

document.getElementById('2').addEventListener('click', function() {
	var button = document.getElementById('2');
	var mate = 2;
    var std = button.getAttribute('data-std');
	var variablePHP = '<?php echo $estudiante[0]->id; ?>';
	button.classList.remove('btn-default');
	button.classList.add('btn-info');

	if(std == 0) {
		$.post("<?= site_url('PerfilEstudiante/ajaxNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : mate, 'std' : std},
			function (data){
				columnsAdd = 0;
				valoresData = JSON.parse(data);
				var colorName = window.chartColors.yellow;
				var newColor = window.chartColors.yellow;
				var newDataset = {
					label: 'Ciencias',
					backgroundColor: newColor,
					borderColor: newColor,
					data: valoresData,
					fill: false
				};
				config.data.datasets.push(newDataset);
				button.setAttribute('data-std', '1');
				if(config.data.labels.length < valoresData.length )
					columnsAdd = valoresData.length - config.data.labels.length + 1;
				
				for (var index = 0; index < columnsAdd; ++index){
					var month = MONTHS[config.data.labels.length];
					config.data.labels.push(month);
				}
				window.myLine.update();
		    }
		);
	} 	else{
			button.classList.remove('btn-info');
			button.classList.add('btn-default');
			button.setAttribute('data-std', '0');
			for (var index = 0; index < config.data.datasets.length; ++index) {
				if(config.data.datasets[index].label == 'Ciencias' ) config.data.datasets.splice(index, 1);
			}			
			window.myLine.update();
		}	
});

document.getElementById('3').addEventListener('click', function() {
	var button = document.getElementById('3');
	var mate = 3;
    var std = button.getAttribute('data-std');
	var variablePHP = '<?php echo $estudiante[0]->id; ?>';
	button.classList.remove('btn-default');
	button.classList.add('btn-info');

	if(std == 0) {
		$.post("<?= site_url('PerfilEstudiante/ajaxNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : mate, 'std' : std},
			function (data){
				columnsAdd = 0;
				valoresData = JSON.parse(data);
				var colorName = window.chartColors.cian;
				var newColor = window.chartColors.cian;
				var newDataset = {
					label: 'Ingles',
					backgroundColor: newColor,
					borderColor: newColor,
					data: valoresData,
					fill: false
				};
				config.data.datasets.push(newDataset);
				button.setAttribute('data-std', '1');
				if(config.data.labels.length < valoresData.length )
					columnsAdd = valoresData.length - config.data.labels.length + 1;
				
				for (var index = 0; index < columnsAdd; ++index){
					var month = MONTHS[config.data.labels.length];
					config.data.labels.push(month);
				}
				window.myLine.update();
		    }
		);
	} 	else{
			button.classList.remove('btn-info');
			button.classList.add('btn-default');
			button.setAttribute('data-std', '0');
			for (var index = 0; index < config.data.datasets.length; ++index) {
				if(config.data.datasets[index].label == 'Ingles' ) config.data.datasets.splice(index, 1);
			}			
			window.myLine.update();
		}	
});

document.getElementById('4').addEventListener('click', function() {
	var button = document.getElementById('4');
	var mate = 4;
    var std = button.getAttribute('data-std');
	var variablePHP = '<?php echo $estudiante[0]->id; ?>';
	button.classList.remove('btn-default');
	button.classList.add('btn-info');

	if(std == 0) {
		$.post("<?= site_url('PerfilEstudiante/ajaxNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : mate, 'std' : std},
			function (data){
				columnsAdd = 0;
				valoresData = JSON.parse(data);
				var colorName = window.chartColors.green;
				var newColor = window.chartColors.green;
				var newDataset = {
					label: 'Lenguaje',
					backgroundColor: newColor,
					borderColor: newColor,
					data: valoresData,
					fill: false
				};
				config.data.datasets.push(newDataset);
				button.setAttribute('data-std', '1');
				if(config.data.labels.length < valoresData.length )
					columnsAdd = valoresData.length - config.data.labels.length + 1;
				
				for (var index = 0; index < columnsAdd; ++index){
					var month = MONTHS[config.data.labels.length];
					config.data.labels.push(month);
				}
				window.myLine.update();
		    }
		);
	} 	else{
			button.classList.remove('btn-info');
			button.classList.add('btn-default');
			button.setAttribute('data-std', '0');
			for (var index = 0; index < config.data.datasets.length; ++index) {
				if(config.data.datasets[index].label == 'Lenguaje' ) config.data.datasets.splice(index, 1);
			}			
			window.myLine.update();
		}	
});

document.getElementById('5').addEventListener('click', function() {
	var button = document.getElementById('5');
	var mate = 5;
    var std = button.getAttribute('data-std');
	var variablePHP = '<?php echo $estudiante[0]->id; ?>';
	button.classList.remove('btn-default');
	button.classList.add('btn-info');

	if(std == 0) {
		$.post("<?= site_url('PerfilEstudiante/ajaxNotas' ) ?>",{'id_estudiante' : variablePHP, 'materia' : mate, 'std' : std},
			function (data){
				columnsAdd = 0;
				valoresData = JSON.parse(data);
				var colorName = window.chartColors.blue;
				var newColor = window.chartColors.blue;
				var newDataset = {
					label: 'Matematicas',
					backgroundColor: newColor,
					borderColor: newColor,
					data: valoresData,
					fill: false
				};
				config.data.datasets.push(newDataset);
				button.setAttribute('data-std', '1');
				if(config.data.labels.length < valoresData.length )
					columnsAdd = valoresData.length - config.data.labels.length + 1;
				
				for (var index = 0; index < columnsAdd; ++index){
					var month = MONTHS[config.data.labels.length];
					config.data.labels.push(month);
				}
				window.myLine.update();
		    }
		);
	} 	else{
			button.classList.remove('btn-info');
			button.classList.add('btn-default');
			button.setAttribute('data-std', '0');
			for (var index = 0; index < config.data.datasets.length; ++index) {
				if(config.data.datasets[index].label == 'Matematicas' ) config.data.datasets.splice(index, 1);
			}			
			window.myLine.update();
		}	
});

document.getElementById('removeData').addEventListener('click', function() {
	config.data.labels.splice(-1, 1); // remove the label first
	config.data.datasets.forEach(function(dataset) {
		dataset.data.pop();
	});
	window.myLine.update();
});
</script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/js/Chart.min.js') ?>"></script>

<script>
var variablePHP = '<?php echo $estudiante[0]->id; ?>';
$.post("<?= site_url('PerfilEstudiante/getNumeroSeguimientos' ) ?>",{'id_estudiante' : variablePHP},
	function (data){
		valoresData = JSON.parse(data);
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: ["Procedimientos", "Habilidad/talento", "Mediacion escolar", "Red Interna", "Red externa"],
		        datasets: [{
		            label: 'Numero de seguimientos',
		            data: valoresData,
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.4)',
		                'rgba(54, 162, 235, 0.4)',
		                'rgba(255, 206, 86, 0.4)',
		                'rgba(47, 192, 30, 0.4)',
		                'rgba(153, 102, 255, 0.4)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(41, 184, 24, 1)',
		                'rgba(153, 102, 255, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});

    }
);




</script>

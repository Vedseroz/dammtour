<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>




<script>
    $(document).ready(function(){
        var myTable = $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable({
            "bAutoWidth":false,
            "processing":true,
            "ajax":{
                "url": "<?= site_url('Chofer/getDatosChofer'); ?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "title":'Nombre Chofer',
                    "data":'nombre_chofer',
                    "targets":0,
                    "searchable":true,
                    "visible":true
                },
                {
                    "title": 'Apellido Chofer',
                    "data": 'apellido_chofer',
                    "targets": 1,
                    "searchable": false,
                    "visible": true
                },
                {
                    "title": 'Rut',
                    "data": 'rut',
                    "targets": 2,
                    "searchable": true,
                    "visible":true               
                },

            ],
            "order":[[0,"desc"]],
            "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
            }
        })
    });
    
</script>







<!--=========================================================================CSS===============================================================================-->
<style>
.no-click {
    pointer-events: none;
}
</style>
<style>
    .contenedor {
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .cuadro {
        border: 1.5px solid #ddd;
        border-radius: 150px;
        width: 200px;
        height: 200px;
        box-shadow: 0px 1px 10px #ccc;
        transition: 0.6s;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .cuadro:hover {
        box-shadow: 0px 5px 10px #999;
        border-radius: 200px;
    }
    
    .cuadro img {
        width: 65%;
        transition: 0.5s;
        position: absolute;
    }
    
    .cuadro:hover > img {
        transform: scale(0);
        opacity: 0;
    }
    
    .cuadro label {    
        margin-left: -30rem;
        position: absolute;
        transition: 0.5s;
        font-family: 'Work Sans', sans-serif;
        font-size: 25px;
        font-weight: bold;
        color: white;
    }
    
    .cuadro:hover > label {    
      	margin-left: 0px;
    }
    /*SI SE CREA UN NUEVO BOTON, ASIGNAR EL COLOR AL BOTÓN Y CARACTERÍSTICAS RELATIVAS A ESTE*/
    .uno:hover {
        background: #3F51B5;
        border-color: #3F51B5;
    }
    
    .dos:hover {
        background: #FA1010;
        border-color: #FA1010;
    }
     
    .tres:hover {
        background: #FB7702;
        border-color: #FB7702;
    } 
      
    .cuatro:hover {
        background: #31E8F7;
        border-color: #31E8F7;
        text-align: center;
    } 
     
    .cinco:hover {
        background: #409A3C;
        border-color: #409A3C;
    }
    
    .grid-parent {
		display: flex;
		justify-content: space-evenly;
	}
	/*Para que los tab-content con noticias, cumpleaños, feriados, etc...
	tengan el mismo tamaño*/
	.tab-content{
		height: 380px;
	}
	/*Estilo de la tabla feriados*/
	.table-wrapper{
		overflow-y: scroll;
		height: 320px;
	}
	
	.table-wrapper th{
		position: sticky;
		top: 0;
	}
	
	table{
		border-collapse: collapse;
		width: 100%;
	}
	
	th{
		background: repeat-x #F2F2F2;
		background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%)
	}
	
	td,th{
		padding: 10px;
		text-align: center;
	}
	/*Tamaño, color y bordes  en las noticias*/
	.tab-pane{
		overflow-y: scroll;
		overflow-x: hidden;
		max-height: 340px;
		width     : 100%;
	}
	.card {
		border: 1px solid #ccc;
		background-color: #FFFFFF;
		padding-left: 12px;
	}
	.card-header{
		background: repeat-x #f7f7f7;
		background-image: linear-gradient(to bottom,#FFF 0,#EEE 100%);
		color: #669FC7;
	}
    #asignarbutton {
        color:transparent;
        background-color:transparent;
        border-color:transparent;
    }
</style>

<!-- ====================================================================HTML============================================================================================-->
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover"></table>
        </div>
    
    </div>
</div> 

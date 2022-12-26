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
                "url": "<?= site_url('Transfer/getDatosVoucher/'.$this->uri->segment(3)); ?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "title":'Fecha',
                    "data":'fecha',
                    "targets":0,
                    "searchable":true,
                    "visible":true
                },
                {
                    "title": 'Origen',
                    "data": 'origen',
                    "targets": 1,
                    "searchable": true,
                    "visible": true
                },
                {
                    "title": 'Hora Inicio',
                    "data": 'hora_inicio',
                    "targets": 2,
                    "visible":true               
                },
                {
                    "title": 'Destino',
                    "data": 'destino',
                    "targets": 3,
                    "searchable": true,
                    "visible":true
                },
                {
                    "title": 'Hora Finalizacion',
                    "data": 'hora_finalizacion',
                    "targets": 4,
                    "searchable": false,
                    "visible":true
                },
                {
                    "title": 'Detalles',
                    "data": 'detalles',
                    "targets": 5,
                    "searchable": false,
                    "visible":true

                },
                {
                "title": 'Opciones',
                "data": null,
                "targets": 6,
                "searchable": false,
                "orderable": false,
                "render": function(data,type,row,meta){
                    
                    var link = '<?php echo site_url('Transfer/editarEvento/'); ?>' + row.id_voucher;
                    
                    return '<a class="btn btn-primary rounded-pill" href="'+link+'"><i class="fa fa-edit"></i></a>'
                    + '<a onclick="return confirm_modal('+row.id_pasajero+');" type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#exampleModal" id = "'+row.id+'"><i class="fa fa-times" aria-hidden="true"></i></a>'

                    }
                },  

            ],
            "order":[[0,"desc"]],
            "language": {
            "url": "<?= base_url('assets/js/dataTable.spanish.json') ?>"
            }
        })
    });
    

    function confirm_modal(id){
        console.log(id);
        var url='<?php echo site_url('Transfer/eliminarEvento/')?>';
        var new_url = url+id;
        //$("url-delete").attr("href",new_url);
        jQuery('#exampleModal').modal('show',{backdrop : 'static'});
        var link = document.getElementById('url-delete');
        link.href = new_url;
    }
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

<!--Modal-->
<div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alerta:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--CONENIDO DEL MODAL, AQUI VA EL FORMULARIO-->  
        <h4>¿Está seguro que quiere eliminar a este evento?</h4>
      </div>

      <!--Este es el pie del modal aqui puedes agregar mas botones-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="url-delete" name="url-delete" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times">&nbsp;</i>Eliminar</a>
      </div>
    </div>
  </div>
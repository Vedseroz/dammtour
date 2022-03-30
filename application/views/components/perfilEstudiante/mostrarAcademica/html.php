<?= $components->infoBasica ?>

<?= $components->menuPE ?>

<div class="linea-separadora">
    <div class="col-sm-12">
         <hr size="8px" color="black" />
    </div>
</div>
<div class="row">
	<label for="form-field-select-2">Buscar por curso:</label>
	
	<div class="input-group col-xs-4">
		<select class="form-control" id="selectCurso">
			<option value="" ></option>
            <?php foreach($cursos as $key => $value): ?>
            <option value="<?= $value->id_curso ?>" ><?= $value->nombre ?></option>
            <?php endforeach; ?>
		</select>
		<span class="input-group-btn">
			<button type="button" class="btn btn-purple btn-sm">
				<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
				Mostrar
			</button>
		</span>
	</div>
</div>



<div class="row">
	<h3 class="header smaller lighter green">Registro de calificaciones</h3>
	 <div class="col-xs-10">
		<canvas id="myChart"  height="100" aria-label="Hello ARIA World" role="img"></canvas>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<br>
				<h3 class="header smaller lighter green">Registrar una calificación</h3>
			<br>
				<input type="text" id="spinner3" />
				<div class="space-6"></div>
			<br>
				<label for="form-field-select-2">Asignatura:</label>

				<select class="form-control" id="form-field-select-1">
					<option value="0"></option>
					<option value="5">Matematicas</option>
					<option value="4">Lenguaje</option>
					<option value="1">Historia</option>
					<option value="2">Ciencias</option>
					<option value="3">Ingles</option>
				</select>
			<br>
		</div>  
		<div class="row">
			<button class="btn btn-info" id="bootbox-confirm">Registrar</button>
		</div> 
	</div>  
</div>  

<br>
<br>

<button class="btn btn-info" id="4" data-std="1" > Lenguaje </button>
<button class="btn btn-info" id="5" data-std="1" > Matematicas </button>
<button class="btn btn-default" id="1" data-std="0" > Historia </button>
<button class="btn btn-default" id="2" data-std="0" > Ciencias </button>
<button class="btn btn-default" id="3" data-std="0" > Ingles </button>
<div class="row">



    
</div>  
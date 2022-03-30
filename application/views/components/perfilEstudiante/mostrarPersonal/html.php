<?= $components->infoBasica ?>

<?= $components->menuPE ?>

<div class="linea-separadora">
    <div class="col-sm-12">
         <hr size="8px" color="black" />
    </div>
</div>

<div class="row">
    <label class="control-label no-padding-right"><b>Información basica </b></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Nombre:</label>
    <label class="col-md-2 control-label"><?php echo $estudiante[0]->nombres ?>&nbsp<?php echo $estudiante[0]->apellido_p ?>&nbsp<?php echo $estudiante[0]->apellido_m ?>  </label>    
</div>

<div class="row">
    <label class="col-md-2 control-label">RUT:</label>
    <label class="col-md-2 control-label"><?php echo $estudiante[0]->rut ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Fecha nacimiento:</label>
    <label class="col-md-2 control-label"><?php echo $estudiante[0]->nacimiento ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Dirección:</label>
    <label class="col-md-2 control-label"><?php echo $estudiante[0]->direccion ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Apoderado tutor:</label>
    <label class="col-md-2 control-label"><?php if(empty($estudiante[0]->apoderado)) echo 'Sin información'; else echo $estudiante[0]->apoderado; ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Apoderado suplente:</label>
    <label class="col-md-2 control-label"><?php empty($estudiante[0]->apoderado_s) ? print('Sin información') : print($estudiante[0]->apoderado_s) ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Enfermedades:</label>
    <label class="col-md-2 control-label"><?php empty($estudiante[0]->enfermedades) ? print('Sin información') : print($estudiante[0]->enfermedades) ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Alergias:</label>
    <label class="col-md-2 control-label"><?php empty($estudiante[0]->alergias) ? print('Sin información') :  print($estudiante[0]->alergias) ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Cesfam:</label>
    <label class="col-md-2 control-label"><?php empty($estudiante[0]->cesfam) ? print('Sin información') : print($estudiante[0]->cesfam) ?></label>
</div>

<div class="row linea-separadora">
        <div class="col-lg-12">
            <hr size="8px" color="black" />
        </div>
</div>

<div class="row">
    <label class="control-label no-padding-right"><b>Información Familiar </b></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Padre:</label>
    <label class="col-md-2 control-label"><?php empty($info_familiar[0]->padre ) ? print('Sin información') : print($info_familiar[0]->padre) ?></label>
</div>

<div class="row">
    <label class="col-md-2 control-label">Madre:</label>
    <label class="col-md-2 control-label"><?php empty($info_familiar[0]->madre) ?  print('Sin información') : print($info_familiar[0]->madre) ?></label>
</div>

    <?php 
        if(!empty($hermanos)){
            foreach ($hermanos as $hermano) {
                echo
                    '<div class="row">
                        <label class="col-md-2 control-label">Hermano :</label>
                        <label class="col-md-2 control-label">'.$hermano->nombre.'</label>
                    </div>';
            }
        }else 
            echo '<div class="row">
                    <label class="col-md-2 control-label">Hermano :</label>
                    <label class="col-md-2 control-label">Sin información</label>
                 </div>';
    ?>





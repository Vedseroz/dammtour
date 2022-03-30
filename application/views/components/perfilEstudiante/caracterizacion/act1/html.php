<?= $components->infoBasica ?>

<?= $components->menuPE ?>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<?= $components->menuDPE ?>

<div class="col-xs-12">
    <div class="row form-horizontal">
        <div class="form-group">
            <h1>Información Básica del estudiante </h1>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="nombres">Nombre:</label>
            <input name="nombres" data-rel="tooltip" readonly="readonly" type="text" id="nombres" class="col-md-2" value="<?= set_value('nombres', $estudiante[0]->nombres) ?>">
            <label class="col-md-2 control-label" for="rut">RUT: </label>
            <input name="rut" data-rel="tooltip" readonly="readonly" type="text" id="rut" class="col-md-2" value="<?= set_value('rut', $estudiante[0]->rut) ?>">
        </div>            

        <div class="form-group">
            <label class="col-md-2 control-label" for="nacimiento">Fecha nacimiento:</label>
            <input name="nacimiento" data-rel="tooltip" readonly="readonly" type="date" id="nacimiento" placeholder="" class="col-md-2" value="<?= set_value('nacimiento', $estudiante[0]->nacimiento) ?>">
            <label class="col-md-2 control-label" for="direccion"> Dirección: </label>
            <input name="direccion" readonly="readonly" data-rel="tooltip" type="text" id="direccion" placeholder="Dirección" class="col-md-2" value="<?= set_value('direccion', $estudiante[0]->direccion) ?>">
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="apoderado"> Apoderado Tutor: </label>
            <input name="apoderado" data-rel="tooltip" readonly="readonly" type="text" id="apoderado" placeholder="Apoderado tutor" class="col-md-2" value="<?= set_value('apoderado', $estudiante[0]->apoderado) ?>">
            <label class="col-md-2 control-label"  for="suplente"> Apoderado Suplente: </label>
            <input name="suplente" maxlength="255" readonly="readonly" data-rel="tooltip" type="text" id="suplente" placeholder="Apoderado Suplente" class="col-md-2" value="<?= set_value('suplente', $estudiante[0]->apoderado_s) ?>">
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="cesfam">Cesfam:</label>
            <input name="cesfam" readonly="readonly" maxlength="255" data-rel="tooltip" type="text" id="cesfam" placeholder="Cesfam" class="col-md-6" value="<?= set_value('cesfam', $estudiante[0]->cesfam)?>">
        </div>        

        <div class="form-group">
            <label class="col-md-2 control-label" for="enfermedades">Enfermedades: </label>
            <input name="enfermedades" readonly="readonly" data-rel="tooltip" type="text" id="enfermedades" class="col-md-6" value="<?= set_value('enfermedades', $estudiante[0]->enfermedades) ?>">
        </div>

        <div class="form-group">
            <label class="col-md-2  control-label" for="alergias">Alergias: </label>
            <input name="alergias" readonly="readonly" data-rel="tooltip" type="text" id="alergias" placeholder="Alergias" class="col-md-6" value="<?= set_value('alergias', $estudiante[0]->alergias) ?>">
        </div>

        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>

        <div class="form-group">
            <h1>Información Social del estudiante </h1>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="ingreso">Ingreso familiar: </label>
            <input name="ingreso" data-rel="tooltip" readonly="readonly" type="text" id="ingreso" class="col-md-2" value="<?= set_value('ingreso', $actividad1d[0]->ingreso) ?>">
            <label class="col-md-2 control-label" for="integrantes">Número de integrantes: </label>
            <input name="integrantes" readonly="readonly" data-rel="tooltip" type="text" id="integrantes"  class="col-md-2" value="<?= set_value('integrantes', $actividad1d[0]->integrantes) ?>">
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="habitaciones">Número habitaciones: </label>
            <input name="habitaciones" readonly="readonly" data-rel="tooltip" type="text" id="habitaciones"  class="col-md-2" value="<?= set_value('habitaciones', $actividad1d[0]->habitaciones) ?>">
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="servicios">Servicios básicos: </label>
            <input name="servicios" readonly="readonly" data-rel="tooltip" type="text" id="servicios"  class="col-md-6" value="<?= set_value('servicios', $actividad1d[0]->servicios) ?>">
        </div>

        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>

        <div class="form-group">
            <h1>Información adicional</h1>
        </div>

        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="RAE">Requiere apoyo especializado: </label>
                <input name="RAE" data-rel="tooltip" readonly="readonly" type="text" id="RAE"  class="col-md-6" value="<?= set_value('RAE', $actividad1d[0]->RAE) ?>">
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-md-2 control-label " for="preferente">Preferente: </label>
            <input name="preferente" data-rel="tooltip" disabled="disabled" <?= $actividad1d[0]->preferente == 0 ? "" : "checked='checked'" ?> type="checkbox" id="preferente"  class="col-md-1" value="1">
            <label class="col-md-2 control-label" for="prioritario">Prioritario: </label>
            <input name="prioritario" data-rel="tooltip" disabled="disabled" <?= $actividad1d[0]->prioritario == 0 ? "" : "checked='checked'" ?> type="checkbox" id="prioritario"  class="col-md-1" value="1">
        </div>

        <?php  
        foreach ($actividad1dtest as $test) {
            echo '<div class="form-group">';
                echo '<label class="col-md-2 control-label" for="test">Listas de test: </label>';
                echo '<input name="test" readonly="readonly" data-rel="tooltip" type="text" id="test"  class="col-md-6" value="' . $test->lista_test. '">';
            echo '</div>';
        }
        ?>

        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>
        
        <div class="form-group">
            <h1>Información Académica</h1>
        </div>

        <?php 
        if(empty($colegios_anteriores)) 
            echo '<div class="row center"><h3>* Sin colegios anteriores</h3></div>';
            foreach ($colegios_anteriores as $cole) {
                echo '<div class="row">';
                    echo '<div class="form-group">';
                        echo '<label class="col-md-2  control-label" for="colegios">Colegio anterior: </label>';
                        echo '<input name="colegios" readonly="readonly" data-rel="tooltip" type="text" id="colegios"  class="col-md-6" value="' . $cole->nombre_colegio. '">';
                    echo '</div>';
                echo '</div>';
            }
        ?>

        <div class="form-group">
            <div class="linea-separadora">
                <div class="col-sm-12">
                     <hr size="8px" color="black" />
                     <h2>Cursos Repetidos</h2>
                </div>
            </div>
        </div>       
 
        <div class="row">
            <div id="contrepetido">
                <?php if(empty($cursos_repetidos)) 
                echo '<div class="row center"><h3>* Sin cursos repetidos</h3></div>';
                foreach ($cursos_repetidos as $key => $value) {
                    echo '<div class="form-group">' ;
                        echo '<label class="col-md-2 control-label">Causa: </label>' ;
                        echo '<input readonly="readonly" data-rel="tooltip" type="text" class="test col-md-5" value="'.$value->causa.'">' ;
                        echo '<label class="col-md-2 control-label">Cursos: </label>' ;
                        echo '<input readonly="readonly" data-rel="tooltip" type="text" class="test col-md-1" value="'.$value->curso.'">' ;
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <div class="linea-separadora">
                <div class="col-sm-12">
                    <hr size="8px" color="black" />
                        <h2>Documentos Academicos</h2>
                </div>
            </div>
        </div>  

        <div class="row">
            <?php 
            if(empty($archivos)) 
                echo '<div class="row center"><h3>* Sin archivos academicos</h3></div>';
                if(!empty($archivos)){
                    foreach ($archivos as $key => $value) {
                        if(strlen($value)>25) 
                            $nombreRecortado = substr($value,0,20) . '...';
                        else 
                            $nombreRecortado = $value;
                            echo '<div class="col-sm-4">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Descargar: '.$nombreRecortado.'</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <a href="'.site_url('procedimientosPrimero/download_act1/'. $id_ctrz . '/'.$value).'"id="botonDescargar" class="btn btn-primary btn-block">Descargar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
        </div> 

         <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>
    </div>
</div>
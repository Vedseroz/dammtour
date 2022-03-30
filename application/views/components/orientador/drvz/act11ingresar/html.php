<?= $components->infoBasica ?>

<div>
    <div class="col-sm-2"></div>
    <div class="offset-ms-4 col-sm-6">
    <?= validation_errors() ?>
    <?php foreach($errors as $error => $message): ?>
        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <b><?= $error ?>:</b> <?= $message ?>
        <br></div>
    <?php endforeach; ?>
    </div>
</div>

    <div class="col-xs-12">
        <h1>Evaluación de situación del estudiante </h1>
        <?= form_open(site_url('DerivacionA11/orientadorIng/'. $estudiante[0]->id .'/'. $id_drvz), 'class="form-horizontal" role="form"') ?>

            <div class="form-group">
                <h3>Actividades realizadas:</h3>
                <textarea class="col-sm-8" style="height:100px;" name="actividades" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p1resp)) echo $p1resp; ?></textarea>
                <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
            </div>  

            <div class="form-group">
                <label class="col-sm-1 control-label" for="duracion">Duración: </label>
                    <select name="duracion" class="col-sm-3 chosen-select" data-placeholder="Seleccione...">
                    <option value="1" <?php if($duracion==1) echo 'selected'; ?> >Corto plazo</option>
                    <option value="2" <?php if($duracion==2) echo 'selected'; ?> >Mediano plazo </option>
                    <option value="3" <?php if($duracion==3) echo 'selected'; ?> >Largo plazo </option>
                </select>
            </div>

            <div class="form-group">
                <h3>Eficacia de las acciones realizadas:</h3>
                <textarea class="col-sm-8" style="height:100px;" name="eficacia" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p2resp)) echo $p2resp; ?></textarea>
                <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
            </div>

            <div class="form-group">
                <h3>Intervenciones:</h3>
                <textarea class="col-sm-8" style="height:100px;" name="intervenciones" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p3resp)) echo $p3resp; ?></textarea>
                <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
            </div>

            <div class="form-group">
                <h3> Instrumentos metodológicos: </h3>
                <textarea class="col-sm-8" style="height:100px;" name="instrumentos" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p4resp)) echo $p4resp; ?></textarea>
                <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
            </div>

            <div class="form-group">
                <h3>Vocación del estudiante</h3>
                <textarea name="vocacion" data-rel="tooltip" class="col-xs-8" placeholder="Escriba la vocación del estudiante"><?php if(!empty($vocacion)) echo $vocacion; ?></textarea> 
                <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
            </div>
            
            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>
            
            <h2>Perfiles</h2>
            <h5>*Las características de cada perfil se pueden ver en el ícono de información</h5>
            <br>
            <div class="form-group">
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="1" <?php if($perfil == 1){?>checked<?php }; ?>><strong>CIENTÍFICOS</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Estudiantes demandantes y curiosos. <br/>
                    *Disconformes con las respuestas que se les dan.<br/>
                    *Indagadores.<br/>
                    *Observadores.<br/>
                    *Analíticos.<br/>
                    *Reflexivos.<br/>
                    *Con seguridad al Opinar.<br/>
                    *Metódicos.<br/>
                    *Detallistas.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="2" <?php if($perfil == 2){?>checked<?php }; ?>><strong>EXPLORADORES</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Empáticos.<br/>
                    *Les gusta lo oculto, desean saber más.<br/>
                    *Idealistas.<br/>
                    *Comprenden lo que leen, por lo cual pueden fundamentar.<br/>
                    *Curiosos e inquietos por conocer.<br/>
                    *Admiran la historia.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="3" <?php if($perfil == 3){?>checked<?php }; ?>><strong>ARTESANOS</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Kinésicos. <br/>
                    *Estudiantes inquietos.<br/>
                    *Aprenden haciendo.<br/>
                    *Estudiantes que necesitan un rol.<br/>
                    *Períodos cortos de concentración.<br/>
                    *Trabajan a partir de múltiples actividades.<br/>
                    *Desarrollan instrucciones cortas y precisas.<br/>
                    *Son más activos.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="4" <?php if($perfil == 4){?>checked<?php }; ?>><strong>DEPORTISTAS</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Desarrollan la noción espacial. <br/>
                    *Alimentación saludable.<br/>
                    *Disciplinados, siguen instrucciones.<br/>
                    *Buscan mejorar la técnica.<br/>
                    *Perfeccionistas.<br/>
                    *Inquietos.<br/>
                    *Autocríticos.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="5" <?php if($perfil == 5){?>checked<?php }; ?>><strong>CREADORES</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Estudiantes imaginativos. <br/>
                    *Estudiantes reflexivos, detallistas, observadores.<br/>
                    *Integran el mundo desde otra perspectiva.<br/>
                    *Expresan sus emociones de otra forma.">?</span>
                </div>
            </div>  

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>

            <h2>Habilidades y talentos del estudiante</h2>

           <div class="form-group">
                <h4>Seleccione una o más habilidades y/o talentos del estudiante</h4>
                <div class="col-md-2">
                    <input type="checkbox" name="talento1" value ="Autoconocimiento" <?php if($talento1 != NULL){?>checked<?php }; ?>>Autoconocimiento</input>
                    <br>
                    <br>
                    <input type="checkbox" name="talento4" value ="Manejo de emociones y sentimientos" <?php if($talento4 != NULL){?>checked<?php }; ?>>Manejo de emociones y sentimientos</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="talento2" value ="Empatía" <?php if($talento2 != NULL){?>checked<?php }; ?>>Empatía</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad3" value ="Manejo de problemas y conflictos" <?php if($habilidad3 != NULL){?>checked<?php }; ?>>Manejo de problemas y conflictos</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="habilidad1" value ="Comunicación asertiva" <?php if($habilidad1 != NULL){?>checked<?php }; ?>>Comunicación asertiva</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad4" value ="Relaciones interpersonales" <?php if($habilidad4 != NULL){?>checked<?php }; ?>>Relaciones interpersonales</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="habilidad2" value ="Pensamiento creativo" <?php if($habilidad2 != NULL){?>checked<?php }; ?>>Pensamiento creativo</input>
                    <br>
                    <br>
                    <input type="checkbox" name="talento5" value ="Toma de decisiones" <?php if($talento5 != NULL){?>checked<?php }; ?>>Toma de decisiones</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="talento3" value ="Pensamiento crítico" <?php if($talento3 != NULL){?>checked<?php }; ?>>Pensamiento crítico</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad5" value ="Manejo del éstres" <?php if($habilidad5 != NULL){?>checked<?php }; ?>>Manejo del éstres</input>
                </div>
            </div>

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>

            <div class="clearfix form-actions center">
                <button class="btn btn-info" type="submit" name="finalizar" value="1">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Finalizar
                </button>
                <button class="btn btn-info" type="submit" name="finalizar" value="2">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Guardar
                </button>
                <a href="<?= site_url("inicio/index")?>" class="btn btn-danger" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>

        </form>
    </div>  
</div>

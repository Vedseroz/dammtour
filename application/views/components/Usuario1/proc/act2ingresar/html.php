
<?= $components->infoBasica ?>

<?= $components->menu ?>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<div>
    <div class="offset-ms-4 col-sm-6">
    <?= validation_errors() ?>
    <?php foreach($errors as $error => $message): ?>
        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <b><?= $error ?>:</b> <?= $message ?>
        <br></div>
    <?php endforeach; ?>
</div>

    <div class="col-xs-12">
        <h1>Información Autobiográfica del estudiante </h1>
        <?= form_open(site_url('procedimientosSegundo/Usuario1ing/'.$estudiante[0]->id.'/'.$id_ctrz),'class="form-horizontal" role="form" enctype="multipart/form-data"') ?>
            <table class="form-group">
                <tr>
                    <td>
                        <h3>1. ¿Quien soy?</h1>
                        <textarea name="pregunta1" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p1resp)) echo $p1resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3>2. ¿Qué pienso de mi entorno social y familiar?</h1>
                        <textarea name="pregunta2" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p2resp)) echo $p2resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>3. ¿Cuáles son mis sueños?</h1>
                        <div>
                        <textarea name="pregunta3" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p3resp)) echo $p3resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </div>
                    </td>
                    <td>
                        <h3>4. ¿Cómo me proyecto a futuro?</h1>
                        <textarea name="pregunta4" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p4resp)) echo $p4resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3>5. ¿Cuáles creo que son mis fortalezas?</h1>
                        <textarea name="pregunta5" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p5resp)) echo $p5resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3>6. ¿Qué espero de la escuela?</h1>
                        <textarea name="pregunta6" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p6resp)) echo $p6resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>7. ¿Cómo creo que es mi escuela?</h1>
                        <textarea name="pregunta7" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p7resp)) echo $p7resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3>8. ¿Qué sentido tiene ir a la escuela?</h1>
                        <textarea name="pregunta8" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p8resp)) echo $p8resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>9. ¿Cómo me gustaría que me evalúen?</h1>
                        <textarea name="pregunta9" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p9resp)) echo $p9resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3>10. ¿Cuál es mi asignatura preferida?</h1>
                        <textarea name="pregunta10" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p10resp)) echo $p10resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>11. ¿Cuál es mi asignatura menos preferida?</h1>
                        <textarea name="pregunta11" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p11resp)) echo $p11resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                    </td>
                </tr>             
            </table>

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>

            <h2>Estado de ánimo del estudiante</h2>            
            <br>
            <div class="form-group">
                <table width="40%">
                    <tr>
                        <td style="height:90px;" align="center"><img id="joy" class="center" alt="Alegría" src="<?= base_url('assets/images/emociones/joy.png') ?>" /></td>
                        <td style="height:90px;" align="center"><img id="Preocupado" class="center" alt="Preocupado" src="<?= base_url('assets/images/emociones/worry.png') ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center">Alegría</td>
                        <td align="center">Preocupado</td>
                    </tr>
                    <tr>
                        <td align="center"><input type="radio" name="emotion" value="1"></td>
                        <td align="center"><input type="radio" name="emotion" value="5"></td>
                    </tr>
                    <tr>
                        <td style="height:90px;" align="center"><img id="mad" class="center" alt="Rabia" src="<?= base_url('assets/images/emociones/mad.png') ?>" /></td>
                        <td style="height:90px;" align="center"><img id="sad" class="center" alt="Tristeza" src="<?= base_url('assets/images/emociones/sad.png') ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center">Rabia</td>
                        <td align="center">Tristeza</td>
                    </tr>
                    <tr>
                        <td align="center"><input type="radio" name="emotion" value="3"></td>
                        <td align="center"><input type="radio" name="emotion" value="2"></td>
                    </tr>
                </table>
            </div>  

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>
            
            <h2>Vocación del estudiante</h2>
            <textarea name="vocacion" data-rel="tooltip" class="col-xs-8" placeholder="Escriba la vocación del estudiante" <?php if(!empty($vocacion)) echo $vocacion; ?>></textarea>

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
                    <input type="radio" name="perfil" value="1"><strong>CIENTÍFICOS</strong>
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
                    <input type="radio" name="perfil" value="2"><strong>EXPLORADORES</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Empáticos.<br/>
                    *Les gusta lo oculto, desean saber más.<br/>
                    *Idealistas.<br/>
                    *Comprenden lo que leen, por lo cual pueden fundamentar.<br/>
                    *Curiosos e inquietos por conocer.<br/>
                    *Admiran la historia.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="3"><strong>ARTESANOS</strong>
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
                    <input type="radio" name="perfil" value="4"><strong>DEPORTISTAS</strong>
                    <span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Desarrollan la noción espacial. <br/>
                    *Alimentación saludable.<br/>
                    *Disciplinados, siguen instrucciones.<br/>
                    *Buscan mejorar la técnica.<br/>
                    *Perfeccionistas.<br/>
                    *Inquietos.<br/>
                    *Autocríticos.">?</span>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="5"><strong>CREADORES</strong>
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
                    <input type="checkbox" name="talento1" value ="Autoconocimiento">Autoconocimiento</input>
                    <br>
                    <br>
                    <input type="checkbox" name="talento4" value ="Manejo de emociones y sentimientos">Manejo de emociones y sentimientos</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="talento2" value ="Empatía">Empatía</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad3" value ="Manejo de problemas y conflictos">Manejo de problemas y conflictos</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="habilidad1" value ="Comunicación asertiva">Comunicación asertiva</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad4" value ="Relaciones interpersonales">Relaciones interpersonales</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="habilidad2" value ="Pensamiento creativo">Pensamiento creativo</input>
                    <br>
                    <br>
                    <input type="checkbox" name="talento5" value ="Toma de decisiones">Toma de decisiones</input>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="talento3" value ="Pensamiento crítico">Pensamiento crítico</input>
                    <br>
                    <br>
                    <input type="checkbox" name="habilidad5" value ="Manejo del éstres">Manejo del éstres</input>
                </div>
            </div>

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-2 control-label" for="userfileD">Subir documento: </label>
                <div class="col-xs-5">
                    <input id='input-file' type="file" class="form-control" name="userFileD" >
                </div>
            </div>
             <div class="form-group">
                <label class="col-xs-2 control-label" for="userfileA">Subir entrevista: </label>
                <div class="col-xs-5">
                    <input id='input-file2' type="file" class="form-control" name="userFileA">
                </div>
            </div>

            <div class="clearfix form-actions center">
                <button class="btn btn-info" type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Ingresar
                </button>
                <a href="<?= site_url("inicio/index")?>" class="btn btn-danger" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>
        </form>
    </div>  
</div>

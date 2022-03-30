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

<div class="row">
    <div class="col-xs-12">
        <h1>Información de habilidades del estudiante </h1>
        <?= form_open(site_url('procedimientosTercero/pieIng/'.$estudiante[0]->id.'/'.$id_ctrz), 'class="form-horizontal" role="form" enctype="multipart/form-data"') ?>
            <table class="form-group">
                <tr>
                    <td>
                        <h3 class="col-xs-11" >1.  Estilos de aprendizaje.</h3>
                        <textarea name="pregunta1"  data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p1resp)) echo $p1resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">2.  Orientaciones Metodológicas.</h3>
                        <textarea name="pregunta2" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p2resp)) echo $p2resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">3.  Descripción integración con pares.  </h3>
                        <textarea name="pregunta3" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p3resp)) echo $p3resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">4.   Descripción de interacción con adultos.</h3>
                        <textarea name="pregunta4" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p4resp)) echo $p4resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3 class="col-xs-11">5.  Habilidades favorables.</h1>
                        <textarea name="pregunta5" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p5resp)) echo $p5resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">6.  Habilidades desfavorables.</h1>
                        <textarea name="pregunta6" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p6resp)) echo $p6resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
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
            <h5>*Las características de cada perfil se pueden ver en el ícono de información.</h5>
            <br>
            <div class="form-row">
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="1"><strong>CIENTÍFICOS</strong>
                    <a><span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Estudiantes demandantes y curiosos. <br/>
                    *Disconformes con las respuestas que se les dan.<br/>
                    *Indagadores.<br/>
                    *Observadores.<br/>
                    *Analíticos.<br/>
                    *Reflexivos.<br/>
                    *Con seguridad al Opinar.<br/>
                    *Metódicos.<br/>
                    *Detallistas.">?</span>
                    </a>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="2"><strong>EXPLORADORES</strong>
                    <a><span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Empáticos.<br/>
                    *Les gusta lo oculto, desean saber más.<br/>
                    *Idealistas.<br/>
                    *Comprenden lo que leen, por lo cual pueden fundamentar.<br/>
                    *Curiosos e inquietos por conocer.<br/>
                    *Admiran la historia.">?</span>
                    </a>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="3"><strong>ARTESANOS</strong>
                    <a><span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Kinésicos. <br/>
                    *Estudiantes inquietos.<br/>
                    *Aprenden haciendo.<br/>
                    *Estudiantes que necesitan un rol.<br/>
                    *Períodos cortos de concentración.<br/>
                    *Trabajan a partir de múltiples actividades.<br/>
                    *Desarrollan instrucciones cortas y precisas.<br/>
                    *Son más activos.">?</span>
                    </a>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="4"><strong>DEPORTISTAS</strong>
                    <a><span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Desarrollan la noción espacial. <br/>
                    *Alimentación saludable.<br/>
                    *Disciplinados, siguen instrucciones.<br/>
                    *Buscan mejorar la técnica.<br/>
                    *Perfeccionistas.<br/>
                    *Inquietos.<br/>
                    *Autocríticos.">?</span>
                    </a>
                </div>
                <div class="col-xs-2">
                    <input type="radio" name="perfil" value="5"><strong>CREADORES</strong>
                    <a><span class="help-button" data-html="true" data-rel="popover" data-trigger="hover" data-placement="right" data-content="*Estudiantes imaginativos. <br/>
                    *Estudiantes reflexivos, detallistas, observadores.<br/>
                    *Integran el mundo desde otra perspectiva.<br/>
                    *Expresan sus emociones de otra forma.">?</span>
                    </a>
                </div>
            </div>  
            <br>
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
            
            <table class="table"  id="tabla">
                    <h3  class="col-xs-11">7.  Requiere apoyo en:</h1>
                    <tr class="fila-fija">
                        <td>
                            <div class="row">
                                <div id="contenedor">
                                    <div class="form-group" id="baseclone">
                                        <input name="apoyo[]" data-rel="tooltip" type="text" id="apoyo"  class="apoyo col-md-4" value="">
                                        <button id="eliminar" type="button" class="btn btn-sm btn-danger">Eliminar registro</button>
                                    </div>
                                </div>
                                <button id="agregar" name="agregar" type="button" class="btn btn-info"> Agregar registro</button>
                            </div>
                        </td>
                    </tr> 
            </table>

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

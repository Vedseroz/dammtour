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

<?= $components->infoBasica ?>

<?= $components->menu ?>

<div class="row">
    <div class="linea-separadora">
        <div class="col-sm-12">
             <hr size="8px" color="black" />
        </div>
    </div>

    <div class="col-xs-12">
        <h1>Información Autobiográfica del estudiante </h1>
        <?= form_open(null, 'class="form-horizontal" role="form" enctype="multipart/form-data"') ?>
            <table class="form-group">
                <tr>
                    <td>
                        <h3>1. ¿Quien soy?</h1>
                        <textarea name="pregunta1" data-rel="tooltip" readonly="readonly" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta1 ?> </textarea>
                    </td>
                    <td>
                        <h3>2. ¿Qué pienso de mi entorno social y familiar?</h1>
                        <textarea name="pregunta2" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta2 ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>3. ¿Cuáles son mis sueños?</h1>
                        <textarea name="pregunta3" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta3 ?> </textarea>
                    </td>
                    <td>
                        <h3>4. ¿Cómo me proyecto a futuro?</h1>
                        <textarea name="pregunta4" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta4 ?> </textarea>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3>5. ¿Cuáles creo que son mis fortalezas?</h1>
                        <textarea name="pregunta5" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta5 ?> </textarea>
                    </td>
                    <td>
                        <h3>6. ¿Qué espero de la escuela?</h1>
                        <textarea name="pregunta6" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta6 ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>7. ¿Cómo creo que es mi escuela?</h1>
                        <textarea name="pregunta7" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta7 ?> </textarea>
                    </td>
                    <td>
                        <h3>8. ¿Qué sentido tiene ir a la escuela?</h1>
                        <textarea name="pregunta8" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta8 ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>9. ¿Cómo me gustaría que me evalúen?</h1>
                        <textarea name="pregunta9" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta9 ?> </textarea>
                    </td>
                    <td>
                        <h3>10. ¿Cuál es mi asignatura preferida?</h1>
                        <textarea name="pregunta10" data-rel="tooltip" readonly="readonly" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta10 ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>11. ¿Cuál es mi asignatura menos preferida?</h1>
                        <textarea name="pregunta11" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->pregunta11 ?> </textarea>
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
            
            <table padding= "8px" width="100%">
                <tr>
                    <?php if($actividad2d[0]->emotion == 1) : ?>
                    <td align="center"><img id="joy" class="center" alt="Alegría" src="<?= base_url('assets/images/emociones/joy.png') ?>" /></td>
                    <?php elseif($actividad2d[0]->emotion == 2) : ?>
                    <td align="center"><img id="sad" class="center" alt="Tristeza" src="<?= base_url('assets/images/emociones/sad.png') ?>" /></td>
                    <?php elseif($actividad2d[0]->emotion == 3) : ?>
                    <td align="center"><img id="mad" class="center" alt="Rabia" src="<?= base_url('assets/images/emociones/mad.png') ?>" /></td>
                    <?php elseif($actividad2d[0]->emotion == 5) : ?>
                    <td align="center"><img id="Preocupado" class="center" alt="Preocupado" src="<?= base_url('assets/images/emociones/worry.png') ?>" /></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <?php if($actividad2d[0]->emotion == 1) : ?>
                    <td align="center">Alegría</td>
                    <?php elseif($actividad2d[0]->emotion == 2) : ?>
                    <td align="center">Tristeza</td>
                    <?php elseif($actividad2d[0]->emotion == 3) : ?>
                    <td align="center">Rabia</td>
                    <?php elseif($actividad2d[0]->emotion == 5) : ?>
                    <td align="center">Preocupado</td>
                    <?php endif; ?>
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

            <textarea name="vocacion" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $actividad2d[0]->vocacion ?> </textarea>

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>
        
            <h2>Perfil del estudiante</h2>            
            <br>
            <div class="form-group">
                <?php if($actividad2d[0]->perfil == 1) : ?>
                <p class="col-md-2"><strong>CIENTÍFICOS:</strong></p>
                <p> Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
                <?php elseif($actividad2d[0]->perfil == 2) : ?>
                <p class="col-md-2"><strong>EXPLORADORES:</strong></p> 
                <p> Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
                <?php elseif($actividad2d[0]->perfil == 3) : ?>
                <p class="col-md-2"><strong>ARTESANOS:</strong></p> 
                <p> Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
                <?php elseif($actividad2d[0]->perfil == 4) : ?>
                <p class="col-md-2"><strong>DEPORTISTAS:</strong></p> 
                <p> Interés por el deporte, la salud y la buena alimentación.</p>
                <?php elseif($actividad2d[0]->perfil == 5) : ?>
                <p class="col-md-2"><strong>CREADORES:</strong></p> 
                <p> Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
                <?php endif; ?>
            </div>

            <h2>Habilidades y talentos del estudiante</h2>
            <br>
            <div class="form-group">
                <ul id="dynamic-list">
                    <?php if($actividad2d[0]->talento1 != "Sin Respuesta") : ?>
                        <li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->talento4 != "Sin Respuesta") : ?>
                        <li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->talento2 != "Sin Respuesta") : ?>
                        <li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->habilidad3 != "Sin Respuesta") : ?>
                        <li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->habilidad1 != "Sin Respuesta") : ?>
                        <li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->habilidad4 != "Sin Respuesta") : ?>
                        <li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->habilidad2 != "Sin Respuesta") : ?>
                        <li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->talento5 != "Sin Respuesta") : ?>
                        <li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->talento3 != "Sin Respuesta") : ?>
                        <li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
                        <br>
                    <?php endif ?>
                    <?php if($actividad2d[0]->habilidad5 != "Sin Respuesta") : ?>
                        <li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
                        <br>
                    <?php endif ?>
                </ul>
            </div>

            <div class="form-group">
                <div class="linea-separadora">
                    <div class="col-sm-9">
                         <hr size="8px" color="black" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Documento: <?php echo empty($archivoDox) ? 'Sin Documento' : $archivoDox ; ?></h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <a <?php echo !empty($archivoDox) ? 'href="'. site_url('procedimientosSegundo/download_dox/'. $id_ctrz . '/'.$archivoDox).'"' : '' ?> id="botonDescargar" class="btn btn-primary btn-block">Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Audio: <?php echo empty($archivoAudio) ? 'Sin audio' : $archivoAudio ; ?></h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <a <?php echo !empty($archivoAudio) ? 'href="'. site_url('procedimientosSegundo/download_audio/'. $id_ctrz . '/'.$archivoAudio).'"' : '' ?> id="botonDescargar" class="btn btn-primary btn-block">Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix form-actions center">
                <a href="<?= site_url("inicio/index")?>" class="btn btn-success" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Regresar.
                </a>
            </div>

        </form>
    </div>  
</div>

<?= $components->infoBasica ?>

<?= $components->menuPE ?>
<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <h1 class="col-md-8 center" >Primera Actividad: Contexto de situación </h1>
</div> 

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div> 

<div class="row">
    <div class="clearfix center col-md-12">
        <a href="<?= site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/'.$tipo) ?>" class="btn btn-success">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Primera Actividad
        </a>
        <a class="btn btn">
            <table>
                <td>
                    <i class="ace-icon fa fa-question-circle bigger-210">&nbsp</i>
                </td>
                <td>
                    <?php
                    if($tipo == 1) echo 'Primera Derivación <br> Habilidad/Talento';
                    if($tipo >= 2) echo 'Primera Derivación <br> Conductual';
                    ?>
                </td>
            </table>
        </a>
        <a href="<?php
            if($tipo == 1){
                echo site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/11');
            }
            if($tipo >= 2){
                echo site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/21');
            }
            ?>" class="btn btn-info">
                <i class="ace-icon fa fa-pencil bigger-110"></i>
                Segunda Actividad
        </a>
        <?php 
            if($tipo >= 2){
                $nombre_bt = '';
                if($tipo == 3) $nombre_bt = 'Segunda Derivación <br> Mediación Escolar';
                if($tipo == 4) $nombre_bt = 'Segunda Derivación  <br> Red Interna';
                if($tipo == 5) $nombre_bt = 'Segunda Derivación  <br> Red Externa';
                echo '<a class="btn btn"> <table> <td> <i class="ace-icon fa fa-question-circle bigger-210">&nbsp</i> </td> <td>' .$nombre_bt. '</td> </table> </a>' ;

                if ($tipo == 3){
                    $link_act3 = site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/22');
                    $link_act4 = site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/23');
                    echo ' <a href="'.$link_act3.'" class="btn btn-info"> <i class="ace-icon fa fa-pencil bigger-110"></i>Tercera Actividad</a>';
                    echo ' <a href="'.$link_act4.'" class="btn btn-info"> <i class="ace-icon fa fa-pencil bigger-110"></i>Cuarta Actividad</a>';
                }
                if ($tipo == 4){
                    $link_act3 = site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/31');
                    echo ' <a href="'.$link_act3.'" class="btn btn-info"> <i class="ace-icon fa fa-pencil bigger-110"></i>Tercera Actividad</a>';
                }
                if ($tipo == 5){
                    $link_act3 = site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/32');
                    echo ' <a href="'.$link_act3.'" class="btn btn-info"> <i class="ace-icon fa fa-pencil bigger-110"></i>Tercera Actividad</a>';
                }
            }
        ?>

        <br>
        <br>

        <a href="<?= site_url('perfilEstudiante/seguimientos/'. $estudiante[0]->id)?>" class="col-md-1.5 btn btn-info">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Regresar
        </a>
    </div>
</div>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div> 

<div class="col-xs-12">
    <div class="row form-horizontal">
        <div class="form-group">
            <h2>Evaluación de situación del estudiante</h2>
        </div>
                
        <div class="form-group">
            <h3>Descripción de situación:</h3>
            <textarea class="col-sm-6" name="situacion" readonly="readonly" ><?php echo $derivacion1[0]->situacion ?></textarea>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label" for="razon">razon: </label>
            <input name="razon" readonly="readonly" type="text" id="razon" class="col-sm-2" value="<?= set_value('razon',$derivacion1[0]->razon == 1 ? 'habilidad/talento' : 'Convivencia')?>">
        </div>

        <div class="form-group">
            <h3>Justificación de la derivación:</h3>
            <textarea name="justificacion" readonly="readonly" class="col-sm-6"><?php echo $derivacion1[0]->justificacion ?></textarea>
        </div>

        <div class="form-group">
            <h3>Acciones previas: </h3>
            <textarea name="acciones" readonly="readonly" class="col-sm-6"><?php echo $derivacion1[0]->acciones ?></textarea>
        </div>

        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div> 
        
        <div class="form-group">
            <h2>Vocación del estudiante</h2>
            <textarea name="vocacion" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"> <?php echo $derivacion1[0]->vocacion ?> </textarea>
        </div>

        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>
        
        <div class="form-group">
            <h2>Perfil del estudiante</h2>            
            <br>
        </div>

        <div class="form-group">
            <?php if($derivacion1[0]->perfil == 1) : ?>
            <p class="col-md-2"><strong>CIENTÍFICOS:</strong></p>
            <p> Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
            <?php elseif($derivacion1[0]->perfil == 2) : ?>
            <p class="col-md-2"><strong>EXPLORADORES:</strong></p> 
            <p> Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
            <?php elseif($derivacion1[0]->perfil == 3) : ?>
            <p class="col-md-2"><strong>ARTESANOS:</strong></p> 
            <p> Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
            <?php elseif($derivacion1[0]->perfil == 4) : ?>
            <p class="col-md-2"><strong>DEPORTISTAS:</strong></p> 
            <p> Interés por el deporte, la salud y la buena alimentación.</p>
            <?php elseif($derivacion1[0]->perfil == 5) : ?>
            <p class="col-md-2"><strong>CREADORES:</strong></p> 
            <p> Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
            <?php endif; ?>
        </div>
        
        <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
        </div>

        <div class="form-group">
            <h2>Habilidades y talentos del estudiante</h2>
            <br>
        </div>

        <div class="form-group">
            <ul id="dynamic-list">
                <?php if($derivacion1[0]->talento1 != NULL) : ?>
                    <li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->talento4 != NULL) : ?>
                    <li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->talento2 != NULL) : ?>
                    <li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->habilidad3 != NULL) : ?>
                    <li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->habilidad1 != NULL) : ?>
                    <li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->habilidad4 != NULL) : ?>
                    <li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->habilidad2 != NULL) : ?>
                    <li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->talento5 != NULL) : ?>
                    <li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->talento3 != NULL) : ?>
                    <li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
                    <br>
                <?php endif ?>
                <?php if($derivacion1[0]->habilidad5 != NULL) : ?>
                    <li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>
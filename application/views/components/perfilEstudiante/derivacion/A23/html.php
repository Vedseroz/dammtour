<?= $components->infoBasica ?>

<?= $components->menuPE ?>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <h1 class="col-md-8 center">Cuarta Actividad: Evaluación del estudiante </h1>
</div> 

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div> 

<div class="row">
    <div class="clearfix center col-md-12">
        <a href="<?= site_url("perfilEstudiante/mostrarDerivacion/" . $estudiante[0]->id. '/'. $id_drvz .'/'.$tipo) ?>" class="btn btn-info">
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
                    echo ' <a href="'.$link_act4.'" class="btn btn-success"> <i class="ace-icon fa fa-pencil bigger-110"></i>Cuarta Actividad</a>';
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
        <hr size="8px" color="black"/>
    </div>
</div> 

<div class="col-xs-12">
    <div class="row form-horizontal">
        <div class="form-group">
            <h2>Documento de evaluación del estudiante</h2>
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
                                        <a <?php echo !empty($archivoDox) ? 'href="'. site_url('PerfilEstudiante/downloadDrvz23/'. $id_drvz . '/'.$archivoDox).'"' : '' ?> id="botonDescargar" class="btn btn-primary btn-block">Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
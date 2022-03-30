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
        <h1>Descripción familiar </h1>
            <table class="form-group">
                <tr>
                    <td>
                        <h3 class="col-xs-11">1.  ¿Quién soy?</h3>
                        <textarea name="pregunta1" data-rel="tooltip" readonly="readonly" class="col-xs-11"><?php echo $actividad5d[0]->pregunta1 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">2.  ¿Qué pienso de mi entorno social y familiar?</h3>
                        <textarea name="pregunta2" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta2 ?></textarea>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">3.  ¿Cómo veo al estudiante?</h3>
                        <textarea name="pregunta3" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta3 ?></textarea>
                    </td>
                    </td>
                    <td>
                        <h3 class="col-xs-11">4.  ¿Cómo apoyo al estudiante?</h3>
                        <textarea name="pregunta4" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta4 ?></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3 class="col-xs-11">5.  ¿En qué me comprometo con el desarrollo del estudiante?</h3>
                        <textarea name="pregunta5" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta5 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">6.  ¿Cómo me siento integrado al colegio?</h3>
                        <textarea name="pregunta6" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta6 ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">7.  ¿Cómo espero ser tratado en el colegio?</h3>
                        <textarea name="pregunta7" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta7 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">8.  ¿Cómo aporto al colegio?</h1>
                        <textarea name="pregunta8" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta8 ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">9.  ¿Relate una experiencia positiva con el Usuario 1?</h1>
                        <textarea name="pregunta9" data-rel="tooltip" class="col-xs-11" readonly="readonly"><?php echo $actividad5d[0]->pregunta9 ?></textarea>
                    </td>
                </tr>           
            </table>

            <div class="clearfix form-group center">
                <a href="<?= site_url("inicio/index")?>" class="btn btn-success" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Regresar a Inicio.
                </a>
            </div>

    </div> 

</div>


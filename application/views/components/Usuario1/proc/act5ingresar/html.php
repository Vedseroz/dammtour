
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
        <h1>Descripción familiar </h1>
        <?= form_open(site_url('procedimientosQuinto/Usuario1ing/'.$estudiante[0]->id.'/'.$id_ctrz), 'class="form-horizontal" role="form" ') ?>
            <table class="form-group">
                <tr>
                    <td>
                        <h3 class="col-xs-11">1.  ¿Quién soy?</h3>
                        <textarea name="pregunta1" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p1resp)) echo $p1resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">2.  ¿Qué pienso de mi entorno social y familiar?</h3>
                        <textarea name="pregunta2" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p2resp)) echo $p2resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">3.  ¿Cómo veo al estudiante?</h3>
                        <textarea name="pregunta3" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p3resp)) echo $p3resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                    </td>
                    <td>
                        <h3 class="col-xs-11">4.  ¿Cómo apoyo al estudiante?</h3>
                        <textarea name="pregunta4" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p4resp)) echo $p4resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3 class="col-xs-11">5.  ¿En qué me comprometo con el desarrollo del estudiante?</h3>
                        <textarea name="pregunta5" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p5resp)) echo $p5resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">6.  ¿Cómo me siento integrado al colegio?</h3>
                        <textarea name="pregunta6" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p6resp)) echo $p6resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">7.  ¿Cómo espero ser tratado en el colegio?</h3>
                        <textarea name="pregunta7" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p7resp)) echo $p7resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                    <td>
                        <h3 class="col-xs-11">8.  ¿Cómo aporto al colegio?</h1>
                        <textarea name="pregunta8" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p8resp)) echo $p8resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">9.  ¿Relate una experiencia positiva con el Usuario 1?</h1>
                        <textarea name="pregunta9" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php if(!empty($p9resp)) echo $p9resp; ?></textarea>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
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

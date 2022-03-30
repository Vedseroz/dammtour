<?= $components->infoBasica ?>

<?= $components->menu ?>

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
    <h2>Evaluación del estudiante </h2>
    <?= form_open(site_url('derivacionA23/Usuario1Ing/'.$estudiante[0]->id.'/'.$id_drvz), 'class="form-horizontal" role="form" enctype="multipart/form-data"') ?>
        <div class="form-group">
            <label class="col-xs-2 control-label" for="userfileD">Subir documento de evaluación: </label>
            <div class="col-xs-5">
                <input type="file" class="form-control" name="userFileD" id="id-input-file">
            </div>
            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
        </div>

        <div class="clearfix form-actions center">
            <button class="btn btn-info" type="submit" name="finalizar">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Finalizar
            </button>
            <a href="<?= site_url("inicio/index")?>" class="btn btn-danger" type="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Cancelar
            </a>
        </div>
    </form>
</div>  

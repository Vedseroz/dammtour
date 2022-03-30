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

<div class="clearfix  center col-xs-12">
    <h2>Información Autobiográfica del estudiante </h2>
    <i class="ace-icon fa fa-check fa-5x"></i>
    <h2>Se finalizó esta actividad</h2>

    <div class="row">
        <a href="<?= site_url('inicio/index')?>" class="btn btn-info">
            <i class="ace-icon fa fa-undo bigger-110"></i>
                Regresar
        </a>
    </div>
</div>


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

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<div class="clearfix  center col-xs-12">
    <h2>Información de habilidades del estudiante </h2>
    <i class="ace-icon fa fa-clock-o fa-5x"></i>
    <h2>Esperando el ingreso por PIE</h2>

    <div class="row">
        <a href="<?= site_url('inicio/index')?>" class="btn btn-info">
            <i class="ace-icon fa fa-undo bigger-110"></i>
                Regresar
        </a>
    </div>
</div>


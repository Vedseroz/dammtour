<dir class="row center">
    <h2>Registrar curso</h2>
    <a class="btn btn-app btn-success no-click">
        <i class="ace-icon fa fa-users bigger-230"></i>
        Curso
    </a>
</dir>
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
        <h3 class="header smaller lighter green">Información general</h3>
    
        <?= form_open(site_url('administrador/add_curso/'. $id_colegio), 'class="form-horizontal" role="form"') ?>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="nombre">Nombre curso: </label>
                <div class="col-sm-9">
                    <input name="nombre" data-rel="tooltip" type="text" id="nombre" placeholder="Nombre curso" class="col-xs-10 col-sm-6" value="<?= set_value('nombre') ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio" title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="codigo">Código: </label>
                <div class="col-sm-9">
                    <input name="codigo" maxlength="100" data-rel="tooltip" type="text" id="codigo" placeholder="codigo" class="col-xs-10 col-sm-6" value="<?= set_value('codigo') ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="letra">Letra: </label>
                <div class="col-sm-9">
                    <input name="letra" maxlength="10" data-rel="tooltip" type="text" id="letra" placeholder="letra" class="col-xs-10 col-sm-6" value="<?= set_value('letra') ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="codigo">Fecha: </label>
                <div class="col-sm-9">
                    <input name="fecha" maxlength="200" data-rel="tooltip" type="date" id="fecha" placeholder="Fecha curso" class="col-xs-10 col-sm-6" value="<?= set_value('fecha') ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Opcional." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="clearfix form-actions center">
                <button class="btn btn-info" type="submit" name="finalizar">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Finalizar
                </button>
                <a href="<?= site_url("administrador/show_colegio/". $id_colegio) ?>" class="btn btn-danger">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>

        </form>
    </div>  
</div>

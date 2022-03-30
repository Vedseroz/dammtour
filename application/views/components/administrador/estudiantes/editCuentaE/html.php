<dir class="row center">
    <h2>Editar cuenta de estudiante</h2>
    <a class="btn btn-app btn-success no-click">
        <i class="ace-icon fa fa-graduation-cap bigger-230"></i>
        Estudiante
    </a>
</dir>

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
   
        <?= form_open(site_url('administrador/editCuentaE/' . $id_estudiante . '/' . $id_cuenta), 'class="form-horizontal" role="form"') ?>
        	
            <h3 class="header smaller lighter green">Datos Personales</h3>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="nombres">Nombres: </label>
                <div class="col-sm-8">
                    <input name="nombres" data-rel="tooltip" type="text" id="nombres" class="col-xs-10 col-sm-6" value="<?= $nombres ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="apellidos">Apellidos: </label>
                <div class="col-sm-8">
                    <input name="apellidos" data-rel="tooltip" type="text" class="col-xs-10 col-sm-6" value="<?= $apellidos ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <h3 class="header smaller lighter green">Datos de cuenta</h3>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="password">Contraseña: </label>
                <div class="col-sm-8">
                    <input name="password" data-rel="tooltip" type="text" class="col-xs-10 col-sm-6" value="<?= set_value('password') ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Contraseña de inicio de seción, Obligatorio," title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="passwordc">Confirmar contraseña: </label>
                <div class="col-sm-8">
                    <input name="passwordc" data-rel="tooltip" type="text" class="col-xs-10 col-sm-6">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Contraseña de inicio de seción, Obligatorio," title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="clearfix form-actions center">
                <button class="btn btn-info" type="submit" name="finalizar">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Finalizar
                </button>
                <a href="<?= site_url("Administrador/estudiantes")?>" class="btn btn-danger" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>

        </form>
    </div>  
</div>


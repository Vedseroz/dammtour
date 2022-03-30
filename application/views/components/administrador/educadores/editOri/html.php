<dir class="row center">
	<h2>Editar cuenta de orientador</h2>
	<a class="btn btn-app btn-purple no-click">
        <i class="ace-icon fa fa-ravelry bigger-230"></i>
        Orientador
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
   
        <?= form_open(site_url('administrador/editOri/' . $id), 'class="form-horizontal" role="form"') ?>
        	
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

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="email">Email: </label>
                <div class="col-sm-8">
                    <input name="email" data-rel="tooltip" type="text" class="col-xs-10 col-sm-6" value="<?= $email ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="phone">Telefono: </label>
                <div class="col-sm-8">
                    <input name="phone" type="text" data-rel="tooltip" class="input-mask-phone col-xs-10 col-sm-6" value="<?= $phone ?>">
                </div>
            </div>

            <h3 class="header smaller lighter green">Datos de escuela</h3>

            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="colegios">Colegios: </label>
                <div class="col-sm-8">
                    <div class="col-xs-10 col-sm-6">
                        <select id="colegiosselect" name="colegiosselect" class="chosen-select form-control">
                            <option value="" ></option>
                            <?php foreach($colegios as $key => $value): ?>
                            <option value="<?= $value->id ?>" ><?= $value->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                <a href="<?= site_url("administrador/educadores")?>" class="btn btn-danger" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>

        </form>
    </div>  
</div>


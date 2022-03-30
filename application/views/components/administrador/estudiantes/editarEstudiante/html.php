<dir class="row center">
    <h2>Editar estudiante</h2>
    <a class="btn btn-app btn-success no-click">
        <i class="ace-icon fa fa-graduation-cap bigger-230"></i>
        Estudiante
    </a>
</dir>

<div>
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
           
        <?= form_open(site_url('administrador/edit_estudiante/'. $id_estudiante), 'class="form-horizontal" role="form"') ?>

            <h3 class="header smaller lighter green">Información personal</h3>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="rut">RUT: </label>
                <div class="col-sm-9">
                    <input name="rut" data-rel="tooltip" type="text" id="rut" placeholder="Rut estudiante" class="col-xs-10 col-sm-6" value="<?php echo $rut; ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio, formato 12345678-9" title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="nombres">Nombres: </label>
                <div class="col-sm-9">
                    <input name="nombres" data-rel="tooltip" type="text" id="nombres" placeholder="Nombres" class="col-xs-10 col-sm-6" value="<?php echo $nombres; ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio" title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="apellido_p">Apellido paterno: </label>
                <div class="col-sm-9">
                    <input name="apellido_p" maxlength="200" data-rel="tooltip" type="text" id="apellido_p" placeholder="Apellido paterno" class="col-xs-10 col-sm-6" value="<?php echo $apellido_p; ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="apellido_m">Apellido materno: </label>
                <div class="col-sm-9">
                    <input name="apellido_m" maxlength="200" data-rel="tooltip" type="text" id="apellido_m" placeholder="Apellido materno" class="col-xs-10 col-sm-6" value="<?php echo $apellido_m; ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="nacimiento">Nacimiento: </label>
                <div class="col-sm-9">
                    <input name="nacimiento" data-rel="tooltip" type="date" id="nacimiento" class="col-xs-10 col-sm-6" value="<?php echo $nacimiento; ?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <h3 class="header smaller lighter green">Información academica</h3>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="colegios">Colegios: </label>
                <div class="col-sm-9">
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

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="curso">Curso: </label>
                <div class="col-sm-9">
                    <div class="col-xs-10 col-sm-6">
                        <select id="cursosselect" name="cursosselect" class="chosen-select form-control">
                            <option value="" ></option>
                        </select>
                    </div>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorio." title="" data-original-title="Condiciones">?</span>
                </div>
            </div>

            <div class="clearfix form-actions center">
                <button class="btn btn-info" type="submit" name="finalizar">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Finalizar
                </button>
                <a href="<?= site_url("administrador/estudiantes")?>" class="btn btn-danger" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Cancelar
                </a>
            </div>

        </form>
    </div>  
</div>

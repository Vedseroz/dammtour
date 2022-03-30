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

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<?= $components->menu ?>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>

<div class="row">
    
    <div class="col-xs-12">
        <h1>Información de Denuncia </h1>
        <?= form_open_multipart(null, 'class="form-horizontal" role="form"') ?>
        <br>
        <br>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="titulo">Título de denuncia:</label>
                <input name="titulo" data-rel="tooltip" readonly="readonly" type="text" id="titulo" class="col-md-2" value="<?= set_value('titulo', $actividad1d[0]->titulo) ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="denunciante">Nombre denunciante:</label>
                <input name="denunciante" data-rel="tooltip" readonly="readonly" type="text" id="denunciante" placeholder="" class="col-md-2" value="<?= set_value('denunciante', $actividad1d[0]->denunciante) ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="RUC">RUC:</label>
                <input name="RUC" data-rel="tooltip" readonly="readonly" type="text" id="RUC" placeholder="" class="col-md-2" value="<?= set_value('RUC', $actividad1d[0]->RUC) ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="asignar">Asignado: </label>
                <input name="asignado" data-rel="tooltip" readonly="readonly" type="text" id="asignado" placeholder="" class="col-md-2" value="<?= set_value('asignado', $actividad1d[0]->asignado) ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="denuncia">Denuncia:</label>
                <textarea name="denuncia" maxlength="255" readonly="readonly" data-rel="tooltip" type="text" id="denuncia" rows="5" class="col-md-6"><?php echo $actividad1d[0]->denuncia ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label " for="tipo">Tipo: </label>
                <label class="col-md-1 control-label"><?php if($actividad1d[0]->tipo == 1){ echo "Interno"; }else{ echo "Externo"; } ?>
                </label> 
            </div>
        </div>
 
            <div class="clearfix form-actions center">
                <a href="<?= site_url("inicio/index")?>" class="btn btn-success" type="reset">
                    <i class="ace-icon bigger-110"></i>
                    Regresar
                </a>
            </div>
        </form>
    </div>  
</div>

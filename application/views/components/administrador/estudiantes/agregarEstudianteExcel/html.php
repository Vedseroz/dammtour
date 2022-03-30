<h2>Registrar estudiante por ecxel</h2>
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Cargar Excel</h4>
            </div>
    
            <div class="widget-body">
                <div class="widget-main">
                    <?= $messages ?>
                    <?= form_open_multipart('Administrador/cargaExcel', 'class="form-horizontal" role="form"'); ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="colegios">Colegios: </label>
                            <div class="col-sm-7">
                                <select id="colegiosselect" name="colegiosselect" class="chosen-select form-control">
                                    <option value="" ></option>
                                    <?php foreach($colegios as $key => $value): ?>
                                    <option value="<?= $value->id ?>" ><?= $value->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="curso">Curso: </label>
                            <div class="col-sm-7">
                                <select id="cursosselect" name="cursosselect" class="chosen-select form-control">
                                    <option value="" ></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="xlsx" type="file" id="id-input-file" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="submit" class="btn btn-primary btn-block" value="Cargar">
                            </div>
                        </div>
                        <label>
                            <span class="lbl"> El excel seleccionado para cargar debe tener la estructura señalada por el template.</span>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Template Excel</h4>
            </div>
    
            <div class="widget-body">
                <div class="widget-main">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <a href="<?= site_url('Administrador/template_xlsx') ?>" class="btn btn-primary btn-block">Descargar</a>
                        </div>
                    </div>
                    <br><br>
                    <label>
                        <span class="lbl"> Descargar el template.</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

</div>
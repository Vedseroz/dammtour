<h2>Administracción cuentas de estudiantes y apoderados</h2>

<div class="row col-xs-12">
    <h3 class="header smaller lighter green">Crear cuenta nueva de estudiante</h3>
    <p></p>
    <a href="<?= site_url('administrador/add_estudiante') ?>" class="btn btn-app btn-success">
        <i class="ace-icon fa fa-graduation-cap bigger-230"></i>
        Estudiante
    </a>
    <p></p>
</div>


<div class=" row col-xs-12">
    <h3 class="header smaller lighter green">Cuentas activas</h3>

    <div class="col-xs-12">
        <?php if(!empty($messages)): ?>
             <?= $messages ?>
        <?php endif; ?>
        <br>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="delete-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="delete-modal-label">Eliminar Estudiante</span></h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que quieres eliminar el estudiante, rut: <b><span class="delete-modal-codigo"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" data-loading-text="Cargando..." class="btn btn btn-danger loading-delete-btn" id="deleteButton">Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
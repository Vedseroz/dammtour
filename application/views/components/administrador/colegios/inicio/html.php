<h2>Administracción de colegios y cursos</h2>

<div class="row col-xs-12">
    <h3 class="header smaller lighter green">Registrar un colegio</h3>
    <p></p>
    <a href="<?= site_url('administrador/add_colegio/') ?>" class="btn btn-app btn-success">
        <i class="ace-icon fa fa-university bigger-230"></i>
        Colegio
    </a>
    <p></p>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
        <h3 class="header smaller lighter green">Colegios registrados</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
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
                <h4 class="modal-title" id="delete-modal-label">Eliminar colegio</span></h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que quieres eliminar el colegio, código: <b><span class="delete-modal-codigo"></span></b>?</p>
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
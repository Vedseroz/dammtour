<dir class="row center">
    <h2>Lista de estudiantes <?= $nombreCurso?></h2>
    <a class="btn btn-app btn-success no-click">
        <i class="ace-icon fa fa-users bigger-230"></i>
        Curso
    </a>
</dir>
<div class="col-sm-12">
    <div class="widget-box">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title">Detalles de boton ELIMINAR:</h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-unstyled spaced2">
                            <li class="text-warning bigger-110 orange">
                                <i class="ace-icon fa fa-trash-o"></i>
                                El botón eliminar de esta sección solo desvincula al estudiante del curso, pero mantiene su información y cuentas.
                            </li>                   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.col -->
<div class="row">
    <div class="col-xs-12">
        <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
        <h3 class="header smaller lighter green">Estudiantes registrados</h3>
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
                <h4 class="modal-title" id="delete-modal-label">Eliminar estudiante del curso</span></h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que quieres eliminar el estudiante, RUT: <b><span class="delete-modal-codigo"></span></b>?</p>
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
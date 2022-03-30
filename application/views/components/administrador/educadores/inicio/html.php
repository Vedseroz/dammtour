<h2>Administracción cuentas de funcionarios.</h2>

<div class="row col-xs-12">
	<h3 class="header smaller lighter green">Crear cuenta nueva, Seleccione un tipo de cuenta:</h3>
	<p></p>
	<a href="<?= site_url('administrador/createAdmin') ?>" class="btn btn-app btn-success">
		<i class="ace-icon fa fa-shield bigger-230"></i>
		Admin
	</a>
	<a href="<?= site_url('administrador/createProfeJ') ?>" class="btn btn-app btn-primary">
		<i class="ace-icon fa fa-pencil bigger-230"></i>
		P. Jefe
	</a>
	<a href="<?= site_url('administrador/createPIE') ?>" class="btn btn-app btn-info">
		<i class="ace-icon fa fa-eraser bigger-230"></i>
		PIE
	</a>
	<a href="<?= site_url('administrador/createCC') ?>" class="btn btn-app btn-yellow">
		<i class="ace-icon fa fa-handshake-o bigger-230"></i>
		Comite C.
	</a>
	<a href="<?= site_url('administrador/createOri') ?>" class="btn btn-app btn-purple">
		<i class="ace-icon fa fa-ravelry bigger-230"></i>
		Orientador
	</a>
	<a href="<?= site_url('administrador/createDupla') ?>" class="btn btn-app btn-pink">
		<i class="ace-icon fa fa-paper-plane bigger-230"></i>
		Dupla SP
	</a>
	<p></p>
</div>

<div class="row col-xs-12">
	<h3 class="header smaller lighter green">Cuentas activas</h3>

	<div class="col-xs-12">
	    <?php if(!empty($messages)): ?>
	        <?= $messages ?>
	    <?php endif; ?>
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
                <h4 class="modal-title" id="delete-modal-label">Eliminar Usuario</span></h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que quieres eliminar el usuario, nombre: <b><span class="delete-modal-codigo"></span></b>?</p>
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
	

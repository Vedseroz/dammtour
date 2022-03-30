<dir class="row center">
	<h2>Administración de usuarios y establecimientos, Sistema de acompañamiento estudiantil</h2>

	<a class="btn btn-app btn-success no-click">
		<i class="ace-icon fa fa-shield bigger-230"></i>
		Admin
	</a>
</dir>


<div class="col-sm-12">
	<div class="widget-box">
		<div class="widget-header widget-header-flat">
			<h4 class="widget-title">Resumen:</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				<div class="row">
					<div class="col-xs-12">
						<ul class="list-unstyled spaced2">
							<li>
								<i class="ace-icon fa fa-circle green"></i>
								El sistema permite registrar los estudiantes y administrar las cuentas de usuarios para establecimientos que participan del proyecto de acompañamientos estudiantil.
							</li>

							<li class="text-warning bigger-110 orange">
								<i class="ace-icon fa fa-exclamation-triangle"></i>
								Para que un estudiante pueda ser asignado a un curso, se requiere que tanto el establecimiento como el curso se registren en la sección colegios.
							</li>					
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.col -->

<dir class="row center">
	<div class="col-sm-3">
		<h2>Profesores registrados</h2>

		<a class="btn btn-app btn-success no-click">
			<i class="ace-icon fa fa-user-plus bigger-230"></i>
			<?= $nProfesores ?>
		</a>
	</div>
	<div class="col-sm-3">
		<h2>Estudiantes registrados</h2>

		<a class="btn btn-app btn-success no-click">
			<i class="ace-icon fa fa-graduation-cap bigger-230"></i>
			<?= $nEstudiantes ?>
		</a>
	</div>
	<div class="col-sm-3">
		<h2>Colegios registrados</h2>

		<a class="btn btn-app btn-success no-click">
			<i class="ace-icon fa fa-university bigger-230"></i>
			<?= $nColegios ?>
		</a>
	</div>
	<div class="col-sm-3">
		<h2>Cursos registrados</h2>

		<a class="btn btn-app btn-success no-click">
			<i class="ace-icon fa fa-users  bigger-230"></i>
			<?= $nCursos ?>
		</a>
	</div>
</dir>
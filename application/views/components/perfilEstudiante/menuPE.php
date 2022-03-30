
<div class="row">
    <div class="col-md-1"></div>
    <div class="clearfix center col-md-10">
        <a href="<?= site_url('perfilEstudiante/mostrar/'. $estudiante[0]->id)?>" class="<?= $menuPEselect == 1 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-home bigger-110"></i>
                Perfil General
        </a>
        <a href="<?= site_url('perfilEstudiante/infoPersonal/'. $estudiante[0]->id)?>" class="<?= $menuPEselect == 2 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-book bigger-110"></i>
                Info. Personal
        </a>
        <a href="<?= site_url('perfilEstudiante/infoAcademica/'. $estudiante[0]->id)?>" class="<?= $menuPEselect == 3 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-graduation-cap bigger-110"></i>
                Info. Academica
        </a>
        <a href="<?= site_url('perfilEstudiante/seguimientos/'. $estudiante[0]->id)?>" class="<?= $menuPEselect == 4 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Seguimientos
        </a>
    </div>
</div>
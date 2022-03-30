<div class="row">
    <div class="col-md-2"></div>
    <h2 class="col-md-8 center" ><?= $tituloMenuDPE ?></h2>
</div> 

<div class="row linea-separadora">
        <div class="col-lg-12">
            <hr size="8px" color="black" />
        </div>
</div> 

<div class="row">
    <div class="clearfix center col-md-10">
        <a href="<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id. '/'. $id_ctrz .'/1') ?>" class="<?= $menuDPEselect == 1 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Primera Actividad
        </a>
        <a href="<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id. '/'. $id_ctrz .'/2') ?>" class="<?= $menuDPEselect == 2 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Segunda Actividad
        </a>
        <a href="<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id. '/'. $id_ctrz .'/3') ?>" class="<?= $menuDPEselect == 3 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Tercera Actividad
        </a>
        <a href="<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id. '/'. $id_ctrz .'/4') ?>" class="<?= $menuDPEselect == 4 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Cuarta Actividad
        </a>
        <a href="<?= site_url("perfilEstudiante/mostrarprocedimientos/" . $estudiante[0]->id. '/'. $id_ctrz .'/5') ?>" class="<?= $menuDPEselect == 5 ? 'btn btn-success' : 'btn btn-info' ?>">
            <i class="ace-icon fa fa-pencil bigger-110"></i>
                Quinta Actividad
        </a>
    </div>

    <div class="form-group">
        <a href="<?= site_url('perfilEstudiante/seguimientos/'. $estudiante[0]->id)?>" class="col-md-1.5 btn btn-info">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Regresar
        </a>
    </div>
</div>

<div class="row linea-separadora">
        <div class="col-lg-12">
            <hr size="8px" color="black" />
        </div>
</div> 
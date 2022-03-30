<div class="clearfix  center col-xs-12">
    <h2><?php echo $nombre.", Codigo: ". $codigo?></h2>
    <i class="ace-icon fa fa-check fa-5x"></i>
    <h2>Se edito correctamente</h2>

    <div class="row">
        <a href="<?= site_url('Administrador/show_colegio/'. $id_colegio)?>" class="btn btn-info">
            <i class="ace-icon fa fa-undo bigger-110"></i>
                Regresar
        </a>
    </div>
</div>


<?= $components->infoBasica ?>

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">Reportes de procedimientos</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div>  

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">Reportes de Derivaciones</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container2"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table2" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div> 

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">Reportes de Habilidades y talentos</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container2"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table4" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">Reportes de emociones y georeferencia</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container2"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->

        <div>
            <table id="dynamic-table5" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">Reportes Externos</h3>
        <div class="clearfix">
            <div class="pull-right tableTools-container3"></div>
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        
        <div>
            <table id="dynamic-table3" class="table table-striped table-bordered table-hover"></table>
        </div>
    </div>
</div> 

<br/>
<br/>

<div class="col-xs-12">
    <h3 class="header smaller lighter green">Subir reporte o documento externo:</h3>
    <?=form_open(site_url('Reportes_Profesor_Jefe/Reportes_extra/'.$estudiante[0]->id), 'class="form-horizontal" role="form" enctype="multipart/form-data"')?>
        <div class="form-group">
            <div class="col-xs-5">
                <input type="file" class="form-control" name="File" id="id-input-file">
            </div>
            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Obligatorios." title="" data-original-title="Condiciones">?</span>
        </div>
        <button class="btn btn-info" type="submit" name="finalizar">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Enviar
            </button>
    </form>
</div>  
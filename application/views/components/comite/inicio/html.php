<dir class="row center">
    <h1> <?php echo $colegio_nombre; ?></h1>   
</dir>

<h3 class="header smaller lighter green">Información general</h3>
<dir class="row center">
    <div class="col-sm-4">
        <h2>Procedimientos activos</h2>

        <a class="btn btn-app btn-success">
            <i class="ace-icon fa fa-list-alt bigger-230"></i>
            <?= $nCrtz ?>
        </a>
    </div>
    <div class="col-sm-4">
        <h2>Derivaciónes activas</h2>

        <a class="btn btn-app btn-success">
            <i class="ace-icon fa fa-indent bigger-230"></i>
            <?= $nDrv ?>
        </a>
    </div>
    <div class="col-sm-4">
        <h2>Estudiantes supervizados</h2>

        <a class="btn btn-app btn-success">
            <i class="ace-icon fa fa-graduation-cap bigger-230"></i>
            <?= $nEst ?>
        </a>
    </div>
</dir>


<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter green">procedimientos activos</h3>
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
        <h3 class="header smaller lighter green">Derivaciones activas</h3>
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
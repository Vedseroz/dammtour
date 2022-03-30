<div id="sidebar" class="sidebar responsive ace-save-state" data-sidebar="true" data-sidebar-scroll="true"
    data-sidebar-hover="true">

    <script type="text/javascript">
        try { ace.settings.loadState('sidebar') } catch (e) { }
    </script>

	<!-- Menú -->
    <ul class="nav nav-list" style="top: 0px;">
    	<!-- Item: Inicio -->
        <li class="<?= array('inicio') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('/') ?>">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> Inicio </span>
            </a>
            <b class="arrow"></b>
        </li>

        <!-- procedimientos -->
        <li class="<?= array('procedimientos') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('procedimientos') ?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Procedimientos </span>
            </a>

            <b class="arrow"></b>
        </li>

        <!-- Derivacion 
        <li class="<?= array('derivacion') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('derivacion') ?>">
                <i class="menu-icon fa fa-indent "></i>
                <span class="menu-text"> Derivación </span>
            </a>

            <b class="arrow"></b>
        </li>   
        -->
        <!-- Perfil Estudiante 
        <li class="<?= array('perfil_estudiante') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('perfilEstudiante/buscar') ?>">
                <i class="menu-icon fa fa-graduation-cap"></i>
                <span class="menu-text"> Perfil Estudiante </span>
            </a>

            <b class="arrow"></b>
        </li>  		
        -->
        <!-- Reportes 
        <li class="<?= array('Reportes') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('Estudiantes') ?>">
                <i class="menu-icon fa fa-file"></i>
                <span class="menu-text"> Reportes </span>
            </a>

            <b class="arrow"></b>
        </li> 
        -->      
</div>
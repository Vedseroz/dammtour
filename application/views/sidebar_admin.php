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

        <!-- Educadores -->
        <li class="<?= array('educadores') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('administrador/educadores') ?>">
                <i class="menu-icon fa fa-user-plus"></i>
                <span class="menu-text"> Educadores </span>
            </a>

            <b class="arrow"></b>
        </li>

        <!-- Estudiantes -->
        <li class="<?= array('estudiantes') === array_slice($menu_items, 0, 1) ? 'active open' : '' ?>">
            <a href="<?= site_url('administrador/estudiantes') ?>">
                <i class="menu-icon fa fa-graduation-cap"></i>
                <span class="menu-text"> Estudiantes </span>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <!-- Lista -->
                <li class="<?= array('estudiantes', 'lista') === array_slice($menu_items, 0, 2) ? 'active' : '' ?>">
                    <a href="<?= site_url('administrador/estudiantes') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Lista
                    </a>

                    <b class="arrow"></b>
                </li>
                <!-- Excel -->
                <li class="<?= array('estudiantes', 'excel') === array_slice($menu_items, 0, 2) ? 'active' : '' ?>">
                    <a href="<?= site_url('administrador/estudiantesExcel') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Carga por Excel
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>

        </li>   

        <!-- Colegios -->
        <li class="<?= array('colegios') === array_slice($menu_items, 0, 1) ? 'active' : '' ?>">
            <a href="<?= site_url('administrador/colegios') ?>">
                <i class="menu-icon fa fa-university"></i>
                <span class="menu-text"> Colegios </span>
            </a>

            <b class="arrow"></b>


        </li>

		
</div>
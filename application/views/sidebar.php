<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php site_url('inicio')?>" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light center"><img src="../assets/img/LOGO.png" width="90%" height="10%"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Usuario: <?= $_SESSION['identity'];?> </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-info-circle nav-icon"></i>
                  <p>Resumen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('pasajero');?>" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Pasajero</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('transfer');?>" class="nav-link">
                  <i class="fa fa-taxi nav-icon"></i>
                  <p>Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('chofer');?>" class="nav-link">
                  <i class="fa fa-id-card nav-icon"></i>
                  <p>Chofer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('vehiculo');?>" class="nav-link">
                  <i class="fa fa-car nav-icon"></i></i>
                  <p>Vehiculos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('hospedaje')?>" class="nav-link">
                  <i class="fa fa-building nav-icon"></i>
                  <p>Hospedajes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-location-arrow nav-icon"></i>
                  <p>Tours</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('costo');?>" class="nav-link">
                  <i class="fa fa-dollar-sign nav-icon"></i>
                  <p>Costo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-question-circle nav-icon"></i>
                  <p>Informes</p>
                </a>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- /.contro
<dir class="row center">
    <h2>Informacón de estudiante</h2>
    <a class="btn btn-app btn-success no-click">
        <i class="ace-icon fa fa-graduation-cap bigger-230"></i>
        Estudiante
    </a>
</dir>

<h3 class="header smaller lighter green">Información personal</h3>

<div class="row col-lg-3">
    <img  class="row col-lg-12"  height="180" width="180" src="<?= isset($avatarE) ? base_url($avatarE) : base_url('assets/images/avatars/alumno.jpeg') ?>" alt="Foto de estudiante">
</div>


<div class="col-xs-12 col-sm-9">
    <div class="profile-user-info profile-user-info-striped">

        <div class="profile-info-row">
            <div class="profile-info-name"> RUT </div>

            <div class="profile-info-value">
                <span class="editable" id="country"><?= $rut ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Nombres </div>

            <div class="profile-info-value">
                <span class="editable" id="country"><?= $nombres ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Apellidos </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?= $apellidos ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Nacimiento </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?= $nacimiento ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Colegio</div>

            <div class="profile-info-value">
                <span class="editable" id="signup"><?= $colegio ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Curso </div>

            <div class="profile-info-value">
                <span class="editable" id="login"><?= $curso ?></span>
            </div>
        </div>

    </div>
</div>

<div class="row linea-separadora">
    <div class="col-lg-12">
        <h3 class="header smaller lighter green">Información de cuentas</h3>
    </div>
</div>

<div class="row linea-separadora">
    <?php if(!empty($messages)): ?>
                <?= $messages ?>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">
                    Estado cuenta de estudiante
                    <small><?php if(empty($user_id)) echo '<p style="color:rgba(54, 162, 235,1)"> Sin cuenta</p>'; else echo '<p style="color:rgba(75, 100, 51,1)"> CREADA</p>'; ?></small>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p class="muted">
                        <ul>
                            <li> <b> Username: </b> <?= $eUsername ?></li>

                            <li> <b> Email: </b> <?= $eEmail ?></li>
                        </ul>
                    </p>
                    <hr />
                    <p>
                        <a href="<?= site_url('Administrador/editCuentaE/'. $id_estudiante . '/' . $id_cuenta) ?>"><span class="btn btn-info btn-sm tooltip-info" data-rel="tooltip" data-placement="bottom" title="Modificar">Modificar</span></a>
                    </p>
                </div>
            </div>
        </div>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">
                    Estado cuenta de apoderado
                    <small><?php if(empty($apoderado_user_id)) echo '<p style="color:rgba(54, 162, 235,1)"> Sin cuenta</p>'; else echo '<p style="color:rgba(75, 100, 51,1)"> CREADA</p>'; ?></small>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p class="muted">
                        <ul>
                            <li> <b> Username: </b> <?= $aUsername ?></li>

                            <li> <b> Email: </b> <?= $aEmail ?></li>
                        </ul>
                    </p>
                    <hr />
                    <p>
                        
                        <a href="<?= site_url('Administrador/editCuentaA/'. $id_estudiante . '/' . $apoderado_user_id) ?>"><span class="btn btn-info btn-sm tooltip-info" data-rel="tooltip" data-placement="bottom" title="Modificar">Modificar</span></a>                   
                    </p>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
</div>
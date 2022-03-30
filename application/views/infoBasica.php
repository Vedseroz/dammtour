<div class="row info-basica col-lg-12">  
    <div class="row col-lg-2">
        <img  class="row col-lg-12"  height="130" width="100" src="<?= isset($avatarE) ? base_url($avatarE) : base_url('assets/images/avatars/alumno.jpeg') ?>" alt="Foto de estudiante">
    </div>

<div class="col-lg-9">

    <div class="profile-user-info profile-user-info-striped">

        <div class="profile-info-row">
            <div class="profile-info-name"> <b>Nombre:</b> </div>

            <div class="profile-info-value">
                <span class="editable" id="country"><?php echo $estudiante[0]->nombres ?>&nbsp<?php echo $estudiante[0]->apellido_p ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <b> RUT: </b> </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?php echo $estudiante[0]->rut ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <b>Colegio:</b> </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?php echo $colegio[0]->nombre ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <b> Curso: </b> </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?php echo $curso[0]->codigo ?></span>
            </div>
        </div>
    </div>
</div>
    <div class="row linea-separadora">
            <div class="col-lg-12">
                <hr size="8px" color="black" />
            </div>
    </div>
</div>
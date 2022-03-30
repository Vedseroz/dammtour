<div class="clearfix  center col-md-12">
    <a <?php 
            if($etapa > 1) echo 'href="'.site_url('derivacionA/Usuario1mostrar/'. $estudiante[0]->id . '/' . $id_drvz).'"';
        ?>class="btn btn-info">
        <i class="ace-icon fa fa-check bigger-110"></i>
        Actividad 1
    </a>

    <a class="btn btn">
            <table>
                <td>
            <i class="ace-icon fa fa-question-circle bigger-210">&nbsp</i>
                </td>
                <td>
                    <?php
                        if($tipo == 0) echo 'Primera Derivación <br> En espera';
                        if($tipo == 1) echo 'Primera Derivación <br> Habilidad/Talento';
                        if($tipo >= 2) echo 'Primera Derivación <br> Conductual';
                    ?>
             </td>
            </table>
        </a>
        <a href="
            <?php
                if($tipo == 1) echo site_url('derivacionA11/Usuario1Espera/'. $estudiante[0]->id . '/' . $id_drvz );
                if($tipo == 2 ){
                    if($estado_act == 0){
                        echo site_url('derivacionA21/Usuario1Espera/'. $estudiante[0]->id . '/' . $id_drvz );
                    }
                }
                if($tipo >=  3){
                    echo site_url('derivacionA21/Usuario1Mostrar/'. $estudiante[0]->id . '/' . $id_drvz );}

            ?>"
        class="
            <?php
                if($etapa == 0){
                    echo 'btn btn-warning';
                    }else{
                if($etapa == 2){
                    echo 'btn btn-success';
                }else echo 'btn btn-info';}

            ?>
        ">
            <i class="ace-icon fa <?php
                if($etapa == 0){
                    echo 'fa-pause';
                    }else{
                if($etapa == 2){
                    echo 'fa-refresh';
                }else echo 'fa-check';}

            ?> bigger-110"></i>
                Actividad 2
        </a>
        <?php 
        if($tipo >=2){
            $nombre_bt = '';
            if($tipo == 2) $nombre_bt = 'Segunda Derivación <br> En espera';
            if($tipo == 3) $nombre_bt = 'Segunda Derivación <br> Mediación Escolar';
            if($tipo == 4) $nombre_bt = 'Segunda Derivación  <br> Red Interna';
            if($tipo == 5) $nombre_bt = 'Segunda Derivación  <br> Red Externa';
            echo '<a class="btn btn"> <table> <td> <i class="ace-icon fa fa-question-circle bigger-210">&nbsp</i> </td> <td>' .$nombre_bt. '</td> </table> </a>' ;
            if($tipo == 2)  echo ' <a class="btn btn-warning"> <i class="ace-icon fa fa-pause bigger-110"></i> Actividad 3 </a>';

            if ($tipo == 3){
                if($etapa == 3){
                    $link_act3 = '';
                    $link_act3 = site_url('derivacionA22/Usuario1Espera/'. $estudiante[0]->id . '/' . $id_drvz );
                    echo ' <a href="'.$link_act3.'" class="btn btn-success"> <i class="ace-icon fa fa-refresh bigger-110"></i> Actividad 3 </a>';
                    echo ' <a class="btn btn-warning"> <i class="ace-icon fa fa-pause bigger-110"></i> Actividad 4 </a>';
                }
                if ($etapa == 4){
                    $link_act4 = site_url('derivacionA23/Usuario1Ing/'. $estudiante[0]->id . '/' . $id_drvz );
                    $link_act3 = site_url('derivacionA22/Usuario1Mostrar/'. $estudiante[0]->id . '/' . $id_drvz );
                    echo ' <a href="'.$link_act3.'" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Actividad 3 </a>';
                    echo ' <a href="'.$link_act4.'" class="btn btn-success"> <i class="ace-icon fa fa-refresh bigger-110"></i> Actividad 4 </a>';
                }
                if ($etapa == 5){
                    $link_act4 = site_url('derivacionA23/Usuario1Mostrar/'. $estudiante[0]->id . '/' . $id_drvz );
                    $link_act3 = site_url('derivacionA22/Usuario1Mostrar/'. $estudiante[0]->id . '/' . $id_drvz );
                    echo ' <a href="'.$link_act3.'" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Actividad 3 </a>';
                    echo ' <a href="'.$link_act4.'" class="btn btn-success"> <i class="ace-icon fa fa-refresh bigger-110"></i> Actividad 4 </a>';
                }
            }
            if ($tipo == 4){
                $link_act3 = site_url('derivacionA31/Usuario1Espera/'. $estudiante[0]->id . '/' . $id_drvz );
                echo ' <a href="'.$link_act3.'" class="btn btn-success"> <i class="ace-icon fa fa-refresh bigger-110"></i> Actividad 3 </a>';
            }
            if ($tipo == 5){
                $link_act3 = site_url('derivacionA32/Usuario1Espera/'. $estudiante[0]->id . '/' . $id_drvz );
                echo ' <a href="'.$link_act3.'" class="btn btn-success"> <i class="ace-icon fa fa-refresh bigger-110"></i> Actividad 3 </a>';
            }
        }
        ?>
</div>
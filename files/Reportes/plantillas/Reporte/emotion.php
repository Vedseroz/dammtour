  <?php

  function MorePlantilla($estudiantes= null, $hoy, $id = null, $emo = null, $ids = null){ 

  $plantilla = '<body>
      <header class="clearfix">
        <div id="logo">
          <img src="files/Reportes/img/logo.jpg">
        </div>';
        $plantilla .='<br>
        <br>
        <div id="company" class="clearfix">
          <div>Corporación Municipal de Valparaíso</div>
          <div>Eleuterio Ramirez 455</div>
          <div><a href="mailto:acomitil@cmvalparaiso.cl">acomitil@cmvalparaiso.cl</a></div>
          <br>';
        $plantilla .='<h1>Histórico de emociones</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiantes[2]." ".$estudiantes[3]." ".$estudiantes[4].'</div>';
        $plantilla .= '<div id="project"><span>RUT </span>'.$estudiantes[1].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
        </div>
      </header>
      <main>
      <h1>Histórico de emociones</h1>
      <p>Se consideran los 10 últimos procedimiento comenzando desde la última realizada (código '.$id.'), siendo esta, la más reciente.</p>
      <br>
        <table>
          <thead>
            <tr>
              <th class="campos">FECHA</th>
              <th class="Respuestas">EMOCIÓN</th>
            </tr>
          </thead>
          <tbody>';
          if(!empty($ids) || !empty($emo)){
            for ($x=0; $x < count($ids); $x++){
              $plantilla .= '<tr>
                <td class="Campos">';
              $plantilla .= $ids[$x].'</td>
                <td class="Respuestas">';
              if($emo[$x] == 1) : 
                $plantilla .= '<img id="joy" alt="Alegre" src="assets/images/emociones/joy.png"/><br>Alegre</td>';
              elseif($emo[$x] == 2) :
                $plantilla .= '<img id="sad" alt="Triste" src="assets/images/emociones/sad.png"/><br>Triste</td>';
              elseif($emo[$x] == 3) :
                $plantilla .= '<img id="mad" alt="Enojado" src="assets/images/emociones/mad.png"/><br>Enojado</td>';
              elseif($emo[$x] == 5) : 
                $plantilla .= '<img id="Preocupado" alt="Preocupado" src="assets/images/emociones/worry.png"/><br>Preocupado</td>';
              endif;
              $plantilla .= '</tr>';
            }
          }
          $plantilla .= '</tbody>
        </table>
      </main>
    </body>';
    return $plantilla;
  }
?>

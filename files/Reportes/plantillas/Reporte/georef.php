  <?php

  function getPlantilla($estudiantes= null, $direcciones = null, $fechas = null, $hoy){ 

  $plantilla = '<body>
      <header class="clearfix"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
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
        $plantilla .='<h1>Reporte de Georeferencia</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiantes[2]." ".$estudiantes[3]." ".$estudiantes[4].'</div>';
          $plantilla .= '<div id="project"><span>RUT </span>'.$estudiantes[1].'</div>';
          $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
        </div>
      </header>
      <main>
      <h1>Actualizaciones de dirección hasta la fecha</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">DIRECCIÓN</th>
              <th class="campos">A LA FECHA</th>
            </tr>
          </thead>
          <tbody>';
            if(!empty($direcciones)){
              for ($x=0; $x < count($direcciones); $x++){
                $plantilla .= '<tr>
                <td class="Respuestas">';
                $plantilla .= $direcciones[$x].'</td>
                <td class="Respuestas">';
                $plantilla .= $fechas[$x].'</td>
                </tr>';
              }
            }else{
              $plantilla .= '<td>No hay direcciones registradas</td>
              <td>No hay cambios</td>';
            }
          $plantilla .= '</tbody>
        </table>
      </main>
    <footer>
    </footer>
  </body>';
  return $plantilla;
  }
?>

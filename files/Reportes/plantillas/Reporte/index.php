<?php

  function getPlantilla($estudiantes= null, $id_procedimientos= null, $actividad1d = null, $hoy = null, $listaTest = null, $listaColegios = null, $listaCursos = null, $id_estudiante = null){ 

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
        $plantilla .='<h1>Código de Procedimiento: '.$actividad1d['id_procedimientos'].'</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiantes['nombres']." ".$estudiantes['apellido_p']." ".$estudiantes['apellido_m'].'</div>';
        $plantilla .= '<div id="project"><span>RUT </span>'.$estudiantes['rut'].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
      </header>
      <main>
      <h1>Información básica del estudiante</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAMPOS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">FECHA DE NACIMIENTO</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['nacimiento'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">DIRECCIÓN</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['direccion'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">APODERADO TUTOR</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['apoderado'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">APODERADO SUPLENTE</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['apoderado_s'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">CESFAM</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['cesfam'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">ENFERMEDADES</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['enfermedades'].'</td>';
            $plantilla .= '</tr>
            <tr>  
              <td class="campos">ALERGIAS</td>
              <td class="Respuestas">';
              $plantilla .= $estudiantes['alergias'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Información Social del estudiante</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAMPOS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">INGRESO FAMILIAR</td>
              <td class="Respuestas">';
              $plantilla .= $actividad1d['ingreso'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">NÚMERO DE INTEGRANTES</td>
              <td class="Respuestas">';
              $plantilla .= $actividad1d['integrantes'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">NÚMERO DE HABITACIONES</td>
              <td class="Respuestas">';
              $plantilla .= $actividad1d['habitaciones'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">SERVICIOS BÁSICOS</td>
              <td class="Respuestas">';
              $plantilla .= $actividad1d['servicios'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Información adicional</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAMPOS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">REQUIERE APOYO ESPECIALIZADO</td>
              <td class="Respuestas">';
              $plantilla .= $actividad1d['RAE'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">PREFERENTE</td>
              <td class="Respuestas">';
               if($actividad1d['preferente'] == 1 ) {
                $plantilla .= 'SI</td>';
              }else{
                $plantilla .= 'NO</td>';
              }
            $plantilla .= '</tr>
            <tr>
              <td class="campos">LISTAS DE TEST</td>
              <td class="Respuestas">';
              if(!empty($listaTest)){
                for ($x=0; $x < count($listaTest); $x++){
                  $plantilla .= $listaTest[$x]['lista_test'].'<br>';
                }
                $plantilla .= '</td>';
              }else{
                $plantilla .= 'NO HAY LISTAS</td>';
              }
              $plantilla .='</tr>
          </tbody>
        </table>
        <br>';
        if(!empty($listaColegios)){
          $plantilla .='<h1>Información Académica</h1>
          <table>
            <thead>
              <tr>
                <th class="campos">CAMPOS</th>
                <th class="Respuestas">RESPUESTAS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="campos">COLEGIO(s) ANTERIOR(es)</td>
                <td class="Respuestas">';
                  for ($x=0; $x < count($listaColegios); $x++){
                      $plantilla .= $listaColegios[$x]['nombre_colegio'].'<br>';
                  }
                  $plantilla .= '</td>
              </tr>
            </tbody>
          </table>';
        }
        $plantilla .= '<br>';
        if(!empty($listaCursos)){
        $plantilla .= '<h1>Cursos Repetidos</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAUSA</th>
              <th class="Respuestas">CURSO</th>
            </tr>
          </thead>
          <tbody>';
            for ($x=0; $x < count($listaCursos); $x++) {
              $plantilla .= '<tr>
              <td class="campos">'.$listaCursos[$x]['causa'].'</td>
              <td class="Respuestas">'.$listaCursos[$x]['curso'].'</td>
              </tr>';
            }
            $plantilla .= '
          </tbody>
        </table>';
        }
      $plantilla .= '</main>
    </body>';
    return $plantilla;
  }
?>
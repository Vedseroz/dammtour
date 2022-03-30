<?php

  function getPlantilla($actividad5d = null, $estudiante = null, $hoy = null, $nombre = null, $profe = null){ 

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
          <br>';
        $plantilla .='<h1>Código de Procedimiento: '.$actividad5d['id_procedimientos'].'</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiante[2]." ".$estudiante[3]." ".$estudiante[4].'</div>';
        $plantilla .= '<div id="project"><span>RUT </span>'.$estudiante[1].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>  
        <br>';
        $plantilla .= '<div id="project"><span>Procedimiento completado por </span>';
        if($profe){
          $plantilla .= 'PROFESOR: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        }else{
          $plantilla .='APODERADO: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        }
        $plantilla .= '</div>
      </header>
      <main>
      <h1>Descripción familiar</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">PREGUNTAS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">1. ¿Quién soy?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta1'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">2. ¿Qué pienso de mi entorno social y familiar?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta2'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">3. ¿Cómo veo al estudiante?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta3'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">4. ¿Cómo apoyo al estudiante?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta4'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">5. ¿En qué me comprometo con el desarrollo del estudiante?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta5'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">6. ¿Cómo me siento integrado al colegio?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta6'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">7. ¿Cómo espero ser tratado en el colegio?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta7'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">8. ¿Cómo aporto al colegio?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta8'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">9. ¿Relate una experiencia positiva con el Usuario 1?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad5d['pregunta9'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
      </main>
    </body>';
    return $plantilla;
  }
?>
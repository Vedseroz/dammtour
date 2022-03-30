<?php

  function getPlantilla($actividad3d = null, $estudiante = null, $hoy = null, $nombre = null, $apoyos = null){ 

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
        $plantilla .='<h1>Código de Procedimiento: '.$actividad3d['id_procedimientos'].'</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiante[2]." ".$estudiante[3]." ".$estudiante[4].'</div>';
        $plantilla .= '<div id="project"><span>RUT </span>'.$estudiante[1].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>  
        <br>';
        $plantilla .= '<div id="project"><span>Procedimiento completado por </span> PROFESOR: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        $plantilla .= '</div>
      </header>
      <main>
      <h1>Información de habilidades del estudiante</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">PREGUNTAS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">1. Estilos de aprendizaje.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta1'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">2. Orientaciones Metodológicas.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta2'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">3. Descripción integración con pares.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta3'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">4. Descripción de interacción con adultos.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta4'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">5. Habilidades favorables.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta5'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">6. Habilidades desfavorables.</td>
              <td class="Respuestas">';
              $plantilla .= $actividad3d['pregunta6'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Vocación del estudiante</h1>
          <div>
            <p>';
            $plantilla .= $actividad3d['vocacion'].'</p>
          </div>
        <br>
        <h1>Perfil del estudiante</h1>
        <div>';
          if ($actividad3d['perfil'] == 1) {
            $plantilla .= '<p><strong>CIENTÍFICOS: </strong>Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
            <br>';
          }elseif($actividad3d['perfil'] == 2){
            $plantilla .= '<p><strong>EXPLORADORES: </strong>Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
            <br>';
          }elseif($actividad3d['perfil'] == 3){
            $plantilla .= '<p><strong>ARTESANOS: </strong>Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
            <br>';
          }elseif($actividad3d['perfil'] == 4){
            $plantilla .= '<p><strong>DEPORTISTAS: </strong>Interés por el deporte, la salud y la buena alimentación.</p>
            <br>';
          }elseif($actividad3d['perfil'] == 5){
            $plantilla .= '<p><strong>CREADORES: </strong>Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
            <br>';
          }
        $plantilla .= '</div>
        <h1>Habilidades y talentos del estudiante</h1>
        <div>
          <ul>';
            if($actividad3d['talento1'] != 'Sin Respuesta') 
              $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
              <br>';
            if($actividad3d['talento2'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
              <br>';
            if($actividad3d['talento3'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
              <br>';
            if($actividad3d['talento4'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
              <br>';
            if($actividad3d['talento5'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
              <br>';
            if($actividad3d['habilidad1'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
              <br>';
            if($actividad3d['habilidad2'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
              <br>';
            if($actividad3d['habilidad3'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
              <br>';
            if($actividad3d['habilidad4'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
              <br>';
            if($actividad3d['habilidad5'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
              <br>';
          $plantilla .= '</ul>
        </div>';
        if (!empty($apoyos)){
          $plantilla .= '<h1>Requiere de apoyo</h1>
            <table>
              <tbody>';
                for ($x=0; $x < count($apoyos); $x++){
                  $plantilla .= '<tr>
                  <td class="campos">REGISTRO: </td>
                  <td class="Respuestas">'.$apoyos[$x]['apoyo'].'</td>
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
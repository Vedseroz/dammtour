<?php
  
  function fraccion($profe = NULL, $nombre = NULL, $hoy = NULL, $actividad2d = NULL){ 

  $plantilla = '<body>
      <header class="clearfix">
        <div id="project">';
        $plantilla .= '<div id="project"><span>INGRESADO POR </span>';
        if($profe){
          $plantilla .= 'PROFESOR: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        }else{
          $plantilla .='ALUMNO: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        }
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
      </header>
      <main>
      <br>
      <h1>Información Autobiográfica del estudiante</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">PREGUNTAS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">1. ¿Quien soy?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta1'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">2. ¿Qué pienso de mi entorno social y familiar?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta2'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">3. ¿Cuáles son mis sueños?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta3'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">4. ¿Cómo me proyecto a futuro?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta4'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">5. ¿Cuáles creo que son mis fortalezas?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta5'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">6. ¿Qué espero de la escuela?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta6'].'</td>';
            $plantilla .= '</tr>
            <tr>  
              <td class="campos">7. ¿Cómo creo que es mi escuela?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta7'].'</td>';
            $plantilla .= '</tr>
            <tr>  
              <td class="campos">8. ¿Qué sentido tiene ir a la escuela?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta8'].'</td>';
            $plantilla .= '</tr>
            <tr>  
              <td class="campos">9. ¿Cómo me gustaría que me evalúen?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta9'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">10. ¿Cuál es mi asignatura preferida?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta10'].'</td>';
            $plantilla .= '</tr>
            <tr>  
              <td class="campos">11. ¿Cuál es mi asignatura menos preferida?</td>
              <td class="Respuestas">';
              $plantilla .= $actividad2d['pregunta11'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Estado de ánimo seleccionado</h1>
          <div align ="center">';
            if($actividad2d['emotion'] == 1) : 
              $plantilla .= '<img id="joy" alt="Alegre" src="assets/images/emociones/joy.png"/><br>Alegre';
            elseif($actividad2d['emotion'] == 2) :
              $plantilla .= '<img id="sad" alt="Triste" src="assets/images/emociones/sad.png"/><br>Triste';
            elseif($actividad2d['emotion'] == 3) :
              $plantilla .= '<img id="mad" alt="Enojado" src="assets/images/emociones/mad.png"/><br>Enojado';
            elseif($actividad2d['emotion'] == 5) : 
              $plantilla .= '<img id="Preocupado" alt="Preocupado" src="assets/images/emociones/worry.png"/><br>Preocupado';
            endif;
          $plantilla .= '</div>
        <br>
        <h1>Vocación del estudiante</h1>
          <div>
            <p>';
            $plantilla .= $actividad2d['vocacion'].'</p>
          </div>
        <br>
        <h1>Perfil del estudiante</h1>
        <div>';
          if ($actividad2d['perfil'] == 1) {
            $plantilla .= '<p><strong>CIENTÍFICOS: </strong>Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
            <br>';
          }elseif($actividad2d['perfil'] == 2){
            $plantilla .= '<p><strong>EXPLORADORES: </strong>Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
            <br>';
          }elseif($actividad2d['perfil'] == 3){
            $plantilla .= '<p><strong>ARTESANOS: </strong>Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
            <br>';
          }elseif($actividad2d['perfil'] == 4){
            $plantilla .= '<p><strong>DEPORTISTAS: </strong>Interés por el deporte, la salud y la buena alimentación.</p>
            <br>';
          }elseif($actividad2d['perfil'] == 5){
            $plantilla .= '<p><strong>CREADORES: </strong>Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
            <br>';
          }
        $plantilla .= '</div>
        <h1>Habilidades y talentos del estudiante</h1>
        <div>
          <ul>';
            if($actividad2d['talento1'] != 'Sin Respuesta') 
              $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
              <br>';
            if($actividad2d['talento2'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
              <br>';
            if($actividad2d['talento3'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
              <br>';
            if($actividad2d['talento4'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
              <br>';
            if($actividad2d['talento5'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
              <br>';
            if($actividad2d['habilidad1'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
              <br>';
            if($actividad2d['habilidad2'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
              <br>';
            if($actividad2d['habilidad3'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
              <br>';
            if($actividad2d['habilidad4'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
              <br>';
            if($actividad2d['habilidad5'] != 'Sin Respuesta')
              $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
              <br>';
          $plantilla .= '</ul>
        </div>';
        $plantilla .= '</main>
      <footer>
      </footer>
    </body>';
    return $plantilla;
  }
?>
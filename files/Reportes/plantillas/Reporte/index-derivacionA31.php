  <?php

  function getPlantilla($estudiante = null, $derivacion31 = null, $hoy = null){ 

  $plantilla = '<body>
      <header class="clearfix">
        <div id="logo">
          <img src="files/Reportes/img/logo.jpg">
        </div>
        <br>
        <br>
        <div id="company" class="clearfix">
          <div>Corporación Municipal de Valparaíso</div>
          <div>Eleuterio Ramirez 455</div>
          <div><a href="mailto:acomitil@cmvalparaiso.cl">acomitil@cmvalparaiso.cl</a></div>
          <br>';
        $plantilla .='<h1>Código de Derivación '.$derivacion31['id_derivacion'].'</h1>';
        $plantilla .= '</div>
        <div id="project">';
          $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiante[2]." ".$estudiante[3]." ".$estudiante[4].'</div>';
          $plantilla .= '<div id="project"><span>RUT </span>'.$estudiante[1].'</div>';
          $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
        </div>
      </header>
      <main>
      <h1>Evaluación de situación del estudiante</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAMPOS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">Actividades realizadas: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['actividades'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Duración: </td>
              <td class="Respuestas">';
              if($derivacion31['duracion'] == 1){
                $plantilla .= 'corto plazo </td>';
              }elseif ($derivacion31['duracion'] == 2) {
                $plantilla .= 'mediano plazo </td>';
              }elseif ($derivacion31['duracion'] == 3) {
                $plantilla .= 'largo plazo </td>';     
              }              
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Eficacia de las acciones realizadas: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['eficacia'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Acciones previas: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['acciones'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Intervenciones: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['intervenciones'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Instrumentos metodológicos: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['instrumentos'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Vocación del estudiante: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion31['vocacion'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Perfil del estudiante</h1>
        <div>';
          if ($derivacion31['perfil'] == 1) {
            $plantilla .= '<p><strong>CIENTÍFICOS: </strong>Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
            <br>';
          }elseif($derivacion31['perfil'] == 2){
            $plantilla .= '<p><strong>EXPLORADORES: </strong>Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
            <br>';
          }elseif($derivacion31['perfil'] == 3){
            $plantilla .= '<p><strong>ARTESANOS: </strong>Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
            <br>';
          }elseif($derivacion31['perfil'] == 4){
            $plantilla .= '<p><strong>DEPORTISTAS: </strong>Interés por el deporte, la salud y la buena alimentación.</p>
            <br>';
          }elseif($derivacion31['perfil'] == 5){
            $plantilla .= '<p><strong>CREADORES: </strong>Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
            <br>';
          }
        $plantilla .= '</div>
        <h1>Habilidades y talentos del estudiante</h1>
        <div>
          <ul>';
            if($derivacion31['talento1'] != NULL) 
              $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
              <br>';
            if($derivacion31['talento2'] != NULL)
              $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
              <br>';
            if($derivacion31['talento3'] != NULL)
              $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
              <br>';
            if($derivacion31['talento4'] != NULL)
              $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
              <br>';
            if($derivacion31['talento5'] != NULL)
              $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
              <br>';
            if($derivacion31['habilidad1'] != NULL)
              $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
              <br>';
            if($derivacion31['habilidad2'] != NULL)
              $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
              <br>';
            if($derivacion31['habilidad3'] != NULL)
              $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
              <br>';
            if($derivacion31['habilidad4'] != NULL)
              $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
              <br>';
            if($derivacion31['habilidad5'] != NULL)
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

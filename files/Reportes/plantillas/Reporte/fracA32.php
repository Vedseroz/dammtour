<?php
  
  function fraccion($derivacion31 = null, $nombre = null, $hoy = null){ 

  $plantilla = '<body>
      <header class="clearfix">
      <div id="project">';
        $plantilla .= '<div id="project"><span>INGRESADO POR </span>';
        $plantilla .= 'PROFESOR: '.$nombre['nombre']." ".$nombre['apellido'].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>';
        $plantilla .= '</div>
      </header>
      <main>
      <main>
      <h1>Información de red externa:</h1>
        <table>
          <thead>
            <tr>
              <th class="campos">CAMPOS</th>
              <th class="Respuestas">RESPUESTAS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="campos">Información entregada: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion32['info_entregada'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Enviado por: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion32['enviada'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Información recibida: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion32['info_recibida'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Recibida por: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion32['recibida'].'</td>';
            $plantilla .= '</tr>
            <tr>
              <td class="campos">Vocación del estudiante: </td>
              <td class="Respuestas">';
              $plantilla .= $derivacion32['vocacion'].'</td>';
            $plantilla .= '</tr>
          </tbody>
        </table>
        <br>
        <h1>Perfil del estudiante</h1>
        <div>';
          if ($derivacion32['perfil'] == 1) {
            $plantilla .= '<p><strong>CIENTÍFICOS: </strong>Interés por la experimentación, curioso de los fenómenos naturales, climáticos, físicos y matemáticos. Interés por Animales, medio ambiente, ecología.</p>
            <br>';
          }elseif($derivacion32['perfil'] == 2){
            $plantilla .= '<p><strong>EXPLORADORES: </strong>Interés por la lectura, ilustración de libros, poesía. Interés por liderar, le gusta defender a los otros. Interés por las leyendas antiguas, mitos occidentales, antiguas civilizaciones, culturas indígenas, objetos antiguos.</p>
            <br>';
          }elseif($derivacion32['perfil'] == 3){
            $plantilla .= '<p><strong>ARTESANOS: </strong>Interés por construir cosas y arreglarlas, curiosidad por la parte técnica de los artificios que nos rodean. (Hacer objetos, reparar, etc.)</p>
            <br>';
          }elseif($derivacion32['perfil'] == 4){
            $plantilla .= '<p><strong>DEPORTISTAS: </strong>Interés por el deporte, la salud y la buena alimentación.</p>
            <br>';
          }elseif($derivacion32['perfil'] == 5){
            $plantilla .= '<p><strong>CREADORES: </strong>Interés por el dibujo, y crear imágenes que sueñan o imaginan, se preguntan muchas cosas. Interés por la música y los sonidos de la naturaleza, además por reunirse con sus amigos y familiares, es muy dependiente.</p>
            <br>';
          }
        $plantilla .= '</div>
        <h1>Habilidades y talentos del estudiante</h1>
        <div>
          <ul>';
            if($derivacion32['talento1'] != NULL) 
              $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
              <br>';
            if($derivacion32['talento2'] != NULL)
              $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
              <br>';
            if($derivacion32['talento3'] != NULL)
              $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
              <br>';
            if($derivacion32['talento4'] != NULL)
              $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
              <br>';
            if($derivacion32['talento5'] != NULL)
              $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
              <br>';
            if($derivacion32['habilidad1'] != NULL)
              $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
              <br>';
            if($derivacion32['habilidad2'] != NULL)
              $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
              <br>';
            if($derivacion32['habilidad3'] != NULL)
              $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
              <br>';
            if($derivacion32['habilidad4'] != NULL)
              $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
              <br>';
            if($derivacion32['habilidad5'] != NULL)
              $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
              <br>';
          $plantilla .= '</ul>
        </div>';      $plantilla .= '</main>
      <footer>
      </footer>
    </body>';
    return $plantilla;
  }
?>
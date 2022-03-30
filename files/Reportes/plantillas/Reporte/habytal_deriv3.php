<?php

  function Plantilla($estudiante = null, $hoy, $id = null, $habytal = null){ 

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
        $plantilla .='<h1>Reporte de Habilidades y talentos</h1>';
        $plantilla .= '</div>
        <div id="project">';
        $plantilla .= '<div id="project"><span>CÓDIGO DE DERIVACIÓN DE ORIGEN: </span>'.$id.'</div>';
        $plantilla .= '<div id="project"><span>NOMBRE ESTUDIANTE </span>'.$estudiante[2]." ".$estudiante[3]." ".$estudiante[4].'</div>';
        $plantilla .= '<div id="project"><span>RUT </span>'.$estudiante[1].'</div>';
        $plantilla .= '<div id="project"><span>FECHA </span>'.$hoy.'</div>  
        <br>
      </header>
      <main>
      <br>
      <h1>Habilidades y talentos registrados: </h1>
        <table>
          <thead>
            <tr>
              <th class="campos">Habilidades y talentos</th>
              <th class="campos">Profesor <br>Jefe</th>
              <th class="campos">Comité de <br>Convivencia</th>
              <th class="campos">Dupla Psicosocial<br></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="Respuestas">Autoconocimiento<br></td>
              <td class="Respuestas">';
              if($habytal[1] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[12] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[23] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
            </tr>
            <tr>
              <td class="Respuestas">Empatía<br></td>
              <td class="Respuestas">';
              if($habytal[2] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[13] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[24] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
            </tr>
            <tr>
              <td class="Respuestas">Pensamiento <br>crítico</td>
              <td class="Respuestas">';
              if($habytal[3] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[14] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[25] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>  
            </tr>
            <tr>
              <td class="Respuestas">Manejo de <br>emociones y <br>sentimientos</td>
              <td class="Respuestas">';
              if($habytal[4] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[15] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[26] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>  
            </tr>
            <tr>
              <td class="Respuestas">Toma de <br>decisiones</td>
              <td class="Respuestas">';
              if($habytal[5] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[16] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[27] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>  
            </tr>
            <tr>
              <td class="Respuestas">Comunicación <br>asertiva</td>
              <td class="Respuestas">';
              if($habytal[6] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[17] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[28] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>  
            </tr>
            <tr>
              <td class="Respuestas">Pensamiento <br>creativo</td>
              <td class="Respuestas">';
              if($habytal[7] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[18] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[29] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>  
            </tr>
            <tr>
              <td class="Respuestas">Manejo de <br>problemas y <br>conflictos</td>
              <td class="Respuestas">';
              if($habytal[8] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[19] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[30] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>    
            </tr>
            <tr>
              <td class="Respuestas">Relaciones <br>interpersonales</td>
              <td class="Respuestas">';
              if($habytal[9] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[20] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[31] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>    
            </tr>
            <tr>
              <td class="Respuestas">Manejo del <br>estrés</td>
              <td class="Respuestas">';
              if($habytal[10] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[21] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>
              <td class="Respuestas">';
              if($habytal[32] != NULL){
                $plantilla .='&#10004;';
              }
              $plantilla .= '</td>    
            </tr>
          </tbody>
        </table>
        <h1>Resumen: </h1>
        <ul>
          <li>Usuario 1:
            <ul>';
              if($habytal[1] != NULL) 
                $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
                <br>';
              if($habytal[2] != NULL)
                $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
                <br>';
              if($habytal[3] != NULL)
                $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
                <br>';
              if($habytal[4] != NULL)
                $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
                <br>';
              if($habytal[5] != NULL)
                $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
                <br>';
              if($habytal[6] != NULL)
                $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
                <br>';
              if($habytal[7] != NULL)
                $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
                <br>';
              if($habytal[8] != NULL)
                $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
                <br>';
              if($habytal[9] != NULL)
                $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
                <br>';
              if($habytal[10] != NULL)
                $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
                <br>';
            $plantilla .= '</ul>
          </li>
          <li>Comité de Convivencia:
            <ul>';
              if($habytal[12] != NULL) 
                $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
                <br>';
              if($habytal[13] != NULL)
                $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
                <br>';
              if($habytal[14] != NULL)
                $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
                <br>';
              if($habytal[15] != NULL)
                $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
                <br>';
              if($habytal[16] != NULL)
                $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
                <br>';
              if($habytal[17] != NULL)
                $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
                <br>';
              if($habytal[18] != NULL)
                $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
                <br>';
              if($habytal[19] != NULL)
                $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
                <br>';
              if($habytal[20] != NULL)
                $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
                <br>';
              if($habytal[21] != NULL)
                $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
                <br>';
            $plantilla .= '</ul>
          </li>  
          <li>Dupla Psicosocial:
            <ul>';
              if($habytal[23] != NULL) 
                $plantilla .= '<li><strong>Autoconocimiento:</strong> Representa el punto de partida para crecer como persona, avanzar y dar sentido a la vida. Implica admitirse, quererse y valorarse.</li>
                <br>';
              if($habytal[24] != NULL)
                $plantilla .= '<li><strong>Empatía:</strong> Es necesario entender al otro, conectar con él/ella y "ponerse en su lugar" para comprender sus emociones, sus motivaciones y las razones que lo/la mueven.</li>
                <br>';
              if($habytal[25] != NULL)
                $plantilla .= '<li><strong>Pensamiento crítico:</strong> Si la forma de pensar se basa en premisas, sin cuestionar el mundo, gran parte de las ideas, comportamientos, valores, maneras de afrontar los problemas y los retos cotidianos pueden estar sometidos a presiones sociales y conducen a la estandarización y el conformismo.</li>
                <br>';
              if($habytal[26] != NULL)
                $plantilla .= '<li><strong>Manejo de emociones y sentimientos:</strong> Hay que aprender a conocer, expresar y gestionar las emociones y los sentimientos. El objetivo: conseguir que la emoción y la conducta se adecuén a la particularidad e intensidad de cada situación y no se desencadenen impulsivamente.</li>
                <br>';
              if($habytal[27] != NULL)
                $plantilla .= '<li><strong>Toma de decisiones:</strong> Actuar proactivamente para hacer que las cosas sucedan en vez de limitarse a dejar que ocurran por azar u otros factores externos.</li>
                <br>';
              if($habytal[28] != NULL)
                $plantilla .= '<li><strong>Comunicación asertiva:</strong> Expresarse con claridad, honestidad y de forma apropiada.</li>
                <br>';
              if($habytal[29] != NULL)
                $plantilla .= '<li><strong>Pensamiento creativo:</strong> Utilizar la creatividad puede ayudar a mejorar la forma de actuación, la solución de problemas, actuar, crear valor añadido y oportunidades.</li>
                <br>';
              if($habytal[30] != NULL)
                $plantilla .= '<li><strong>Manejo de problemas y conflictos:</strong> No es posible evitar los conflictos, gracias a ellos se renuevan las oportunidades de cambiar y crecer, pero sí hay formas para llegar a acuerdos más rápido y enfrentarlos como algo natural que es parte del crecimiento.</li>
                <br>';
              if($habytal[31] != NULL)
                $plantilla .= '<li><strong>Relaciones interpersonales:</strong> Hay que establecer y conservar relaciones significativas, así como terminar aquellas que bloqueen el crecimiento personal (Relaciones tóxicas). Hay que aprender a iniciar, mantener o terminar una relación y conocer la forma de hacerlo de forma positiva con las personas que nos rodean.</li>
                <br>';
              if($habytal[32] != NULL)
                $plantilla .= '<li><strong>Manejo del estrés:</strong> Muchas situaciones generan tensiones. Hay que enfrentarse a ellas y aprender a controlar el nivel de estrés diario buscando respuestas más adaptativas, identificando las fuentes de tensión en la vida diaria, reconociendo sus manifestaciones y encontrar fórmulas para elminiarlas o contrarrestarlas.</li>
                <br>';
            $plantilla .= '</ul>
          </li>
        </main>
      <footer>
      </footer>
    </body>';
    return $plantilla;
  }
?>
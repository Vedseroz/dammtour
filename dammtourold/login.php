<?php

  require 'includes/config/database.php';
  $db = conectarDB();

  $errores = [];

  // Autenticar el usuario
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  
    // Validando email
    $email = mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)); 
    
    // Validando password
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) { 
      $errores[] = 'El email es obligatorio o no es válido';
    }

    if (!$password) {
      $errores[] = 'El password es obligatorio';
    }

    if (empty($errores)) { 
      $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
      $resultado = mysqli_query($db, $query);
      # echo '<pre>'; var_dump($resultado); echo '</pre>';

      if ($resultado->num_rows) { 
        $usuario = mysqli_fetch_assoc($resultado); #Guardando registro de el usuario con su email y password

        // Verificar si el password es correcto o no
        $auth = password_verify($password,$usuario['password']);
        # echo '<pre>'; var_dump($auth); echo '</pre>';

        if ($auth) {
          session_start(); 

          // Llenar el arreglo de la sesión
          $_SESSION['usuario'] = $usuario['email'];
          $_SESSION['login'] = true; 
          # echo '<pre>'; var_dump($_SESSION); echo '</pre>';

          header('Location: admin'); 

        }else{
          $errores[] = 'El password es incorrecto';
        }

      }else{
        $errores[] = 'El usuario no existe';
      }
    }
  }

  require 'includes/funciones.php';
  incluirTemplate('importStyle', $inicio = true);

?>


  <main class="contenedor seccion contenido-centrado ">


    <?php foreach ($errores as $error): ?>
      <div class="alerta error">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>

    
    <div class="form-container b-shadow-white">
      <div class="logo2">
        <picture>
          <source srcset="build/img/logo2.webp" type="image/webp">
          <source srcset="build/img/logo2.jpg" type="image/jpeg">
          <img loading="lazy" src="build/img/logo2.jpg" alt="Logo2">
        </picture>
      </div>
      
      <form method="POST" class="login">
          <label for="email">E-mail:</label>
          <input type="email" name="email" placeholder="Tu email" id="email">
          <label for="password">Password:</label>
          <input type="password" name="password" placeholder="Tu Password" id="password">
          <input type="submit" value="Iniciar Sesión" class="boton boton-azul-block">
      </form>
    </div>
  </main>

</body>
</html>

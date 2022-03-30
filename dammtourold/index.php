<?php 
  if (!isset($_SESSION)) { #Si no existe una sesión...
    session_start(); 
  }

  $auth = $_SESSION['login'] ?? null;
  
  /* echo '<pre>'; var_dump($auth); echo '</pre>'; */
  /* echo '<pre>'; var_dump($_SESSION); echo '</pre>'; */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dammtour</title>
  <link rel="shortcut icon" href="build/img/favicon.png" type="image/x-icon">
</head>
<body style="display: flex; justify-content: center;">
  <mark style="display:flex; align-items: center; height: 20vh; border: medium dashed blue; font-size: 2rem; color: blue; font-weight: bold; font-family: sans-serif; padding: 1rem; border-radius: 1rem; margin-top: 40vh;">
  frontend en mantenimiento, - listo en un futuro -
  </mark>
</body>
</html>
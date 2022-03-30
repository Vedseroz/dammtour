<?php

  if (!isset($_SESSION)) { #Si no existe una sesión...
    session_start(); 
  }

  // Guardando 'true' como verificación del la autenticacion y si el usuario no está autenticado devuelve 'null'
  $auth = $_SESSION['login'] ?? null; 

  /* echo '<pre>'; var_dump($auth); echo '</pre>'; */
  /* echo '<pre>'; var_dump($_SESSION); echo '</pre>'; */
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sigetur</title>
  <link rel="shortcut icon" href="../build/img/favicon.png" type="image/x-icon">
  <!-- Librería clockpicker CSS-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker@0.0.7/dist/bootstrap-clockpicker.min.css">
  <!-- Librería Full Calendar  CSS-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- SASS -->
  <link rel="stylesheet" href="../build/css/app.css">

  <!-- Librería Full Calendar JS-->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
</head>
<body>
  <header class="contenedor seccion header b-shadow-white">
    <div class="logo">
      <picture>
        <source srcset="../build/img/logo.webp" type="image/webp">
        <source srcset="../build/img/logo.jpg" type="image/jpeg">
        <img loading="lazy" src="../build/img/logo.jpg" alt="Logo">
      </picture>
    </div>

    <h2>Administrador</h2>

    <?php if($auth): ?>
      <a class="boton-logear boton-azul" href="../cerrar-sesion.php">Cerrar Sesión</a>
    <?php endif; ?>
  </header>

  <main class="contenedor seccion principal b-shadow-white">
    <nav class="navegacion">
      <a class="boton-naranja" href="index.php">Inicio</a>
      <a class="boton-naranja" href="pasajero.php">Pasajero</a>
      <a class="boton-naranja" href="transfer.php">Transfers</a>
      <a class="boton-naranja" href="hospedaje.php">Hospedaje</a>
      <a class="boton-naranja" href="tour.php">Tours</a>
      <a class="boton-naranja" href="calendario.php">Calendario</a>
      <a class="boton-naranja" href="voucher.php">Vouchers</a>
      <a class="boton-naranja" href="costo.php">Costo</a>
    </nav>

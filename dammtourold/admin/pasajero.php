<?php 
  require '../includes/funciones.php';

  $auth = estaAutenticado();

  if (!$auth) { # Si el usuario no se autenticó correctamente...
    header('Location: /dammtour');
  }

  incluirTemplate('header', $inicio = true);  # Incluyendo header al sitio
?>

<div class="inicio">
  <!-- Incluyendo botones del mantenedor -->
  <?php incluirTemplate('botones_estado', $inicio = true); ?>

  <section class="">
    <h2>Pasajeros</h2>
  </section>
</div>

<!-- Incluyendo footer al sitio -->
<?php incluirTemplate('footer', $inicio = true); ?>
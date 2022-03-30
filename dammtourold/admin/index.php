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
  <?php incluirTemplate('botones_estado'); ?>

  <section class="bienvenida">
    <h1>
      Bienvenidos<br> 
      al administrador<br>
      operador turístico<br>
      optour
    </h1>
  </section>
</div>

<!-- Incluyendo footer al sitio -->
<?php incluirTemplate('footer', $inicio = true); ?>

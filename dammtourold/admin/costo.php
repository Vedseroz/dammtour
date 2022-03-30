<?php 
  require '../includes/funciones.php';

  $auth = estaAutenticado();

  if (!$auth) { # Si el usuario no se autenticó correctamente...
    header('Location: /dammtour');
  }

  incluirTemplate('header', $inicio = true);  # Incluyendo header al sitio
?>

<div class="inicio">
  <aside>
    <a class="boton-naranja" href="#">Datos</a>
    <a class="boton-naranja" href="#">Listar</a>
    <a class="boton-naranja" href="#">En espera</a>
    <a class="boton-naranja" href="#">En proceso</a>
    <a class="boton-naranja" href="#">Cotizado</a>
  </aside>

  <section class="">
    <h2>Costos</h2>
  </section>
</div>

<!-- Incluyendo footer al sitio -->
<?php incluirTemplate('footer', $inicio = true); ?>
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
    <a class="boton-naranja" href="#">Listar todo</a>
    <a class="boton-naranja" href="#">Listar mes</a>
    <a class="boton-naranja" href="#">Listar dia</a>
  </aside>

  <section class="">
    <h2>Voucher</h2>
  </section>
</div>

<!-- Incluyendo footer al sitio -->
<?php incluirTemplate('footer', $inicio = true); ?>
<?php
  require '../includes/funciones.php';
  
  $auth = estaAutenticado();
  
  if (!$auth) { # Si el usuario no se autenticó correctamente...
    header('Location: /dammtour');
  }
  
  incluirTemplate('header', $inicio = true);  # Incluyendo header al sitio
?>

<!-- Calendario -->
<?php incluirTemplate('menu_calendario', $inicio = true); ?>


<!--
  Ventana Modal
-->

<!-- Incluyendo header de Ventana Modal  -->
<?php incluirTemplate('modal_header', $inicio = true); ?>

<div class="modal-body">
  
</div>

<!-- Incluyendo footer de Ventana Modal  -->
<?php incluirTemplate('modal_footer', $inicio = true); ?>

<!-- Incluyendo footer al sitio -->
<?php incluirTemplate('footer', $inicio = true); ?>
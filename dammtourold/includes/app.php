<?php
/*
- __DIR__ es un directorio del fichero. Si se utiliza dentro de un include, devolverá el directorio del fichero
  incluído. Por ejemplo la constante TEMPLATES_URL devuelve la ruta completa en donde se encuentran los templates
*/

// Constantes con rutas completas de respectivos archivos o carpetas 
define('TEMPLATES_URL', __DIR__ . '/templates'); 
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
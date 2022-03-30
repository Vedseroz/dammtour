<?php

require 'app.php';

// Función para añadir un template a una página
function incluirTemplate(string $nombre, bool $inicio = false){
    // echo TEMPLATES_URL . "/${nombre}.php";
    
    include TEMPLATES_URL . "/${nombre}.php"; 
}

// Funcion para proteger páginas de usuarios externos
function estaAutenticado(){
    /* echo '<pre>'; var_dump($_SESSION); echo '</pre>'; */

    session_start();
    $auth = $_SESSION['login']; 
  
    if ($auth) { 
      return true;
    }
    
    return false;
  }
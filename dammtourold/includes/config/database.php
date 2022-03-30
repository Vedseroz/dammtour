<?php

//Creando una instancia de una BD
function conectarDB(): mysqli{ 
    $db = mysqli_connect('localhost','dammtour_sigetur','2lH9s5,5H5bH','dammtour_sigetur');
    
    if (!$db) { 
       echo 'Error no se pudo conectar';
       exit; 
    }
    // echo 'BD conectada correctamente';

    return $db; 
}

?>
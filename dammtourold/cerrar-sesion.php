<?php

session_start(); 

$_SESSION = []; #Dejando arreglo de sesion vacia, es decir, se destruye o cierra la sesion

// echo '<pre>'; var_dump($_SESSION); echo '</pre>';

header('Location: /dammtour'); 
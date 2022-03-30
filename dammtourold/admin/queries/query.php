<?php

echo "asdf";

function conectarBD(){
    $pdo = new PDO('mysql:dbname=dammtour_sigetur;host=localhost','dammtour_sigetur','2lH9s5,5H5bH');

    return "conectado a la base de datos";
}

//$db = mysqli_connect('localhost','dammtour_sigetur','2lH9s5,5H5bH','dammtour_sigetur');
//$query = mysqli_query($db,"SELECT * FROM pasajero");
//var_dump(mysqli_fetch_array($query));


function getPasajeros(){                 // esta es una funcion principalmente de prueba
    //efectua conexion a la base de datos
    $query = mysqli_query($db,"SELECT * FROM pasajero");
    $array = mysqli_fetch_array($query);
    return $array;    //retorna la query con todos los pasajeros. 
}


?>



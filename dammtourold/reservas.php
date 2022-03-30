<?php 
  //! Este codigo aun no funciona, falta mejorarlo. 


  header('Content-Type: application/json'); // Cabecera para archivos JSON
  
  # Conexion de BD con PDO
  $pdo = new PDO('mysql:dbname=dammtour_sigetur;host=localhost','dammtour_sigetur','2lH9s5,5H5bH');

  # Si existe un name 'accion' se guarda su valor sino se guarda 'leer'
  $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

  switch ($accion) {
    case 'agregar': // Agregar informacion
      # Sentecia SQL para agregar un evento o reserva, lo que está en VALUES() con ':' se reemplaza al ejecutarse
      # la sentencia por la información del arreglo asociativo que está en 'execute()'.
      $sentenciaSQL = $pdo->prepare(
        "INSERT INTO eventos(title,descripcion,color,textColor,start,end) 
        VALUES(:title,:descripcion,:color,:textColor,:start,:end)"
      );

      # Ejecutando sentencia SQL y reemplazando los valores del INSERT por valores de un arreglo asociativo
      # que se obtenieron a traves del envío de la data de AJAX
      $respuesta = $sentenciaSQL->execute(array(
        'title' => $_POST['title'], 
        'descripcion' => $_POST['descripcion'], 
        'color' => $_POST['color'],
        'textColor' => $_POST['textColor'],
        'start' => $_POST['start'],
        'end' => $_POST['end']
      ));
      # Imprimiendo y convirtiendo arreglo asociativo en un JSON
      echo json_encode($respuesta);
      break;  

    case 'eliminar': // Eliminar informacion
      $respuesta = false; // Booleano false


      if (isset($_POST['id'])) { // Si existe un ID en la data enviada con AJAX
        # Sentecia SQL para eliminar un evento o reserva, lo que está en VALUES() con ':' se reemplaza al 
        # ejecutarse la sentencia por la información del arreglo asociativo que está en 'execute()'.
        $sentenciaSQL = $pdo->prepare("DELETE FROM eventos WHERE id=:id");
        $respuesta = $sentenciaSQL->execute(array('id' => $_POST['id']));
      }
      # Imprimiendo y convirtiendo arreglo asociativo en un JSON
      echo json_encode($respuesta);  
      break;

    case 'modificar': // Modificar informacion
        # Sentecia SQL para modificar un evento o reserva, lo que está en VALUES() con ':' se reemplaza al 
        # ejecutarse la sentencia por la información del arreglo asociativo que está en 'execute()'.
        $sentenciaSQL = $pdo->prepare(
          "UPDATE eventos SET 
          title=:title, descripcion=:descripcion, color=:color, textColor=:textColor, start=:start, end=:end
          WHERE id=:id"
        );
        # Ejecutando sentencia SQL y reemplazando los valores del UPDATE por valores de un arreglo asociativo
        # que se obtenieron a traves del envío de la data de AJAX
        $respuesta = $sentenciaSQL->execute(array(
          'id' => $_POST['id'],
          'title' => $_POST['title'], 
          'descripcion' => $_POST['descripcion'], 
          'color' => $_POST['color'],
          'textColor' => $_POST['textColor'],
          'start' => $_POST['start'],
          'end' => $_POST['end']
        ));
        # Imprimiendo y convirtiendo arreglo asociativo en un JSON
        echo json_encode($respuesta);
      break;

    default: // Leer informacion
      # Sentencia SQL para leer BD 
      $sentencia = 
      "SELECT * FROM pasajero";
      "SELECT p.nombre,p.apellido,p.telefono,p.email,p.observacion,p.servicios,h.posada,l.pais,l.ciudad,
       f.fecha_llegada,f.hora_llegada,f.fecha_salida,f.hora_salida
       FROM pasajero p 
       JOIN hospedaje h ON p.id_pasajero = h.pasajero_id
       JOIN localidad l ON h.localidad_id = l.id_localidad
       JOIN fecha f ON h.fecha_id = f.id_fecha";

      # Sentecia SQL para leer todos los eventos o reservas
      $sentenciaSQL = $pdo->prepare($sentencia);
      # Ejecutando sentencia SQL anterior
      $sentenciaSQL->execute();
      
      # Convirtiendo consulta en un arreglo asociativo
      $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
      // var_dump($resultado);

      # Imprimiendo y convirtiendo arreglo asociativo en un JSON
      echo json_encode($resultado);
      break;
  }
  
?>
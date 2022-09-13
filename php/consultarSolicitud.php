<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/nav.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/predial.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <title>Responder Solicitud</title>
</head>

<body>
  <div class="container">

    <?php
    $folio = $_GET['folio'];
    require_once './../CRUDPHP/crud.php';
    $consulta = CrudPHP::singleton();
    $solicitud = $consulta->consultarConsultaEspecifica($folio);
    $respuesta = $consulta->consultarRespuestaEspecifica($folio);

    ?>
    <h1>Datos de la solicitud de <?php echo $solicitud[0]['nombre']; ?></h1>
    <!-- Mostra informacion de la solicitud -->
    <div class="solicitud">
      <p>Identificador: <?php echo $solicitud[0]['id']; ?></p>
      <p>Cuenta predial: <?php echo $solicitud[0]['cuenta_predial']; ?></p>
      <p>Nombre: <?php echo $solicitud[0]['apellido-p'] . " " . $solicitud[0]['apellido-m'] . " " . $solicitud[0]['nombre']; ?></p>
      <p>Correo: <?php echo $solicitud[0]['correo']; ?></p>
      <p>Direccion: <?php echo $solicitud[0]['calle'] . ", " . $solicitud[0]['colonia'] . ", " . $solicitud[0]['municipio']; ?></p>
      <p>Folio de solicitud: <?php echo $solicitud[0]['folio']; ?></p>
      <p>Adjunto: <?php if ($solicitud[0]['adjunto'] == 1) {
                    echo "<a href='./../archivos/" . $solicitud[0]['folio'] . "." . $solicitud[0]['extencion'] . "' download>Descargar archivo</a>";
                  } else {
                    echo "<p>No se adjunto ningun archivo</p>";
                  } ?></p>
      <p>Comentario: <?php echo $solicitud[0]['comentario']; ?></p>

    </div>
    <?php
    //Si no existe la respuesta se muestra un mensaje
    if ($respuesta == null) {
      echo "<h1>Respuesta no encontrada</h1> <div class='alert alert-danger' role='alert'>    No se ha encontrado una respuesta para la consulta con folio: " . $folio . " <br> Consulte de nuevo mas tarde.</div>";
    } else {
      $html = "<h2>Respuesta a la solicitud</h2>";
      $html .= "<div class='respuesta'>";
      $html .= "<p>Respuesta: " . $respuesta[0]['respuesta'] . "</p>";
      $html .= "<p>Adjunto de respuesta: ";
      if ($respuesta[0]['adjunto'] == 1) {
        $html .= "<a href='./../archivos/" . $respuesta[0]['folio_archivo_adjunto'] . "." . $respuesta[0]['extension'] . "' download>Descargar archivo</a>";
      } else {
        $html .= "<p>No se adjunto ningun archivo</p>";
      }
      $html .= "</p>";
      $html .= "</div>";
      $html .= " <a href='./../index.html' class='btn btn-primary'>Regresar</a>";
      echo $html;
    }
    ?>

  </div>
  <br><br><br><br><br><br>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


  <!-- Importando la ultima version de Jquerry completa -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
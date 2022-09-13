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
  <?php
  $folio = $_GET['folio'];
  require_once './../CRUDPHP/crud.php';
  $consulta = CrudPHP::singleton();
  $solicitud = $consulta->consultarConsultaEspecifica($folio);
  ?>
  <div class="container">
    <h1>Responder a la solicitud de <?php echo $solicitud[0]['nombre']; ?></h1>
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
    <h2>Responder solicitud</h2>
    <form action="./adjuntarRespuesta.php" enctype="multipart/form-data" method="POST">
      <div class="mb-3">
        <label for="recibo" class="form-label">Adjuntar archivo (Opcional)</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
        <p> Enviar mi archivo: <input name="subir_archivo" type="file" /></p>
      </div>
      <div class="mb-3">
        <label for="respuesta" class="form-label">Respuesta</label>
        <textarea class="form-control" id="respuesta" rows="3" name="respuesta"></textarea>
      </div>
      <input type="hidden" name="folio" value="<?php echo $folio; ?>">
      <button type="submit" class="btn btn-primary">Enviar respuesta</button>
    </form>
  </div>
  <br><br><br><br><br><br>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


  <!-- Importando la ultima version de Jquerry completa -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
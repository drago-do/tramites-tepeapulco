<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Procesando el archivo enviado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

  <div class="main container">
    <?php
    require_once './../CRUDPHP/crud.php';
    $directorio = './../comprobantePago/';

    $nuevaConsulta = CrudPHP::singleton();

    //Actualizar la zona horaria de México
    date_default_timezone_set('America/Mexico_City');
    //Verificar que se haya enviado un archivo y que no haya errores
    if ($_FILES['subir_archivo']['error'] == 0) {
      $folio_consulta = $_POST['folio'];
      echo $folio_consulta;
      $mensaje = $_POST['mensaje'];
      $resultado = $nuevaConsulta->consultarRespuestaEspecifica($folio_consulta);
      //Si no hay nada en la $respuesta entonces mostrar el mensaje que el folio no exite
      if (isset($resultado[0]['folio_de_consulta'])) {
        if ($resultado[0]['folio_de_consulta'] == $folio_consulta) {
          $nombre = date('dHis');
          //Subir archivo
          $subir_archivo = $directorio . basename($_FILES['subir_archivo']['name']);
          move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo);
          //Cambiar el nombre del archivo a "fechaActual"  conservando su extension
          $nombreArchivo = basename($_FILES['subir_archivo']['name']);
          $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
          $nombreArchivo = $nombre . "." . $extension;
          // $nombreArchivo = "archivoAdjunto." . $extension;
          rename($subir_archivo, $directorio . $nombreArchivo);

          echo $folio_consulta;

          $pago_validado  = 0;
          $resultado = $nuevaConsulta->insertarNuevaSolicitudPago($folio_consulta, $nombre, $extension, $pago_validado, $mensaje);
          echo "<h1>Solicitud de pago enviada</h1> <div class='alert alert-secondary' role='alert'>
      Tu numero de folio es: " . $folio_consulta . "
    </div>
    <a href='./../index.html' class='btn btn-primary'>Regresar</a>";
        }
      } else {
        echo "<h1>El folio no existe</h1> <div class='alert alert-secondary' role='alert'>
      El folio no existe en la base de datos, nececitas consultar primero la deuda de tu predio. 
    </div>
    <a href='./../index.html' class='btn btn-primary'>Regresar</a>";
      }
    } else if ($_FILES['subir_archivo']['error'] == 2) {
      echo " <h1>Error en la subida del archivo</h1> <div class='alert alert-danger' role='alert'>
      El archivo que subio no es valido, intente con otro con otra extención. </div>";
    } else {
      echo " <h1>Error en la subida del archivo</h1> <div class='alert alert-danger' role='alert'>
      Tiene que adjuntar el comprobante de pago para realizar esta solicitud</div>";
    }







    ?>



  </div>
  <!-- script para agregar libreria jQuerry -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(function() {
      $('.SendEmail').click(function(event) {
        const mail = document.getElementById('sendMail');
        var email = 'presidencia@tepeapulco.gob.mx';
        var subject = 'Test';
        var emailBody = $('#bodymail').text();
        //Adjuntar archivo que esta en la ruta ./archivos/*
        var attach = './archivos/archivoAdjunto.rar';

        mail.setAttribute('href', 'mailto:' + email + '?subject=' + subject + '&body=' + emailBody + '&attach=' + attach);
        mail.click();
      });
    });
  </script>

</body>

</html>
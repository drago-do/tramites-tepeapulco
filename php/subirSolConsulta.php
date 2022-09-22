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
    $directorio = './../archivos/';
    $folio = date("YmdHis");

    //Actualizar la zona horaria de México
    date_default_timezone_set('America/Mexico_City');
    //Verificar que se haya enviado un archivo y que no haya errores
    if ($_FILES['subir_archivo']['error'] == 0) {
      //Subir archivo
      $subir_archivo = $directorio . basename($_FILES['subir_archivo']['name']);
      move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo);
      //Cambiar el nombre del archivo a "fechaActual"  conservando su extension
      $nombreArchivo = basename($_FILES['subir_archivo']['name']);
      $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
      $nombreArchivo = $folio . "." . $extension;
      // $nombreArchivo = "archivoAdjunto." . $extension;
      rename($subir_archivo, $directorio . $nombreArchivo);
      $adjunto = 1;
    } else if ($_FILES['subir_archivo']['error'] == 2) {
      echo " <h1>Error en la subida del archivo</h1> <div class='alert alert-danger' role='alert'>
      El archivo que subio no es valido, intente con otro. </div>";
      $extension = "";
      $adjunto = 0;
    } else {
      $extension = "";
      $adjunto = 0;
    }




    //Rescatar datos del formulario, nombre, correo, calle, ciudad, estado, codigo postal, mensaje
    $correo = $_POST['correo'];
    $apelidoPaterno = $_POST['apellido-p'];
    $apellidoMaterno = $_POST['apellido-m'];
    $nombre = $_POST['nombre'];
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $cuenta_predial = $_POST['cuenta_predial'];
    $comentario = $_POST['comentario'];


    if (isset($apelidoPaterno) && isset($apellidoMaterno) && isset($nombre) && isset($calle) && isset($colonia) && isset($municipio)) {
      $consultaRespondida = 0;
      $nuevaConsulta = CrudPHP::singleton();
      $resultado = $nuevaConsulta->insertarNuevaConsulta($correo, $apelidoPaterno, $apellidoMaterno, $nombre, $calle, $colonia, $municipio, $folio, $extension, $adjunto, $cuenta_predial, $comentario, $consultaRespondida);
      echo "<h1>Consulta enviada</h1> <div class='alert alert-secondary' role='alert'>
      Tu numero de folio es: " . $folio . "
    </div>
    <a href='./../index.html' class='btn btn-primary'>Regresar</a>";
    } else {
      echo " <h1>Error en la consulta</h1> <div class='alert alert-danger' role='alert'>
      Algunos datos no fueron ingresados correctamente.
</div>";
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
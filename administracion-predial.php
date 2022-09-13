<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./img/favicon.png">
  <link rel="stylesheet" href="./css/nav.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/predial.css">
  <link rel="stylesheet" href="./css/administracion-predial.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">


  <title>Municipio Tepeapulco</title>
</head>

<body>

  <div class="navbar navbar-expand-lg">
    <div class="header">
      <p id="texte-header">Presidencia Municipal de Tepeapulco 2020-2024</p>
      <img src="./img/logo.png" alt="Logotipo Tepeapulco">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <nav id="navbar">
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 enlaces">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              TRANSPARENCIA
            </a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="https://tepeapulco.gob.mx/Armonizacion/Armonizacion.html">ARMONIZACIÓN
                  CONTABLE</a></li>
              <li><a class="nav-link" href="https://tepeapulco.gob.mx/transparencia/index.html">TRANSPARENCIA</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://tepeapulco.gob.mx/tramites/index.html">TRÁMITES
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#acciones">ACCIONES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://tepeapulco.gob.mx/galeria/index.html">GALERÍA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#i-pmd" id="pmd">PMD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://tepeapulco.gob.mx/ubicaciones/index.html">UBICACIONES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">CONTACTO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://smx6.hostdime.com.mx:2096/">
              CORREO INSTITUCIONAL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://tepeapulco.gob.mx/portal2021/1/openemr-6.0.0/interface/login/login.php?site=default">
              SERVICIO MEDICO</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <div class="lista-de-solicitudes">
    <?php
    require_once './CRUDPHP/crud.php';
    $nuevaConsulta = CrudPHP::singleton();
    $solicitudes = $nuevaConsulta->consultarConsultas();
    //Si no hay solicitudes se muestra un mensaje
    if (empty($solicitudes)) {
      echo "<h1>No hay solicitudes pendientes</h1>";
    } else {
      foreach ($solicitudes as $solicitud) {
        echo "<div class='solicitud'>";
        echo "<div class='nombre-y-folio'>";
        echo "<p class='nombre' style='font-weight:bolder' >Nombre: " . $solicitud['apellido-p'] . " " . $solicitud['apellido-m'] . " " . $solicitud['nombre'] . "</p>";
        echo "<p>Folio de solicitud: " . $solicitud['folio'] . "</p>";
        echo "</div>";

        echo "<div class='datos-y-botones'>";
        echo "<div class='datos'>";
        echo "<p class='correo'>Correo: " . $solicitud['correo'] . "</p>";
        echo "<p>Direccion: " . $solicitud['calle'] . ", " . $solicitud['colonia'] . ", " . $solicitud['municipio'] . "</p>";
        echo "</div>";
        echo "<div class='botones'>";
        echo "<button class='btn btn-primary' onClick='verSolicitud(" . $solicitud['folio'] . ")'>Ver solicitud</button>";
        echo "<button class='btn btn-danger' onClick='eliminarSolicitud(" . $solicitud['folio'] . ")'>Eliminar solicitud</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
    }
    ?>
    <!-- Modal que muestre los campos de id	
correo	
apellido-p	
apellido-m	
nombre	
calle	
colonia	
municipio	
folio	
adjunto	
cuenta_predial	
comentario	  de la tabla solicitud_consulta  el modal se abre al hacer click en el boton verSolicitud()-->
    <div class="modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalles de la Solicitud</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modal-body-php">

          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- Importar Jquerry desde google -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Importar la ultima version de Jquerry -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Importar Bootstrap desde google -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function verSolicitud(folio) {

      $.ajax({
        url: './php/verSolicitud.php',
        type: 'POST',
        data: {
          folio: folio
        },
        success: function(data) {
          $('#modal-body-php').html(data);
          $('.modal').modal('show');
        }
      });
    }

    function eliminarSolicitud(folio) {
      $.ajax({
        url: './php/eliminarSolicitud.php',
        type: 'POST',
        data: {
          folio: folio
        },
        success: function(data) {
          location.reload();
        }
      });
    }

    function responderSolicitud(folio) {
      //Redirigir a la pagina responderSolicitud.php enviando el folio de la solicitud como parametro
      window.location.href = "./php/responderSolicitud.php?folio=" + folio;
    }
  </script>

</body>

</html>
<!--       // Si el dato $solicitud['adjunto'] es 1 adjuntar la descarga de la imagen de la ruta:./archivos/$folio si es 0 no adjuntar nada
      if ($solicitud['adjunto'] == 1) {
        echo "<a href='./archivos/" . $solicitud['folio'] . ".png' download>Descargar archivo</a>";
      } else {
        echo "<p>No se adjunto ningun archivo</p>";
      }
      echo "</div>"; -->
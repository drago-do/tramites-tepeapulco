<?php
require_once './../CRUDPHP/crud.php';
$folio = $_POST['folio'];
$nuevaConsulta = CrudPHP::singleton();
$solicitud = $nuevaConsulta->consultarConsultaEspecifica($folio);
$solicitudPago = $nuevaConsulta->consultarSolicitudPago($folio);

$html = "";
$html = "<div>";
$html .= "<p>Identificador: " . $solicitud[0]['id'] . "</p>";
$html .= "<p>Cuenta predial: " . $solicitud[0]['cuenta_predial'] . "</p>";
$html .= "<p>Nombre: " . $solicitud[0]['apellido-p'] . " " . $solicitud[0]['apellido-m'] . " " . $solicitud[0]['nombre'] . "</p>";
$html .= "<p>Correo: " . $solicitud[0]['correo'] . "</p>";
$html .= "<p>Direccion: " . $solicitud[0]['calle'] . ", " . $solicitud[0]['colonia'] . ", " . $solicitud[0]['municipio'] . "</p>";
$html .= "<p>Folio de solicitud: " . $solicitud[0]['folio'] . "</p>";
$html .= "<p>Adjunto: ";
if ($solicitud[0]['adjunto'] == 1) {
  $html .= "<a href='./archivos/" . $solicitud[0]['folio'] . "." . $solicitud[0]['extencion'] . "' download>Descargar archivo</a>";
} else {
  $html .= "<p>No se adjunto ningun archivo</p>";
}
$html .= "</p>";
$html .= "<p>Comentario: " . $solicitud[0]['comentario'] . "</p>";
$html .= "<h1>Respuesta enviada: </h1>";
if ($solicitud[0]['respuesta_enviada'] == 1) {
  $respuesta = $nuevaConsulta->consultarRespuestaEspecifica($folio);
  $html .= "<p>Respuesta: " . $respuesta[0]['respuesta'] . "</p>";
  $archivo_adjunto = $respuesta[0]['folio_archivo_adjunto'];
  $extension = $respuesta[0]['extension'];
  if ($archivo_adjunto != "") {
    $html .= "<p>Archivo adjunto: <a href='./../archivos/" . $archivo_adjunto . $extension . "' download>Descargar archivo</a></p>";
  } else {
    $html .= "<p>No se adjunto ningun archivo</p>";
  }
}
$html .= "<h1>Solicitud de pago</h1>";
$html .= "<p>Identificador: " . $solicitudPago[0]['id_pago'] . "</p>";
$html .= "<p>Enlace a comprobante: <a href='./../comprobantePago/" . $solicitudPago[0]['nombre_comprobante'] . "." . $solicitudPago[0]['extencion'] . "' download>Descargar archivo</a></p>";
$html .= "<p>Mensaje: " . $solicitudPago[0]['mensaje'] . "</p>";

$html .= "</div>";

$html .= "<div class='botones-solicitud'>";

$html .= "<button class='btn btn-primary' onClick='responderSolicitudPago(" . $solicitud[0]['folio'] . ")'>Responder</button>";
$html .= "<button class='btn btn-danger' onClick='eliminarSolicitud(" . $solicitud[0]['folio'] . ")'>Eliminar solicitud</button>";
$html .= "</div>";

echo $html;

<?php
require_once './../CRUDPHP/crud.php';
$folio = $_POST['folio'];
$nuevaConsulta = CrudPHP::singleton();
$solicitud = $nuevaConsulta->consultarConsultaEspecifica($folio);

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
$html .= "</div>";

$html .= "<div class='botones-solicitud'>";
$html .= "<button class='btn btn-primary' onClick='responderSolicitud(" . $solicitud[0]['folio'] . ")'>Responder</button>";
$html .= "<button class='btn btn-danger' onClick='eliminarSolicitud(" . $solicitud[0]['folio'] . ")'>Eliminar solicitud</button>";
$html .= "</div>";

echo $html;

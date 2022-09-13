<?php
//singleton
class CrudPHP
{
  private static $instancia;
  private $dbh;

  private function __construct()
  {
    try {
      $servidor = "localhost";
      $base = "predial";
      $usuario = "root";
      $contrasenia = "";
      $this->dbh = new PDO('mysql:host=' . $servidor . ';dbname=' . $base, $usuario, $contrasenia);
      $this->dbh->exec("SET CHARACTER SET utf8");
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public static function singleton()
  {
    if (!isset(self::$instancia)) {
      $miclase = __CLASS__;
      self::$instancia = new $miclase;
    }
    return self::$instancia;
  }

  public function Consulta($p1)
  {
    try {
      $query = $this->dbh->prepare("SELECT campos FROM tabla WHERE campo LIKE ?");
      $query->bindParam(1, $p1);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function consultarConsultas()
  {
    try {
      $query = $this->dbh->prepare("SELECT * FROM solicitud_consulta");
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function consultarConsultaEspecifica($folio)
  {
    try {
      $query = $this->dbh->prepare("SELECT * FROM solicitud_consulta WHERE folio = ?");
      $query->bindParam(1, $folio);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function consultarRespuestaEspecifica($folio)
  {
    try {
      $query = $this->dbh->prepare("SELECT * FROM respuesta_consulta WHERE folio_de_consulta LIKE ?");
      $query->bindParam(1, $folio);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }
  public function insertarNuevaConsulta($correo, $apellidoP, $apellidoM, $nombre, $calle, $colonia, $Municipio, $folio, $extencion, $adjunto, $cuenta_predial, $comentario)
  {
    try {
      $query = $this->dbh->prepare("INSERT INTO solicitud_consulta VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?)");
      $query->bindParam(1, $correo);
      $query->bindParam(2, $apellidoP);
      $query->bindParam(3, $apellidoM);
      $query->bindParam(4, $nombre);
      $query->bindParam(5, $calle);
      $query->bindParam(6, $colonia);
      $query->bindParam(7, $Municipio);
      $query->bindParam(8, $folio);
      $query->bindParam(9, $extencion);
      $query->bindParam(10, $adjunto);
      $query->bindParam(11, $cuenta_predial);
      $query->bindParam(12, $comentario);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function insertarNuevaRespuesta($folio_de_consulta, $respuesta, $adjunto, $extension, $folio_archivo_adjunto)
  {
    try {
      $query = $this->dbh->prepare("INSERT INTO respuesta_consulta VALUES (null,?, ?, ?, ?, ?)");
      $query->bindParam(1, $folio_de_consulta);
      $query->bindParam(2, $respuesta);
      $query->bindParam(3, $adjunto);
      $query->bindParam(4, $extension);
      $query->bindParam(5, $folio_archivo_adjunto);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function insertar($p1)
  {
    try {
      $query = $this->dbh->prepare("INSERT INTO tabla VALUES (?)");
      $query->bindParam(1, $p1);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function Borrar($p1)
  {
    try {
      $query = $this->dbh->prepare("DELETE FROM tabla WHERE campo LIKE ?");
      $query->bindParam(1, $p1);
      $query->execute();
      return $query->fetchAll();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }

  public function Actualizar($p1, $p2)
  {
    try {
      $query = $this->dbh->prepare("UPDATE tabla SET campo1=? WHERE campo2 LIKE ?");
      $query->bindParam(1, $p1);
      $query->bindParam(2, $p2);
      $query->execute();
      $this->dbh = null;
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }



  public function __clone()
  {
    trigger_error('La clonación no es permitida!.', E_USER_ERROR);
  }
}

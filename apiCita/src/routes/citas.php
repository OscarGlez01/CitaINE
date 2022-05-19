<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;
/**
 * Metodo GET que obtiene una cita con base en su identificador
 */
$app->get('/api/cita/{id}', function(Request $request, Response $response){
    try{
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM cita WHERE id = $id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $cita = $stmt->fetch(PDO::FETCH_ASSOC);
        $data["cita"]=[
            "id" => $cita["id"],
            "folio" => $cita["folio"],
            "Ciudadano" => $db->query("SELECT * FROM ciudadano WHERE id =". $cita["idCiudadano"])->fetch(PDO::FETCH_ASSOC),
            "Modulo" => $db->query("SELECT * FROM modulo WHERE id =". $cita["idModulo"])->fetch(PDO::FETCH_ASSOC),
            "fecha" => $cita["fecha"],
            "Documento" => $db->query("SELECT * FROM documentonacionalidad WHERE id =". $cita["idDocumento"])->fetch(PDO::FETCH_ASSOC),
            "Comprobante" => $db->query("SELECT * FROM comprobantedomicilio WHERE id =". $cita["idComprobante"])->fetch(PDO::FETCH_ASSOC),
            "Tramite" => $db->query("SELECT * FROM tramite WHERE id =". $cita["idTramite"])->fetch(PDO::FETCH_ASSOC)
        ];
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    }catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

/**
 * Metodo GET que obtiene todas las citas de la base de datos.
 */
$app->get('/api/citas', function(Request $request, Response $response){
    $sql = "SELECT * FROM cita";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $citas = $stmt->fetchAll();
        $data = [];
        foreach($citas as $idCita => $cita){
            $data["citas"][] = [
                "id" => $cita["id"],
                "folio" => $cita["folio"],
                "Ciudadano" => $db->query("SELECT * FROM ciudadano WHERE id =". $cita["idCiudadano"])->fetch(PDO::FETCH_ASSOC),
                "Modulo" => $db->query("SELECT * FROM modulo WHERE id =". $cita["idModulo"])->fetch(PDO::FETCH_ASSOC),
                "fecha" => $cita["fecha"],
                "Documento" => $db->query("SELECT * FROM documentonacionalidad WHERE id =". $cita["idDocumento"])->fetch(PDO::FETCH_ASSOC),
                "Comprobante" => $db->query("SELECT * FROM comprobantedomicilio WHERE id =". $cita["idComprobante"])->fetch(PDO::FETCH_ASSOC),
                "Tramite" => $db->query("SELECT * FROM tramite WHERE id =". $cita["idTramite"])->fetch(PDO::FETCH_ASSOC)
            ];
        }
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

$app->post('/api/cita/guardar', function(Request $request, Response $response){
    try{
        $value = $request->getParsedBody();
        $idCiudadano = $value["idCiudadano"];
        $idModulo = $value["idModulo"];
        $fecha = $value["fecha"];
        $idDocumento = $value["idDocumento"];
        $idComprobante = $value["idComprobante"]; 
        $idTramite = $value["idTramite"];

        $db = new db();
        $db = $db->connect();
        include("../src/entities/Respuesta.php");
        $object = new Respuesta();
        

        $sql = "INSERT INTO cita (idCiudadano, idModulo, fecha, idDocumento, idComprobante, idTramite) VALUES (:idCiudadano, :idModulo, :fecha, :idDocumento, :idComprobante, :idTramite)";
        $statement = $db->prepare($sql);
        if($statement->execute([":idCiudadano" => $idCiudadano, ":idModulo" => $idModulo, ":fecha" => $fecha, ":idDocumento" => $idDocumento, ":idComprobante" => $idComprobante, ":idTramite" => $idTramite])){
            $object->resultado = true;
            $object->mensaje = "El usuario se guardo correctamente";

        }else {
            $object->resultado = false;
            $object->mensaje = "Ocurrio un error al guardar el usuario";
        }
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($object, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});
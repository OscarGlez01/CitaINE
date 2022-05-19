<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Obtener todas las citas
$app->get('/api/citas', function(Request $request, Response $response){
    $sql = "SELECT * FROM cita";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $citas = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($citas, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Guarda un usuario
$app->post('/api/citas/guardar', function(Request $request, Response $response){
    
    try {
        $value = json_decode($request->getBody());
        $folio = $value->folio;
        $ciudadano = $value->ciudadano;
        $fecha = $value->fecha;
        $documento = $value->documento;
        $comprobante = $value->comprobante;
        $idModulo = $value->idModulo;
        $idTramite = $value->idTramite;
        $estado = $value->estado;

        $db = new db();
        $db = $db->connect();

        include("../src/entities/Respuesta.php");
        $object = new Respuesta();

        $sql = "INSERT INTO cita (folio, ciudadano, fecha, documento, comprobante, idModulo, idTramite, estado) VALUES (:folio, :ciudadano, :fecha, :documento, :comprobante, :idModulo, :idTramite, :estado);";
        $statement = $db->prepare($sql);
        if($statement->execute([":folio" => $folio, ":ciudadano" => $ciudadano, ":fecha" => $fecha,
        ":documento" => $documento,  ":comprobante" => $comprobante, ":idModulo" => $idModulo,
        ":idTramite" => $idTramite])){
          $object->resultado = true;
          $object->mensaje = "El usuario se guardo correctamente";

        } else {
            $object->resultado = false;
            $object->mensaje="Ocurrio un error al guardar el usuario";
        }

        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($object, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});



?>